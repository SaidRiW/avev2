    <!-- Modal de creación-->
    <div id="modalCreate" class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen">
            <div class="panel p-8 rounded-lg overflow-hidden w-full max-w-md">
                <div class="flex justify-between items-center mb-4 dark:text-white">
                    <h2 class="text-xl font-semibold">{{ _('Nuevo evento') }}</h2>
                    <button id="closeCreateModal" class="text-gray-600 hover:text-gray-800 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="w-6 h-6">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <!-- Form -->
                <form class="flex flex-col gap-4" action="{{route('apps.evento.store')}}" method="POST" tabindex="-1" role="dialog" enctype="multipart/form-data">
                @csrf  
                    <div class="relative">
                        <label for="txtTitulo">Título</label>
                        <input type="text" id="txtTitulo" name="titulo" class="form-input" required />
                    </div>
                    <div class="relative">
                        <label for="txtDescripcion">Descripción</label>
                        <textarea rows="3" id="txtDescripcion" name="descripcion" class="form-textarea ltr:rounded-l-none rtl:rounded-r-none"></textarea>
                    </div>
                    <div class="relative" x-data="form">
                            <label for="fecha_hora">Fecha y hora</label>
                            <input id="fecha_hora" name="fecha_hora" class="form-input" />
                        </div>
                    <div class="relative mb-4">
                        <label>Prioridad</label>
                        <div class="mt-3">
                        @foreach ($dataPrioridad as $item)
                            <label class="inline-flex cursor-pointer ltr:mr-3 rtl:ml-3">
                                <input type="radio" class="form-radio text-{{ $item->color}}" name="prioridad"
                                    value="{{ $item->_id }}"/>
                                <span class="ltr:pl-2 rtl:pr-2">{{ $item->tipo }}</span>
                            </label>
                        @endforeach
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <button type="button" class="btn btn-outline-danger" id="cancelCreateModal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Crear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>