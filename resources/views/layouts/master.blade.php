<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta id="csrf-token" name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="CJ Inspired">

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.7.0/main.css" integrity="sha256-A66pMx+rXyk6CAO5trwo2V/M7hZQ2rw9Yc/FHUUFSgk=" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.7.0/main.css" integrity="sha256-M4Uz0KnKR3Zuk0PdyNLeM2fdQc3+uIV26FO5idbWJDY=" crossorigin="anonymous"> --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.7.0/main.min.css" integrity="sha256-lb6jjUl3OiZ5L/IlozGnDaOLw46mDeFx3S5goaPekPA=" crossorigin="anonymous"> --}}
    <title> @yield('page_title') | {{ config('app.name') }} </title>

    @include('partials.inc_top')
</head>

<style>

section.upcoming-events {
    display: flex;
}

section.upcoming-events .title {
    margin-left: -10px;
    color: white;
    text-align: right;
    display: inline-block;
}

section.upcoming-events .pagination {
    text-align: right;
    margin-top: -3px;
}

section.upcoming-events .headline {
    margin: 0;
}

section.upcoming-events .btn {
    margin: 0 10px;
    color: #fff;
    padding: 0;
    border: none;
    background: none;
}

section.upcoming-events .btn:hover,
section.upcoming-events .btn:active {
    color: #3caea3;
}

section.upcoming-events .card {
    width: 180px;
    height: 170px;
    padding: 20px;
    margin: 0 15px;
    border-radius: 10px;

    display: inline-block;
    background: #193d81;
}

section.upcoming-events .card .date {
    margin: 3px;
    font-size: 20px;
    color: white;
    text-align: center;
    font-weight: 800;
    font-family: 'Open Sans', sans-serif;
}

section.upcoming-events .card .event {
    font-size: 15px;
    font-weight: 700;
    text-align: center;
    color: white;
    font-family: 'Roboto Mono', monospace;
}


/* Responsiveness */

@media screen and (max-width: 1023px) {
    section.upcoming-events .title {
        width: 170px;
        font-size: 12px;
        margin-bottom: 20px;
    }
    section.upcoming-events .card {
        width: 130px;
        height: 130px;
        padding: 15px;
        margin: 0 10px;
    }
    section.upcoming-events .card .date {
        font-size: 20px;
    }
    section.upcoming-events .card .event {
        font-size: 13px;
    }
}

@media only screen and (max-width: 680px) {
    section.upcoming-events {
        flex-wrap: wrap;
        padding-right: 25px;
        padding-left: 25px;
    }
    section.upcoming-events .card {
        margin-bottom: 15px;
    }
}


</style>

<body class="{{ in_array(Route::currentRouteName(), ['payments.invoice', 'marks.tabulation', 'marks.show', 'ttr.manage', 'ttr.show']) ? 'sidebar-xs' : '' }}">

@include('partials.top_menu')
<div class="page-content">
    @include('partials.menu')
    <div class="content-wrapper">
        @include('partials.header')

        <div class="content">
            {{--Error Alert Area--}}
            @if($errors->any())
                <div class="alert alert-danger border-0 alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>

                        @foreach($errors->all() as $er)
                            <span><i class="icon-arrow-right5"></i> {{ $er }}</span> <br>
                        @endforeach

                </div>
            @endif
            <div id="ajax-alert" style="display: none"></div>

            @yield('content')
        </div>


    </div>
</div>

@include('partials.inc_bottom')
@yield('scripts')
</body>
<script>

    $(document).ready(function () {

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });

        var calendar = $('#calendar').fullCalendar({

            editable:true,
            header:{
                left:'prev,next today',
                center:'title',
                right:'month,agendaWeek,agendaDay'
            },
            events:'/dashboard',
            eventColor: '#2541b2',
            selectable: true,
            selectHelper: true,

            select:function(start, end, allDay)
            {
                var title = prompt('Event Title:');

                if(title)
                {
                    var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');

                    var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');



                    $.ajax({
                        url:"/dashboard/action",
                        type:"POST",
                        data:{
                            title: title,
                            start: start,
                            end: end,
                            type: 'add'
                        },
                        success:function(data)
                        {
                            calendar.fullCalendar('refetchEvents');
                            alert("Event Created Successfully");
                        }
                    })
                }
            },
            editable:true,

            eventResize: function(event, delta)
            {
                var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                var title = event.title;
                var id = event.id;
                $.ajax({
                    url:"/dashboard/action",
                    type:"POST",
                    data:{
                        title: title,
                        start: start,
                        end: end,
                        id: id,
                        type: 'update'
                    },
                    success:function(response)
                    {
                        calendar.fullCalendar('refetchEvents');
                        alert("Event Updated Successfully");
                    }
                })
            },
            eventDrop: function(event, delta)
            {
                var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                var title = event.title;
                var id = event.id;
                $.ajax({
                    url:"/dashboard/action",
                    type:"POST",
                    data:{
                        title: title,
                        start: start,
                        end: end,
                        id: id,
                        type: 'update'
                    },
                    success:function(response)
                    {
                        calendar.fullCalendar('refetchEvents');
                        alert("Event Updated Successfully");
                    }
                })
            },

            eventClick:function(event)
            {
                if(confirm("Are you sure you want to remove it?"))
                {
                    var id = event.id;
                    $.ajax({
                        url:"/dashboard/action",
                        type:"POST",
                        data:{
                            id:id,
                            type:"delete"
                        },
                        success:function(response)
                        {
                            calendar.fullCalendar('refetchEvents');
                            alert("Event Deleted Successfully");
                        }
                    })
                }
            }
        });

    });
</script>

<script>

    $(document).ready(function () {

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });

        var calendar = $('#viewonlycalendar').fullCalendar({
            editable:false,
            header:{
                left:'prev,next today',
                center:'title',
                right:'month,agendaWeek,agendaDay'
            },
            events:'/dashboard',
            eventColor: '#2541b2',
            selectable:false,
            selectHelper: false,
            select:function(start, end, allDay)
            {
                var title = prompt('Event Title:');

                if(title)
                {
                    var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');

                    var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');

                    $.ajax({
                        url:"/dashboard/action",
                        type:"POST",
                        data:{
                            title: title,
                            start: start,
                            end: end,
                            type: 'add'
                        },
                        success:function(data)
                        {
                            calendar.fullCalendar('refetchEvents');
                            alert("Event Created Successfully");
                        }
                    })
                }
            },



        });

    });

</script>

{{-- <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.7.0/main.js" integrity="sha256-UYwUI07v3ZaBPEu6HOJIokV15Zeh2Xj/bGT+MxtA0l0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.7.0/main.min.js" integrity="sha256-Ao+73w9IZNPf3C3Ij0Dyj5ZYdxA/xC1kobU9G2TQJyA=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.7.0/locales-all.js" integrity="sha256-JioheWkYsJTaMcygTlhzmt6Ut1dx+YAaos5dDPYu/6w=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.7.0/locales-all.min.js" integrity="sha256-6TW9hevn9VV+Dk6OtclSzIjH05B6f2WWhJ/PQgy7m7s=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.7.0/main.js" integrity="sha256-rZzBwSK1mhxhhAmAmuhuadbNunmGpnFnzfsPpGRugrQ=" crossorigin="anonymous"></script> --}}
</html>
