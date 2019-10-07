@extends('layouts.master')
@section('header')
 <strong>Edit User</strong>   
@endsection
@section('content')
<form action="{{url('user/update')}}" method="POST" enctype="multipart/form-data">
    <div class="card card-gray">
        <div class="toolbox">
        <button class="btn btn-sm btn-success btn-oval">
            <i class="fa fa-save"></i> Update
        </button>
        <a href="{{url('user')}}" class="btn btn-sm btn-warning btn-oval">
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
                <input type="hidden" name="id" value="{{$user->id}}">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group row">
                            <label for="name" class="col-sm-4">Full Name <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" autofocus required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-4">Email Address <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username" class="col-sm-4">Username <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="username" name="username" value="{{$user->username}}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-sm-4">Password <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <p class="small-text">keep in blank to use old password</p>
                                <input type="password" class="form-control" id="password" name="password" value="{{old('password')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-4">Role <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select name="role" id="role" class="form-control">
                                    <option value="">--select--</option>
                                    @foreach($roles as $role)
                                    <option value="{{$role->id}}" {{$user->role_id==$role->id?'selected':''}}>{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="language" class="col-sm-4">Languages <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select name="language" id="language" class="form-control">
                                    <option value="en" {{$user->language=='en'?'selected':''}}>English</option>
                                    <option value="km" {{$user->language=='km'?'selected':''}}>ភាសាខ្មែរ</option>
                                   
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-s m-3">
                        <div class="form-group row">
                            <label for="photo" class="col-sm-3">Photo </label>
                            <div class="col-sm-8">
                                <input type="file" class="form-control" id="photo" name="photo" 
                                    accept="image/x-png,image/gif,image/jpeg" onchange="preview(event)">
                                <p style="margin-top:9px">
                                    <img src="{{asset($user->photo)}}" alt="" width="150" id="img">
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