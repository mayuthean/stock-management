@extends('layouts.master')
@section('header')
 <strong> <i class="fa fa-user"></i> Roles</strong>   
@endsection
@section('content')
    <div class="card card-gray">
        <div class="toolbok">
        <a href="{{url('role/create')}}" class="btn btn-sm btn-primary btn-oval">
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
                        <th>Name</th>
                        <th>Active</th> 
                    </tr>
                </thead>
                <tbody>
                    @php ($i=1)
                    @foreach ($roles as $role)
                    <tr>
                        <td>{{$i++}}</td> 
                        <td> 
                            <a href="{{url('role/detail/'.$role->id)}}">{{$role->name}}</a>
                        </td> 
                        </a>
                        <td>
                            <a href="{{url('role/delete/'.$role->id)}}" class="text-danger" title="Delete" onclick="return confirm('Are you sure!')">
                               <i class="fa fa-trash"></i>
                            </a> &nbsp; &nbsp;
                            <a href="{{url('role/edit/'.$role->id)}}" class="text-primary" title="Edit">
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