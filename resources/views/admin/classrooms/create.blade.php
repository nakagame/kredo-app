@extends('layouts.app')

@section('title', 'Admin: Create Class')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h1 class="text-secondary fw-light mb-3">Create Class</h1>

    <div class="bg-white">
        <form action="{{ route('admin.classroom.store') }}" method="POST" class="w-50 p-5">
            @csrf

            <div class="mb-3">
                <label for="course" class="form-label text-secondary">Course</label>
                <select name="course" id="course" class="form-select" autofocus>
                    <option value="" hidden>Select a course</option>
                    @foreach ($all_courses as $course)
                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                    @endforeach
                </select>

                @error('course')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-3">
                <div class="row">
                    <div class="col">
                        <label for="date" class="form-label text-secondary">Date</label>
                        <input type="date" name="date" id="date" class="form-control">

                        @error('date')
                            <p class="text-danger small">{{ $message }}</p>  
                        @enderror
                    </div>
                    <div class="col">
                        <label for="start_time" class="form-label text-secondary">Start Time (PHT)</label>
                        <select name="start_time" id="start_time" class="form-select">
                            <option value="" hidden>--:--</option>
                    
                            <optgroup label="Morning" class="text-secondary">
                                <option value="09:00">09:00</option>
                                <option value="10:00">10:00</option>
                                <option value="11:00">11:00</option>
                                <option value="12:00">12:00</option>
                            </optgroup>
                    
                            <optgroup label="Afternoon" class="text-secondary">
                                <option value="14:00">14:00</option>
                                <option value="15:00">15:00</option>
                                <option value="16:00">16:00</option>
                                <option value="17:00">17:00</option>
                            </optgroup>
                        </select>
                    
                        @error('start_time')
                            <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>                    
                </div>
            </div>

            <div class="mb-3">
                <label for="teacher" class="form-label">Teacher</label>
                <select name="teacher" id="teacher" class="form-select">
                    <option value="" hidden>Select a teacher</option>
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <button type="submit" class="btn btn-dark small">
                <i class="fa-solid fa-save"></i>&nbsp; Save
            </button>
        </form>
    </div>
@endsection