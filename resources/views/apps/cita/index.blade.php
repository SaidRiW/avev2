<x-layout.default>

    <script src="/assets/js/simple-datatables.js"></script>
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/flatpickr.min.css') }}">
    <script src="/assets/js/flatpickr.js"></script>

    <div x-data="striped">
        <div class="panel">
            <div>
                <div class="md:absolute md:top-5 ltr:md:left-5 rtl:md:right-5">
                    <div class="flex items-center gap-2 mb-5">
                        <a class="btn btn-primary gap-2" id="openCreateModal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" class="w-5 h-5">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            Agendar cita
                        </a>
                    </div>
                </div>
            </div>
            <table id="tableHover" class="table-hover"></table>
        </div>
    </div>
    @include('apps.cita.create')
    @include('apps.cita.edit')
    @include('apps.cita.delete')
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("striped", () => ({
                init() {
                    const tableOptions = {
                        data: {
                            headings: ["#", "Matricula", "Estudiante", "Fecha/Hora", "Motivo", "Grupo", "Acciones"],
                            data: [
                                @php
                                    $cont = 1 ;  
                                @endphp       
                                @foreach($data as $info)
                                    @php
                                        $motivoEscapada = addcslashes($info->motivo, "\n\r\"'\\");
                                    @endphp
                                    [
                                        '{{ $cont }}',
                                        '{{ $info->estudiante["matricula"] }}',
                                        '{{ $info->estudiante["name"] }} {{ $info->estudiante["apellido_pat"] }} {{ $info->estudiante["apellido_mat"] }}',
                                        @if ($info->fecha_hora == '1969-12-31 18:00:00 PM')
                                            '{{'Sin fecha, editar cita.'}}',
                                        @else
                                            '{{ $info->fecha_hora }}',
                                        @endif
                                        '{{ $motivoEscapada }}',
                                        '{{ $info->grupo["grupo"] }}',
                                        '<button type="button" class="hover:text-info edit-button" data-id="{{ $info->_id }}"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 ltr:mr-2 rtl:ml-2"><path d="M15.2869 3.15178L14.3601 4.07866L5.83882 12.5999L5.83881 12.5999C5.26166 13.1771 4.97308 13.4656 4.7249 13.7838C4.43213 14.1592 4.18114 14.5653 3.97634 14.995C3.80273 15.3593 3.67368 15.7465 3.41556 16.5208L2.32181 19.8021L2.05445 20.6042C1.92743 20.9852 2.0266 21.4053 2.31063 21.6894C2.59466 21.9734 3.01478 22.0726 3.39584 21.9456L4.19792 21.6782L7.47918 20.5844L7.47919 20.5844C8.25353 20.3263 8.6407 20.1973 9.00498 20.0237C9.43469 19.8189 9.84082 19.5679 10.2162 19.2751C10.5344 19.0269 10.8229 18.7383 11.4001 18.1612L11.4001 18.1612L19.9213 9.63993L20.8482 8.71306C22.3839 7.17735 22.3839 4.68748 20.8482 3.15178C19.3125 1.61607 16.8226 1.61607 15.2869 3.15178Z" stroke="currentColor" stroke-width="1.5"/><path opacity="0.5" d="M14.36 4.07812C14.36 4.07812 14.4759 6.04774 16.2138 7.78564C17.9517 9.52354 19.9213 9.6394 19.9213 9.6394M4.19789 21.6777L2.32178 19.8015" stroke="currentColor" stroke-width="1.5"/></svg></button><button type="button" class="hover:text-danger delete-button" data-id="{{ $info->_id }}"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"><path d="M20.5001 6H3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><path d="M18.8334 8.5L18.3735 15.3991C18.1965 18.054 18.108 19.3815 17.243 20.1907C16.378 21 15.0476 21 12.3868 21H11.6134C8.9526 21 7.6222 21 6.75719 20.1907C5.89218 19.3815 5.80368 18.054 5.62669 15.3991L5.16675 8.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><path opacity="0.5" d="M9.5 11L10 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><path opacity="0.5" d="M14.5 11L14 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><path opacity="0.5" d="M6.5 6C6.55588 6 6.58382 6 6.60915 5.99936C7.43259 5.97849 8.15902 5.45491 8.43922 4.68032C8.44784 4.65649 8.45667 4.62999 8.47434 4.57697L8.57143 4.28571C8.65431 4.03708 8.69575 3.91276 8.75071 3.8072C8.97001 3.38607 9.37574 3.09364 9.84461 3.01877C9.96213 3 10.0932 3 10.3553 3H13.6447C13.9068 3 14.0379 3 14.1554 3.01877C14.6243 3.09364 15.03 3.38607 15.2493 3.8072C15.3043 3.91276 15.3457 4.03708 15.4286 4.28571L15.5257 4.57697C15.5433 4.62992 15.5522 4.65651 15.5608 4.68032C15.841 5.45491 16.5674 5.97849 17.3909 5.99936C17.4162 6 17.4441 6 17.5 6" stroke="currentColor" stroke-width="1.5"/></svg></button>'
                                    ],
                                    @php
                                        $cont++;
                                    @endphp
                                @endforeach
                            ]
                        },
                        sortable: false,
                        searchable: true,
                        perPage: 10,
                        perPageSelect: [10, 20, 30, 50, 100],
                        firstLast: true,
                        firstText: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                        lastText: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M11 19L17 12L11 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> <path opacity="0.5" d="M6.99976 19L12.9998 12L6.99976 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                        prevText: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M15 5L9 12L15 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                        nextText: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                        labels: {
                            perPage: "{select}"
                        },
                        layout: {
                            top: "{search}",
                            bottom: "{info}{select}{pager}",
                        },
                    };

                    const datatable2 = new simpleDatatables.DataTable('#tableHover', tableOptions);

                    //CREAR REGISTRO
                    const openCreateModalButton = document.getElementById('openCreateModal');
                    const closeCreateModalButton = document.getElementById('closeCreateModal');
                    const cancelCreateModalButton = document.getElementById('cancelCreateModal');
                    const modalCreate = document.getElementById('modalCreate');

                    openCreateModalButton.addEventListener('click', function () {
                        modalCreate.classList.remove('hidden');
                    });

                    closeCreateModalButton.addEventListener('click', function () {
                        modalCreate.classList.add('hidden');
                    });

                    cancelCreateModalButton.addEventListener('click', function () {
                        modalCreate.classList.add('hidden');
                    });

                    // Función para mostrar el modal de edición
                    function showModalEdit(id, matricula, motivo, fecha_hora) {
                        const modalEdit = document.getElementById('modalEdit');
                        const editForm = document.getElementById('editForm');
                        editForm.action = '/apps/cita/' + id;
                        editForm.querySelector('input[name="matricula"]').value = matricula;
                        editForm.querySelector('textarea[name="motivo"]').value = motivo;
                        editForm.querySelector('input[name="fecha_hora"]').value = fecha_hora;

                        modalEdit.classList.remove('hidden');
                    }

                    // Función para mostrar el modal de eliminación
                    function showModalDelete(id, nombre) {
                        const modalDelete = document.getElementById('modalDelete');
                        const deleteForm = document.getElementById('deleteForm');
                        deleteForm.action = '/apps/cita/' + id;
                        deleteForm.querySelector('input[name="matricula"]').value = nombre;
                        modalDelete.classList.remove('hidden');
                    }

                    // Función para obtener los datos del registro al hacer clic al botón de editar y abrir el modal
                    const editButtons = document.querySelectorAll('.edit-button');
                    editButtons.forEach(button => {
                        button.addEventListener('click', function () {
                            const id = this.dataset.id; // Obtener el ID de la publicación
                            const matricula = this.parentNode.parentNode.querySelector('td:nth-child(2)').textContent.trim();
                            const motivo = this.parentNode.parentNode.querySelector('td:nth-child(5)').textContent.trim();
                            const fecha_hora = this.parentNode.parentNode.querySelector('td:nth-child(4)').textContent.trim();
                            showModalEdit(id, matricula, motivo, fecha_hora);
                        });
                    });

                    // Función para obtener los datos del registro al hacer clic al botón de eliminar y abrir el modal
                    const deleteButtons = document.querySelectorAll('.delete-button');
                    deleteButtons.forEach(button => {
                        button.addEventListener('click', function () {
                            const id = this.dataset.id; // Obtener el ID de la publicación
                            const nombre = this.parentNode.parentNode.querySelector('td:nth-child(3)').textContent.trim();
                            showModalDelete(id, nombre);
                        });
                    });

                    // Cerrar modal al hacer clic en el botón de cancelar
                    const closeButtons = document.querySelectorAll('.btn-close-modal, .btn-cancel-modal');
                    closeButtons.forEach(button => {
                        button.addEventListener('click', function () {
                            const modals = document.querySelectorAll('.modal'); // Seleccionar solo los modales
                            modals.forEach(modal => {
                                modal.classList.add('hidden');
                            });
                        });
                    });
                }
            }));
            Alpine.data("form", () => ({
                init() {
                    flatpickr(document.getElementById('fecha_hora'), {
                        enableTime: true,
                        dateFormat: 'Y-m-d H:i'
                    })
                }
            }));
            Alpine.data("formEdit", () => ({
                init() {
                    flatpickr(document.getElementById('fecha_horaEdit'), {
                        enableTime: true,
                        dateFormat: 'Y-m-d H:i'
                    })
                }
            }));
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var txtMatricula = document.getElementById('txtMatricula');
            txtMatricula.addEventListener('change', function() {
                var matricula = this.value;
                fetch('/apps/cita/estudiante/' + matricula)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('nombreEstudiante').value = data.nombre;
                        } else {
                            document.getElementById('nombreEstudiante').value = 'No existe este estudiante';
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    </script>

@if(session('success'))
    <script>
        // Definición de la función showAlert
        async function showAlert() {
            new window.Swal({
                icon: 'success',
                title: '{{ session("success") }}',
                confirmButtonText: 'Cerrar',
                buttonsStyling: false, // Desactiva el estilo por defecto de los botones
                customClass: {
                    confirmButton: 'btn btn-dark my-custom-class', // Aplica una clase propia para personalizar el botón
                }
            });
        }

        // Llamar a showAlert cuando la página se carga
        window.onload = function() {
            showAlert();
        };
    </script>
    <style>
        .my-custom-class {
            margin-top: 20px;
        }
    </style>
@endif
@if(session('error'))
    <script>
        // Definición de la función showAlert
        async function showAlert() {
            new window.Swal({
                title: '{{ session("error") }}',
                confirmButtonText: 'Cerrar',
                buttonsStyling: false, // Desactiva el estilo por defecto de los botones
                customClass: {
                    confirmButton: 'btn btn-dark my-custom-class', // Aplica una clase propia para personalizar el botón
                }
            });
        }

        // Llamar a showAlert cuando la página se carga
        window.onload = function() {
            showAlert();
        };
    </script>
    <style>
        .my-custom-class {
            margin-top: 20px;
        }
    </style>
@endif
</x-layout.default>
