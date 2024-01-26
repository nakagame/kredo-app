@if ($course->trashed())
    {{-- Visible --}}
    <div class="modal fade" id="show-course-{{ $course->id }}">
        <div class="modal-dialog">
            <div class="modal-content border-success">
                <div class="modal-header border-success">
                    <h3 class="modal-title text-success">
                        <i class="fa-solid fa-eye"></i>&nbsp; Show this class
                    </h3>
                </div>
                <div class="modal-body">
                    <p class="lead">
                        Are you sure you want to show <span class="fw-bold">{{ $course->title }}</span> ?
                    </p>
                </div>
                <form action="{{ route('admin.courses.show', $course->id) }}" method="post">
                    @csrf
                    @method('PATCH')

                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-success" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Show</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Visible end --}}
@else
    {{-- Hide --}}
    <div class="modal fade" id="hide-course-{{ $course->id }}">
        <div class="modal-dialog">
            <div class="modal-content border-danger">
                <div class="modal-header border-danger">
                    <h3 class="modal-title text-danger">
                        <i class="fa-solid fa-eye-slash"></i>&nbsp; Hide this class
                    </h3>
                </div>
                <div class="modal-body">
                    <p class="lead">
                        Are you sure you want to hide <span class="fw-bold">{{ $course->title }}</span> ?
                    </p>
                </div>
                <form action="{{ route('admin.courses.hide', $course->id) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Hide</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Hide end --}}
@endif
