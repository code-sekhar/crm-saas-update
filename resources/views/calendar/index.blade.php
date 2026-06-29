<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl">

Calendar

</h2>

    </x-slot>

    <div class="py-6">

        <div class="  mx-auto">

            <div class="bg-white shadow rounded-xl p-6">

                <div id="calendar"></div>

            </div>

        </div>

    </div>

    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css" rel="stylesheet">

    {{-- <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {

                initialView: 'dayGridMonth',

                height: 700,

                events: '{{ route("calendar.events") }}',

                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },

                displayEventTime: true,

                eventClick: function(info) {
                    if (info.event.url) {
                        info.jsEvent.preventDefault();
                        window.location.href = info.event.url;
                    }
                },

                eventDidMount: function(info) {

                    info.el.title =
                        "Lead: " + info.event.title + "\n" +
                        "Time: " + (info.event.extendedProps.time ?? '-') + "\n" +
                        "Priority: " + (info.event.extendedProps.priority ?? '-') + "\n" +
                        "Status: " + (info.event.extendedProps.status ?? '-');

                },
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true
                },
                editable:true,

                eventDrop:function(info){

                    fetch('/calendar/follow-up/'+info.event.id,{

                        method:'PUT',

                        headers:{

                            'Content-Type':'application/json',

                            'X-CSRF-TOKEN':'{{ csrf_token() }}'

                        },

                        body:JSON.stringify({

                            follow_up_date:info.event.startStr.substring(0,10)

                        })

                    })

                    .then(res=>res.json())

                    .then(data=>{

                        alert('Follow-up Rescheduled Successfully');

                    })

                    .catch(()=>{

                        info.revert();

                        alert('Update Failed');

                    });

                },
                // dateClick: function(info) {

                //     window.location.href =
                //         "/follow-ups/create?date=" + info.dateStr;

                // },
                // plugins: [
                //     FullCalendar.dayGridPlugin,
                //     FullCalendar.timeGridPlugin,
                //     FullCalendar.listPlugin,
                //     FullCalendar.interactionPlugin
                // ],

                editable: true,
                selectable: true,

            });

            calendar.render();

        });
        </script>

</x-app-layout>
