@extends('layouts.app');
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center">Register</h2>
                        <form action="/register" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span><br>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span><br>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone number:</label>
                                <input type="text" id="phone" name="phone" class="form-control" required>
                                @error('phone')
                                <span class="text-danger">{{ $message }}</span><br>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password:</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                                @error('password')
                                <span class="text-danger">{{ $message }}</span><br>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
