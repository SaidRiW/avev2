    <!-- Modal de Edición -->
    <div id="modalEdit" class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto modal flex items-center justify-center">
        <div class="flex items-center justify-center min-h-screen">
            <div class="panel p-8 rounded-lg overflow-hidden max-w-[90%] w-full max-w-md">
                <div class="flex justify-between items-center mb-4 dark:text-white">
                    <h2 class="text-xl font-semibold">Cambiar foto de perfil</h2>
                    <button class="btn-close-modal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="w-6 h-6">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <!-- Formulario de Edición -->
                <form id="editForm" class="flex flex-col gap-4" action="{{ route('apps.users.update') }}" method="POST" tabindex="-1" role="dialog" enctype="multipart/form-data">
                    @csrf  
                    @method('PUT')
                    <div class="flex items-center justify-center">
                        <img src="{{ Auth::user()->imagen }}" alt="image" class="w-24 h-24 rounded-full object-cover  mb-5 preview-image"/>
                    </div>
                    <div class="relative">
                        <input id="ctnFile" type="file" name="imagen" accept="image/x-png,image/gif,image/jpeg,image/jpg" class="form-input file:py-2 file:px-4 file:border-0 file:font-semibold p-0 file:bg-primary/90 ltr:file:mr-5 rtl:file:ml-5 file:text-white file:hover:bg-primary" />
                    </div>
                    <div class="flex justify-between">
                        <button type="button" class="btn btn-outline-danger btn-cancel-modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>