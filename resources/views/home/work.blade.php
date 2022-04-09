@extends('layouts.app')


@section('content')

    <div class="container mb-5">
        <div class="col-md-12 main-box" style="background: #eee">
            <div class="main-info col-md-12 text-center pt-3 pb-3 line-height">
                <i class="fas fa-crown text-warning fa-4x"></i>
                <img src="{{$user->profile_photo_url}}" class="image-res mt-2" alt="User Image" style="width: 17%; display:block">
                <a href="{{route('profile',$user->id)}}" ><h1 class="h1 bold text-center"><i class="fas fa-user ml-2 mr-2"></i>{{$user->name}}</h1></a>
                @if ($user->email)
                    <p class="h5 bold text-center"><i class="fas fa-envelope-open-text ml-2 mr-2 text-center"></i>{{$user->email}}</p>
                @endif
                @php
                    $user_id = $user->id;
                    $belongs_to = DB::select("SELECT * FROM users WHERE belongs_to = $user_id");
                @endphp
                <p class="h3 text-center"> <i class="fas fa-users"></i> @lang('site.the_audience') {{count($belongs_to)}}</p>

                @if (auth()->user()->id == $user->id)
                    <div class="row col-md-6 offset-md-3 m-auto">
                        <label for="add_audience" class="h6 bold col-md-4 p-2"> <i class="fas fa-plus mt-1"></i> @lang('site.add_audience')</label>
                        <input type="text" class=" col-md-8 text-center p-2 h5 bold" value="{{route('register',$user->id)}}">
                        {{-- <i class="fas fa-copy mt-2 ml-2 float-end" style="font-size: 1.5em"></i> --}}
                    </div>
                @endif
                <h4 class="col-md-12 bg-dark text-warning text-center h4 bold p-3 mt-5">
                    @lang('site.your_money') {{$user->coins}}
                </h4>
            </div>

            {{-- @if ($user->sub == 1) --}}
                <div class="col-md-12 belongs_to" id="belongs_to" date-count="1">
                    <div class="the-audience">
                        <h2 class="h2 bold p-3"> <i class="fas fa-users ml-2 mr-2"></i>@lang('site.the_audience') </h2>
                        @if ($belongs_to)
                                {{-- <div class="col-md-12">
                                    <belongs-to user_id="{{$user->id}}" />
                                </div> --}}
                                <div class="row">
                                    @foreach ($belongs_to as $users)
                                        <div class="col-md-2">
                                            <a href="{{route('work_with_us',$users->id)}}">
                                                @if ($user->image)
                                                        <img src="{{URL::asset("img/users/$user->image")}}" class="mt-2 image-sub" alt="User Image" style="">
                                                    @else
                                                        <img src="{{URL::asset('img/users/users.png')}}" class="mt-2 image-sub" alt="User Image" style="">
                                                @endif
                                            </a>
                                            <a href="{{route('work_with_us',$users->id)}}">
                                                <h6 class="h6 bold pt-2 text-center">{{$users->name}}</h6>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                @if ($user->id == auth()->user()->id)
                                        <div class="col-md-12 text-danger h3 text-center bold text-capitalize">
                                            @lang('site.audience_empty')
                                            <br>
                                            @lang('site.audience_empty2')
                                            <input type="text" class=" col-md-8 text-center mt-3 p-2 h5 bold text-dark" value="{{route('register', $user->id)}}">
                                        </div>
                                    @else
                                    <div class="col-md-12 text-danger h3 mb-3 text-center bold text-capitalize">

                                    </div>
                                    <div class="clear"></div>
                                @endif
                        @endif
                    </div>
                </div>
            {{-- @else <!-- End Of If This User Subscripe -->
                    @if ($user->id == auth()->user()->id)
                            <div class="">
                                <h3 class="h3 bold text-capitalize text-danger  text-center line-height mb-3">
                                    Subscribe with us and make money from your home
                                </h3>
                                <div class="col-md-12">
                                    @include('home.work.work_sub')
                                </div>
                            </div>
                        @else
                            <div class="col-md-12 text-danger h4 text-center bold line-height text-capitalize">
                                        This Account Has Not Subscribed Yet
                                    <br>
                                        Invite Him To Subscribe
                                    <br>
                                @if (auth()->user()->sub == 1)
                                    <input type="text" class=" col-md-8 text-center mt-3 p-2 h5 bold text-dark" value="{{route('register', auth()->user()->id)}}">
                                @else
                                    <div>
                                        <h5 class="h5 bold text-capitalize text-dark  text-center line-height mb-3">
                                            Subscribe with us and make money from your home
                                        </h5>
                                        @include('home.work.work_sub')
                                        <!-- include Work Subscribe Model -->
                                    </div>
                                @endif
                            </div>
                            <!-- End Box If This User Not Subscribe -->
                    @endif
            @endif --}}

        </div>
    </div>
@endsection
