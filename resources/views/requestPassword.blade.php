@extends('layouts.app')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            @if (session('status'))
                <div>{{ session('status') }}</div>
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="card-title text-center">
                        <h2>Reset Password</h2>
                    </div>
                    <form action="{{route('reset.email')}}" method="post">
                        @csrf
                        <div class="form-group">
                        <input type="email" placeholder="Type your email" class="form-control" name="email">
                            @error('email')
                            <span>{{ $message }}</span><br>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Send Email</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
