@extends('layouts.app')

@section('title', 'Admin: All Courses')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" id="successAlert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row mb-4">
        <div class="col">
            <div class="row">
                <div class="col-auto">
                    <h1 class="text-secondary fw-light">All Courses</h1>
                </div>
                <div class="col text-end">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#create-course">
                        <i class="fa-solid fa-plus"></i> Create a Course
                    </button>
                </div>
                @include('admin.courses.modal.create')
            </div>
        </div>
    </div>

    <table class="table table-hover align-middle bg-white border w-50">
        <thead class="table-success text-secondary small">
            <tr>
                <th></th>
                <th>TITLE</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($all_courses as $course)
                <tr>
                    <td>{{ $course->id }}</td>
                    <td>{{ $course->title }}</td>
                    <td>
                        {{-- modal --}}
                            @if ($course->trashed())
                                <button class="btn border-0 bg-transparent p-0" data-bs-toggle="modal" data-bs-target="#show-course-{{ $course->id }}">
                                    <i class="fa-solid fa-eye"></i>&nbsp; visble
                                </button>
                                @include('admin.courses.modal.action')
                            @else
                                <button class="btn border-0 bg-transparent text-danger p-0" data-bs-toggle="modal" data-bs-target="#hide-course-{{ $course->id }}"
                                    {{ $course->classroom->count() === 0 ? '' : 'disabled' }}>
                                     
                                    <i class="fa-solid fa-eye-slash"></i>&nbsp; Hide
                                </button>
                                @include('admin.courses.modal.action')
                            @endif
                        {{-- modal end --}}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">
                        No Courses yet.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="row w-50 justify-content-center">
        <div class="col-auto">
            {{ $all_courses->links() }}
        </div>
    </div>
@endsection