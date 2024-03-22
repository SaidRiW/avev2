    <!-- Modal de Eliminación -->
    <div id="modalDelete" class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto modal">
        <div class="flex items-center justify-center min-h-screen">
            <div class="panel p-8 rounded-lg overflow-hidden w-full max-w-md">
                <div class="flex justify-between items-center mb-4 dark:text-white">
                    <h2 class="text-xl font-semibold">¿Estás seguro de eliminar esta carrera?</h2>
                </div>
                <!-- Formulario de Eliminación -->
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <div class="relative mb-4">
                        <input type="text" class="form-input disabled:pointer-events-none disabled:bg-[#eee] dark:disabled:bg-[#1b2e4b] cursor-not-allowed" disabled name="nombre" class="form-input">
                    </div>
                    <div class="flex justify-between">
                        <button type="button" class="btn btn-outline-primary btn-cancel-modal">No, cancelar</button>
                        <button type="submit" class="btn btn-danger">Sí, eliminar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
