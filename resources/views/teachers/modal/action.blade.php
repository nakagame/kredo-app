{{-- Lesson Done --}}
<div class="modal fade" id="finish-class-{{ $class->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-success w-75">
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <h3>
                            {{ $class->course->title }}
                        </h3>
                    </div>
                    <div class="col text-end">
                        <button class="btn border-0 bg-transparent text-secondary p-0" data-bs-dismiss="modal">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </div>
                <p class="mb-0">
                    <i class="fa-regular fa-calendar"></i>&nbsp; {{ Date('M d, Y', strtotime($class->date)) }}
                </p>
                <p class="mb-3">
                    <i class="fa-regular fa-clock"></i>&nbsp; {{ $class->start_time }}
                </p>
                <p class="text-secondary">
                    Student: <span class="fw-bold text-dark">{{ $class->student->name }}</span>
                </p>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <form action="{{ route('teacher.destroy', $class->id) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-success px-4">
                        Mark as Done
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- Lesson Done end --}}

{{-- Revrting Lesson --}}
<div class="modal fade" id="revert-class-{{ $class->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-secondary w-75">
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <h3>
                            {{ $class->course->title }}
                        </h3>
                    </div>
                    <div class="col text-end">
                        <button class="btn border-0 bg-transparent text-secondary p-0" data-bs-dismiss="modal">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </div>
                <p class="mb-0">
                    <i class="fa-regular fa-calendar"></i>&nbsp; {{ Date('M d, Y', strtotime($class->date)) }}
                </p>
                <p class="mb-3">
                    <i class="fa-regular fa-clock"></i>&nbsp; {{ $class->start_time }}
                </p>
                <p class="text-secondary">
                    Student: <span class="fw-bold text-dark">{{ $class->student->name }}</span>
                </p>
                <p class="bg-warning text-dark p-3">
                    Once reverted, this class shall be removed from your History and move back to your Bookings.
                </p>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <form action="{{ route('teacher.revert-class', $class->id) }}" method="post">
                    @csrf
                    @method('PATCH')

                    <button type="submit" class="btn btn-primary px-4">
                        Revert This Class
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- Revrting Lesson End --}}
