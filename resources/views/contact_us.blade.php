@extends('layouts.app')

@section('content')
    <div class="container">
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
                <div class="section-title">
                <h2 class="title-style text-center"> <i class="fas fa-mail-bulk mr-2 ml-2"></i>@lang('site.contact')</h2>
                {{-- <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p> --}}
                </div>

                <div class="row">

                <div class="col-lg-5 d-flex align-items-stretch">
                    <div class="info">
                    <div class="address">
                        <i class="fas fa-map-marked-alt"></i>
                        <h4>@lang('site.location'):</h4>
                        <p> @lang('site.make_company') </p>
                    </div>

                    <div class="email">
                        <i class="fas fa-envelope"></i>
                        <h4>@lang('site.email'):</h4>
                        <a href="mailto:abdoshokrey111@gmail.com" class="text-dark link-decoration"> abdoshokrey111@gmail.com </a>
                    </div>

                    <div class="phone mt-4">
                        <i class="fas fa-phone"></i>
                        <h4>@lang('site.call'):</h4>
                        <p>+20-1129899520</p>
                    </div>

                    {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe> --}}
                    </div>

                </div>

                <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
                    <form action="{{route('send_message')}}" method="post" role="form" class="php-email-form">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name" class="bold"> <i class="fas fa-user mr-2 ml-2"> </i> @lang('site.name')  </label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="@error('name'){{old('name')}}@else {{auth()->user()->name}} @enderror">
                                @error('name')
                                    <b class="bold text-danger">
                                        <i class="fas fa-exclamation-triangle mr-2 ml-2"></i>
                                        {{$message}}
                                    </b>
                                @enderror
                            </div> <!-- End Of Message Name -->
                            <div class="form-group col-md-6">
                                <label for="email" class="bold"> <i class="fas fa-envelope-open-text mr-2 ml-2"></i> @lang('site.email')</label>
                                <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="@error('email'){{old('email')}}@else {{auth()->user()->email}} @enderror">
                                @error('email')
                                    <b class="bold text-danger">
                                        <i class="fas fa-exclamation-triangle mr-2 ml-2"></i>
                                        {{$message}}
                                    </b>
                                @enderror
                            </div> <!-- End Of Message Email -->
                        </div>

                        <div class="col-md-12 mt-3 p-2">
                            <label for="message" class="bold"> <i class="fas fa-paper-plane mr-2 ml-2"></i> @lang('site.message') </label>
                            <textarea type="text" name="message" id="message" cols="30" rows="10" class="form-control @error('message') is-invalid @enderror" placeholder="@lang('site.message') ...">@error('message'){{old('message')}}@enderror</textarea>
                            @error('message')
                                <b class="bold text-danger">
                                    <i class="fas fa-exclamation-triangle mr-2 ml-2"></i>
                                    {{$message}}
                                </b>
                            @enderror
                        </div> <!-- End Of Message -->

                        {{-- <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div> --}}
                        <div class="text-center"><button type="submit"> <i class="fas fa-paper-plane"></i> @lang('site.send_message')</button></div>
                    </form>
                </div>

                </div>

        </div>
    </section><!-- End Contact Section -->
    </div>
@endsection
