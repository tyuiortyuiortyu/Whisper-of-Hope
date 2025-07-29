<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="background: #FFFFFF; border-radius: 25px; box-shadow: 0 4px 20px rgba(0,0,0,0.10); border: none;">
            <!-- White Header -->
            <div class="modal-header" style="border: none; background: #FFFFFF; padding: 10px 20px 8px; border-bottom: 1px solid #f0f0f0; border-radius: 25px 25px 0 0;">
                <h5 class="modal-title" id="editProfileModalLabel" style="font-size: 2.5rem; letter-spacing: 2px; color: #333; margin: 0; font-weight: 300;">{{ __('profile.edit_profile') }}</h5>
                <img src="{{ asset('images/admin/user_admin/close.png') }}" class="modal-close-btn" data-bs-dismiss="modal" aria-label="{{ __('general.close') }}" alt="Close">
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
                            style="background: #F9BCC4; color: black; border: none; border-radius: 15px; padding: 6px 16px; font-weight: 500; font-size: 0.9rem;">
                            {{ __('profile.upload') }}
                        </button>
                        
                        <button type="button" class="btn" id="removeImageBtn"
                            style="background: #D6D6D6; color: black; border: none; border-radius: 15px; padding: 6px 16px; font-weight: 500; font-size: 0.9rem;">
                            {{ __('profile.remove') }}
                        </button>
                    </div>

                    <!-- Form Fields in 2 columns -->
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="editName" class="form-label fw-bold mb-2" style="color: #333; font-size: 0.9rem;">{{ __('profile.name') }}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="editName" name="name" value="{{ old('name', auth()->user()->name) }}" required
                                   style="background: #FFF9EA; border: none; border-radius: 10px; padding: 12px 16px; min-height: 45px;">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="editEmail" class="form-label fw-bold mb-2" style="color: #333; font-size: 0.9rem;">{{ __('profile.email') }}</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   id="editEmail" name="email" value="{{ old('email', auth()->user()->email) }}" required
                                   style="background: #FFF9EA; border: none; border-radius: 10px; padding: 12px 16px; min-height: 45px;">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="editPhone" class="form-label fw-bold mb-2" style="color: #333; font-size: 0.9rem;">{{ __('profile.phone_number') }}</label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                   id="editPhone" name="phone" value="{{ old('phone', auth()->user()->phone) }}"
                                   style="background: #FFF9EA; border: none; border-radius: 10px; padding: 12px 16px; min-height: 45px;">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold mb-2" style="color: #333; font-size: 0.9rem;">{{ __('profile.gender') }}</label>
                            <div class="position-relative">
                                <select class="form-select @error('gender') is-invalid @enderror" name="gender"
                                    style="background: #FFF9EA; border: none; border-radius: 10px; padding: 12px 16px; min-height: 45px; appearance: none;">
                                    <option value="">{{ __('profile.select_gender') }}</option>
                                    <option value="male" {{ old('gender', auth()->user()->gender) == 'male' ? 'selected' : '' }}>{{ __('profile.male') }}</option>
                                    <option value="female" {{ old('gender', auth()->user()->gender) == 'female' ? 'selected' : '' }}>{{ __('profile.female') }}</option>
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
                <div class="modal-footer d-flex justify-content-end gap-2" style="border: none; background: #FFDBDF; padding: 0 30px 30px; border-radius: 0 0 25px 25px;">
                    <button type="submit" class="btn" 
                        style="background: #F9BCC4; color: black; border: none; border-radius: 15px; padding: 8px 20px; font-weight: 500; font-size: 0.9rem;">
                        {{ __('profile.save_changes') }}
                    </button>
                    <button type="button" class="btn" data-bs-dismiss="modal"
                        style="background: #D6D6D6; color: black; border: none; border-radius: 15px; padding: 8px 20px; font-weight: 500; font-size: 0.9rem;">
                        {{ __('general.cancel') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.modal-close-btn {
    width: 24px;
    height: 24px;
    object-fit: contain;
    cursor: pointer;
    background: none;
    border: none;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.modal-close-btn:hover {
    background: #f5f5f5;
    transform: scale(1.1);
}

/* Pink focus animations for form inputs */
.form-control:focus {
    background: #FFF9EA !important;
    border: none !important;
    box-shadow: 0 0 0 0.2rem rgba(249, 188, 196, 0.25) !important;
    outline: none !important;
}

.form-select:focus {
    background: #FFF9EA !important;
    border: none !important;
    box-shadow: 0 0 0 0.2rem rgba(249, 188, 196, 0.25) !important;
    outline: none !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add CSRF token to AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

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
                    newProfileImageInput.value = '';
                    return;
                }
                
                // Validate file size (max 2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('File size must be less than 2MB.');
                    newProfileImageInput.value = '';
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
            
            // Replace with placeholder regardless of current state
            const placeholder = document.createElement('div');
            placeholder.id = 'profileImagePreview';
            placeholder.style.cssText = 'width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: repeating-linear-gradient(45deg, #eee 0 8px, #fff 8px 16px); border-radius: 50%;';
            placeholder.innerHTML = '<i class="bi bi-person-fill" style="font-size: 2rem; color: #999;"></i>';
            currentPreview.replaceWith(placeholder);
        });
    });

    // Handle form submission with AJAX
    const editProfileForm = document.getElementById('editProfileForm');
    if (editProfileForm) {
        editProfileForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            
            // Show loading state
            submitBtn.disabled = true;
            submitBtn.textContent = 'Saving...';
            
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Update profile modal data
                    updateProfileModal(data);
                    
                    // Close edit modal and show profile modal
                    const modalInstance = bootstrap.Modal.getInstance(editProfileModal);
                    if (modalInstance) {
                        modalInstance.hide();
                    }
                    
                    // Show success message
                    showSuccessMessage(data.message);
                    
                } else {
                    throw new Error(data.message || 'Update failed');
                }
            })
            .catch(error => {
                console.error('Error details:', error);
                alert('Error updating profile: ' + error.message);
            })
            .finally(() => {
                // Reset button state
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;
            });
        });
    }

    // Function to update profile modal with new data
    function updateProfileModal(data) {
        // Update profile image in profile modal
        const profileImageContainer = document.getElementById('profileImageContainer');
        if (profileImageContainer) {
            if (data.profile_image_url) {
                profileImageContainer.innerHTML = `
                    <img src="${data.profile_image_url}" 
                         style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;" id="profileModalImage">
                `;
            } else {
                profileImageContainer.innerHTML = `
                    <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;
                        background: repeating-linear-gradient(45deg, #eee 0 8px, #fff 8px 16px);
                        border-radius: 50%;" id="profileModalPlaceholder">
                        <i class="bi bi-person-fill" style="font-size: 2rem; color: #999;"></i>
                    </div>
                `;
            }
        }
        
        // Update navbar profile image
        const navbarProfileImg = document.querySelector('.auth-container .profile-img');
        const navbarProfileIcon = document.querySelector('.auth-container .bi-person-circle');
        
        if (data.profile_image_url) {
            // If there's a new image
            if (navbarProfileImg) {
                // Update existing image
                navbarProfileImg.src = data.profile_image_url;
            } else if (navbarProfileIcon) {
                // Replace icon with image
                navbarProfileIcon.outerHTML = `<img src="${data.profile_image_url}" class="profile-img ms-2" style="width:32px;height:32px;object-fit:cover;border-radius:50%;">`;
            }
        } else {
            // If image was removed
            if (navbarProfileImg) {
                // Replace image with icon
                navbarProfileImg.outerHTML = `<i class="bi bi-person-circle fs-5 ms-2"></i>`;
            }
        }
        
        // Update profile data in modal
        if (data.user) {
            const nameEl = document.getElementById('profileModalName');
            const emailEl = document.getElementById('profileModalEmail');
            const phoneEl = document.getElementById('profileModalPhone');
            const genderEl = document.getElementById('profileModalGender');
            
            if (nameEl) nameEl.textContent = data.user.name;
            if (emailEl) emailEl.textContent = data.user.email;
            if (phoneEl) phoneEl.textContent = data.user.phone || '';
            if (genderEl) genderEl.textContent = data.user.gender ? data.user.gender.charAt(0).toUpperCase() + data.user.gender.slice(1) : '';
        }
        
        // Update navbar user name
        const navbarUserName = document.querySelector('.auth-container .user-name');
        if (navbarUserName && data.user && data.user.name) {
            navbarUserName.textContent = data.user.name;
        }
    }

    // Function to show success message
    function showSuccessMessage(message) {
        // Create and show a temporary success alert
        const alert = document.createElement('div');
        alert.className = 'alert alert-success alert-dismissible fade show position-fixed';
        alert.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
        alert.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        document.body.appendChild(alert);
        
        // Auto remove after 3 seconds
        setTimeout(() => {
            if (alert.parentNode) {
                alert.remove();
            }
        }, 3000);
    }

    // Clean modal backdrop handling
    if (editProfileModal) {
        editProfileModal.addEventListener('hidden.bs.modal', function() {
            // Remove only extra backdrops, keep one if another modal needs to show
            const backdrops = document.querySelectorAll('.modal-backdrop');
            if (backdrops.length > 0) {
                // Remove all backdrops and let Bootstrap handle it properly
                backdrops.forEach(backdrop => backdrop.remove());
                
                // Check if any other modals are still open
                const openModals = document.querySelectorAll('.modal.show');
                if (openModals.length === 0) {
                    // Only reset body if no modals are open
                    document.body.classList.remove('modal-open');
                    document.body.style.overflow = '';
                    document.body.style.paddingRight = '';
                }
            }
        });
        
        // Prevent multiple backdrop creation
        editProfileModal.addEventListener('show.bs.modal', function() {
            // Clean any existing backdrops before showing
            const existingBackdrops = document.querySelectorAll('.modal-backdrop');
            if (existingBackdrops.length > 0) {
                existingBackdrops.forEach(backdrop => backdrop.remove());
            }
        });
    }
});
</script>