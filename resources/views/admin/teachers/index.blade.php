@extends('layouts.app')

@section('title', 'Admin: Teachers')

@section('content')
    <div class="row mb-4">
        <div class="col">
            <div class="row">
                <div class="col-auto">
                    <h1 class="text-secondary fw-light">All Teachers</h1>
                </div>
                <div class="col text-end">
                    <a href="{{ route('admin.teachers.create') }}" class="btn btn-info">
                        <i class="fa-solid fa-plus"></i> Create a Teacher
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container mb-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card border rounded-0">
                    <div class="card-body row no-gutters align-items-center">
                        <div class="col-auto">
                            <i class="fa-solid fa-magnifying-glass" style="font-size: 2rem;"></i>
                        </div>
                        <div class="col">
                            <form action="{{ route('admin.teachers.search') }}">
                                <input class="form-control border-0" name="search" type="search" placeholder="Search Teachers">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <table class="table table-hover align-middle bg-white border">
        <thead class="table-info text-secondary small">
            <tr>
                <th></th>
                <th>NAME</th>
                <th>EMAIL</th>
                <th>CLASSES</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($teachers as $teacher)
                <tr>
                    <td>
                        <a href="" class="text-decoration-none text-dark">
                            @if ($teacher->avatar)
                                <img src="{{ $teacher->avatar }}" alt="{{ $teacher->name }}" class="rounded-circle mx-auto d-block avatar-md">
                            @else
                                <i class="fa-solid fa-user-tie icon-lg text-center mx-auto d-block"></i>
                            @endif
                        </a>
                    </td>
                    <td>
                        <a href="" class="fw-bold text-decoration-none text-dark">
                            {{ $teacher->name }}
                        </a>
                    </td>
                    <td>{{ $teacher->email }}</td>
                    <td>{{ $teacher->classes->count() }}</td>
                    <td>
                        @if ($teacher->trashed())
                            <button class="btn border-0 bg-transparent text-success p-0" data-bs-toggle="modal" data-bs-target="#Inactivate-teacher-{{ $teacher->id }}">
                                <i class="fa-solid fa-user-check"></i>&nbsp; Inactivate
                            </button>
                            @include('admin.teachers.modal.action')
                        @else
                            <button class="btn border-0 bg-transparent text-danger p-0" data-bs-toggle="modal" data-bs-target="#deactivate-teacher-{{ $teacher->id }}"
                                {{ $teacher->classes->count() === 0 ? '' : 'disabled' }} >
                                <i class="fa-solid fa-user-xmark"></i>&nbsp; Deactivate
                            </button>
                            @include('admin.teachers.modal.action')
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">
                        No Teachers yet.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="d-flex justify-content-center">
        {{ $teachers->links() }}
    </div>
@endsection