<div class="modal fade" id="edit-profile-{{ $user->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-primary">
            <div class="modal-header border-primary">
                <h3 class="modal-title text-primary">
                    <i class="fa-solid fa-pen"></i>&nbsp; Edit Profile
                </h3>
            </div>
            
            <form action="{{ route('update') }}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                @method('PATCH')
            
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="name" id="name" placeholder="John Doe" value="{{ $user->name }}" autofocus required>
                        <label for="name">Name</label>

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror                       
                    </div>

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email', $user->email) }}" placeholder="name@example.com" required>
                        <label for="email">Email address</label>
                        
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                           
                    <div class="mb-3">
                        <label for="avatar" class="form-label d-block">Avatar</label>
                        @if ($user->avatar)
                            <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="rounded mb-3" style="object-fit: cover; width: 200px; height: 200px;">  
                        @endif
                        <input type="file" name="avatar" id="avatar" class="form-control" aria-describedby="avatar-info">
                        <div class="form-text" id="avatar-info">
                            Available file format: jpeg, jpg, png, gif only. <br>
                            Maximum file size is 1048 KB.
                        </div>
       
                        @error('avatar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror                      
                    </div>
                </div>

                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>   

<script>
    (() => {
        'use strict';

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation');

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add('was-validated');
            }, false);

            // Add an input event listener to check validity on input change
            form.addEventListener('input', event => {
                if (event.target.tagName.toLowerCase() === 'input') {
                    event.target.classList.remove('is-invalid');
                }
            });
        });
    })();
</script>
