@extends('layouts.app')

@section('title', 'Admin: All Classes')

@section('content')
    <div class="row mb-4">
        <div class="col">
            <div class="row">
                <div class="col-auto">
                    <h1 class="text-secondary fw-light">All Classes</h1>
                </div>
                <div class="col text-end">
                    <a href="{{ route('admin.classroom.create') }}" class="btn btn-dark">
                        <i class="fa-solid fa-plus"></i> Create a Class
                    </a>

                    <a href="{{ route('admin.classroom.history') }}" class="btn btn-outline-secondary">
                        <i class="fa-solid fa-clock-rotate-left"></i>&nbsp; All Finished Classes
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row row-cols-4 g-4 mb-5">
        @forelse ($all_classes as $class)
            @if ($class->teacher && $class->teacher->is_active()) 
                <div class="col">  
                    <div class="card card-body bg-white shadow h-100">
                        @if ($class->student_id)
                            <span class="badge text-white bg-success w-25 mb-2">
                                Booked
                            </span>
                        @else
                            <span class="badge text-white bg-warning w-25 mb-2">
                                Vacant
                            </span>
                        @endif
        
                        <h2 class="h5">{{ $class->course->title }}</h2>
                        <p class="mb-0">
                            <i class="fa-regular fa-calendar"></i>&nbsp; {{ Date('M d, Y', strtotime($class->date)) }}
                        </p>
                        <p class="mb-0">
                            <i class="fa-regular fa-clock"></i>&nbsp; {{ $class->start_time }}
                        </p>
                        <a href="" class="text-decoration-none text-dark mb-3">
                            <i class="fa-solid fa-user-tie"></i>&nbsp; {{ optional($class->teacher)->name }}
                        </a>
                        <a href="" class="text-decoration-none text-secondary">
                            Student: 
                            @if ($class->student_id)
                                <span class="fw-bold text-dark">{{ $class->student->name }}</span>
                            @else
                                <span class="fw-bold text-dark">---</span>
                            @endif
                        </a>
                    </div>    
                </div>
            @endif
        @empty
            <div class="col">
                <p class="display-6">No Classes yet.</p>
            </div>        
        @endforelse
    </div>

    <div class="d-flex justify-content-center">
        {{ $all_classes->links() }}
    </div>
@endsection