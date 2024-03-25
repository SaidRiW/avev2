    <!-- Modal de Edición -->
    <div id="modalEdit" class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto modal">
        <div class="flex items-center justify-center min-h-screen">
            <div class="panel p-8 rounded-lg overflow-hidden w-full max-w-md">
                <div class="flex justify-between items-center mb-4 dark:text-white">
                    <h2 class="text-xl font-semibold">Editar publicación</h2>
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
                <form id="editForm" class="flex flex-col gap-4" action="" method="POST" tabindex="-1" role="dialog" enctype="multipart/form-data">
                    @csrf  
                    @method('PUT')
                    <div class="relative">
                        <label for="txtTitulo">Título</label>
                        <input type="text" id="txtTitulo" name="titulo" class="form-input" required />
                    </div>
                    <div class="relative">
                        <label for="txtDescripcion">Descripción</label>
                        <textarea rows="3" id="txtDescripcion" name="descripcion" class="form-textarea ltr:rounded-l-none rtl:rounded-r-none"></textarea>
                    </div>
                    <div class="relative">
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
                    <div class="relative">
                        <label for="ctnSelect2">Grupo a enviar</label>
                        <select id="ctnSelect2" name="grupo" class="form-select text-white-dark" required>
                            @foreach ($dataGrupo as $item)
                            <option value="{{ $item->_id}}">{{ $item->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="relative">
                        <label for="ctnFile">Imagen</label>
                        <input id="ctnFile" type="file" name="imagen" accept="image/x-png,image/gif,image/jpeg,image/jpg" class="form-input file:py-2 file:px-4 file:border-0 file:font-semibold p-0 file:bg-primary/90 ltr:file:mr-5 rtl:file:ml-5 file:text-white file:hover:bg-primary" />
                    </div>
                    <!-- Enlace para abrir los campos de fechas -->
                    <a href="#" id="toggleDateFieldsEdit" class="text-primary underline">Si esta publicación es un evento, clic aquí.</a>

                    <!-- Campos de fechas que se muestran al dar click al enlace -->
                    <div id="dateFieldsEdit" style="display: none;">
                        <div class="relative mb-4" x-data="formEdit">
                            <label for="fechaInicioEdit">Fecha inicial</label>
                            <input id="fechaInicioEdit" name="fechaInicio" class="form-input"/>
                        </div>
                        <div class="relative mb-4" x-data="formEdit">
                            <label for="fechaFinEdit">Fecha final</label>
                            <input id="fechaFinEdit" name="fechaFin" class="form-input"/>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <button type="button" class="btn btn-outline-danger btn-cancel-modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>