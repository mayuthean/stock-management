@extends('layouts.master')
@section('header')
 <strong> Roles</strong>   
@endsection
@section('content')
    <div class="card card-gray">
        <div class="toolbok">
        <a href="{{url('role')}}" class="btn btn-sm btn-primary btn-oval">
                <i class="fa fa-reply"></i> Back
            </a>
        </div>
            <strong class="text-primary">
                  Set permission for role [{{ $role->name}}]
            </strong>
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>View</th> 
                        <th>Edit</th>
                        <th>Create</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                   @php($i=1)
                   @foreach($permissions as $p)
                        <tr>
                              <td>{{ $i++ }}</td>
                              <td>{{ $p->alias }}</td>
                              <td><input type="checkbox" value="{{ $p->view?'1':'0' }}"{{ $p->view?'checked':'' }}></td>
                              <td><input type="checkbox" value="{{ $p->edit?'1':'0' }}"{{ $p->edit?'checked':'' }}></td>
                              <td><input type="checkbox" value="{{ $p->create?'1':'0' }}"{{ $p->create?'checked':'' }}></td>
                              <td><input type="checkbox" value="{{ $p->delete?'1':'0' }}"{{ $p->delete?'checked':'' }}></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection