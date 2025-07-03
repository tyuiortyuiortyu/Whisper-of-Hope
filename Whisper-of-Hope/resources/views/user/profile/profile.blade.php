<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="background: #FFFFFF; border-radius: 25px; box-shadow: 0 4px 20px rgba(0,0,0,0.10); border: none;">
            <!-- White Header -->
            <div class="modal-header" style="border: none; background: #FFFFFF; padding: 10px 20px 8px; border-bottom: 1px solid #f0f0f0; display: flex; justify-content: space-between; align-items: center; border-radius: 25px 25px 0 0;">
                <h5 class="modal-title" id="profileModalLabel" style="font-size: 2.5rem; letter-spacing: 2px; color: #333; margin: 0; font-weight: 500;">Profile</h5>
                <img src="{{ asset('images/admin/user_admin/close.png') }}" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close" alt="Close">
            </div>
            <!-- Pink Body -->
            <div class="modal-body" style="background: #FFDBDF; padding: 30px; border-radius: 0 0 25px 25px;">
                <!-- Edit Profile Button -->
                <div class="d-flex justify-content-end mb-3">
                    <button type="button" class="btn" 
                        style="background: #F791A9; color: #fff; border-radius: 20px; padding: 8px 16px; font-weight: 500; border: none; font-size: 0.9rem;"
                        data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        <i class="bi bi-pencil-square me-1"></i>Edit Profile
                    </button>
                </div>
                
                <!-- Profile Image Section -->
                <div class="d-flex justify-content-center mb-4">
                    <div style="width: 80px; height: 80px; position: relative;" id="profileImageContainer">
                        @if(auth()->user()->profile_image)
                            <img src="{{ asset('storage/' . auth()->user()->profile_image) }}?v={{ time() }}" 
                                 style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;" id="profileModalImage">
                        @else
                            <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;
                                background: repeating-linear-gradient(45deg, #eee 0 8px, #fff 8px 16px);
                                border-radius: 50%;" id="profileModalPlaceholder">
                                <i class="bi bi-person-fill" style="font-size: 2rem; color: #999;"></i>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Profile Information in 2 columns -->
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold mb-2" style="color: #333; font-size: 0.9rem;">Name</label>
                        <div style="background: #FFF9EA; border: none; border-radius: 10px; padding: 12px 16px; min-height: 45px; display: flex; align-items: center;" id="profileModalName">
                            {{ auth()->user()->name }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold mb-2" style="color: #333; font-size: 0.9rem;">Email</label>
                        <div style="background: #FFF9EA; border: none; border-radius: 10px; padding: 12px 16px; min-height: 45px; display: flex; align-items: center;" id="profileModalEmail">
                            {{ auth()->user()->email }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold mb-2" style="color: #333; font-size: 0.9rem;">Phone Number</label>
                        <div style="background: #FFF9EA; border: none; border-radius: 10px; padding: 12px 16px; min-height: 45px; display: flex; align-items: center;" id="profileModalPhone">
                            {{ auth()->user()->phone ?? '' }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold mb-2" style="color: #333; font-size: 0.9rem;">Gender</label>
                        <div style="background: #FFF9EA; border: none; border-radius: 10px; padding: 12px 16px; min-height: 45px; display: flex; align-items: center; justify-content: space-between;">
                            <span id="profileModalGender">{{ auth()->user()->gender ? ucfirst(auth()->user()->gender) : '' }}</span>
                            <i class="bi bi-chevron-down" style="color: #666; font-size: 0.8rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
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
</style>