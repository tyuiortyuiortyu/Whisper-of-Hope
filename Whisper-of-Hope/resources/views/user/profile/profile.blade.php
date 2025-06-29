<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="background: #FFFFFF; border-radius: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.10); border: none;">
            <!-- White Header -->
            <div class="modal-header d-flex justify-content-between align-items-center" style="border: none; background: #FFFFFF; padding: 20px 30px 15px; border-bottom: 1px solid #f0f0f0;">
                <h5 class="modal-title fw-bold" id="profileModalLabel" style="font-size: 1.4rem; color: #333; margin: 0;">Profile</h5>
                <div class="d-flex align-items-center">
                    <button type="button" class="btn me-3" 
                        style="background: #F791A9; color: #fff; border-radius: 20px; padding: 8px 16px; font-weight: 500; border: none; font-size: 0.9rem;"
                        data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        <i class="bi bi-pencil-square me-1"></i>Edit Profile
                    </button>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="font-size: 1.2rem;"></button>
                </div>
            </div>
            <!-- Pink Body -->
            <div class="modal-body" style="background: #FFDBDF; padding: 30px;">
                <!-- Profile Image Section -->
                <div class="d-flex justify-content-center mb-4">
                    <div style="width: 80px; height: 80px; position: relative;">
                        @if(auth()->user()->profile_image)
                            <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" 
                                 style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                        @else
                            <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;
                                background: repeating-linear-gradient(45deg, #eee 0 8px, #fff 8px 16px);
                                border-radius: 50%;">
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Profile Information in 2 columns -->
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold mb-2" style="color: #333; font-size: 0.9rem;">Name</label>
                        <div style="background: #FFF9EA; border: none; border-radius: 20px; padding: 12px 16px; min-height: 45px; display: flex; align-items: center;">
                            {{ auth()->user()->name }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold mb-2" style="color: #333; font-size: 0.9rem;">Email</label>
                        <div style="background: #FFF9EA; border: none; border-radius: 20px; padding: 12px 16px; min-height: 45px; display: flex; align-items: center;">
                            {{ auth()->user()->email }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold mb-2" style="color: #333; font-size: 0.9rem;">Phone Number</label>
                        <div style="background: #FFF9EA; border: none; border-radius: 20px; padding: 12px 16px; min-height: 45px; display: flex; align-items: center;">
                            {{ auth()->user()->phone ?? '' }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold mb-2" style="color: #333; font-size: 0.9rem;">Gender</label>
                        <div style="background: #FFF9EA; border: none; border-radius: 20px; padding: 12px 16px; min-height: 45px; display: flex; align-items: center; justify-content: space-between;">
                            <span>{{ auth()->user()->gender ? ucfirst(auth()->user()->gender) : '' }}</span>
                            <i class="bi bi-chevron-down" style="color: #666; font-size: 0.8rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>