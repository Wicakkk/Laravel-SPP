@extends('template.main')

@section('konten')
<h1 class="text-center mb-4">Edit Profile</h1>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nama" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->nama }}" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-warning">Save Changes</button>
                    <a href="{{ route('profile.edit') }}" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <div class="row mb-3">
                <div class="col text-end">
                    <img class="img-profile rounded-circle" src="../template/img/undraw_profile.svg">
                </div>
                <div class="col align-self-center">
                    <h2>{{ $user->nama }}</h2>
                    <h6>username : {{ $user->username }}</h6>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
