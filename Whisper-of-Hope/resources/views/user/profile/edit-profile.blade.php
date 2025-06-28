<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="background: #FFFFFF; border-radius: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.10); border: none;">
            <!-- White Header -->
            <div class="modal-header" style="border: none; background: #FFFFFF; padding: 20px 30px 15px; border-bottom: 1px solid #f0f0f0;">
                <h5 class="modal-title fw-bold" id="editProfileModalLabel" style="font-size: 1.4rem; color: #333; margin: 0;">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="font-size: 1.2rem;"></button>
            </div>
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" id="editProfileForm">
                @csrf
                @method('PUT')
                <meta name="csrf-token" content="{{ csrf_token() }}">
                
                <!-- Pink Body -->
                <div class="modal-body" style="background: #FFDBDF; padding: 30px;">
                    <!-- Profile Image Section -->
                    <div class="d-flex justify-content-center mb-3">
                        <div style="width: 80px; height: 80px; position: relative;">
                            <label for="profileImage" style="cursor: pointer; width: 100%; height: 100%; display: block;">
                                @if(auth()->user()->profile_image)
                                    <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" id="profileImagePreview"
                                         style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                                @else
                                    <div id="profileImagePreview" style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;
                                        background: repeating-linear-gradient(45deg, #eee 0 8px, #fff 8px 16px);
                                        border-radius: 50%;">
                                        <i class="bi bi-person-fill" style="font-size: 2rem; color: #999;"></i>
                                    </div>
                                @endif
                            </label>
                            <input type="file" class="form-control d-none" id="profileImage" name="profile_image" accept="image/*">
                            <!-- Hidden input to track image removal -->
                            <input type="hidden" id="removeImage" name="remove_image" value="0">
                        </div>
                    </div>

                    <!-- Upload/Remove Buttons -->
                    <div class="d-flex justify-content-center gap-2 mb-4">
                        <button type="button" class="btn" onclick="document.getElementById('profileImage').click()" 
                            style="background: #F791A9; color: #fff; border: none; border-radius: 15px; padding: 6px 16px; font-weight: 500; font-size: 0.9rem;">
                            Upload
                        </button>
                        <button type="button" class="btn" id="removeImageBtn"
                            style="background: #D6D6D6; color: #fff; border: none; border-radius: 15px; padding: 6px 16px; font-weight: 500; font-size: 0.9rem;">
                            Remove
                        </button>
                    </div>

                    <!-- Form Fields in 2 columns -->
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="editName" class="form-label fw-bold mb-2" style="color: #333; font-size: 0.9rem;">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="editName" name="name" value="{{ old('name', auth()->user()->name) }}" required
                                   style="background: #FFF9EA; border: none; border-radius: 20px; padding: 12px 16px; min-height: 45px;">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="editEmail" class="form-label fw-bold mb-2" style="color: #333; font-size: 0.9rem;">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   id="editEmail" name="email" value="{{ old('email', auth()->user()->email) }}" required
                                   style="background: #FFF9EA; border: none; border-radius: 20px; padding: 12px 16px; min-height: 45px;">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="editPhone" class="form-label fw-bold mb-2" style="color: #333; font-size: 0.9rem;">Phone Number</label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                   id="editPhone" name="phone" value="{{ old('phone', auth()->user()->phone) }}"
                                   style="background: #FFF9EA; border: none; border-radius: 20px; padding: 12px 16px; min-height: 45px;">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold mb-2" style="color: #333; font-size: 0.9rem;">Gender</label>
                            <div class="position-relative">
                                <select class="form-select @error('gender') is-invalid @enderror" name="gender"
                                    style="background: #FFF9EA; border: none; border-radius: 20px; padding: 12px 16px; min-height: 45px; appearance: none;">
                                    <option value="">Select Gender</option>
                                    <option value="male" {{ old('gender', auth()->user()->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender', auth()->user()->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                                <div style="position: absolute; right: 16px; top: 50%; transform: translateY(-50%); pointer-events: none;">
                                    <i class="bi bi-chevron-down" style="color: #666; font-size: 0.8rem;"></i>
                                </div>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Pink Footer with Buttons -->
                <div class="modal-footer d-flex justify-content-end gap-2" style="border: none; background: #FFDBDF; padding: 0 30px 30px;">
                    <button type="submit" class="btn" 
                        style="background: #F791A9; color: #fff; border: none; border-radius: 15px; padding: 8px 20px; font-weight: 500; font-size: 0.9rem;">
                        Save changes
                    </button>
                    <button type="button" class="btn" data-bs-dismiss="modal"
                        style="background: #D6D6D6; color: #fff; border: none; border-radius: 15px; padding: 8px 20px; font-weight: 500; font-size: 0.9rem;">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add CSRF token to AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Wait for modal to be fully loaded
    const editProfileModal = document.getElementById('editProfileModal');
    
    editProfileModal.addEventListener('shown.bs.modal', function() {
        // Refresh CSRF token when modal opens
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const csrfInput = document.querySelector('input[name="_token"]');
        if (csrfInput) {
            csrfInput.value = csrfToken;
        }

        const profileImageInput = document.getElementById('profileImage');
        const removeImageBtn = document.getElementById('removeImageBtn');
        const removeImageFlag = document.getElementById('removeImage');
        let profileImagePreview = document.getElementById('profileImagePreview');

        // Remove existing event listeners to prevent duplicates
        profileImageInput.replaceWith(profileImageInput.cloneNode(true));
        const newProfileImageInput = document.getElementById('profileImage');
        
        // Handle image upload
        newProfileImageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Validate file type
                if (!file.type.startsWith('image/')) {
                    alert('Please select an image file.');
                    return;
                }
                
                // Validate file size (max 2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('File size must be less than 2MB.');
                    return;
                }

                // Reset remove flag when new image is selected
                removeImageFlag.value = '0';

                const reader = new FileReader();
                reader.onload = function(e) {
                    const currentPreview = document.getElementById('profileImagePreview');
                    
                    if (currentPreview.tagName === 'IMG') {
                        currentPreview.src = e.target.result;
                    } else {
                        // Replace placeholder with image
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.id = 'profileImagePreview';
                        img.style.cssText = 'width: 100%; height: 100%; object-fit: cover; border-radius: 50%;';
                        currentPreview.replaceWith(img);
                    }
                };
                reader.readAsDataURL(file);
            }
        });

        // Handle image removal
        removeImageBtn.addEventListener('click', function() {
            // Clear file input
            newProfileImageInput.value = '';
            
            // Set remove flag to true
            removeImageFlag.value = '1';
            
            const currentPreview = document.getElementById('profileImagePreview');
            
            if (currentPreview.tagName === 'IMG') {
                // Replace image with placeholder
                const placeholder = document.createElement('div');
                placeholder.id = 'profileImagePreview';
                placeholder.style.cssText = 'width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: repeating-linear-gradient(45deg, #eee 0 8px, #fff 8px 16px); border-radius: 50%;';
                placeholder.innerHTML = '<i class="bi bi-person-fill" style="font-size: 2rem; color: #999;"></i>';
                currentPreview.replaceWith(placeholder);
            }
        });
    });

    // Handle Edit Profile modal close to show Profile modal
    const editProfileModal = document.getElementById('editProfileModal');
    if (editProfileModal) {
        editProfileModal.addEventListener('hidden.bs.modal', function() {
            // Only return to profile modal if no other modal is being opened
            setTimeout(function() {
                const anyModalOpen = document.querySelector('.modal.show');
                if (!anyModalOpen) {
                    // Show profile modal with blank backdrop
                    const profileModal = document.getElementById('profileModal');
                    if (profileModal) {
                        const modalInstance = new bootstrap.Modal(profileModal, {
                            backdrop: true,
                            keyboard: true
                        });
                        modalInstance.show();
                    }
                }
            }, 150);
        });

        // Handle X button for edit profile
        const editCloseBtn = editProfileModal.querySelector('.btn-close');
        if (editCloseBtn) {
            editCloseBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const modalInstance = bootstrap.Modal.getInstance(editProfileModal);
                if (modalInstance) {
                    modalInstance.hide();
                } else {
                    editProfileModal.classList.remove('show');
                    editProfileModal.style.display = 'none';
                    // Clean backdrops
                    const backdrops = document.querySelectorAll('.modal-backdrop');
                    backdrops.forEach(backdrop => backdrop.remove());
                }
            });
        }
    }
});
</script>