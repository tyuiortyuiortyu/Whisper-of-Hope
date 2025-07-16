<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('admin.header_community') . ' - Admin' }}</title>
    
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Gidugu&family=Yantramanav:wght@300;400;500;700&display=swap">
    
    @stack('styles')
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Yantramanav:wght@300;400;500;600;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Yantramanav';
        }

        /* Hide scrollbars */
        * {
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* Internet Explorer 10+ */
        }
        
        *::-webkit-scrollbar {
            display: none; /* WebKit */
        }

        body {
            background-color: white;
            overflow-x: hidden;
        }

        html {
            overflow-x: hidden;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
            margin-left: 280px;
            background: white;
            transition: margin-left 0.3s ease;
        }

        .top-header {
            background: #ffffff;
            color: black;
            padding: 10px 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
            position: relative;
            z-index: 10;
        }

        .top-header h1 {
            font-family: 'Gidugu';
            font-size: 4rem;
            font-weight: 400;
            margin-left: 20px;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .notification-btn {
            position: relative;
            background: none;
            border: none;
            color: black;
            font-size: 1.2rem;
            cursor: pointer;
            padding: 8px;
            border-radius: 50%;
            transition: background-color 0.3s ease;
        }

        .notification-btn:hover {
            background: rgba(0, 0, 0, 0.1);
        }

        .notification-badge {
            position: absolute;
            top: -2px;
            right: -2px;
            background: #ff4444;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.8rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .menu-toggle {
            display: none;
            background: none;
            border: none;
            color: black;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 5px;
        }

        .content-area {
            /* padding-bottom: 30px; */
            min-height: calc(100vh - 80px);
            background: white;
        }

        .page-content {
            background: white;
            /* border-radius: 10px;x */
            box-shadow: none;
            overflow: hidden;
        }

        .left-panel, .right-panel { flex: 1; }
        .category-btn { margin: 0.25rem; }
        .category-btn.active { background-color: #f78fb3; color: white; }
        .btn-disabled { opacity: 0.5; cursor: not-allowed; }

        .image-upload-box .overlay {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: black;
            font-size: 14px;
            cursor: pointer;
        }

        .image-upload-box .circle {
            background-color: #F791A9;
            border-radius: 50%;
            width: 40px; height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
            font-weight: bold;
            font-family: 'Yantramanav';
        }

        .image-upload-box .text {
            margin-top: 4px;
        }

        .category-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr); /* 2 kolom */
            gap: 15px; /* jarak antar kotak */
            margin-top: 8px;
        }

        .category-option {
            display: flex;
            align-items: center;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            font-size: 14px;
            color: black;
            background: white;
            transition: border-color 0.2s, background-color 0.2s;
        }

        /* Sembunyikan radio asli */
        .category-option input[type="radio"] {
            display: none;
        }

        /* Lingkaran pink */
        .category-option .checkmark {
            width: 18px;
            height: 18px;
            border: 2px solid #F791A9;
            border-radius: 50%;
            margin-right: 8px;
            box-sizing: border-box;
            position: relative;
        }

        /* Titik di dalam saat checked */
        .category-option input[type="radio"]:checked + .checkmark::after {
            content: "";
            width: 10px;
            height: 10px;
            background: #F791A9;
            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        /* Efek hover */
        .category-option:hover {
            border-color: #F791A9;
            background-color: #fdf4f6;
        }

        #title:focus {
            border-color: #F9BCC4;
            box-shadow: 0 0 0 0.25rem rgba(247, 143, 179, 0.25);
            outline: none;
        }

        #content:focus {
            border-color: #F9BCC4;
            box-shadow: 0 0 0 0.25rem rgba(247, 143, 179, 0.25);
            outline: none;
        }

        #updateBtn:hover {
            border-color: #F791A9 !important;
            background-color: #F791A9 !important;
        }

        .sidebar {
            width: 280px;
            background: linear-gradient(to bottom, #FFDBDF, #F791A9);
            color: #333;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            z-index: 1000;
            font-family: 'Yantramanav', sans-serif;
        }

        .sidebar-header {
            padding: 30px 25px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            margin-bottom: -15px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .logo-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
        }

        .logo-text h3 {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: -5px;
            color: #333;
            font-family: 'Yantramanav', sans-serif;
        }

        .logo-text span {
            font-size: 1rem;
            font-weight: 400;
            color: black;
            font-family: 'Yantramanav', sans-serif;
        }

        .sidebar-menu {
            flex: 1;
            list-style: none;
            padding: 15px 0;
            margin: 0;
        }

        .menu-item {
            margin-bottom: 10px;
        }

        .menu-item a {
            display: flex;
            align-items: center;
            padding: 12px 25px;
            color: #333;
            text-decoration: none;
            transition: all 0.2s ease;
            font-size: 1.1rem;
            font-weight: 400;
            letter-spacing: 0.5px;
            position: relative;
            margin-right: 0;
            margin-bottom: 20px;
            margin-left: 0;
            font-family: 'Yantramanav', sans-serif;
        }

        .menu-icon {
            width: 20px;
            height: 20px;
            object-fit: contain;
            margin-right: 20px;
        }

        .menu-item a:hover,
        .menu-item a:active,
        .menu-item.active a {
            background: #FFF9EA;
            border-radius: 0 50px 50px 0;
            color: #333;
            box-shadow: 2px 2px 5px rgba(0,0,0,0.1);
            width: calc(100% - 30px);
            margin-left: 0;
        }

        .sidebar-footer {
            padding: 15px 20px;
        }

        .logout-btn {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            color: #333;
            text-decoration: none;
            transition: all 0.2s ease;
            font-size: 0.95rem;
            font-weight: 500;
            font-family: 'Yantramanav', sans-serif;
        }

        .logout-btn:hover {
            color: #000;
        }

        .language-switcher .btn {
            background: rgba(255, 255, 255, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.4);
            color: #333;
            font-size: 0.875rem;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .language-switcher .btn:hover {
            background: rgba(255, 255, 255, 0.5);
            border-color: rgba(255, 255, 255, 0.6);
            color: #333;
            transform: translateY(-1px);
        }

        .language-switcher .dropdown-menu {
            min-width: 160px;
            border-radius: 10px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
            padding: 8px 0;
        }
        
        .language-switcher .dropdown-item {
            font-size: 0.875rem;
            padding: 10px 16px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .language-switcher .dropdown-item.active {
            background-color: #F791A9;
            color: white;
            font-weight: 600;
        }
        
        .language-switcher .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #333;
            transform: translateX(2px);
        }
        
        .language-switcher .dropdown-item.active:hover {
            background-color: #F791A9;
            color: white;
            transform: translateX(2px);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
            }
            
            .menu-toggle {
                display: block;
            }
            
            .top-header {
                padding-left: 60px;
                position: relative;
            }
            
            .menu-toggle {
                position: absolute;
                left: 20px;
                top: 50%;
                transform: translateY(-50%);
            }

            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <nav class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <img src="{{ asset('images/logo.png') }}" alt="Whisper of Hope" class="logo-img">
                    <div class="logo-text">
                        <h3>{{ __('navbar.admin') }}</h3>
                        <span>{{ __('admin.dashboard') }}</span>
                    </div>
                </div>
                
                <!-- Language Switcher -->
                <div class="language-switcher mt-3">
                    <x-language-switcher />
                </div>
            </div>
            
            <ul class="sidebar-menu">
                <li class="menu-item">
                    <a href="{{ route('admin.user_admin') }}">
                        <img src="/images/admin/users.png" class="menu-icon" alt="{{ __('admin.users') }}">
                        <span>{{ __('admin.users') }}</span>
                    </a>
                </li>
                
                <li class="menu-item">
                    <a href="{{ route('admin.request_admin') }}">
                        <img src="/images/admin/requested-wig.png" class="menu-icon" alt="{{ __('admin.requested_wig') }}">
                        <span>{{ __('admin.requested_wig') }}</span>
                    </a>
                </li>
                
                <li class="menu-item">
                    <a href="{{ route('admin.donate_admin') }}">
                        <img src="/images/admin/donated-hair.png" class="menu-icon" alt="{{ __('admin.donated_hair') }}">
                        <span>{{ __('admin.donated_hair') }}</span>
                    </a>
                </li>
                
                <li class="menu-item">
                    <a href="{{ route('admin.whisper_admin') }}">
                        <img src="/images/admin/the-whispers.png" class="menu-icon" alt="{{ __('admin.the_whisper') }}">
                        <span>{{ __('admin.the_whisper') }}</span>
                    </a>
                </li>
                
                <li class="menu-item active">
                    <a href="{{ route('admin.community_admin') }}">
                        <img src="/images/admin/community-stories.png" class="menu-icon" alt="{{ __('admin.community_stories') }}">
                        <span>{{ __('admin.community_stories') }}</span>
                    </a>
                </li>
            </ul>
            
            <div class="sidebar-footer">
                <a href="#" class="logout-btn" onclick="event.preventDefault(); logoutAdmin();">
                    <img src="/images/admin/logout.png" class="menu-icon" alt="{{ __('admin.logout') }}">
                    <span>{{ __('navbar.logout') }}</span>
                </a>
            </div>
        </nav>
        
        <div class="main-content">
            <header class="top-header">
                <h1>{{ __('admin.header_community') }}</h1>
            </header>
            
            <div class="content-area px-0">
                <div class="page-content d-flex flex-row pt-0">
                    <!-- Left Panel: Edit Form -->
                    <div class="left-panel px-4 pt-4 pb-5" style="background: #ffffff; color: black; box-shadow: 0 2px 12px rgba(0, 0, 0, 0.15); border: 1px solid rgba(0, 0, 0, 0.08); position: relative; z-index: 10">
                        <h4>{{ __('admin.preview.details_label') }}</h4>
                        <form action="{{ route('admin.community_admin_update', $story) }}" method="POST" enctype="multipart/form-data" id="storyForm">
                            @csrf
                            @method('PUT')
                            {{-- Image Upload --}}
                            <div class="form-group mb-4">
                                <label style="color: #8C8C8C">{{ __('admin.preview.image_label') }}</label>
                                <div class="d-flex justify-content-center">
                                    <div class="image-upload-box" style="width:100%; height: 250px; position: relative;"  id="imagePreview">
                                        <img id="previewImg" src="{{ asset('images/' . $story->image) }}" alt="Preview" style="width: 100%; height: 100%; object-fit: cover; cursor: pointer; border-radius: 5px;">
                                        <div class="overlay" style="background: rgba(0, 0, 0, 0.35); border-radius: 5px;" onclick="document.getElementById('imageInput').click()">
                                            <div class="circle">
                                                <span>+</span>
                                            </div>
                                            <div class="text" style="color: white">{{ __('admin.preview.add_image') }}</div>
                                        </div>
                                        <input type="file" id="imageInput" name="image" accept="image/*" style="display: none;" onchange="previewImage(this)">
                                    </div>
                                </div>
                            </div>

                            {{-- Title --}}
                            <div class="form-group mb-4">
                                <label for="title" style="color: #8C8C8C">{{ __('admin.preview.title_label') }}</label>
                                <div class="d-flex justify-content-center">
                                    <input type="text" id="title" name="title" value="{{ old('title', $story->title) }}" style="border-width: 1px; border-color: #8C8C8C; height: 3rem; border-radius: 5px; width: 100%; padding: 0 0 0 15px" required>
                                </div>
                            </div>

                            {{-- Category --}}
                            <div class="form-group mb-4">
                                <label for="category" style="color: #8C8C8C">{{ __('admin.preview.category_label') }}</label><br>
                                <div class="category-grid">
                                    @foreach($categories as $category)
                                        <label class="category-option {{ $category->id % 2 == 0 ? 'ms-1' : 'me-1' }}" style="border-radius: 5px; height: 3rem; font-family: 'Yantramanav'" onclick="selectCategory({{ $category->id }}, '{{ __('admin.' . $category->name) }}')">
                                            <input type="radio" name="category_id" value="{{ $category->id }}" {{ $story->category_id == $category->id ? 'checked' : '' }} id="category_id">
                                            <span class="checkmark"></span>
                                            {{ __('admin.' . $category->name)}}
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Content --}}
                            <div>
                                <label style="color: #8C8C8C">{{ __('admin.preview.story_label') }}</label>
                                <textarea id="content" name="content" class="form-control" style="height: 200px; border-radius: 5px">{{ $story->content }}</textarea>
                            </div>
                        </form>
                    </div>

                    <!-- Right Panel: Preview -->
                    <div class="right-panel">
                        {{-- Header --}}
                        <div class="d-flex align-items-center py-3" style="background: #ffffff; color: black; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15); border-bottom: 1px solid rgba(0, 0, 0, 0.08); position: relative; z-index: 10">
                            <h4 class="ps-4 my-0">{{ __('admin.preview.preview_header') }}</h4>
                        </div>

                        {{-- Post Button --}}
                        <div class="d-flex align-items-center justify-content-end py-4 pe-4">
                            <button type="submit" form="storyForm" class="update-btn mb-0 px-4 py-1" style="border-radius: 40px; background: #F9BCC4; color: black; border-color: transparent; font-family: 'Yantramanav'">{{ __('admin.preview.updatePost_btn') }}</button>
                        </div>

                        {{-- Preview Box --}}
                        <div class="preview-container d-flex justify-content-center px-4 pb-2">
                            <div class="preview-box px-4 py-4" style="border: 1px solid #8C8C8C; border-radius: 5px; min-height: 44rem">
                                <div class="category-name d-flex align-items-center justify-content-start" style="width: 100%">
                                    <div class="d-flex align-items-center justify-content-center py-2 px-3" style="border: 1px solid #F9BCC4; border-radius: 40px;">
                                        <p class="preview-category mb-0" id="previewCategory">{{ __('admin.' . $category->name)}}</p>
                                    </div>
                                </div>
                                
                                <div class="title-container d-flex align-items-center justify-content-center py-4">
                                    <h3 class="preview-title mb-0" id="previewTitle" style="font-family: 'Gidugu'; font-size: 3rem">{{ $story->title }}</h3>
                                </div>

                                <div class="creator-container d-flex align-items-center ps-3">
                                    <p class="text-start text-muted mb-0" style="font-family: 'Yantramanav'">
                                        {{ __('admin.preview.by_whisper') . \Carbon\Carbon::parse($story->created_at)->format('F d, Y h.i.s A') }}
                                    </p>
                                </div>
                                
                                <div class="d-flex align-items-center justify-content-center py-2" style="width: 100%; height: 300px" id="previewImageContainer">
                                    <img src="{{ asset('images/' . $story->image) }}" alt="Preview Image" id="previewStoryImage" style="width: 30rem; height: 100%">
                                </div>

                                <div class="px-3 mb-5 pt-3" id="previewText" style="max-width: 100%; margin: 0 auto; font-family: 'Yantramanav'">
                                    {!! nl2br(e($story->content)) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="unsavedModal" class="modal" tabindex="-1" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.2); z-index:2000; justify-content:center; align-items:center;">
                    <div style="background:white; border-radius:1rem; padding:2rem 2.5rem; box-shadow:0 4px 24px rgba(0,0,0,0.15); min-width:320px; max-width:90vw; text-align:center;">
                        <div style="font-size:1.1rem; margin-bottom:1.5rem; color:#333;">{{ __('admin.preview.modalMsg1') }} <br> {{ __('admin.preview.modalMsg2')}}</div>
                        <div style="display:flex; gap:1.5rem; justify-content:center;">
                            <button id="unsavedCancel" style="background:#D6D6D6; color:#333; border:none; border-radius:2rem; padding:0.3rem 2.5rem; font-weight:600; font-size:1rem;">{{ __('admin.cancelBtn_label') }}</button>
                            <button id="unsavedClose" style="background:#F9BCC4; color:#333; border:none; border-radius:2rem; padding:0.3rem 2.5rem; font-weight:600; font-size:1rem;">{{ __('admin.preview.closeBtn_label') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- JavaScript -->
    <script src="{{ asset('js/admin/main.js') }}"></script>
    @stack('scripts')

    <!-- Unsaved Changes Modal -->
    <script>
        // LIVE PREVIEW
        let selectedCategoryId = {{ $story->category_id }};
        const original = {
            title: @json($story->title),
            content: @json($story->content),
            category_id: '{{ $story->category_id }}',
            image: @json($story->image)
        };

        function selectCategory(categoryId, categoryName) {
            document.querySelectorAll('.category-option').forEach(option => {
                option.classList.remove('selected');
            });
            event.target.closest('.category-option').classList.add('selected');
            document.getElementById('category_id').value = categoryId;
            selectedCategoryId = categoryId;
            document.getElementById('previewCategory').textContent = categoryName;
            checkUnsaved();
        }

        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImg').src = e.target.result;
                    document.getElementById('previewStoryImage').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
            checkUnsaved();
        }

        document.getElementById('title').addEventListener('input', function() {
            document.getElementById('previewTitle').textContent = this.value || 'Title';
            checkUnsaved();
        });

        document.getElementById('content').addEventListener('input', function() {
            const content = this.value.replace(/\n/g, '<br>');
            document.getElementById('previewText').innerHTML = content || 'Story content will appear here...';
            checkUnsaved();
        });

        // Unsaved changes detection
        function checkUnsaved() {
            const title = document.getElementById('title').value;
            const content = document.getElementById('content').value;
            const categoryId = document.getElementById('category_id').value;
            const imageInput = document.getElementById('imageInput');
            let imageChanged = false;
            if (imageInput.files && imageInput.files.length > 0) imageChanged = true;
            window.hasUnsaved = (
                title !== original.title ||
                content !== original.content ||
                categoryId !== original.category_id ||
                imageChanged
            );
        }

        // Modal logic
        function showUnsavedModal(callback) {
            const modal = document.getElementById('unsavedModal');
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
            document.getElementById('unsavedCancel').onclick = function() {
                modal.style.display = 'none';
                document.body.style.overflow = '';
                if (callback) callback(false);
            };
            document.getElementById('unsavedClose').onclick = function() {
                modal.style.display = 'none';
                document.body.style.overflow = '';
                if (callback) callback(true);
            };
        }

        // Intercept in-app navigation (e.g., sidebar links)
        document.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', function(e) {
                if (window.hasUnsaved && !this.closest('.modal')) {
                    e.preventDefault();
                    showUnsavedModal(leave => {
                        if (leave) window.location = link.href;
                    });
                }
            });
        });

        // Intercept browser back button
        window.addEventListener('popstate', function(e) {
            if (window.hasUnsaved) {
                showUnsavedModal(leave => {
                    if (leave) history.back();
                    else history.pushState(null, '', window.location.href);
                });
            }
        });

        // Form validation
        document.getElementById('storyForm').addEventListener('submit', function(e) {
            window.hasUnsaved = false;
            const title = document.getElementById('title').value.trim();
            const content = document.getElementById('content').value.trim();
            const categoryId = document.getElementById('category_id').value;
            if (!title) {
                alert('Please enter a title');
                e.preventDefault();
                return;
            }
            if (!content) {
                alert('Please enter story content');
                e.preventDefault();
                return;
            }
            if (!categoryId) {
                alert('Please select a category');
                e.preventDefault();
                return;
            }
        });

        // Mobile menu toggle
        document.getElementById('menuToggle').addEventListener('click', function() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('active');
        });
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(e) {
            const sidebar = document.querySelector('.sidebar');
            const menuToggle = document.getElementById('menuToggle');
            if (window.innerWidth <= 768 && 
                !sidebar.contains(e.target) && 
                !menuToggle.contains(e.target)) {
                sidebar.classList.remove('active');
            }
        });

        function logoutAdmin() {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("admin.logout") }}';
            
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';
            
            form.appendChild(csrfInput);
            document.body.appendChild(form);
            form.submit();
        }
    </script>
</body>
</html>