<x-layout.default>

    <link href="{{ Vite::asset('resources/css/fullcalendar.min.css') }}" rel='stylesheet' />
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/flatpickr.min.css') }}">
    <script src="/assets/js/flatpickr.js"></script>
    <script src='/assets/js/fullcalendar.min.js'></script>
    <script src='/assets/js/es.js'></script>
    <div x-data="calendar">
        <div class="panel">
            <div class="mb-5">
                <div class="mb-4 flex items-center sm:flex-row flex-col sm:justify-between justify-center">
                    <div class="sm:mb-0 mb-4">
                        <div class="text-lg font-semibold ltr:sm:text-left rtl:sm:text-right text-center">Calendario</div>
                        <div class="flex items-center mt-2 flex-wrap sm:justify-start justify-center">
                            <div class="flex items-center ltr:mr-4 rtl:ml-4">
                                <div class="h-2.5 w-2.5 rounded-sm ltr:mr-2 rtl:ml-2 bg-danger"></div>
                                <div>Alta</div>
                            </div>
                            <div class="flex items-center ltr:mr-4 rtl:ml-4">
                                <div class="h-2.5 w-2.5 rounded-sm ltr:mr-2 rtl:ml-2 bg-warning"></div>
                                <div>Media</div>
                            </div>
                            <div class="flex items-center ltr:mr-4 rtl:ml-4">
                                <div class="h-2.5 w-2.5 rounded-sm ltr:mr-2 rtl:ml-2 bg-success"></div>
                                <div>Baja</div>
                            </div>
                            @if(Auth::user()->id_rol  == 1 || Auth::user()->id_rol  == 3)
                            <div class="flex items-center ltr:mr-4 rtl:ml-4">
                                <div class="h-2.5 w-2.5 rounded-sm ltr:mr-2 rtl:ml-2 bg-primary"></div>
                                <div>Cita</div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @if(Auth::user()->id_rol == 3)
                    <button type="button" class="btn btn-primary" id="openCreateModal">

                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" class="w-5 h-5 ltr:mr-2 rtl:ml-2">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Agendar evento
                    </button>
                    @endif
                </div>
                <div class="calendar-wrapper" id='calendar'></div>
            </div>
        </div>
    </div>
    @if(Auth::user()->id_rol == 3)
        @include('apps.evento.create')
    @endif
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("calendar", () => ({
                defaultParams: ({
                    id: null,
                    title: '',
                    start: '',
                    end: '',
                    description: '',
                    type: 'primary'
                }),
                params: {
                    id: null,
                    title: '',
                    start: '',
                    end: '',
                    description: '',
                    type: 'primary'
                },
                isAddEventModal: false,
                minStartDate: '',
                minEndDate: '',
                calendar: null,
                now: new Date(),
                events: @json($eventos),
                init() {
                    console.log(this.events);
                    var calendarEl = document.getElementById('calendar');
                    this.calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'dayGridMonth',
                        headerToolbar: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'dayGridMonth,timeGridWeek,timeGridDay',
                        },
                        editable: true,
                        dayMaxEvents: true,
                        selectable: true,
                        droppable: true,
                        eventClick: function(calEvent, jsEvent, view) {
                            var url = calEvent.url;
                            if (url) {
                                window.location.href = url;
                            }
                        },
                        select: (event) => {
                            this.showCreateModal(event)
                        },
                        events: this.events,
                        locale: 'es',
                    });
                    this.calendar.render();

                    this.$watch('$store.app.sidebar', () => {
                        setTimeout(() => {
                            this.calendar.render();
                        }, 300);
                    });
                },

                showCreateModal(event) {
                    // Muestra el modal de creación
                    const modalCreate = document.getElementById('modalCreate');
                    modalCreate.classList.remove('hidden');

                    // Extrae la fecha del evento
                    const startDate = event.start;

                    // Formatea la fecha para el campo de fecha y hora
                    const formattedDate = startDate.getFullYear() + '-' + ('0' + (startDate.getMonth() + 1)).slice(-2) + '-' + ('0' + startDate.getDate()).slice(-2) + ' ' + ('0' + startDate.getHours()).slice(-2) + ':' + ('0' + startDate.getMinutes()).slice(-2);

                    // Actualiza el valor del campo de fecha y hora en el formulario
                    document.getElementById('fecha_hora').value = formattedDate;
                }

            }));

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
