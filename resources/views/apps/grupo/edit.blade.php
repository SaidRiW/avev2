    <!-- Modal de Edición -->
    <div id="modalEdit" class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto modal">
        <div class="flex items-center justify-center min-h-screen">
            <div class="panel p-8 rounded-lg overflow-hidden w-full max-w-md">
                <div class="flex justify-between items-center mb-4 dark:text-white">
                    <h2 class="text-xl font-semibold">Editar grupo</h2>
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
                <form id="editForm" class="flex flex-col gap-4" action="" method="POST" tabindex="-1" role="dialog">
                    @csrf  
                    @method('PUT')
                    <div class="relative">
                        <label for="txtNombre">Nomenclatura del grupo</label>
                        <input type="text" id="txtNombre" name="nombre" placeholder="Nombre" class="form-input" required>
                    </div>
                    <div class="relative mb-4">
                        <label for="ctnSelect1">Carrera</label>
                        <select id="ctnSelect1" name="carrera" class="form-select text-white-dark" required>
                            @foreach ($dataCarrera as $item)
                            <option value="{{ $item->_id}}">{{ $item->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-between">
                        <button type="button" class="btn btn-outline-danger btn-cancel-modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>