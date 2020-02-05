@extends('layouts.app', ['title' => 'Staff Leave'])

@section('style')
    <style>
        .popper,
        .tooltip {
            position: absolute;
            z-index: 9999;
            background: #FFC107;
            color: black;
            width: 150px;
            border-radius: 3px;
            box-shadow: 0 0 2px rgba(0,0,0,0.5);
            padding: 10px;
            text-align: center;
        }
        .style5 .tooltip {
            background: #1E252B;
            color: #FFFFFF;
            max-width: 200px;
            width: auto;
            font-size: .8rem;
            padding: .5em 1em;
        }
        .popper .popper__arrow,
        .tooltip .tooltip-arrow {
            width: 0;
            height: 0;
            border-style: solid;
            position: absolute;
            margin: 5px;
        }

        .tooltip .tooltip-arrow,
        .popper .popper__arrow {
            border-color: #FFC107;
        }
        .style5 .tooltip .tooltip-arrow {
            border-color: #1E252B;
        }
        .popper[x-placement^="top"],
        .tooltip[x-placement^="top"] {
            margin-bottom: 5px;
        }
        .popper[x-placement^="top"] .popper__arrow,
        .tooltip[x-placement^="top"] .tooltip-arrow {
            border-width: 5px 5px 0 5px;
            border-left-color: transparent;
            border-right-color: transparent;
            border-bottom-color: transparent;
            bottom: -5px;
            left: calc(50% - 5px);
            margin-top: 0;
            margin-bottom: 0;
        }
        .popper[x-placement^="bottom"],
        .tooltip[x-placement^="bottom"] {
            margin-top: 5px;
        }
        .tooltip[x-placement^="bottom"] .tooltip-arrow,
        .popper[x-placement^="bottom"] .popper__arrow {
            border-width: 0 5px 5px 5px;
            border-left-color: transparent;
            border-right-color: transparent;
            border-top-color: transparent;
            top: -5px;
            left: calc(50% - 5px);
            margin-top: 0;
            margin-bottom: 0;
        }
        .tooltip[x-placement^="right"],
        .popper[x-placement^="right"] {
            margin-left: 5px;
        }
        .popper[x-placement^="right"] .popper__arrow,
        .tooltip[x-placement^="right"] .tooltip-arrow {
            border-width: 5px 5px 5px 0;
            border-left-color: transparent;
            border-top-color: transparent;
            border-bottom-color: transparent;
            left: -5px;
            top: calc(50% - 5px);
            margin-left: 0;
            margin-right: 0;
        }
        .popper[x-placement^="left"],
        .tooltip[x-placement^="left"] {
            margin-right: 5px;
        }
        .popper[x-placement^="left"] .popper__arrow,
        .tooltip[x-placement^="left"] .tooltip-arrow {
            border-width: 5px 0 5px 5px;
            border-top-color: transparent;
            border-right-color: transparent;
            border-bottom-color: transparent;
            right: -5px;
            top: calc(50% - 5px);
            margin-left: 0;
            margin-right: 0;
        }
        /* basic positioning */
        .legend { list-style: none; }
        .legend li { float: left; margin-right: 10px; }
        .legend span { border: 1px solid #ccc; float: left; width: 12px; height: 12px; margin: 2px; }
        /* your colors */
        .legend .Annual { background-color: #083561; }
        .legend .Halfday { background-color: #23a699; }
        .legend .Medical { background-color: #228f2a; }
        .legend .Emergency { background-color: #f56e25; }
        .legend .Unpaid { background-color: #d41111; }
        .legend .Compassionate { background-color: #70196f; }
        .legend .Maternity { background-color: #e6397b; }
        .legend .Unrecorded { background-color: #52575c; }
        .legend .Public { background-color: #fffa70; }

    </style>
@endsection
@section('content')
    @include('users.partials.header', ['title' => 'Staff Leave Calendar'])  

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card  shadow">
                    <div class="card-header bg-secondary border-0">
                        <div class="row align-items-center">
                            <div class="col-10">
                                <ul class="legend" style="margin-left: -40px;font-size: 13px;">
                                    <li>
                                        <span class="Annual" style="margin-top: 3px;border-radius: 15px;border: 1px solid black;"></span> Annual
                                    </li>
                                    <li>
                                        <span class="Halfday" style="margin-top: 3px;border-radius: 15px;border: 1px solid black;"></span> Half day
                                    </li>
                                    <li>
                                        <span class="Medical" style="margin-top: 3px;border-radius: 15px;border: 1px solid black;"></span> Medical
                                    </li>
                                    <li>
                                        <span class="Emergency" style="margin-top: 3px;border-radius: 15px;border: 1px solid black;"></span> Emergency
                                    </li>
                                    <li>
                                        <span class="Unpaid" style="margin-top: 3px;border-radius: 15px;border: 1px solid black;"></span> Unpaid
                                    </li>
                                    <li>
                                        <span class="Compassionate" style="margin-top: 3px;border-radius: 15px;border: 1px solid black;"></span> Compassionate
                                    </li>
                                    <li>
                                        <span class="Maternity" style="margin-top: 3px;border-radius: 15px;border: 1px solid black;"></span> Maternity/Paternity
                                    </li>
                                    <li>
                                        <span class="Unrecorded" style="margin-top: 3px;border-radius: 15px;border: 1px solid black;"></span> Unrecorded
                                    </li>
                                    <li>
                                        <span class="Public" style="margin-top: 3px;border-radius: 15px;border: 1px solid black;"></span> Public Holiday
                                    </li>
                                </ul>
                            </div>
                            <div class="col-2 text-right">
                                <a href="{{ route('staff-leave.create') }}" class="btn btn-sm btn-primary">Apply Leave</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <link href='{{ asset('fullCalendar/packages/core/main.css') }}' rel='stylesheet' />
    <link href='{{ asset('fullCalendar/packages/daygrid/main.css') }}' rel='stylesheet' />
    <link href='{{ asset('fullCalendar/packages/timegrid/main.css') }}' rel='stylesheet' />
    <link href='{{ asset('fullCalendar/packages/list/main.css') }}' rel='stylesheet' />
    <script src='{{ asset('fullCalendar/packages/core/main.js') }}'></script>
    <script src='{{ asset('fullCalendar/packages/interaction/main.js') }}'></script>
    <script src='{{ asset('fullCalendar/packages/daygrid/main.js') }}'></script>
    <script src='{{ asset('fullCalendar/packages/timegrid/main.js') }}'></script>
    <script src='{{ asset('fullCalendar/packages/list/main.js') }}'></script>
    <script src='{{ asset('fullCalendar/packages/google-calendar/main.js') }}'></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
    
        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list', 'googleCalendar' ],
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
            },
            googleCalendarApiKey: 'AIzaSyADnip91wbBqE3zSJBGkTfL4sbuZYR-Slg',
            navLinks: true, // can click day/week names to navigate views
            eventLimit: true, // allow "more" link when too many events
            eventRender: function (info) {
                $(info.el).tooltip({ title: info.event.title });     
            },
            businessHours: {
                daysOfWeek: [ 1, 2, 3, 4, 5 ], 
                startTime: '9:00',
                endTime: '18:00', 
            },
            eventSources: [
                [
                    @foreach($leave as $leaves)
                    {
                        title : '{{ $leaves->staff_info->name }} - {{ $leaves->title }}',
                        description : '{{ $leaves->title }}',
                        @if ($leaves->halfDay == '0')
                            start : '{{ $leaves->start }}',
                            end : '{{ $leaves->end->addDays(1) }}',
                            allDay: true,
                        @else
                            start : '{{ $leaves->start }}',
                            end : '{{ $leaves->end }}',
                        @endif

                        @if ($leaves->type == 'AL')
                            @if ($leaves->halfDay == '0')
                                color: '#083561',
                                textColor: '#ffffff',
                            @else
                                color: '#23a699',
                                textColor: '#ffffff',
                            @endif
                        @elseif($leaves->type == 'MC')
                            color: '#228f2a',
                            textColor: '#ffffff',
                        @elseif($leaves->type == 'EL')
                            color: '#f56e25',
                            textColor: '#ffffff',
                        @elseif($leaves->type == 'UP')
                            color: '#d41111',
                            textColor: '#ffffff',
                        @elseif($leaves->type == 'CL')
                            color: '#70196f',
                            textColor: '#ffffff',
                        @elseif($leaves->type == 'M' || $leaves->type == 'P')
                            color: '#e6397b',
                            textColor: '#ffffff',
                        @elseif($leaves->type == 'X')
                            color: '#52575c',
                            textColor: '#ffffff',
                        @endif
                        
                        constraint: 'businessHours'
                    },
                    @endforeach
                ],
                {
                    googleCalendarId: 'en.malaysia#holiday@group.v.calendar.google.com',
                    color: '#fffa70',
                    textColor: '#000000'
                }
            ]
        });
    
            calendar.render();
        });
    
    </script>

    @if (Session::has('success'))
    <script>
        demo.showNotification("bottom","right","done","{{ Session::get('success') }}","success");
    </script>
    @endif
@endpush