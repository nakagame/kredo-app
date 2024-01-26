@if ($teacher->trashed())
    {{-- Inactivate --}}
    <div class="modal fade" id="Inactivate-teacher-{{ $teacher->id }}">
        <div class="modal-dialog">
            <div class="modal-content border-success">
                <div class="modal-header border-success">
                    <h3 class="modal-title text-success">
                        <i class="fa-solid fa-user"></i>&nbsp; Inactive User
                    </h3>
                </div>
                <div class="modal-body">
                    <p class="lead">
                        Are you sure you want to inactivate <span class="fw-bold">{{ $teacher->name }}</span> ?
                    </p>
                </div>
                <form action="{{ route('admin.teachers.inactive', $teacher->id) }}" method="post">
                    @csrf
                    @method('PATCH')

                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-success" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Inactivate end --}}
@else
    {{-- Deactivate --}}
    <div class="modal fade" id="deactivate-teacher-{{ $teacher->id }}">
        <div class="modal-dialog">
            <div class="modal-content border-danger">
                <div class="modal-header border-danger">
                    <h3 class="modal-title text-danger">
                        <i class="fa-solid fa-user"></i>&nbsp; Deactive User
                    </h3>
                </div>
                <div class="modal-body">
                    <p class="lead">
                        Are you sure you want to deactive <span class="fw-bold">{{ $teacher->name }}</span> ?
                    </p>
                </div>
                <form action="{{ route('admin.teachers.deactive', $teacher->id) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Deactive</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Deactivate end --}}
@endif
