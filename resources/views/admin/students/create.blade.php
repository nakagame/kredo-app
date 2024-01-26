@extends('layouts.app')

@section('title', 'Admin: Create a Student')

@section('content')
    @if(session('success'))
        <div class="alert alert-primary alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h1 class="text-secondary fw-light mb-3">Create Student</h1>

    <div class="bg-white">
        <form action="{{ route('admin.students.store') }}" method="POST" class="w-50 p-5">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label text-secondary">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" autofocus>

                @error('name')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label text-secondary">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">

                @error('email')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label text-secondary">Password</label>
                <input type="password" name="password" id="password" class="form-control" value="{{ old('password') }}">

                @error('password')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label text-secondary">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" value="{{ old('confirm_password') }}">
            
                @error('confirm_password')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary small">
                <i class="fa-solid fa-save"></i>&nbsp; Save
            </button>
        </form>
    </div>
@endsection