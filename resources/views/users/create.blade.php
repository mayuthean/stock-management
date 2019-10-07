@extends('layouts.master')
@section('header')
 <strong>{{trans('label.create')}}</strong>   
@endsection
@section('content')
<form action="{{url('user/save')}}" method="POST" enctype="multipart/form-data">
    <div class="card card-gray">
        <div class="toolbox">
        <button class="btn btn-sm btn-success btn-oval">
            <i class="fa fa-save"></i> {{trans('label.save')}}
        </button>
        <a href="{{url('user')}}" class="btn btn-sm btn-warning btn-oval">
            <i class="fa fa-reply"></i> {{trans('label.back')}}
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
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group row">
                            <label for="name" class="col-sm-4">{{trans('label.name')}}<span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" autofocus required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-4">{{trans('label.email')}}<span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username" class="col-sm-4">{{trans('label.username')}}<span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="username" name="username" value="{{old('username')}}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-sm-4">{{trans('label.password')}}<span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="password" name="password" value="{{old('password')}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="role" class="col-sm-4">{{trans('label.role')}} <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select name="role" id="role" class="form-control chosen-select">
                                    <option value="">--select--</option>
                                    @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="language" class="col-sm-4">{{trans('label.language')}} <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select name="language" id="language" class="form-control">
                                    <option value="en">English</option>
                                    <option value="km">ភាសាខ្មែរ</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-s m-3">
                        <div class="form-group row">
                            <label for="photo" class="col-sm-3">{{trans('label.photo')}}</label>
                            <div class="col-sm-8">
                                <input type="file" class="form-control" id="photo" name="photo" 
                                    accept="image/x-png,image/gif,image/jpeg" onchange="preview(event)">
                                <p style="margin-top:9px">
                                    <img src="" alt="" width="150" id="img">
                                </p>
                            </div>
                        </div>
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