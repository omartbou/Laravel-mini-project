@extends('layouts.app')
@section('title','users')
@section('content')
<x-navbar></x-navbar>
<div class="container">
    @if(session()->has('success'))
        <x-alert type="success">{{session('success')}}</x-alert>

    @endif

    <div class="row">
        <div class="col-md-6"></div> <!-- Add other content or empty column -->
        <div class="col-md-6 text-right my-2">
            <a href="{{route('users.create')}}" class="btn btn-primary" >Add new user</a>
        </div>
    </div>
</div><table class="table" >
    <thead>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Action</th>
    </thead>
    @foreach($users as $key=>$user)

    <tbody>
    <td>{{$user->name}}</td>
    <td>{{$user->email}}</td>
    <td>{{$user->phone}}</td>
    <td>
        <div class="d-flex align-items-center">
            <form  action="{{ route('users.destroy', $user->id) }}" method="POST" class="mr-2" >
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-link text-danger" ><i class="bi bi-trash"></i>
                </button>

            </form>
            <form action="{{route('users.edit',$user->id)}}" method="GET">
                @csrf
                <button type="submit" class="btn btn-link text-warning" ><i class="bi bi-pencil"></i></button>
            </form>
        </div>
    </td>
    </tbody>
    @endforeach

</table>
@endsection
