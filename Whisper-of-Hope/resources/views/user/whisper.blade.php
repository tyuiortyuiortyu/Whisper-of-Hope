@extends('layout.app')

@section('title', 'The Whisper Page')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    /* Import Google Fonts */
    @import url('https://fonts.googleapis.com/css2?family=Gidugu&family=Yantramanav:wght@300;400;500;700&display=swap');

    /* Hide scrollbar for the entire page */
    body {
        overflow-x: hidden; /* Hide horizontal scrollbar */
        scrollbar-width: none; /* Firefox */
        -ms-overflow-style: none; /* Internet Explorer 10+ */
        font-family: 'Yantramanav', sans-serif; /* Default font for body */
    }
    
    body::-webkit-scrollbar {
        display: none; /* Safari and Chrome */
    }   
    
    html {
        scrollbar-width: none; /* Firefox */
        -ms-overflow-style: none; /* Internet Explorer 10+ */
    }
    
    html::-webkit-scrollbar {
        display: none; /* Safari and Chrome */
    }

    /* Simple Masonry with CSS Columns */
    .masonry {
      column-count: 1;
      column-gap: 1.5rem;
    }

    @media (min-width: 640px) {
      .masonry {
        column-count: 2;
      }
    }

    @media (min-width: 1024px) {
      .masonry {
        column-count: 4;
      }
    }

    .masonry > div {
      break-inside: avoid;
      margin-bottom: 1.5rem;
    }
    
    .whisper-header {
      padding: 0.75rem 1rem;
      border-radius: 0.5rem 0.5rem 0 0;
      font-weight: 500;
      font-family: 'Yantramanav', sans-serif;
      /* Remove any default color, will be set dynamically */
    }
    
    .whisper-body {
      background-color: #FFFCF5;
      padding: 1rem;
      border-radius: 0 0 0.5rem 0.5rem;
      font-family: 'Yantramanav', sans-serif;
    }
    
    .whisper-card {
      border-radius: 0.5rem;
      overflow: hidden;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .add-note-container {
      position: fixed;
      bottom: 8rem;
      right: 2rem;
      z-index: 1000;
      transition: opacity 0.3s ease, transform 0.3s ease;
    }
    
    .add-note-container.hidden {
      opacity: 0;
      transform: translateX(20px);
      pointer-events: none;
    }
    
    .add-button {
      background-color: #FFDBDF;
      color: #333;
      border: none;
      border-radius: 30px;
      padding: 0.75rem;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      cursor: pointer;
      font-size: 2rem;
      transition: all 0.3s ease;
      font-family: 'Yantramanav', sans-serif;
      font-weight: 500;
      width: 60px;
      height: 60px;
      overflow: visible;
      position: relative;
    }
    
    .add-button:hover {
      background-color: #f8bbd0;
      transform: translateY(-2px) scale(1.05);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.25);
      padding: 0.75rem 1rem;
      width: 150px;
      height: 60px;
      justify-content: flex-end;
    }
    
    .add-button i {
      background-color: #333;
      color: white;
      border-radius: 8px;
      padding: 0.5rem;
      font-size: 1rem;
      width: 32px;
      height: 32px;
      display: none;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
      flex-shrink: 0;
    }
    
    .add-button:hover i {
      background-color: #555;
      display: flex;
    }

    .plain-plus {
      font-size: 1.5rem;
      font-weight: bold;
      color: #333;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
      width: 32px;
      height: 32px;
      border-radius: 50%;
      border: none;
      background-color: transparent;
    }

    .add-button:hover .plain-plus {
      display: none;
    }

    .leave-note-text {
      position: absolute;
      left: 1rem;
      top: 50%;
      transform: translateY(-50%);
      font-size: 0.75rem;
      font-family: 'Yantramanav', sans-serif;
      font-weight: 500;
      opacity: 0;
      transition: opacity 0.3s ease;
      line-height: 1.1;
      width: 120px;
      text-align: left;
      color: transparent;
    }
    
    .add-button:hover .leave-note-text {
      opacity: 1;
      color: #333;
    }

    .header-text {
      font-size: 5rem;
      font-weight: bold;
      margin-bottom: 2rem;
      margin-top: 1rem;
      font-family: 'Gidugu', cursive; /* Gidugu font for title */
    }

    /* Modal Styles */
    .add-modal-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      display: none;
      justify-content: center;
      align-items: center;
      z-index: 2000;
    }

    .add-modal-overlay.show {
      display: flex;
    }

    .add-modal-content {
      background: #FEF0F0;
      border-radius: 0.5rem;
      padding: 2rem;
      max-width: 500px;
      width: 90%;
      max-height: 90vh;
      overflow-y: auto;
      position: relative;
      font-family: 'Yantramanav', sans-serif;
      /* Hide scrollbar for modal content */
      scrollbar-width: none; /* Firefox */
      -ms-overflow-style: none; /* Internet Explorer 10+ */
    }
    
    .add-modal-content::-webkit-scrollbar {
      display: none; /* Safari and Chrome */
    }

    .add-modal-content h3 {
      font-family: 'Yantramanav', sans-serif;
      font-weight: 500;
    }

    .add-modal-close {
      position: absolute;
      top: 1rem;
      right: 1rem;
      background: none;
      border: none;
      font-size: 1.5rem;
      cursor: pointer;
      color: #666;
    }

    .btn-close{
      position: absolute;
      top: 2rem;
      right: 2rem;
      font-size: 1rem;
      cursor: pointer;
      color: #666;
    }

    .modal-close:hover {
      color: #333;
    }

    .form-group {
      margin-bottom: 1.5rem;
    }

    .form-label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 500;
      font-family: 'Yantramanav', sans-serif;
    }

    .form-input {
      width: 100%;
      padding: 0.75rem;
      border: 2px solid #e5e5e5;
      border-radius: 0.375rem;
      font-size: 1rem;
      font-family: 'Yantramanav', sans-serif;
    }

    .form-input:focus {
      outline: none;
      border-color: #f8bbd0;
      box-shadow: 0 0 0 3px rgba(248, 187, 208, 0.1);
    }

    .form-textarea {
      resize: vertical;
      min-height: 100px;
      font-family: 'Yantramanav', sans-serif;
    }

    .color-options {
      display: flex;
      gap: 0.75rem;
      flex-wrap: wrap;
    }

    .color-option {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      border: 3px solid transparent;
      cursor: pointer;
      transition: transform 0.2s ease;
    }

    .color-option:hover {
      transform: scale(1.1);
    }

    .color-option.selected {
      border-color: #333;
      transform: scale(1.15);
    }

    .preview-card {
      margin: 1.5rem 0;
    }

    .modal-buttons {
      display: flex;
      gap: 1rem;
      justify-content: flex-end;
      margin-top: 2rem;
    }

    .btn {
      padding: 0.75rem 1.5rem;
      border: none;
      border-radius: 2rem;
      cursor: pointer;
      font-weight: 800;
      font-size: 1rem;
      transition: all 0.2s ease;
      font-family: 'Yantramanav', sans-serif;
    }

    .btn-primary {
      background-color: #F9BCC4;
      color: black;
    }

    .btn-primary:hover {
      background-color: #f5a8c1;
    }

    .btn-secondary {
      background-color: #6c757d;
      color: white;
    }

    .btn-secondary:hover {
      background-color: #5a6268;
    }
    
    /* Loading spinner */
    .loading-spinner {
        display: none;
        width: 20px;
        height: 20px;
        border: 2px solid #f3f3f3;
        border-top: 2px solid #333;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin-left: 0.5rem;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    .btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
    
    .alert {
        padding: 0.75rem 1rem;
        margin-bottom: 1rem;
        border-radius: 0.375rem;
        font-family: 'Yantramanav', sans-serif;
    }
    
    .alert-success {
        background-color: #d4ebd1;
        color: #2d5016;
        border: 1px solid #a3d977;
    }
    
    .alert-error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
    
    /* Confirmation Modal Styles */
    .confirmation-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 3000;
    }

    .confirmation-overlay.show {
        display: flex;
    }

    .confirmation-content {
        background: #FFFCF5;
        border-radius: 0.5rem;
        padding: 1.5rem;
        max-width: 400px;
        width: 90%;
        text-align: center;
        font-family: 'Yantramanav', sans-serif;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
    }

    .confirmation-title {
        font-size: 1.2rem;
        font-weight: 500;
        margin-bottom: 1rem;
        color: #333;
    }

    .confirmation-message {
        font-size: 1rem;
        color: #666;
        margin-bottom: 1.5rem;
        line-height: 1.4;
    }

    .confirmation-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
    }

    .btn-confirm {
        background-color: #F9BCC4;
        color: black;
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 2rem;
        cursor: pointer;
        font-weight: 800;
        font-size: 1rem;
        font-family: 'Yantramanav', sans-serif;
        transition: background-color 0.2s ease;
    }

    .btn-confirm:hover {
        background-color: #f5a8c1;
    }

    .btn-cancel {
        background-color: #D6D6D6;
        color: black;
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 2rem;
        cursor: pointer;
        font-weight: 800;
        font-size: 1rem;
        font-family: 'Yantramanav', sans-serif;
        transition: background-color 0.2s ease;
    }

    .btn-cancel:hover {
        background-color: #5a6268;
    }
</style>

<div class="container">
    <h1 class="header-text">THE WHISPERS</h1>
    
    <div class="masonry" id="whisper-wall">
        <!-- Cards will be populated here by JavaScript -->
    </div>
</div>

<div class="add-note-container" id="addNoteContainer">
    <button class="add-button" id="add-whisper">
        <span class="plain-plus">+</span>
        <i class="bi bi-plus-lg"></i>
        <span class="leave-note-text">Leave a note of<br>hope & support</span>
    </button>
</div>

<!-- Modal -->
<div class="add-modal-overlay" id="whisperModal">
    <div class="add-modal-content">
        {{-- <button class="modal-close" id="closeModal" style="top: 20px; right: 20px;">&times;</button> --}}
        <button type="button" class="btn-close position-absolute" id="closeModal" data-bs-dismiss="modal" aria-label="Close" ></button>
        <h3 style="margin-bottom: 1.5rem; margin-top: 0;">Create a Whisper of Hope</h3>
        
        <div id="alertContainer"></div>
        
        <!-- Preview Card -->
        <div class="preview-card">
            <div class="whisper-card">
                <div class="whisper-header" id="previewHeader" style="background-color: #f8bbd0; color: #753753;">
                    To : <span id="previewTo">Someone Special</span>
                </div>
                <div class="whisper-body">
                    <div id="previewMessage" style="color: #753753;">Your words of support will appear here...</div>
                </div>
            </div>
        </div>

        <form id="whisperForm">
            <div class="form-group">
                <label class="form-label" for="toInput">To:</label>
                <input type="text" id="toInput" class="form-input" placeholder="e.g., our brave fighter, someone special, you" maxlength="50" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="messageInput">Words of Support:</label>
                <textarea id="messageInput" class="form-input form-textarea" placeholder="Write your message of hope, strength, or encouragement..." maxlength="500" required></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Choose a Color:</label>
                <div class="color-options" id="colorOptions">
                    <!-- Colors will be loaded dynamically -->
                </div>
            </div>

            <div class="add-modal-buttons">
                <button type="submit" class="btn btn-primary" id="submitBtn">
                    Post Whisper
                    <div class="loading-spinner" id="loadingSpinner"></div>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Confirmation Modal -->
<div class="confirmation-overlay" id="confirmationModal">
    <div class="confirmation-content">
        <div class="confirmation-message">
            Your message hasn't been sent yet. Closing this will lose it.
        </div>
        <div class="confirmation-buttons">
            <button class="btn-cancel" id="confirmCancel">Cancel</button>
            <button class="btn-confirm" id="confirmClose">Close</button>
        </div>
    </div>
</div>

<script>
    // Global variables
    let whisperData = [];
    let colorData = [];
    let selectedColorId = null;
    let selectedColorHex = '#f8bbd0';

    // DOM elements
    const modal = document.getElementById('whisperModal');
    const addWhisperBtn = document.getElementById('add-whisper');
    const closeModalBtn = document.getElementById('closeModal');
    const whisperForm = document.getElementById('whisperForm');
    const submitBtn = document.getElementById('submitBtn');
    const loadingSpinner = document.getElementById('loadingSpinner');
    const alertContainer = document.getElementById('alertContainer');
    
    // Confirmation modal elements
    const confirmationModal = document.getElementById('confirmationModal');
    const confirmCancel = document.getElementById('confirmCancel');
    const confirmClose = document.getElementById('confirmClose');
    
    // Form elements
    const toInput = document.getElementById('toInput');
    const messageInput = document.getElementById('messageInput');
    const colorOptionsContainer = document.getElementById('colorOptions');
    
    // Preview elements
    const previewHeader = document.getElementById('previewHeader');
    const previewTo = document.getElementById('previewTo');
    const previewMessage = document.getElementById('previewMessage');

    // Load colors from server
    function loadColors() {
        fetch('/api/colors')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                colorData = data;
                createColorOptions();
                // Load whispers after colors are loaded
                loadWhispers();
            })
            .catch(error => {
                console.error('Error loading colors:', error);
                // Fallback to default colors if API fails
                createDefaultColors();
                showAlert('Using default colors. Some features may be limited.', 'error');
                // Still load whispers even with default colors
                loadWhispers();
            });
    }

    // Fallback function to create default colors
    function createDefaultColors() {
        colorData = [
            { id: 1, name: 'Pink', hex_value: '#f8bbd0', font_color: '#753753' },
            { id: 2, name: 'Orange', hex_value: '#fbdbc9', font_color: '#753C37' },
            { id: 3, name: 'Green', hex_value: '#d4ebd1', font_color: '#377558' },
            { id: 4, name: 'Blue', hex_value: '#d1e2f5', font_color: '#375375' },
            { id: 5, name: 'Purple', hex_value: '#d4d1eb', font_color: '#374375' }
        ];
        createColorOptions();
    }

    // Create color option elements
    function createColorOptions() {
        colorOptionsContainer.innerHTML = '';
        
        if (colorData.length === 0) {
            showAlert('No colors available. Please refresh the page.', 'error');
            return;
        }
        
        colorData.forEach((color, index) => {
            const colorDiv = document.createElement('div');
            colorDiv.className = 'color-option';
            colorDiv.dataset.colorId = color.id;
            colorDiv.dataset.colorHex = color.hex_value;
            colorDiv.style.backgroundColor = color.hex_value;
            colorDiv.title = color.name;
            
            // Select first color by default
            if (index === 0) {
                colorDiv.classList.add('selected');
                selectedColorId = color.id;
                selectedColorHex = color.hex_value;
                updatePreview(); // Update preview with default color
            }
            
            colorDiv.addEventListener('click', function() {
                // Remove selected class from all options
                document.querySelectorAll('.color-option').forEach(opt => opt.classList.remove('selected'));
                
                // Add selected class to clicked option
                this.classList.add('selected');
                
                // Update selected color
                selectedColorId = this.dataset.colorId;
                selectedColorHex = this.dataset.colorHex;
                
                // Update preview
                updatePreview();
            });
            
            colorOptionsContainer.appendChild(colorDiv);
        });
    }

    // Load whispers from server
    function loadWhispers() {
        fetch('/api/whispers')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                whisperData = data;
                createWhisperCards();
            })
            .catch(error => {
                console.error('Error loading whispers:', error);
                showAlert('Failed to load whispers. Please refresh the page.', 'error');
            });
    }

    // Function to create whisper cards
    function createWhisperCards() {
        const whisperWall = document.getElementById('whisper-wall');
        whisperWall.innerHTML = ''; // Clear existing cards
        
        whisperData.forEach(function(whisper) {
            addWhisperCard(whisper, false);
        });
    }

    function addWhisperCard(whisper, prepend = true) {
        const whisperWall = document.getElementById('whisper-wall');
        
        // Create card container
        const cardDiv = document.createElement('div');
        cardDiv.className = 'whisper-card';
        
        // Create header
        const headerDiv = document.createElement('div');
        headerDiv.className = 'whisper-header';
        headerDiv.style.backgroundColor = whisper.color;
        headerDiv.style.color = whisper.font_color; // Use font_color from database
        headerDiv.textContent = 'To : ' + whisper.to;
        
        // Create body
        const bodyDiv = document.createElement('div');
        bodyDiv.className = 'whisper-body';
        bodyDiv.style.color = whisper.font_color; // Add this line to change content color
        bodyDiv.innerHTML = whisper.message;
        
        // Append header and body to card
        cardDiv.appendChild(headerDiv);
        cardDiv.appendChild(bodyDiv);
        
        // Add card to wall
        if (prepend) {
            whisperWall.insertBefore(cardDiv, whisperWall.firstChild);
        } else {
            whisperWall.appendChild(cardDiv);
        }
    }

    // Show alert message
    function showAlert(message, type = 'success') {
        alertContainer.innerHTML = `<div class="alert alert-${type}">${message}</div>`;
        setTimeout(() => {
            alertContainer.innerHTML = '';
        }, 5000);
    }

    // Function to check if form has content
    function hasFormContent() {
        const toValue = toInput.value.trim();
        const messageValue = messageInput.value.trim();
        return toValue !== '' || messageValue !== '';
    }

    // Function to show confirmation modal
    function showConfirmation() {
        confirmationModal.classList.add('show');
    }

    // Function to hide confirmation modal
    function hideConfirmation() {
        confirmationModal.classList.remove('show');
    }

    // Modal functionality
    addWhisperBtn.addEventListener('click', function() {
        modal.classList.add('show');
        document.body.style.overflow = 'hidden';
    });

    function closeModal() {
        modal.classList.remove('show');
        document.body.style.overflow = '';
        resetForm();
        alertContainer.innerHTML = '';
    }

    function attemptCloseModal() {
        if (hasFormContent()) {
            showConfirmation();
        } else {
            closeModal();
        }
    }

    closeModalBtn.addEventListener('click', attemptCloseModal);

    // Confirmation modal event listeners
    confirmCancel.addEventListener('click', function() {
        hideConfirmation();
    });

    confirmClose.addEventListener('click', function() {
        hideConfirmation();
        closeModal();
    });

    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            attemptCloseModal();
        }
    });

    // Prevent confirmation modal from closing when clicking inside it
    confirmationModal.addEventListener('click', function(e) {
        if (e.target === confirmationModal) {
            hideConfirmation();
        }
    });

    // Real-time preview updates
    toInput.addEventListener('input', updatePreview);
    messageInput.addEventListener('input', updatePreview);

    function updatePreview() {
        const toValue = toInput.value.trim() || 'Someone Special';
        const messageValue = messageInput.value.trim() || 'Your words of support will appear here...';
        
        previewTo.textContent = toValue;
        previewMessage.innerHTML = messageValue.replace(/\n/g, '<br>');
        previewHeader.style.backgroundColor = selectedColorHex;
        
        // Find the selected color data to get font color
        const selectedColor = colorData.find(color => color.hex_value === selectedColorHex);
        const fontColor = selectedColor ? selectedColor.font_color : '#333';
        
        previewHeader.style.color = fontColor;
        // Add this line to change preview content color
        previewMessage.style.color = fontColor;
    }

    // Form submission with AJAX
    whisperForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const toValue = toInput.value.trim();
        const messageValue = messageInput.value.trim();
        
        if (!toValue || !messageValue) {
            showAlert('Please fill in both the recipient and message fields.', 'error');
            return;
        }
        
        if (!selectedColorId) {
            showAlert('Please select a color.', 'error');
            return;
        }
        
        // Show loading state
        submitBtn.disabled = true;
        loadingSpinner.style.display = 'inline-block';
        
        // Send AJAX request
        fetch('/api/whispers', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                to: toValue,
                message: messageValue,
                color_id: selectedColorId
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Add new whisper to the beginning of the array
                whisperData.unshift(data.whisper);
                
                // Add the new card to the wall
                addWhisperCard(data.whisper, true);
                
                // Close modal and show success message
                closeModal();
                
                // Show success alert outside modal
                setTimeout(() => {
                    showAlert(data.message, 'success');
                }, 100);
            } else {
                throw new Error(data.message || 'Failed to post whisper');
            }
        })
        .catch(error => {
            console.error('Error posting whisper:', error);
            showAlert('Failed to post whisper. Please try again.', 'error');
        })
        .finally(() => {
            // Reset loading state
            submitBtn.disabled = false;
            loadingSpinner.style.display = 'none';
        });
    });

    function resetForm() {
        toInput.value = '';
        messageInput.value = '';
        
        // Reset color selection to first color
        const colorOptions = document.querySelectorAll('.color-option');
        colorOptions.forEach(opt => opt.classList.remove('selected'));
        if (colorOptions.length > 0) {
            colorOptions[0].classList.add('selected');
            selectedColorId = colorOptions[0].dataset.colorId;
            selectedColorHex = colorOptions[0].dataset.colorHex;
        } else if (colorData.length > 0) {
            // Fallback if DOM elements aren't ready
            selectedColorId = colorData[0].id;
            selectedColorHex = colorData[0].hex_value;
        }
        
        // Reset preview
        updatePreview();
    }

    // Scroll functionality
    let scrollTimer = null;
    const addNoteContainer = document.getElementById('addNoteContainer');
    
    function hideButton() {
        addNoteContainer.classList.add('hidden');
    }
    
    function showButton() {
        addNoteContainer.classList.remove('hidden');
    }
    
    window.addEventListener('scroll', function() {
        // Hide button when scrolling
        hideButton();
        
        // Clear existing timer
        if (scrollTimer) {
            clearTimeout(scrollTimer);
        }
        
        // Show button again after 350ms of no scrolling
        scrollTimer = setTimeout(function() {
            showButton();
        }, 350);
    });

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        loadColors();
        // Don't call loadWhispers() here - call it after colors are loaded
    });

    // Load colors from server
    function loadColors() {
        fetch('/api/colors')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                colorData = data;
                createColorOptions();
                // Load whispers after colors are loaded
                loadWhispers();
            })
            .catch(error => {
                console.error('Error loading colors:', error);
                // Fallback to default colors if API fails
                createDefaultColors();
                showAlert('Using default colors. Some features may be limited.', 'error');
                // Still load whispers even with default colors
                loadWhispers();
            });
    }
</script>

@endsection
