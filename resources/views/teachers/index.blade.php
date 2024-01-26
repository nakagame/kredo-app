@extends('layouts.app')

@section('title', 'Teacher: Home')

@section('content')
    {{-- Bookings  --}}
    <div class="row text-secondary">
        <div class="col">
            <h1 class="fw-light">Bookings</h1>
        </div>
        <div class="col text-end">
            <a href="{{ route('teacher.show') }}" class="btn btn-outline-secondary">
                <i class="fa-solid fa-clock-rotate-left"></i>&nbsp; View Finished Bookings
            </a>
        </div>
    </div>
    <div class="row row-cols-4 g-4 mb-5">
        @forelse ($my_classes as $class)
            <div class="col">
                <div class="card card-body bg-white shadow h-100">
                    <span class="badge text-white bg-success w-25 mb-2">
                        Booked
                    </span>
                    <h2 class="h5 mb-0">{{ $class->course->title }}</h2>
                    <p class="mb-0">
                        <i class="fa-regular fa-calendar"></i>&nbsp; {{ Date('M d, Y', strtotime($class->date)) }}
                    </p>
                    <p class="mb-3">
                        <i class="fa-regular fa-clock"></i>&nbsp; {{ $class->start_time }}
                    </p>
                    <p class="text-secondary">
                        Student: <span class="fw-bold text-dark">{{ $class->student->name }}</span>
                    </p>
                    
                    {{-- modal  --}}
                    <button class="btn btn-outline-success w-100" data-bs-toggle="modal" data-bs-target="#finish-class-{{ $class->id }}">
                        Done
                    </button>
                    
                    @include('teachers.modal.action')
                    {{-- modal end --}}
                </div>
            </div>
        @empty
            <div class="col">
                <p class="text-secondary">No booking found.</p>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center">
        {{ $my_classes->appends(['my_classes_page' => $my_classes->currentPage()])->links() }}
    </div> 
    {{-- Bookings end --}}

    {{-- Vacant classes  --}}
    <div class="row text-secondary">
        <div class="col">
            <h1 class="fw-light">Vacant Classes</h1>
        </div>
    </div>
    <div class="row row-cols-4 g-4 mb-5">
        @forelse ($vacant_classes as $vacant_classe)
            <div class="col">                
                <div class="card card-body bg-white shadow h-100">
                    <span class="badge text-white bg-warning w-25 mb-2">
                        Vacant
                    </span>
                    <h2 class="h5">{{ $vacant_classe->course->title }}</h2>
                    <p class="mb-0">
                        <i class="fa-regular fa-calendar"></i>&nbsp; {{ Date('M d, Y', strtotime($vacant_classe->date)) }}
                    </p>
                    <p class="mb-0">
                        <i class="fa-regular fa-clock"></i>&nbsp; {{ $vacant_classe->start_time }}
                    </p>
                </div>    
            </div>
        @empty
            <div class="col">
                <p class="text-secondary">No booking found.</p>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center">
        {{ $vacant_classes->appends(['vacant_classes_page' => $vacant_classes->currentPage()])->links() }}
    </div>
    {{-- Vacant classes end --}}
@endsection