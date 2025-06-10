<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="background: #FFD6DF; border-radius: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.10); border: none;">
            <div class="modal-header" style="border: none; background: #FFD6DF;">
                <h5 class="modal-title fw-bold" id="profileModalLabel" style="font-size: 1.3rem;">Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-start" style="background: #FFD6DF;">
                <div class="me-4 flex-shrink-0 d-flex flex-column align-items-center" style="width: 320px;">
                    <div style="position:relative; width:220px; height:220px; margin-bottom: 20px;">
                        @if(auth()->user()->profile_image)
                            <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" class="profile-img" style="width:100%; height:100%; object-fit:cover; border-radius:16px; background:#fff;">
                        @else
                            <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;
                                background: repeating-linear-gradient(45deg,#eee 0 20px,#fff 20px 40px);
                                border-radius:16px;position:relative;">
                                <span style="position:absolute;top:10px;left:10px;background:rgba(255,255,255,0.8);border-radius:50%;padding:6px;">
                                    <i class="bi bi-camera" style="font-size: 1.2rem; color: #222;"></i>
                                </span>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="flex-grow-1 d-flex flex-column justify-content-center" style="min-height:220px;">
                    <div class="mb-2"><span class="fw-bold">Name:</span> <span>{{ auth()->user()->name }}</span></div>
                    <div class="mb-2"><span class="fw-bold">Email:</span> <span style="color:#888;">{{ auth()->user()->email }}</span></div>
                    <div class="mb-2"><span class="fw-bold">Phone Number:</span> <span>{{ auth()->user()->phone ?? '-' }}</span></div>
                    <div class="mb-4"><span class="fw-bold">Gender:</span> <span style="color:#888;">{{ auth()->user()->gender ? ucfirst(auth()->user()->gender) : '-' }}</span></div>
                    <button type="button" class="btn d-flex align-items-center justify-content-center"
                        style="background: #E96A8B; color: #fff; border-radius: 20px; min-width: 160px; font-weight: 500; box-shadow: 0 2px 8px #0001;"
                        data-bs-toggle="modal" data-bs-target="#editProfileModal" data-bs-dismiss="modal">
                        <i class="bi bi-pencil-square me-2"></i> Edit Profile
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>