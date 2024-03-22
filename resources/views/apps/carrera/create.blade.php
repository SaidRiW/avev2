    <!-- Modal de creación-->
    <div id="modalCreate" class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen">
            <div class="panel p-8 rounded-lg overflow-hidden w-full max-w-md">
                <div class="flex justify-between items-center mb-4 dark:text-white">
                    <h2 class="text-xl font-semibold">{{ _('Nueva carrera') }}</h2>
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
                <form class="flex flex-col gap-4" action="{{route('apps.carrera.store')}}" method="POST" tabindex="-1" role="dialog">
                @csrf  
                    <div class="relative mb-4">
                        <input type="text" name="nombre" placeholder="Nombre" class="form-input" required />
                    </div>
                    <div class="flex justify-between">
                        <button type="button" class="btn btn-outline-danger" id="cancelCreateModal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>