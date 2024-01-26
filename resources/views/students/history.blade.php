@extends('layouts.app')

@section('title', 'Student: History')

@section('content')
    <a href="{{ route('student.index') }}" class="btn btn-lg border-0 bg-transparent text-primary p-0 mb-4">
        <i class="fa-solid fa-chevron-left"></i>&nbsp; Back
    </a>

    <h1 class="fw-light text-secondary">History</h1>
    
    <table class="table table-hober table-bordered align-middle bg-white border w-50">
        <thead class="table-secondary small">
            <tr>
                <th>DATE</th>
                <th>TIME</th>
                <th>COURSE</th>
                <th>TEACHER</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($my_finished_classes as $class)
                <tr>
                    <td>{{ $class->date }}</td>
                    <td>{{ $class->start_time }}</td>
                    <td>{{ $class->course->title }}</td>
                    <td>{{ $class->teacher->name }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No classes found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="row justify-content-center w-50">
        <div class="col-auto">
            {{ $my_finished_classes->links() }}
        </div>
    </div>
@endsection