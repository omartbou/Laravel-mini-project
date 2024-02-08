@extends ('layouts.app')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('users.update',$user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="Full Name" value="{{$user->name}}">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span><br>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control"  name="email" placeholder="Email" value="{{$user->email}}">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span><br>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="phone" placeholder="Phone number" value="{{$user->phone}}">
                            @error('phone')
                            <span class="text-danger">{{ $message }}</span><br>
                            @enderror
                        </div>
                        <input type="submit" class="btn btn-primary btn-block" value="Update this user">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


