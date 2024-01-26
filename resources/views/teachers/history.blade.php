@extends('layouts.app')

@section('title', 'Teacher: History')

@section('content')
    <a href="{{ route('teacher.index') }}" class="btn btn-lg border-0 bg-transparent text-primary p-0 mb-4">
        <i class="fa-solid fa-chevron-left"></i>&nbsp; Back
    </a>

    <h1 class="fw-light text-secondary">History</h1>
    
    <table class="table table-hover table-bordered align-middle bg-white border w-75">
        <thead class="table-secondary small">
            <tr>
                <th>DATE</th>
                <th>TIME</th>
                <th>STUDENT</th>
                <th>COURSE</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($my_finished_classes as $class)
                <tr>
                    <td>{{ $class->date }}</td>
                    <td>{{ $class->start_time }}</td>
                    <td>{{ $class->student->name }}</td>
                    <td>{{ $class->course->title }}</td>
                    <td class="text-center">
                        {{-- modal --}}
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#revert-class-{{ $class->id }}">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                        </button>
                        {{-- modal end --}}
                    </td>
                </tr>

                @include('teachers.modal.action')
            @empty
                <tr>
                    <td colspan="5" class="text-center">No booking found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="row justify-content-center w-75">
        <div class="col-auto">
            {{ $my_finished_classes->links() }}
        </div>
    </div>
@endsection