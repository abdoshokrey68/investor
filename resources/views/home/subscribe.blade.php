@extends('layouts.app')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-4 p-0">
                <div class="card">
                    <div class="col-md-12">
                        <img src="{{$user->profile_photo_url}}" alt="User Image" class="image-res mt-5">
                        <h3 class="h3 bold text-center mt-3">
                            <i class="fas fa-user mr-2 ml-2"></i>{{$user->name}}
                            @if (auth()->user()->id != $user->id)
                                @php
                                    $user_id = auth()->user()->id;
                                    $friend_id = $user->id;
                                    $friend_status = DB::select("SELECT * FROM friends where `user_id` = $user_id AND `friend_id` = $friend_id LIMIT 1");
                                @endphp
                                @if(!$friend_status)
                                    <a href="{{route('add_friend',$user->id)}}">
                                        <i class="fas fa-user-plus btn btn-secondary text-light pt-2 pb-2"></i>
                                        {{-- <i class="fas fa-user-plus btn btn-secondary text-light pt-2 pb-2" id="add-new-friend" data-info="{{$user->id}}" data-url="{{route('add_friend')}}"></i> --}}
                                    </a>
                                @else
                                    @php
                                        $user_id = auth()->user()->id;
                                        $friend_id = $user->id;
                                        $test2 = DB::select("SELECT * FROM friends where `user_id` = $user_id AND `friend_id` = $friend_id AND `status` = 0 LIMIT 1");
                                    @endphp
                                    @if ($test2)
                                        <a href="{{route('remove_friend',$user->id)}}">
                                            <i class="fas fa-user-minus btn btn-secondary text-light pt-2 pb-2"></i>
                                        </a>
                                            <p class="text-success h6 bold p-2">
                                            Friendship request has been sent
                                        </p>
                                    @else
                                        <a href="{{route('remove_friend',$user->id)}}">
                                            <i class="fas fa-user-check btn btn-secondary text-light pt-2 pb-2"></i>
                                        </a>
                                        <p class="text-success h6 bold p-2">
                                            You are really friends
                                        </p>
                                    @endif
                                @endif
                            @endif
                        </h3>
                        <p class="h6 text-center bold"><i class="fas fa-paper-plane mr-2 ml-2"></i>{{$user->email}}</p>

                            @if ($user->status == 0)
                                <p class="bold col-md-12 p-3 mt-4 float-end text-center" style="background: #9b59b6; color:#fff">
                                    Innovative
                                </p>
                            @elseif($user->status == 1)
                                <p class="bold col-md-12 p-3 mt-4 float-end text-center" style="background: #16a085; color:#000">
                                    Investor
                                </p>
                            @elseif($user->status == 2)
                                <p class="bold col-md-12 p-3 mt-4 float-end text-center" style="background: #34495e; color:#fff">
                                Financier
                                </p>
                            @elseif($user->status == 3)
                                <p class="bold col-md-12 btn-danger float-end text-center">
                                    Admin
                                </p>
                            @endif

                        <div class="clearfix"></div>

                        <div class="all-projects">
                            <p class="h4 p-2 mt-3 bold">
                                <i class="fas fa-lightbulb mt-2 ml-2"></i> All Projects : {{$user->projects->count()}}
                            </p>

                            @if (auth()->user()->id == $user->id )
                                <p class="coins-box col-md-12 bg-dark text-warning bold h6 p-3 text-center">
                                    Coins : {{$user->coins}} <i class="fas fa-coins"></i>
                                </p>
                            @endif

                            <div class="rating-box col-md-12 bg-dark text-warning bold h6 p-3 text-center">
                                <span class=""><i class="fas fa-smile mr-2 ml-2"></i>Ratings :</span>
                                @for ($i = 1; $i <= $user->rating; $i++)
                                    <i class="fas fa-star text-warning"></i>
                                @endfor
                                @for ($i = 1; $i <= (5 - $user->rating); $i++)
                                    <i class="fas fa-star text-secondary"></i>
                                @endfor
                            </div>

                            <b class="h5 line-height "> <span class="bold"> BIO : </span> {{$user->bio}} </b>

                            <p class="h6 bold"> <i class="fas fa-globe-asia"></i> Country : {{$user->country}}
                            </p>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card  bg-light mb-3">
                        <div class="card-header"> <h4 class="h4 bold">Subscribe Now </h4></div>
                        <div class="card-body">
                            <h5 class="card-title">Dark card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <br>
                            <div class="float-end">
                                @include('home.work.work_sub')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
