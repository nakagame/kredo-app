<div class="modal fade" id="cancel-class-{{ $class->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger w-75">
            <form action="{{ route('student.cancel', $class->id) }}" method="post">
                @csrf
                @method('PATCH')

                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <h3>
                                {{ $class->course->title }}
                            </h3>
                        </div>
                        <div class="col text-end">
                            <button type="button" data-bs-dismiss="modal" class="btn border-0 bg-transparent text-secondary">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                    </div>
                    <p class="mb-0">
                        <i class="fa-regular fa-calendar"></i>&nbsp; {{ Date('M d, Y', strtotime($class->date)) }}
                    </p>
                    <p class="mb-0">
                        <i class="fa-regular fa-clock"></i>&nbsp; {{ $class->start_time }}
                    </p>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="submit" class="btn btn-danger">
                        Cancel This Booking
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

