@extends('layouts.app')

@section('title', 'Explore Teachers')

@section('content')
    <div class="row">
        <div class="col">
            <a href="{{ route('admin.teachers') }}" class="text-decoration-none text-primary">
                <i class="fa-solid fa-chevron-left"></i>&nbsp; Back
            </a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-5">
            <p class="h5 text-muted mb-4">
                Search results for "<span class="fw-bold">{{ $search }}</span>"
            </p>

            @forelse ($users as $user)
                <div class="row align-items-center mb-3">
                    <div class="col-auto">
                        @if ($user->avatar)
                            <img src="{{ $user->avatar }}" alt="{{$user->name }}" class="rounded-circle mx-auto d-block avatar-md">
                        @else
                            <i class="fa-solid fa-user-tie icon-lg text-center mx-auto d-block"></i>
                        @endif
                    </div>
                    <div class="col p-0 text-trancate">
                        <p class="fw-bold mb-0">{{ $user->name }}</p>
                        <p class="text-muted mb-0">{{ $user->email }}</p>
                    </div>
                </div>
            @empty
                <p class="text-muted text-center lead">
                    No Teachers found.
                </p>
            @endforelse
        </div>
    </div>

    <div class="row justify-content-center mt-4">
        <div class="col-4">
            {{ $users->appends(['search' => $search])->links() }}
        </div>
    </div>
@endsection