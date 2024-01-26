@extends('layouts.app')

@section('title', 'Admin: All Classes History')

@section('content')
    <a href="{{ route('admin.classroom') }}" class="btn btn-lg border-0 bg-transparent text-primary p-0 mb-4">
        <i class="fa-solid fa-chevron-left"></i>&nbsp; Back
    </a>

    <h1 class="fw-light text-secondary">Full History</h1>
    
    <table class="table table-hober table-bordered align-middle bg-white border w-75 mb-5">
        <thead class="table-secondary small">
            <tr>
                <th>DATE</th>
                <th>TIME</th>
                <th>TEACHER</th>
                <th>STUDENT</th>
                <th>COURSE</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($all_finished_classes as $class)
                <tr>
                    <td>{{ $class->date }}</td>
                    <td>{{ $class->start_time }}</td>
                    <td>{{ $class->student->name }}</td>
                    <td>{{ $class->teacher->name }}</td>
                    <td>{{ $class->course->title }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No classes finished yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>  

    <div class="row w-75 justify-content-center">
        <div class="col-auto">
            {{ $all_finished_classes->links() }}
        </div>
    </div>
@endsection