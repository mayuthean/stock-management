@extends('layouts.master')
@section('header')
 <strong> <i class="fa fa-user"></i> Users</strong>   
@endsection
@section('content')
    <div class="card card-gray">
        <div class="toolbok">
        <a href="{{url('user/create')}}" class="btn btn-sm btn-primary btn-oval">
                <i class="fa fa-plus-circle"></i> Create
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
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php ($i=1)
                    @foreach ($users as $user)
                    <tr>
                        <td>{{$i++}}</td>  
                        <td><img src="{{$user->photo}}" width="50" alt="no img" style="border-radius:5px"></td>
                        <td>{{$user->name}}</td> 
                        <td>{{$user->username}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            <a href="{{url('user/delete/'.$user->id)}}" class="text-danger" title="Delete" onclick="return confirm('Are you sure!')">
                               <i class="fa fa-trash"></i>
                            </a> &nbsp; &nbsp;
                            <a href="{{url('user/edit/'.$user->id)}}" class="text-primary" title="Edit">
                                <i class="fa fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection