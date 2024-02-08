@extends('layouts.app')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">

                <div class="card-body">
                    <div class="card-title text-center">
                        <h2>New Password</h2>
                    </div>
                    <form action="{{route('password.update')}}" method="post">
                        @csrf
                        <input type="hidden" name="token" value="{{$token}}">
                        <div class="form-group">
                        <input type="password" placeholder="New Password"  class="form-control" name="password">
                            @error('password')
                            <span>{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                        <input type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="brn btn-primary btn-block">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
