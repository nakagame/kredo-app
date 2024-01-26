<div class="modal fade" id="create-course">
    <div class="modal-dialog">
        <div class="modal-content border-success">
            <div class="modal-header border-success">
                <h3 class="modal-title text-success">
                    <i class="fa-solid fa-plus"></i>&nbsp; Create a new class
                </h3>
            </div>
            <form action="{{ route('admin.courses.store') }}" method="post">
                @csrf

                <div class="modal-body">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control">
                    @error('title')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>

                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-success" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>