<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Haven of Wisdom Academy</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="stylesheet" href="fontawesome-5.5/css/all.min.css" />
        <link rel="stylesheet" href="slick/slick.css">
        <link rel="stylesheet" href="slick/slick-theme.css">
        <link rel="stylesheet" href="magnific-popup/magnific-popup.css">
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/tooplate-infinite-loop.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.7.0/main.css" integrity="sha256-A66pMx+rXyk6CAO5trwo2V/M7hZQ2rw9Yc/FHUUFSgk=" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.7.0/main.css" integrity="sha256-M4Uz0KnKR3Zuk0PdyNLeM2fdQc3+uIV26FO5idbWJDY=" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.7.0/main.min.css" integrity="sha256-lb6jjUl3OiZ5L/IlozGnDaOLw46mDeFx3S5goaPekPA=" crossorigin="anonymous">

        <title> @yield('page_title') | {{ config('app.name') }} </title>

        @include('partials.inc_top')
    </head>
    <body class="{{ in_array(Route::currentRouteName(), ['payments.invoice', 'marks.tabulation', 'marks.show', 'ttr.manage', 'ttr.show']) ? 'sidebar-xs' : '' }}">
        {{-- @include('partials.top_menu')
        <div class="page-content">
            @include('partials.menu')
            <div class="content-wrapper">
                @include('partials.header') --}}


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



            {{-- </div>
        </div> --}}
        @include('partials.inc_bottom')
        @yield('scripts')
        <script>

            function getOffSet(){
              var _offset = 450;
              var windowHeight = window.innerHeight;

              if(windowHeight > 500) {
                _offset = 400;
              }
              if(windowHeight > 680) {
                _offset = 300
              }
              if(windowHeight > 830) {
                _offset = 210;
              }

              return _offset;
            }

            function setParallaxPosition($doc, multiplier, $object){
              var offset = getOffSet();
              var from_top = $doc.scrollTop(),
                bg_css = 'center ' +(multiplier * from_top - offset) + 'px';
              $object.css({"background-position" : bg_css });
            }

            // Parallax function
            // Adapted based on https://codepen.io/roborich/pen/wpAsm
            var background_image_parallax = function($object, multiplier, forceSet){
              multiplier = typeof multiplier !== 'undefined' ? multiplier : 0.5;
              multiplier = 1 - multiplier;
              var $doc = $(document);
              // $object.css({"background-attatchment" : "fixed"});

              if(forceSet) {
                setParallaxPosition($doc, multiplier, $object);
              } else {
                $(window).scroll(function(){
                  setParallaxPosition($doc, multiplier, $object);
                });
              }
            };

            var background_image_parallax_2 = function($object, multiplier){
              multiplier = typeof multiplier !== 'undefined' ? multiplier : 0.5;
              multiplier = 1 - multiplier;
              var $doc = $(document);
              $object.css({"background-attachment" : "fixed"});

              $(window).scroll(function(){
                if($(window).width() > 768) {
                  var firstTop = $object.offset().top,
                      pos = $(window).scrollTop(),
                      yPos = Math.round((multiplier * (firstTop - pos)) - 186);

                  var bg_css = 'center ' + yPos + 'px';

                  $object.css({"background-position" : bg_css });
                } else {
                  $object.css({"background-position" : "center" });
                }
              });
            };

            $(function(){
              // Hero Section - Background Parallax
              background_image_parallax($(".tm-parallax"), 0.30, false);
              background_image_parallax_2($("#contact"), 0.80);
              background_image_parallax_2($("#testimonials"), 0.80);

              // Handle window resize
              window.addEventListener('resize', function(){
                background_image_parallax($(".tm-parallax"), 0.30, true);
              }, true);

              // Detect window scroll and update navbar
              $(window).scroll(function(e){
                if($(document).scrollTop() > 120) {
                  $('.tm-navbar').addClass("scroll");
                } else {
                  $('.tm-navbar').removeClass("scroll");
                }
              });

              // Close mobile menu after click
              $('#tmNav a').on('click', function(){
                $('.navbar-collapse').removeClass('show');
              })

              // Scroll to corresponding section with animation
              $('#tmNav').singlePageNav({
                'easing': 'easeInOutExpo',
                'speed': 600
              });

              // Add smooth scrolling to all links
              // https://www.w3schools.com/howto/howto_css_smooth_scroll.asp
              $("a").on('click', function(event) {
                if (this.hash !== "") {
                  event.preventDefault();
                  var hash = this.hash;

                  $('html, body').animate({
                    scrollTop: $(hash).offset().top
                  }, 600, 'easeInOutExpo', function(){
                    window.location.hash = hash;
                  });
                } // End if
              });

              // Pop up
            //   $('.tm-gallery').magnificPopup({
            //     delegate: 'a',
            //     type: 'image',
            //     gallery: { enabled: true }
            //   });

              $('.tm-testimonials-carousel').slick({
                dots: true,
                prevArrow: false,
                nextArrow: false,
                infinite: false,
                slidesToShow: 3,
                slidesToScroll: 1,
                responsive: [
                  {
                    breakpoint: 992,
                    settings: {
                      slidesToShow: 2
                    }
                  },
                  {
                    breakpoint: 768,
                    settings: {
                      slidesToShow: 2
                    }
                  },
                  {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1
                    }
                  }
                ]
              });

              // Gallery
            //   $('.tm-gallery').slick({
            //     dots: true,
            //     infinite: false,
            //     slidesToShow: 5,
            //     slidesToScroll: 2,
            //     responsive: [
            //     {
            //       breakpoint: 1199,
            //       settings: {
            //         slidesToShow: 4,
            //         slidesToScroll: 2
            //       }
            //     },
            //     {
            //       breakpoint: 991,
            //       settings: {
            //         slidesToShow: 3,
            //         slidesToScroll: 2
            //       }
            //     },
            //     {
            //       breakpoint: 767,
            //       settings: {
            //         slidesToShow: 2,
            //         slidesToScroll: 1
            //       }
            //     },
            //     {
            //       breakpoint: 480,
            //       settings: {
            //         slidesToShow: 1,
            //         slidesToScroll: 1
            //       }
            //     }
            //   ]
            //   });
            });

        </script>
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
                    selectable:true,
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

        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery-1.9.1.min.js"></script>
        <script src="slick/slick.min.js"></script>
        <script src="magnific-popup/jquery.magnific-popup.min.js"></script>
        <script src="js/easing.min.js"></script>
        <script src="js/jquery.singlePageNav.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.7.0/main.js" integrity="sha256-UYwUI07v3ZaBPEu6HOJIokV15Zeh2Xj/bGT+MxtA0l0=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.7.0/main.min.js" integrity="sha256-Ao+73w9IZNPf3C3Ij0Dyj5ZYdxA/xC1kobU9G2TQJyA=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.7.0/locales-all.js" integrity="sha256-JioheWkYsJTaMcygTlhzmt6Ut1dx+YAaos5dDPYu/6w=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.7.0/locales-all.min.js" integrity="sha256-6TW9hevn9VV+Dk6OtclSzIjH05B6f2WWhJ/PQgy7m7s=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.7.0/main.js" integrity="sha256-rZzBwSK1mhxhhAmAmuhuadbNunmGpnFnzfsPpGRugrQ=" crossorigin="anonymous"></script>
    </body>
</html>
