<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="background: #FFD6DF; border-radius: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.10); border: none;">
            <div class="modal-header" style="border: none; background: #FFD6DF;">
                <h5 class="modal-title fw-bold" id="editProfileModalLabel" style="font-size: 1.3rem;">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body d-flex align-items-start" style="background: #FFD6DF;">
                    <div class="me-4 flex-shrink-0 d-flex flex-column align-items-center" style="width: 320px;">
                        <div style="position:relative; width:220px; height:220px; margin-bottom: 20px;">
                            <label for="profileImage" style="cursor:pointer; width:100%; height:100%;">
                                @if(auth()->user()->profile_image)
                                    <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" id="profileImagePreview" style="width:100%; height:100%; object-fit:cover; border-radius:16px; background:#fff;">
                                @else
                                    <div id="profileImagePreview" style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;
                                        background: repeating-linear-gradient(45deg,#eee 0 20px,#fff 20px 40px);
                                        border-radius:16px;">
                                    </div>
                                @endif
                                <span style="position:absolute;top:10px;left:10px;background:rgba(255,255,255,0.8);border-radius:50%;padding:6px;">
                                    <i class="bi bi-camera" style="font-size: 1.2rem; color: #222;"></i>
                                </span>
                            </label>
                            <input type="file" class="form-control d-none" id="profileImage" name="profile_image" accept="image/*">
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <div class="mb-4 d-flex align-items-center">
                            <label for="editName" class="form-label mb-0" style="width:120px;">Name:</label>
                            <input type="text" class="form-control ms-2 @error('name') is-invalid @enderror"
                                   id="editName" name="name" value="{{ old('name', auth()->user()->name) }}" required
                                   style="background: #FFF9EA; border-radius: 16px; box-shadow: 0 2px 8px #0001; border:none;">
                        </div>
                        <div class="mb-4 d-flex align-items-center">
                            <label for="editEmail" class="form-label mb-0" style="width:120px;">Email:</label>
                            <input type="email" class="form-control ms-2 @error('email') is-invalid @enderror"
                                   id="editEmail" name="email" value="{{ old('email', auth()->user()->email) }}" required
                                   style="background: #FFF9EA; border-radius: 16px; box-shadow: 0 2px 8px #0001; border:none;">
                        </div>
                        <div class="mb-4 d-flex align-items-center">
                            <label for="editPhone" class="form-label mb-0" style="width:120px;">Phone Number:</label>
                            <input type="tel" class="form-control ms-2 @error('phone') is-invalid @enderror"
                                   id="editPhone" name="phone" value="{{ old('phone', auth()->user()->phone) }}"
                                   style="background: #FFF9EA; border-radius: 16px; box-shadow: 0 2px 8px #0001; border:none;">
                        </div>
                        <div class="mb-4 d-flex align-items-center">
                            <label class="form-label mb-0" style="width:120px;">Gender:</label>
                            <div class="ms-2 w-100">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="genderMale" value="male" {{ old('gender', auth()->user()->gender) == 'male' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="genderMale">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="female" {{ old('gender', auth()->user()->gender) == 'female' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="genderFemale">Female</label>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex mt-4">
                            <button type="submit" class="btn" style="background: #E96A8B; color: #fff; border-radius: 20px; min-width: 110px; font-weight: 500;">Save</button>
                            <button type="button" class="btn ms-2" style="background: #E0E0E0; color: #333; border-radius: 20px; min-width: 110px; font-weight: 500;" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
document.getElementById('profileImage').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            let preview = document.getElementById('profileImagePreview');
            if (preview.tagName === 'IMG') {
                preview.src = e.target.result;
            } else {
                // Replace checkerboard with image
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.width = '100%';
                img.style.height = '100%';
                img.style.objectFit = 'cover';
                img.style.borderRadius = '16px';
                img.style.background = '#fff';
                img.id = 'profileImagePreview';
                preview.replaceWith(img);
            }
        }
        reader.readAsDataURL(file);
    }
});
</script>