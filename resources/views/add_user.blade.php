@extends ('layouts.app')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="form-group">
                <input type="text" class="form-control" name="name" placeholder="Full Name">
                    @error('name')
                    <span class="text-danger">{{ $message }}</span><br>
                    @enderror
                </div>
                <div class="form-group">
                <input type="email" class="form-control"  name="email" placeholder="Email">
                    @error('email')
                    <span class="text-danger">{{ $message }}</span><br>
                    @enderror
                </div>
                <div class="form-group">
                <input type="text" class="form-control" name="phone" placeholder="Phone number">
                    @error('phone')
                    <span class="text-danger">{{ $message }}</span><br>
                    @enderror
            </div>
                <input type="submit" class="btn btn-primary btn-block" value="Add new user">
            </form>
        </div>
            </div>
        </div>
    </div>
    </div>



