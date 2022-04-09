@extends('admin.layout')

@section('admin_content')

<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2> <i class="fas fa-envelope-open mr-2 ml-2"></i> All Users Messages </h2>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="table_id">
                        <thead >
                            <tr class="text-center">
                                <th>#ID</th>
                                {{-- <th>Message</th> --}}
                                <th>Name</th>
                                <th>Email</th>
                                <th>Controller</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($messages as $key => $message)
                                <tr class="odd gradeA text-center">
                                    <td>{{$key}}</td>
                                    {{-- <td> {{$message->message}} </td> --}}
                                    <td> {{$message->name}} </td>
                                    <td class="center"> {{$message->email}} </td>
                                    <td>
                                        <button type="button" class="btn btn-dark text-light" data-toggle="modal" data-target="#showmessage{{$key}}"> <i class="fas fa-eye"></i> </button>
                                        <a href="#" class="btn btn-success text-dark"> <i class="fas fa-edit"></i> </a>
                                        <a href="#" class="btn btn-danger text-dark"> <i class="fas fa-trash"></i> </a>
                                    </td>

                                    <!-- Modal -->
                                    <div class="modal fade" id="showmessage{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"> Message </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                {{$message->message}}
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
                <div class="col-md-4 offset-md-4" style="">
                    {{ $messages->links() }}
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>

@endsection
