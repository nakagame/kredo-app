@extends('layouts.app')

@section('title', 'Student: Home')

@section('content')
    {{-- My classes  --}}
    <div class="row text-secondary">
        <div class="col">
            <h1 class="fw-light">My Classes</h1>
        </div>
        <div class="col text-end">
            <a href="{{ route('student.show') }}" class="btn btn-outline-secondary">
                <i class="fa-solid fa-clock-rotate-left"></i>&nbsp; View Finished Classes
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
                    <h2 class="h5">{{ $class->course->title }}</h2>
                    <p class="mb-0">
                        <i class="fa-regular fa-calendar"></i>&nbsp; {{ Date('M d, Y', strtotime($class->date)) }}
                    </p>
                    <p class="mb-0">
                        <i class="fa-regular fa-clock"></i>&nbsp; {{ $class->start_time }}
                    </p>
                    
                    {{-- Cancel modal --}} 
                    <button class="btn border-0 bg-transparent text-secondary p-0 text-start" data-bs-toggle="modal" data-bs-target="#cancel-class-{{ $class->id }}">
                        <i class="fa-solid fa-ban"></i> Cancel
                    </button>
                    {{-- Cancel modal end --}}
                </div>
                
                @include('students.modal.action')
            </div>
        @empty
            <div class="col">
                <p class="text-secondary">You can book any available classes below.</p>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center">
        {{ $my_classes->appends(['my_classes_page' => $my_classes->currentPage()])->links() }}
    </div>
    {{-- My classes end --}}

    {{-- Available classes  --}}
    <div class="row text-secondary">
        <div class="col">
            <h1 class="fw-light">Available Classes</h1>
        </div>
    </div>
    <div class="row row-cols-4 g-4 mb-5">
        @forelse ($available_classes as $available_class)
            <div class="col">                
                <div class="card card-body bg-white shadow h-100">
                    <span class="badge text-white bg-warning w-25 mb-2">
                        Vacant
                    </span>
                    <h2 class="h5">{{ $available_class->course->title }}</h2>
                    <p class="mb-0">
                        <i class="fa-regular fa-calendar"></i>&nbsp; {{ Date('M d, Y', strtotime($available_class->date)) }}
                    </p>
                    <p class="mb-4">
                        <i class="fa-regular fa-clock"></i>&nbsp; {{ $available_class->start_time }}
                    </p>
                    
                    <form action="{{ route('student.update', $available_class->id) }}" method="post">
                        @csrf
                        @method("PATCH")

                        <button type="submit" class="btn btn-outline-success w-100">
                            Book This Class
                        </button>
                    </form>
                </div>    
            </div>
        @empty
            <div class="col">
                <p class="text-secondary">No available classes.</p>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center">
        {{ $available_classes->appends(['available_classes' => $available_classes->currentPage()])->links() }}
    </div>
    {{-- Available classes end --}}
@endsection