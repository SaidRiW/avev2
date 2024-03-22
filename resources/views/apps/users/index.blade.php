<x-layout.default>
    <div>
        <div class="panel">
            <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light">Información personal</h5>
                <a id="openEditModal""
                    class="ltr:ml-auto rtl:mr-auto btn btn-primary p-2 rounded-full">

                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                        <path opacity="0.5" d="M4 22H20" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round" />
                        <path
                            d="M14.6296 2.92142L13.8881 3.66293L7.07106 10.4799C6.60933 10.9416 6.37846 11.1725 6.17992 11.4271C5.94571 11.7273 5.74491 12.0522 5.58107 12.396C5.44219 12.6874 5.33894 12.9972 5.13245 13.6167L4.25745 16.2417L4.04356 16.8833C3.94194 17.1882 4.02128 17.5243 4.2485 17.7515C4.47573 17.9787 4.81182 18.0581 5.11667 17.9564L5.75834 17.7426L8.38334 16.8675L8.3834 16.8675C9.00284 16.6611 9.31256 16.5578 9.60398 16.4189C9.94775 16.2551 10.2727 16.0543 10.5729 15.8201C10.8275 15.6215 11.0583 15.3907 11.5201 14.929L11.5201 14.9289L18.3371 8.11195L19.0786 7.37044C20.3071 6.14188 20.3071 4.14999 19.0786 2.92142C17.85 1.69286 15.8581 1.69286 14.6296 2.92142Z"
                            stroke="currentColor" stroke-width="1.5" />
                        <path opacity="0.5"
                            d="M13.8879 3.66406C13.8879 3.66406 13.9806 5.23976 15.3709 6.63008C16.7613 8.0204 18.337 8.11308 18.337 8.11308M5.75821 17.7437L4.25732 16.2428"
                            stroke="currentColor" stroke-width="1.5" />
                    </svg>
                </a>
            </div>
            <div class="mb-5">
                <div class="flex flex-col justify-center items-center">
                    <img src="{{ Auth::user()->imagen }}" alt="image"
                        class="w-24 h-24 rounded-full object-cover  mb-5" />
                    <p class="font-semibold text-primary text-xl">{{ Auth::user()->name . ' ' . Auth::user()->apellido_pat . ' ' . Auth::user()->apellido_mat }}</p>
                </div>
                <ul class="mt-5 flex flex-col max-w-[260px] m-auto space-y-4 font-semibold text-white-dark">
                    <li class="flex items-center gap-3">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="9" cy="9" r="2" stroke="#1C274C" stroke-width="1.5"/>
                            <path d="M13 15C13 16.1046 13 17 9 17C5 17 5 16.1046 5 15C5 13.8954 6.79086 13 9 13C11.2091 13 13 13.8954 13 15Z" stroke="#1C274C" stroke-width="1.5"/>
                            <path opacity="0.5" d="M2 12C2 8.22876 2 6.34315 3.17157 5.17157C4.34315 4 6.22876 4 10 4H14C17.7712 4 19.6569 4 20.8284 5.17157C22 6.34315 22 8.22876 22 12C22 15.7712 22 17.6569 20.8284 18.8284C19.6569 20 17.7712 20 14 20H10C6.22876 20 4.34315 20 3.17157 18.8284C2 17.6569 2 15.7712 2 12Z" stroke="#1C274C" stroke-width="1.5"/>
                            <path d="M19 12H15" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                            <path d="M19 9H14" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                            <path opacity="0.9" d="M19 15H16" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                        {{  $rol->rol }}
                    </li>
                    @if(Auth::user()->id_rol == 1 || Auth::user()->id_rol == 2)
                    <li class="flex items-center gap-3">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 6V19C4 20.6569 5.34315 22 7 22H17C18.6569 22 20 20.6569 20 19V9C20 7.34315 18.6569 6 17 6H4ZM4 6V5" stroke="#1C274D" stroke-width="1.5"/>
                            <path d="M18 6.00002V6.75002H18.75V6.00002H18ZM15.7172 2.32614L15.6111 1.58368L15.7172 2.32614ZM4.91959 3.86865L4.81353 3.12619H4.81353L4.91959 3.86865ZM5.07107 6.75002H18V5.25002H5.07107V6.75002ZM18.75 6.00002V4.30604H17.25V6.00002H18.75ZM15.6111 1.58368L4.81353 3.12619L5.02566 4.61111L15.8232 3.0686L15.6111 1.58368ZM4.81353 3.12619C3.91638 3.25435 3.25 4.0227 3.25 4.92895H4.75C4.75 4.76917 4.86749 4.63371 5.02566 4.61111L4.81353 3.12619ZM18.75 4.30604C18.75 2.63253 17.2678 1.34701 15.6111 1.58368L15.8232 3.0686C16.5763 2.96103 17.25 3.54535 17.25 4.30604H18.75ZM5.07107 5.25002C4.89375 5.25002 4.75 5.10627 4.75 4.92895H3.25C3.25 5.9347 4.06532 6.75002 5.07107 6.75002V5.25002Z" fill="#1C274D"/>
                            <path opacity="0.5" d="M8 12H16" stroke="#1C274D" stroke-width="1.5" stroke-linecap="round"/>
                            <path opacity="0.5" d="M8 15.5H13.5" stroke="#1C274D" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                        {{  $admin->servicio['servicio'] }}
                    </li>
                    @endif
                    @if(Auth::user()->id_rol == 3)
                    <li class="flex items-center gap-3">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 6V19C4 20.6569 5.34315 22 7 22H17C18.6569 22 20 20.6569 20 19V9C20 7.34315 18.6569 6 17 6H4ZM4 6V5" stroke="#1C274D" stroke-width="1.5"/>
                            <path d="M18 6.00002V6.75002H18.75V6.00002H18ZM15.7172 2.32614L15.6111 1.58368L15.7172 2.32614ZM4.91959 3.86865L4.81353 3.12619H4.81353L4.91959 3.86865ZM5.07107 6.75002H18V5.25002H5.07107V6.75002ZM18.75 6.00002V4.30604H17.25V6.00002H18.75ZM15.6111 1.58368L4.81353 3.12619L5.02566 4.61111L15.8232 3.0686L15.6111 1.58368ZM4.81353 3.12619C3.91638 3.25435 3.25 4.0227 3.25 4.92895H4.75C4.75 4.76917 4.86749 4.63371 5.02566 4.61111L4.81353 3.12619ZM18.75 4.30604C18.75 2.63253 17.2678 1.34701 15.6111 1.58368L15.8232 3.0686C16.5763 2.96103 17.25 3.54535 17.25 4.30604H18.75ZM5.07107 5.25002C4.89375 5.25002 4.75 5.10627 4.75 4.92895H3.25C3.25 5.9347 4.06532 6.75002 5.07107 6.75002V5.25002Z" fill="#1C274D"/>
                            <path opacity="0.5" d="M8 12H16" stroke="#1C274D" stroke-width="1.5" stroke-linecap="round"/>
                            <path opacity="0.5" d="M8 15.5H13.5" stroke="#1C274D" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                        {{  $estudiante->grupo['grupo'] }}
                    </li>
                    @endif
                    <li>
                        <a href="javascript:;" class="flex items-center gap-3">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.5" d="M2 12C2 8.22876 2 6.34315 3.17157 5.17157C4.34315 4 6.22876 4 10 4H14C17.7712 4 19.6569 4 20.8284 5.17157C22 6.34315 22 8.22876 22 12C22 15.7712 22 17.6569 20.8284 18.8284C19.6569 20 17.7712 20 14 20H10C6.22876 20 4.34315 20 3.17157 18.8284C2 17.6569 2 15.7712 2 12Z" stroke="#1C274C" stroke-width="1.5"/>
                            <path d="M6 8L8.1589 9.79908C9.99553 11.3296 10.9139 12.0949 12 12.0949C13.0861 12.0949 14.0045 11.3296 15.8411 9.79908L18 8" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                        <span class="text-primary truncate">{{ Auth::user()->email }}</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @include('apps.users.edit')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Obtener el elemento de la etiqueta <a>
            const openEditModalButton = document.getElementById('openEditModal');

            // Obtener el modal de edición
            const editModal = document.getElementById('modalEdit');

            // Obtener el botón de cierre del modal
            const closeModalButton = editModal.querySelector('.btn-close-modal');

            // Obtener el botón de cancelar del modal
            const cancelModalButton = editModal.querySelector('.btn-cancel-modal');

            // Función para abrir el modal
            function openModal() {
                editModal.classList.remove('hidden');
                editModal.classList.add('flex');
            }

            // Función para cerrar el modal
            function closeModal() {
                editModal.classList.remove('flex');
                editModal.classList.add('hidden');
            }

            // Función para cancelar el modal
            function cancelModal() {
                editModal.classList.remove('flex');
                editModal.classList.add('hidden');
            }

            // Agregar evento de clic al botón de apertura del modal
            openEditModalButton.addEventListener('click', function () {
                openModal();
            });

            // Agregar evento de clic al botón de cierre del modal
            closeModalButton.addEventListener('click', function () {
                closeModal();
            });

            // Agregar evento de clic al botón de cancelar del modal
            cancelModalButton.addEventListener('click', function () {
                cancelModal();
            });

            // Escucha el evento change en el input de tipo file
            document.getElementById("ctnFile").addEventListener("change", function (event) {
                // Obtiene el archivo seleccionado
                const file = event.target.files[0];
                if (file) {
                    // Crea un objeto URL para la imagen seleccionada
                    const imageUrl = URL.createObjectURL(file);
                    // Actualiza la imagen de vista previa en el formulario
                    document.querySelector(".preview-image").src = imageUrl;
                }
            });
        });
    </script>
</x-layout.default>
