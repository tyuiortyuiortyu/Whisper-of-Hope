@extends('admin.layout.app')

@section('title', 'The Whisper')

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
        padding-right: 2rem;
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
      transition: all 0.3s ease;
    }
    
    .whisper-card.removing {
      opacity: 0;
      transform: scale(0.8);
      margin-bottom: 0;
      height: 0;
      overflow: hidden;
    }

    .header-text {
      font-size: 5rem;
      font-weight: bold;
      margin-bottom: 2rem;
      margin-top: 1rem;
      font-family: 'Gidugu', cursive; /* Gidugu font for title */
    }

    /* Delete Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.4);
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }

    .modal.is-active {
        opacity: 1;
        visibility: visible;
    }

    .modal-content {
        background-color: #FEF0F0;
        border-radius: 14px;
        border: none;
        box-shadow: 0 5px 25px rgba(0,0,0,0.2);
        width: 90%;
        max-width: 400px;
        text-align: center;
        transform: scale(0.95);
        transition: transform 0.3s ease;
    }

    .modal.is-active .modal-content {
        transform: scale(1);
    }

    .modal-body {
        padding: 30px 30px 20px 30px;
    }

    .modal-body h3 {
        margin: 0;
        color: black;
        font-family: 'Yantramanav', sans-serif;
        font-size: 1.2rem;
        font-weight: 500;
    }

    .modal-actions {
        display: flex;
        justify-content: center;
        padding: 0 30px 30px;
        gap: 20px;
    }

    .modal-actions button {
        cursor: pointer;
        font-family: 'Yantramanav', sans-serif;
        transition: background-color 0.2s ease, transform 0.1s ease;
        padding: 8px 30px;
        border: none;
        border-radius: 50px;
        font-size: 1rem;
        font-weight: 600;
        width: 120px;
    }

    .modal-actions button:active {
        transform: scale(0.95);
    }

    .modal-actions .btn-cancel {
        background-color: #E8E8E8;
        font-weight: 500;
    }

    .modal-actions .btn-cancel:hover {
        background-color: #CCC;
        color: #FFFFFF;
    }

    .modal-actions .btn-delete-confirm {
        background: #F9BCC4;
        font-weight: 500;
    }

    .modal-actions .btn-delete-confirm:hover {
        background: #F791A9;
        color: #FFFFFF;
    }
    
    /* Delete button styles */
    .delete-btn {
        background: none;
        border: none;
        cursor: pointer;
        padding: 0.25rem;
        border-radius: 0.25rem;
        transition: all 0.2s ease;
        float: right;
        margin-left: 0.5rem;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .delete-btn:hover {
        background-color: rgba(255, 255, 255, 0.1);
        transform: scale(1.1);
    }
    
    .delete-btn img {
        width: 16px;
        height: 16px;
        opacity: 0.7;
        transition: opacity 0.2s ease;
    }
    
    .delete-btn:hover img {
        opacity: 1;
    }
    
    .whisper-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .header-content {
        flex: 1;
    }
    
    /* Filter dropdown styles */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        gap: 20px;
        padding: 0 30px;
        padding-top: 20px;
        margin-left: 650px;
    }
    
    .search-container {
        position: relative;
        flex: 1;
        min-width: 200px;
    }
    
    .search-container input {
        width: 100%;
        padding: 12px 40px 12px 15px;
        border: 1px solid #ddd;
        border-radius: 25px;
        font-size: 14px;
        background: white;
        font-family: 'Yantramanav', sans-serif;
    }
    
    .search-icon {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        width: 16px;
        height: 16px;
        object-fit: contain;
        cursor: pointer;
    }
    
    .filter-dropdown {
        padding: 12px 20px;
        border: 1px solid #ddd;
        border-radius: 25px;
        background-color: white;
        color: #333;
        font-family: 'Yantramanav', sans-serif;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        min-width: 180px;
        transition: all 0.3s ease;
        outline: none;
        appearance: none;
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23333' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 15px center;
        background-size: 16px;
        padding-right: 40px;
    }
    
    .filter-dropdown:focus {
        outline: none;
        border-color: #F9BCC4;
        box-shadow: 0 0 0 3px rgba(249, 188, 196, 0.1);
    }
    
    .filter-dropdown:hover {
        border-color: #F9BCC4;
    }
    
    /* Alert Styles */
    .alert {
        padding: 15px;
        margin: 0 0 20px 0;
        border-radius: 8px;
        transition: opacity 0.5s ease, transform 0.5s ease;
        position: relative;
    }
    
    .alert.fade-out {
        opacity: 0;
        transform: translateY(-10px);
    }
    
    .alert-success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    
    .alert-danger {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
</style>

<div class="container">
    
    <!-- Filter Section -->
    <div class="page-header">
        <div class="search-container">
            <input type="text" id="searchInput" class="search-input" placeholder="Search by recipient...">
            <img src="{{ asset('images/admin/user_admin/search.png') }}" class="search-icon" alt="Search">
        </div>
        <select id="colorFilter" class="filter-dropdown">
            <option value="">All Colors</option>
            <!-- Options will be populated dynamically -->
        </select>
    </div>
    
    <!-- Alert container will be inserted here by JavaScript -->
    
    <div class="masonry" id="whisper-wall">
        <!-- Cards will be populated here by JavaScript -->
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteConfirmationModal" class="modal">
    <div class="modal-content delete-modal">
        <div class="modal-body text-center">
            <h3>Are you sure want to delete this Whisper?</h3>
        </div>
        
        <div class="modal-actions">
            <button type="button" class="btn-cancel" id="deleteCancel">Cancel</button>
            <button type="button" class="btn-delete-confirm" id="deleteConfirm">OK</button>
        </div>
    </div>
</div>

<script>
    // Global variables
    let whisperData = [];
    let colorData = [];
    let whisperToDelete = null;
    let cardToDelete = null;
    let filteredWhispers = [];

    // Alert functions
    function showAlert(message, type = 'success') {
        // Remove existing alerts first
        const existingAlerts = document.querySelectorAll('.alert');
        existingAlerts.forEach(alert => alert.remove());
        
        // Create new alert
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type}`;
        alertDiv.textContent = message;
        
        // Insert after page header
        const pageHeader = document.querySelector('.page-header');
        pageHeader.insertAdjacentElement('afterend', alertDiv);
        
        // Auto close after 5 seconds
        setTimeout(() => {
            alertDiv.classList.add('fade-out');
            
            // Remove from DOM after fade animation
            setTimeout(() => {
                alertDiv.remove();
            }, 500);
        }, 5000);
    }
    
    function setupAutoCloseAlerts() {
        const alerts = document.querySelectorAll('.alert');
        
        alerts.forEach(alert => {
            // Auto close after 5 seconds
            setTimeout(() => {
                alert.classList.add('fade-out');
                
                // Remove from DOM after fade animation
                setTimeout(() => {
                    alert.remove();
                }, 500);
            }, 5000);
        });
    }

    // DOM elements
    const colorFilter = document.getElementById('colorFilter');
    const searchInput = document.getElementById('searchInput');
    
    // Delete confirmation modal elements
    const deleteConfirmationModal = document.getElementById('deleteConfirmationModal');
    const deleteCancel = document.getElementById('deleteCancel');
    const deleteConfirm = document.getElementById('deleteConfirm');

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
                populateFilterDropdown();
                // Load whispers after colors are loaded
                loadWhispers();
            })
            .catch(error => {
                console.error('Error loading colors:', error);
                // Fallback to default colors if API fails
                createDefaultColors();
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
        populateFilterDropdown();
    }

    // Populate filter dropdown with colors
    function populateFilterDropdown() {
        // Clear existing options except "All Colors"
        const allColorsOption = colorFilter.querySelector('option[value=""]');
        colorFilter.innerHTML = '';
        colorFilter.appendChild(allColorsOption);
        
        // Add color options
        colorData.forEach(color => {
            const option = document.createElement('option');
            option.value = color.id;
            option.textContent = color.name;
            option.style.backgroundColor = color.hex_value;
            option.style.color = color.font_color;
            colorFilter.appendChild(option);
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
                filteredWhispers = [...whisperData]; // Initialize filtered whispers
                createWhisperCards();
            })
            .catch(error => {
                console.error('Error loading whispers:', error);
            });
    }

    // Function to create whisper cards
    function createWhisperCards() {
        const whisperWall = document.getElementById('whisper-wall');
        whisperWall.innerHTML = ''; // Clear existing cards
        
        filteredWhispers.forEach(function(whisper) {
            addWhisperCard(whisper, false);
        });
        
        // Trigger layout refresh after cards are added
        refreshMasonryLayout();
    }

    // Function to refresh masonry layout
    function refreshMasonryLayout() {
        const whisperWall = document.getElementById('whisper-wall');
        
        // Get all remaining cards
        const cards = whisperWall.querySelectorAll('.whisper-card:not(.removing)');
        
        // Force reflow by temporarily hiding and showing the container
        whisperWall.style.visibility = 'hidden';
        whisperWall.offsetHeight; // Trigger reflow
        whisperWall.style.visibility = 'visible';
        
        // Alternative method: recreate the masonry structure
        const tempContainer = document.createElement('div');
        tempContainer.className = whisperWall.className;
        tempContainer.id = whisperWall.id + '_temp';
        
        // Move all non-removing cards to temp container
        cards.forEach(card => {
            tempContainer.appendChild(card.cloneNode(true));
        });
        
        // Replace the original container content
        whisperWall.innerHTML = tempContainer.innerHTML;
        
        // Re-attach event listeners to the new cards
        reattachEventListeners();
    }
    
    // Function to reattach event listeners after DOM manipulation
    function reattachEventListeners() {
        const deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(btn => {
            const whisperId = btn.closest('.whisper-card').dataset.whisperId;
            const cardElement = btn.closest('.whisper-card');
            
            btn.onclick = function() {
                deleteWhisper(whisperId, cardElement);
            };
        });
    }

    // Filter whispers by color and search term
    function filterWhispers() {
        const colorId = colorFilter.value;
        const searchTerm = searchInput.value.toLowerCase().trim();
        
        let filtered = [...whisperData];
        
        // Filter by color if selected
        if (colorId && colorId !== '') {
            filtered = filtered.filter(whisper => whisper.color_id == colorId);
        }
        
        // Filter by search term if provided
        if (searchTerm !== '') {
            filtered = filtered.filter(whisper => 
                whisper.to.toLowerCase().includes(searchTerm)
            );
        }
        
        filteredWhispers = filtered;
        createWhisperCards();
    }

    // Add event listeners for filters
    colorFilter.addEventListener('change', filterWhispers);
    searchInput.addEventListener('input', filterWhispers);

    function addWhisperCard(whisper, prepend = true) {
        const whisperWall = document.getElementById('whisper-wall');
        
        // Create card container
        const cardDiv = document.createElement('div');
        cardDiv.className = 'whisper-card';
        cardDiv.dataset.whisperId = whisper.id;
        
        // Create header
        const headerDiv = document.createElement('div');
        headerDiv.className = 'whisper-header';
        headerDiv.style.backgroundColor = whisper.color;
        headerDiv.style.color = whisper.font_color;
        
        // Create header content container
        const headerContent = document.createElement('div');
        headerContent.className = 'header-content';
        headerContent.textContent = 'To : ' + whisper.to;
        
        // Create delete button
        const deleteBtn = document.createElement('button');
        deleteBtn.className = 'delete-btn';
        deleteBtn.innerHTML = '<img src="{{ asset('images/admin/user_admin/delete.png') }}" alt="Delete" title="Delete whisper">';
        deleteBtn.title = 'Delete whisper';
        deleteBtn.onclick = function() {
            deleteWhisper(whisper.id, cardDiv);
        };
        
        // Append content and delete button to header
        headerDiv.appendChild(headerContent);
        headerDiv.appendChild(deleteBtn);
        
        // Create body
        const bodyDiv = document.createElement('div');
        bodyDiv.className = 'whisper-body';
        bodyDiv.style.color = whisper.font_color;
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

    // Delete whisper function
    function deleteWhisper(whisperId, cardElement) {
        whisperToDelete = whisperId;
        cardToDelete = cardElement;
        showDeleteConfirmation();
    }
    
    // Function to show delete confirmation modal
    function showDeleteConfirmation() {
        deleteConfirmationModal.classList.add('is-active');
    }

    // Function to hide delete confirmation modal
    function hideDeleteConfirmation() {
        deleteConfirmationModal.classList.remove('is-active');
        whisperToDelete = null;
        cardToDelete = null;
    }
    
    // Function to actually delete the whisper
    function confirmDeleteWhisper() {
        if (!whisperToDelete || !cardToDelete) {
            return;
        }
        
        fetch(`/api/whispers/${whisperToDelete}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Show success alert
                showAlert('Whisper deleted successfully!', 'success');
                
                // Remove from whisperData array
                whisperData = whisperData.filter(whisper => whisper.id != whisperToDelete);
                
                // Remove from filtered whispers array
                filteredWhispers = filteredWhispers.filter(whisper => whisper.id != whisperToDelete);
                
                // Add removing class for smooth animation
                cardToDelete.classList.add('removing');
                
                // Remove card from DOM after animation completes
                setTimeout(() => {
                    cardToDelete.remove();
                    
                    // Force immediate layout refresh
                    refreshMasonryLayout();
                }, 300);
                
                hideDeleteConfirmation();
            } else {
                throw new Error(data.message || 'Failed to delete whisper');
            }
        })
        .catch(error => {
            console.error('Error deleting whisper:', error);
            showAlert('Failed to delete whisper. Please try again.', 'danger');
            hideDeleteConfirmation();
        });
    }

    // Delete confirmation modal event listeners
    deleteCancel.addEventListener('click', function() {
        hideDeleteConfirmation();
    });

    deleteConfirm.addEventListener('click', function() {
        confirmDeleteWhisper();
    });

    // Prevent delete confirmation modal from closing when clicking inside it
    deleteConfirmationModal.addEventListener('click', function(e) {
        if (e.target === deleteConfirmationModal) {
            hideDeleteConfirmation();
        }
    });

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        loadColors();
        setupAutoCloseAlerts();
    });

</script>

@endsection