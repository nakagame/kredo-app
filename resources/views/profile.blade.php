@extends('layouts.app')

@section('title', Auth::user()->name)
    
@section('content')
    <h1 class="fw-light text-secondary">Profile</h1>

    <div class="bg-white p-5 rounded">
        <div class="row">
            <div class="col">
                @if ($user->avatar)
                    <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="rounded" style="object-fit: cover; width: 100%;">
                @else
                    <i class="fa-solid fa-user text-secondary text-center d-block" style="font-size: 15rem;"></i>
                @endif
            </div>
            <div class="col">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <h1>{{ $user->name }}</h1>
                    </div>
                    <div class="col text-end">
                        <button class="btn border-0 bg-transparent text-secondary" data-bs-toggle="modal" data-bs-target="#edit-profile-{{ $user->id }}">
                            Edit Profile
                        </button>
                    </div>
                </div>
                <p>{{ $user->email }}</p>
            </div>
        </div>
    </div>
    
    @include('modal.edit-profile')
@endsection
