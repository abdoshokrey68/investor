@extends('home.project.project_layout')

@section('project_content')

    <div class="col-md-12 p-0">
        <div class="card mt-4">
            <h3 class="h3 bold p-3"> @lang('site.name') : {{$project->name}} </h3>
            <div class="card-header bg-warning h5 bold"> <i class="fas fa-edit mr-2 ml-2"></i> @lang('site.edit_suggestion') </div>
            <div class="card-body">
                <form action="{{route('comment.update', $project->id)}}" method="post">
                    @csrf
                    <textarea class="form-control" name="comment" id="comment" cols="30" rows="10" required placeholder="@lang('site.best_candidate')">@error('comment'){{old('comment')}}@else{{$comment->comment}}@enderror</textarea>
                    @error('comment')
                        <p class="text-danger col-md-12 mt-2 bold"><i class="fas fa-times ml-2 mr-2"></i>{{$message}}</p>
                    @enderror <!-- End Of Comment Box -->

                    <select name="status" id="status" class="form-control mt-3 mb-3" required>
                        @lang('site.project_amount')
                        <option disabled @if(!old('status')) selected @endif> @lang('site.choose_plane')  </option>
                        <option value="1" @if($comment->status == 1) selected @endif @if(old('status') == 1 ) selected @endif > @lang('site.request_project') </option>
                        <option value="2" @if($comment->status == 2) selected @endif @if(old('status') == 2 ) selected @endif >@lang('site.will_financier')  </option>
                        {{-- <option value="3" @if($comment->status == 3) selected @endif> @lang('site.inveset_project')  </option> --}}
                    </select>
                    @error('status')
                        <p class="text-danger col-md-12 mt-2 bold"><i class="fas fa-times ml-2 mr-2"></i>{{$message}}</p>
                    @enderror <!-- End Of Comment Box -->
                    <button class="btn btn-primary text-light h2 bold float-end"> <i class="fas fa-paper-plane"></i>  @lang('site.update') </button>
                </form>
            </div>
        </div>
    </div>

@endsection
