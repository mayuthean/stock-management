@extends('layouts.master')
@section('header')
 <strong>Update Role</strong>   
@endsection
@section('content')
<form action="{{url('role/update')}}" method="POST" enctype="multipart/form-data">
    <div class="card card-gray">
        <div class="toolbox">
        <button class="btn btn-sm btn-success btn-oval">
            <i class="fa fa-save"></i> Save
        </button>
        <a href="{{url('role')}}" class="btn btn-sm btn-warning btn-oval">
            <i class="fa fa-reply"></i> Back
        </a>
        </div>
        <div class="card-block">
            @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <p>
                        {{session('success')}}
                    </p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
             @if(Session::has('error'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <p>
                        {{session('error')}}
                    </p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$role->id}}">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group row">
                            <label for="name" class="col-sm-4">Role Name <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" id="name" name="name" value="{{$role->name}}" autofocus required>
                            </div>
                        </div>
                        <div class="col-s m-3">
                        </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('js')
 <script>
     function preview(evt){
        let img = document.getElementById('img');
        img.src = URL.createObjectURL(evt.target.files[0]);
     }
 </script>   
@endsection