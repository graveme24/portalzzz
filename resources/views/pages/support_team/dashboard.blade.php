@extends('layouts.master')
@section('page_title', 'My Dashboard')
@section('content')
    @if(Qs::userIsTeamSA())
       <div class="row">
           <div class="col-sm-6 col-xl-3">
               <div class="card card-body bg-blue-400 has-bg-image">
                   <div class="media">
                       <div class="media-body">
                           <h3 class="mb-0">{{ $users->where('user_type', 'student')->count() }}</h3>
                           <span class="text-uppercase font-size-xs font-weight-bold">Total Students</span>
                       </div>

                       <div class="ml-3 align-self-center">
                           <i class="icon-users4 icon-3x opacity-75"></i>
                       </div>
                   </div>
               </div>
           </div>

           <div class="col-sm-6 col-xl-3">
               <div class="card card-body bg-danger-400 has-bg-image">
                   <div class="media">
                       <div class="media-body">
                           <h3 class="mb-0">{{ $users->where('user_type', 'teacher')->count() }}</h3>
                           <span class="text-uppercase font-size-xs">Total Teachers</span>
                       </div>

                       <div class="ml-3 align-self-center">
                           <i class="icon-users2 icon-3x opacity-75"></i>
                       </div>
                   </div>
               </div>
           </div>

           <div class="col-sm-6 col-xl-3">
               <div class="card card-body bg-success-400 has-bg-image">
                   <div class="media">
                       <div class="mr-3 align-self-center">
                           <i class="icon-pointer icon-3x opacity-75"></i>
                       </div>

                       <div class="media-body text-right">
                           <h3 class="mb-0">{{ $users->where('user_type', 'admin')->count() }}</h3>
                           <span class="text-uppercase font-size-xs">Total Administrators</span>
                       </div>
                   </div>
               </div>
           </div>

           <div class="col-sm-6 col-xl-3">
               <div class="card card-body bg-indigo-400 has-bg-image">
                   <div class="media">
                       <div class="mr-3 align-self-center">
                           <i class="icon-user icon-3x opacity-75"></i>
                       </div>

                       <div class="media-body text-right">
                           <h3 class="mb-0">{{ $users->where('user_type', 'parent')->count() }}</h3>
                           <span class="text-uppercase font-size-xs">Total Parents</span>
                       </div>
                   </div>
               </div>
           </div>
       </div>



    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">School Calendar</h5>
         {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <div id='calendar'></div>
        </div>

    </div>
    @endif

    {{--Events Calendar Begins--}}
    @if(Qs::userIsViewOnly())

    <div class="card">
        <div class="card-header header-elements-inline">

            <h2 class="headline">Upcoming Events</h2>
         {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">

            @if(count($events) > 0)
            <section class="section upcoming-events">
              <div class="title">
                @if(count($events) > 4)
                <div class="pagination" style="text-align: right;
                margin-top: -3px;">
                  <button class="btn btn-left">
                    <i class="fa fa-3x fa-angle-left"></i>
                  </button>
                  <button class="btn btn-right">
                    <i class="fa fa-3x fa-angle-right"></i>
                  </button>
                </div>
                @endif
              </div>
              @foreach ($events as $event)
              <div class="card">
                <h3 class="date">{{ $event->getEventDate() }}</h3>
                <p class="event">{{ $event->title }}</p>
              </div>
              @endforeach

            </section>
            @endif

        </div>

    </div>
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">School Calendar</h5>
         {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <div id='viewonlycalendar'></div>
        </div>

    </div>
    @endif

    {{--Events Calendar Ends--}}
    @endsection

