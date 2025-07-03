<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin</title>
    
    
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

        /* .right-panel .top-header {
            background: #ffffff;
            color: black;
            padding: 10px 20px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.15);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid rgba(0, 0, 0, 0.08);
            position: relative;
            z-index: 10;
        } */

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

        #titleInput:focus {
            border-color: #F9BCC4;
            box-shadow: 0 0 0 0.25rem rgba(247, 143, 179, 0.25);
            outline: none;
        }

        #contentInput:focus {
            border-color: #F9BCC4;
            box-shadow: 0 0 0 0.25rem rgba(247, 143, 179, 0.25);
            outline: none;
        }

        #updateBtn:hover {
            border-color: #F791A9 !important;
            background-color: #F791A9 !important;
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
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('admin.layout.partials.navbar')
        
        <div class="main-content">
            <header class="top-header">
                <h1>Community Stories</h1>
            </header>
            
            <div class="content-area px-0">
                <div class="page-content d-flex flex-row pt-0">
                    <!-- Left Panel: Edit Form -->
                    <div class="left-panel px-4 pt-4 pb-5" style="background: #ffffff; color: black; box-shadow: 0 2px 12px rgba(0, 0, 0, 0.15); border: 1px solid rgba(0, 0, 0, 0.08); position: relative; z-index: 10">
                        <h4>Details</h4>
                        <form id="editForm" method="POST" action="{{ route('admin.community_admin_update', $story->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label style="color: #8C8C8C">Image</label>
                                <div class="d-flex justify-content-center">
                                    <div class="image-upload-box" style="width:100%; height: 250px; position: relative;">
                                        <img id="imagePreview" src="{{ asset('images/' . $story->image) }}" alt="Preview" style="width: 100%; height: 100%; object-fit: cover; cursor: pointer; border-radius: 5px;">
                                        <div class="overlay" style="background: rgba(0, 0, 0, 0.35)" onclick="document.getElementById('imageInput').click();">
                                            <div class="circle">
                                                <span>+</span>
                                            </div>
                                            <div class="text" style="color: white">Add Image</div>
                                        </div>
                                        <input type="file" id="imageInput" name="image" style="display:none;" accept="image/*">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label style="color: #8C8C8C">Title</label>
                                <div class="d-flex justify-content-center">
                                    <input type="text" id="titleInput" name="title" value="{{ $story->title }}" class="form-control" style="border-width: 1px; border-color: #8C8C8C; height: 3rem; border-radius: 5px">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label style="color: #8C8C8C">Category</label><br>
                                <div class="category-grid">
                                    @foreach($categories as $category)
                                        <label class="category-option {{ $category->id % 2 == 0 ? 'ms-1' : 'me-1' }}" style="border-radius: 5px; height: 3rem; font-family: 'Yantramanav'">
                                            <input type="radio" name="category_id" value="{{ $category->id }}"
                                                {{ $story->category_id == $category->id ? 'checked' : '' }}>
                                            <span class="checkmark"></span>
                                            {{ $category->name }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <div>
                                <label style="color: #8C8C8C">Story</label>
                                <textarea id="contentInput" name="content" class="form-control" style="height: 200px; border-radius: 5px">{{ $story->content }}</textarea>
                            </div>
                        </form>
                    </div>

                    <!-- Right Panel: Preview -->
                    <div class="right-panel">
                        {{-- Header --}}
                        <div class="d-flex align-items-center py-3" style="background: #ffffff; color: black; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15); border-bottom: 1px solid rgba(0, 0, 0, 0.08); position: relative; z-index: 10">
                            <h4 class="ps-4 my-0">Preview</h4>
                        </div>

                        {{-- Post Button --}}
                        <div class="d-flex align-items-center justify-content-end py-4 pe-4">
                            <button id="updateBtn" class="btn btn-secondary mb-0" style="border-radius: 40px; background: #F9BCC4; color: black; border-color: transparent; font-family: 'Yantramanav'">Update Post</button>
                        </div>

                        {{-- Preview Box --}}
                        <div class="preview-container d-flex justify-content-center px-4 pb-2">
                            <div class="preview-box px-4 py-4" style="border: 1px solid #8C8C8C; border-radius: 5px; min-height: 44rem">
                                <div class="category-name d-flex align-items-center justify-content-start" style="width: 100%">
                                    <div class="d-flex align-items-center justify-content-center py-2 px-3" style="border: 1px solid #F9BCC4; border-radius: 40px;">
                                        <p class="preview-category mb-0">{{ $story->category->name }}</p>
                                    </div>
                                </div>
                                
                                <div class="title-container d-flex align-items-center justify-content-center py-4">
                                    <h3 class="preview-title mb-0" style="font-family: 'Gidugu'; font-size: 3rem">{{ $story->title }}</h3>
                                </div>

                                <div class="creator-container d-flex align-items-center ps-3">
                                    <p class="text-start text-muted mb-0" style="font-family: 'Yantramanav'">
                                        by {{ $story->author ?? 'Whisper of Hope' }} on {{ \Carbon\Carbon::parse($story->created_at)->format('F d, Y h.i.s A') }}
                                    </p>
                                </div>
                                
                                <div class="d-flex align-items-center justify-content-center py-2" style="width: 100%; height: 300px">
                                    <img src="{{ asset('images/' . $story->image) }}" alt="Preview Image" id="previewImage" style="width: 30rem; height: 100%">
                                </div>
                                <div class="px-3 mb-5 pt-3" style="max-width: 100%; margin: 0 auto; font-family: 'Yantramanav'">
                                    {!! nl2br(e($story->content)) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- JavaScript -->
    <script src="{{ asset('js/admin/main.js') }}"></script>
    @stack('scripts')
    
    <script>

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

        // --- JavaScript Live Preview Synchronization ---
        document.addEventListener('DOMContentLoaded', function() {
            const titleInput    = document.getElementById('titleInput');
            const contentInput  = document.getElementById('contentInput');
            const imageInput    = document.getElementById('imageInput');
            const imagePreview  = document.getElementById('imagePreview');
            const previewImage  = document.getElementById('previewImage');
            const updateBtn     = document.getElementById('updateBtn');
            const previewTitle  = document.querySelector('.preview-title');
            const previewCategory = document.querySelector('.preview-category');
            const previewContent = document.querySelector('.px-3.mb-5.pt-3');

            // Helper to get only the category name from label
            function getCategoryNameFromLabel(label) {
                let text = label.cloneNode(true);
                text.querySelectorAll('input, .checkmark').forEach(el => el.remove());
                return text.textContent.trim();
            }

            // Real-time preview update function
            function updatePreview() {
                // Title
                previewTitle.textContent = titleInput.value || 'Title';
                // Content
                previewContent.innerHTML = (contentInput.value || '').replace(/\n/g, '<br>') || '<span style="color:#aaa">No story yet...</span>';
                // Category
                const checkedRadio = document.querySelector('input[name="category_id"]:checked');
                if (checkedRadio) {
                    const label = checkedRadio.closest('label');
                    if (label) {
                        previewCategory.textContent = getCategoryNameFromLabel(label);
                    }
                }
            }

            // Title and content input events
            titleInput.addEventListener('input', updatePreview);
            contentInput.addEventListener('input', updatePreview);

            // Category radio buttons
            document.querySelectorAll('input[name="category_id"]').forEach(radio => {
                radio.addEventListener('change', updatePreview);
            });

            // Image upload
            imagePreview.addEventListener('click', () => imageInput.click());
            imageInput.addEventListener('change', () => {
                const file = imageInput.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = e => {
                        imagePreview.src = previewImage.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Initial preview
            updatePreview();
        });


    </script>
</body>
</html>