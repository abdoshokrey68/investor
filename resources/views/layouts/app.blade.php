<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{-- @if (\Request::route()->getName())
        @elseif()
        @else
        @endif --}}
        {{request()->route()->getName()}}
    </title>

    <!-- Fonts -->

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" />

    <!-- DataTables CSS -->
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css"> --}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @if (App::getLocale() == 'ar')
        <link href="{{URL::asset('css/home/home-ar.css')}}" rel="stylesheet">
    @endif

    <link rel="stylesheet" href="{{asset('css/home/home.css')}}">

    <link rel="stylesheet" href="{{asset('css/admin/dash.css')}}">

</head>
<body dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{route('home')}}">
                    <i class="fas fa-home"></i>
                    K of Investor
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else

                            <li class="nav-item dropdown mr-2 ml-2 ">
                                <a id="navbarDropdown" class="getnotice nav-link col-md-12 text-light dropdown-toggle btn btn-dark p-2 notice-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre get-notice="{{route('get_notice')}}">
                                    <i class="fas fa-bell"></i>
                                    @php
                                        $user_id = auth()->user()->id;
                                        $notice_show = DB::select("SELECT * FROM notices WHERE `user_id` = $user_id AND `show` = 0");
                                    @endphp
                                    @if (count($notice_show) != 0)
                                        <span id="notice-count" class="count bg-danger">{{count($notice_show)}}</span>
                                    @endif
                                </a>
                                <div class="dropdown-menu @if (app()->getLocale() == 'en') dropdown-menu-right @endif notice-box" aria-labelledby="navbarDropdown" >
                                    <h5 class="h5 bold p-2 text-primary">
                                        <i class="fas fa-bell mt-2 ml-2"></i>
                                        @lang('site.notifications_box')
                                    </h5>
                                    <div id="all-notice">
                                        <notice-component user_id='{{auth()->user()->id}}' locale="{{app()->getLocale()}}" />
                                    </div>
                                </div> <!-- End Notification Box -->
                            </li>

                            <li class="nav-item dropdown mr-2 ml-2 exit">
                                <a id="navbarDropdown" class="getnotice nav-link col-md-12 text-light dropdown-toggle btn btn-dark p-2 notice-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre get-notice="{{route('get_notice')}}">
                                    <i class="fas fa-user"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" style="width: 220px" aria-labelledby="navbarDropdown" >
                                    <div class="col-md-12 p-0 card">
                                        <a href="{{route('profile',auth()->user()->id)}}" class="btn btn-light">
                                            <i class="fas fa-user mr-2 ml-2"></i>
                                            @lang('site.profile')
                                        </a>
                                    </div>
                                    <div class="col-md-12 p-0 card">
                                        <a href="{{route('profile.edit',auth()->user()->id)}}" class="btn btn-light">
                                            <i class="fas fa-user-edit mr-2 ml-2"></i>
                                            @lang('site.edit_profile')
                                        </a>
                                    </div>
                                </div> <!-- End Logout Box -->
                            </li>

                            @if (auth()->user()->status == 4)
                                <li class="nav-item dropdown mr-2 ml-2">
                                    <a href="{{route('admin.users')}}" class="btn text-light" style="background: rgb(87, 1, 158)">
                                        <i class="fas fa-user-shield"></i>
                                    </a>
                                </li>
                            @endif

                            <li class="nav-item dropdown mr-2 ml-2">
                                <a class=" btn btn-danger bg-danger" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>

                        @endguest
                            <li class="nav-item dropdown">
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    @if (app()->getLocale() != $localeCode)
                                        <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" rel="alternate" hreflang="{{ $localeCode }}" class="nav-link text-dark m-0">
                                            {{ $properties['native'] }}
                                        </a>
                                    @endif
                                @endforeach
                            </li>
                    </ul>
                </div>
            </div>
        </nav>

        @auth
            @if (\Request::route()->getName() != 'profile')
                <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm pt-5" style="min-height: 100px">
                    <div class="container mt-5">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent2" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse col-md-12 float-end" id="navbarSupportedContent2">
                            <ul class="navbar-nav @if (App()->getLocale() == 'ar') ml-auto @else mr-auto @endif">
                                <li class="nav-item">
                                    <a href="{{route('home')}}" class="btn  mr-2 ml-2 mt-2 @if(\Request::route()->getname() == 'home') btn-light text-primary @else btn-dark  @endif ">
                                        <i class="fas fa-home"></i>
                                        @lang('site.all_projects')
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{route('contact_us')}}" class="btn  mr-2 ml-2 mt-2 @if(\Request::route()->getname() == 'contact_us') btn-light text-primary @else btn-dark  @endif ">
                                        <i class="fas fa-paper-plane"></i>
                                        @lang('site.contact')
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{route('about_us')}}" class="btn  mr-2 ml-2 mt-2 @if(\Request::route()->getname() == 'about_us') btn-light text-primary @else btn-dark  @endif ">
                                        <i class="fas fa-info-circle"></i>
                                        @lang('site.about')
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{route('work_with_us', auth()->user()->id)}}" class="btn mr-2 ml-2 mt-2 @if(\Request::route()->getname() == 'work_with_us') btn-light text-primary @else btn-dark  @endif">
                                        <i class="fas fa-briefcase"></i>
                                        @lang('site.work_with_us')
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            @endif
        @endauth

        <main class="py-4 pg-sucand m-0">
            @yield('content')
        </main>

        {{-- @auth
        <div class="card p-0 friends-list col-md-4 col-sm-6">
            <div class=" btn btn-primary  p-2 text-left" id="open-friends-box">
                <i class="fas fa-user-friends"></i>
                @lang('site.friends_list')
                @php
                    $user_id = auth()->user()->id;
                    $request_count = DB::select("SELECT * FROM friends WHERE `user_id` = $user_id AND `status` = 0");
                @endphp
                    @if (count($request_count) > 0)
                        <button class="btn btn-danger bold ml-2 mr-2 text-light">
                            {{count($request_count)}}
                        </button>
                    @endif
            </div>
            <div class="card-body friends-box col-md-12 p-0" id="friends-box">
                <firends-list></firends-list>
            </div>
        </div>
        <input type="hidden" id="online_status" value="{{route('onlone_status')}}">
        <!-- End Of Friends Box -->
        @endauth --}}
    </div>




    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <!-- CK EDITOR -->
    {{-- <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script> --}}
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script> --}}

    {{-- <script src="{{URL::asset('js/ckeditor.js')}}"></script> --}}

    <!-- DataTables JavaScript -->
    {{-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script> --}}

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{asset('js/home.js')}}"></script>

    {{-- <script src="https://js.pusher.com/7.0/pusher.min.js"></script> --}}
    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <script>

        // Enable pusher logging - don't include this in production
        // Pusher.logToConsole = true;

        // var pusher = new Pusher('c19220ded91e34026e04', {
        //     cluster: 'eu'
        // });

        // var channel = pusher.subscribe('comment-notice');
        // channel.bind('commentNotice', function(data) {
        // });
            // alert(JSON.stringify(data));
            // console.log(data.notice)

        // ClassicEditor
        //     .create( document.querySelector( '#myeditor' ) )
        //     .catch( error => {
        //         console.error( error );
        //     } );

        // CKEDITOR.replace('myeditor')

        // $(document).ready( function () {
        //     $('#myTable').DataTable();
        // } );
    </script>

</body>
</html>
