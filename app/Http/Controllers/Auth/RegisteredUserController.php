<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Grupo;
use App\Models\Servicio;
use App\Models\Rol;
use App\Models\Estudiante;
use App\Models\Administrador;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $dataGrupo = Grupo::all();
        $dataServicio = Servicio::all();
        $dataRol = Rol::where('rol', '!=', 'SuperAdmin')->get();
        return view('auth.register')->with(compact('dataGrupo','dataServicio','dataRol'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $servicio = Servicio::find($request->servicio);
        $roleId = intval($request->role);

        if ($roleId !== 2 && $servicio->nombre == 'Docencia') {
            $roleId = 2;
        }

        $user = User::create([
            'name' => $request->name,
            'apellido_pat' => $request->apellido_pat,
            'apellido_mat' => $request->apellido_mat,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_rol' => $roleId,
            'imagen' => '/assets/images/user.jpg',
        ]);

        event(new Registered($user));

        if ($request->role === '1') {

            $admin = new Administrador;
            $admin->id_user = $user->id;
            $admin->servicio = [
                'id_servicio' => $servicio->_id,
                'servicio' => $servicio->nombre,
            ];
            $admin->created_at = date("Y-m-d h:m:s");
            $admin->save();

        } elseif ($request->role === '3') {
            $grupo = Grupo::find($request->grupo);

            $estudiante = new Estudiante;
            $estudiante->id_user = $user->id;
            $estudiante->matricula = $request->matricula;
            $estudiante->grupo = [
                'id_grupo' => $grupo->_id,
                'grupo' => $grupo->nombre,
            ];
            $estudiante->created_at = date("Y-m-d h:m:s");
            $estudiante->save();

        }

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
