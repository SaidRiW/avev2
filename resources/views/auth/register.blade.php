<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nombre -->
        <div>
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Apellido paterno -->
        <div>
            <x-input-label for="apellido_pat" :value="__('Apellido paterno')" />
            <x-text-input id="apellido_pat" class="block mt-1 w-full" type="text" name="apellido_pat" :value="old('apellido_pat')" required autofocus autocomplete="apellido_pat" />
            <x-input-error :messages="$errors->get('apellido_pat')" class="mt-2" />
        </div>

        <!-- Apellido materno -->
        <div>
            <x-input-label for="apellido_mat" :value="__('Apellido materno')" />
            <x-text-input id="apellido_mat" class="block mt-1 w-full" type="text" name="apellido_mat" :value="old('apellido_mat')" required autofocus autocomplete="apellido_mat" />
            <x-input-error :messages="$errors->get('apellido_mat')" class="mt-2" />
        </div>

        <!-- Correo institucional -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Correo institucional')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Tipo de Usuario -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Tipo de usuario')" />
            <select id="role" class="block mt-1 w-full" name="role" required>
                <option value=3>Estudiante</option>
                <option value=1>Administrador</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Campos adicionales -->
        <div class="mt-4" id="additional_fields" style="display: none;">
            <!-- Matrícula -->
            <div id="matricula_field">
                <x-input-label for="matricula" :value="__('Matrícula')" />
                <x-text-input id="matricula" class="block mt-1 w-full" type="text" name="matricula" :value="old('matricula')" />
                <x-input-error :messages="$errors->get('matricula')" class="mt-2" />
            </div>

            <!-- Grupo -->
            <div id="grupo_field">
                <x-input-label for="grupo" :value="__('Grupo')" />
                <select id="grupo" class="block mt-1 w-full" name="grupo" required>
                        @foreach ($dataGrupo as $item)
                            <option value="{{ $item->_id}}">{{ $item->nombre }}</option>
                        @endforeach
                </select>
                <x-input-error :messages="$errors->get('grupo')" class="mt-2" />
            </div>

            <!-- Servicio -->
            <div id="servicio_field">
                <x-input-label for="servicio" :value="__('Servicio')" />
                <select id="servicio" class="block mt-1 w-full" name="servicio" required>
                        @foreach ($dataServicio as $item)
                            <option value="{{ $item->_id}}">{{ $item->nombre }}</option>
                        @endforeach
                </select>
                <x-input-error :messages="$errors->get('servicio')" class="mt-2" />
            </div>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('¿Ya estás registrado?') }}
            </a>

            <x-primary-button class="ms-4" style="background-color: #001f3f;">
                {{ __('Registrar') }}
            </x-primary-button>
        </div>
    </form>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            function showAdditionalFields() {
                var role = document.getElementById('role').value;

                //Mostrar el campo adicional correspondiente al tipo de usuario seleccionado
                if (role == 3) {
                    document.getElementById('matricula_field').style.display = 'block';
                    document.getElementById('grupo_field').style.display = 'block';
                    document.getElementById('servicio_field').style.display = 'none'; //Ocultar otro campo
                } else if (role == 1) {
                    document.getElementById('servicio_field').style.display = 'block';
                    document.getElementById('matricula_field').style.display = 'none'; //Ocultar otro campo
                    document.getElementById('grupo_field').style.display = 'none'; //Ocultar otro campo
                }

                if (role == 3 || role == 1) {
                    document.getElementById('additional_fields').style.display = 'block';
                } else {
                    document.getElementById('additional_fields').style.display = 'none';
                }
            }

            //Mostrar los campos adicionales al cargar la página si hay un valor seleccionado por defecto
            showAdditionalFields();

            //Agregar el evento change al campo de selección de rol
            document.getElementById('role').addEventListener('change', function() {
                showAdditionalFields();
            });
        });
    </script>
</x-guest-layout>
