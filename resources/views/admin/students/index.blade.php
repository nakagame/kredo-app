@extends('layouts.app')

@section('title', 'Admin: All Students')

@section('content')
    <div class="row mb-4">
        <div class="col">
            <div class="row">
                <div class="col-auto">
                    <h1 class="text-secondary fw-light">All Students</h1>
                </div>
                <div class="col text-end">
                    <a href="{{ route('admin.students.create') }}" class="btn btn-primary">
                        <i class="fa-solid fa-plus"></i> Create a Student
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
                            <form action="{{ route('admin.students.search') }}">
                                <input class="form-control border-0" name="search" type="search" placeholder="Search Students">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-hover align-middle bg-white border">
        <thead class="table-primary text-secondary small">
            <tr>
                <th></th>
                <th>NAME</th>
                <th>EMAIL</th>
                <th>CLASSES</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($students as $student)
                <tr>
                    <td>
                        <a href="" class="text-decoration-none text-dark">
                            @if ($student->avatar)
                                <img src="{{ $student->avatar }}" alt="{{ $student->name }}" class="rounded-circle mx-auto d-block avatar-md">
                            @else
                                <i class="fa-regular fa-user icon-lg text-center mx-auto d-block"></i>
                            @endif
                        </a>
                    </td>
                    <td>
                        <a href="" class="fw-bold text-decoration-none text-dark">
                            {{ $student->name }}
                        </a>
                    </td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->classes_student->count() }}</td>
                    <td>
                        @if ($student->trashed())
                            <button class="btn border-0 bg-transparent text-success p-0" data-bs-toggle="modal" data-bs-target="#Inactivate-student-{{ $student->id }}">
                                <i class="fa-solid fa-user-check"></i>&nbsp; Inactivate
                            </button>
                            @include('admin.students.modal.action')
                        @else
                            <button class="btn border-0 bg-transparent text-danger p-0" data-bs-toggle="modal" data-bs-target="#deactivate-student-{{ $student->id }}"
                                {{ $student->classes_student->count() === 0 ? '' : 'disabled' }} >
                                     
                                <i class="fa-solid fa-user-xmark"></i>&nbsp; Deactivate
                            </button>
                            @include('admin.students.modal.action')
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">
                        No Students yet.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $students->links() }}
    </div>
@endsection