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
    @include('apps.cita_estudiante.create')
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("striped", () => ({
                init() {
                    const tableOptions = {
                        data: {
                            headings: ["#", "Administrativo", "Fecha/Hora", "Motivo", "Servicio"],
                            data: [
                                @php
                                    $cont = 1 ;  
                                @endphp       
                                @foreach($data as $info)
                                    [
                                        '{{ $cont }}',
                                        '{{ $info->administrador["name"] }} {{ $info->administrador["apellido_pat"] }} {{ $info->administrador["apellido_mat"] }}',
                                        @if ($info->fecha_hora == '1969-12-31 18:00:00 PM')
                                            '{{'Sin fecha, cancelar cita.'}}',
                                        @else
                                            '{{ $info->fecha_hora }}',
                                        @endif
                                        '{{ $info->motivo }}',
                                        '{{ $info->servicio["servicio"] }}',
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
        });
    </script>

</x-layout.default>
