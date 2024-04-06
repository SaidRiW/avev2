<x-layout.default>
    <div class="panel">
        <div class="mx-auto" style="width: 55%;"> <!-- Aquí se establece el ancho fijo deseado -->
            @foreach($data as $info)
            <div class="px-8 pt-4 pb-4 bg-gray-50 dark:bg-gray-900 flex items-center rounded-lg justify-center">
                <div class="px-5 py-4 bg-white dark:bg-gray-800 shadow rounded-lg w-screen">
                    <div class="flex mb-4">
                        <img class="w-12 h-12 rounded-full" src="{{ $info->administrador['imagen'] }}"/>
                        <div class="ml-2 mt-0.5">
                            <span class="block font-medium text-base leading-snug text-black dark:text-gray-100">{{ $info->administrador["name"] . ' ' . $info->administrador["apellido_pat"] . ' ' . $info->administrador["apellido_mat"] }}</span>
                            <span class="block text-sm text-gray-500 dark:text-gray-400 font-light leading-snug">{{ $info->servicio["servicio"] }}</span>
                        </div>
                    </div>
                    <p class="font-bold text-gray-900 dark:text-gray-100 mb-2">{{ $info->titulo }}</p>
                    <!-- Aquí usamos nl2br() para convertir los saltos de línea en etiquetas <br> -->
                    <p class="text-gray-800 dark:text-gray-100 leading-snug md:leading-normal">{!! nl2br(e($info->descripcion)) !!}</p>
                    @if($info->imagen != 'sin_imagen')
                    <img class="mt-4 mx-auto" src="{{ $info->imagen }}"/>
                    @endif
                    <div class="flex justify-end mt-5">
                        <div class="ml-1 text-gray-500 dark:text-gray-400 font-light">{{ $info->created_at->diffForHumans() }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-layout.default>