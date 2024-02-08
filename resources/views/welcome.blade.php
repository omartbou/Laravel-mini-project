@extends('layouts.app')
@section('content')
<div class="container mt-5">

    <div class="row justify-content-center">
        <div class="col-md-6">
            @if(session()->has('success'))
                <x-alert type="success">{{session('success')}}</x-alert>
                @elseif(session()->has('error'))
                <x-alert type="danger">{{session('error')}}</x-alert>
            @endif
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center">Login</h2>
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="username" name="email" class="form-control" required>
                            @error('email')
                           <span class="text-danger"> {{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group d-flex align-items-center justify-content-between">
                            <a href="{{ route('register') }}">Register</a>
                            <a href="{{ route('reset.request') }}">Forgot Password?</a>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    @endsection
