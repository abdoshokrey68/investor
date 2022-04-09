@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3 p-0">
                <div class="list-group text-center">
                    {{-- <a href="{{route('admin')}}" class="list-group-item list-group-item-action @if (\Request::route()->getName() == 'admin') active @endif" aria-current="true"> @lang('site.dashboard') </a> --}}
                    <a href="{{route('admin.messages')}}" class="list-group-item list-group-item-action @if (\Request::route()->getName() == 'admin.messages') active @endif"> @lang('site.messages')</a>
                    <a href="{{route('admin.users')}}" class="list-group-item list-group-item-action @if (\Request::route()->getName() == 'admin.users') active @endif"> @lang('site.users')</a>
                    <a href="{{route('admin.projects')}}" class="list-group-item list-group-item-action @if (\Request::route()->getName() == 'admin.projects') active @endif"> @lang('site.all_projects')</a>
                    <a href="{{route('admin.comments')}}" class="list-group-item list-group-item-action @if (\Request::route()->getName() == 'admin.comments') active @endif"> @lang('site.comments')</a>
                </div>
            </div>
            <div class="col-md-9">
                @yield('admin_content')
            </div>
        </div>
    </div>
@endsection
