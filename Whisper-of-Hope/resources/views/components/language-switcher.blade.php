<div class="dropdown language-switcher">
    <button class="btn btn-outline-light btn-sm dropdown-toggle d-flex align-items-center gap-2" 
            type="button" 
            id="languageDropdown"
            aria-expanded="false">
        @if(app()->getLocale() == 'id')
            <img src="{{ asset('images/flags/indonesia.png') }}" alt="Indonesia" class="flag-icon">
            <span class="d-none d-md-inline">ID</span>
        @else
            <img src="{{ asset('images/flags/usa.png') }}" alt="English" class="flag-icon">
            <span class="d-none d-md-inline">EN</span>
        @endif
    </button>
    <ul class="dropdown-menu dropdown-menu-end" id="languageDropdownMenu">
        <li>
            <a class="dropdown-item d-flex align-items-center gap-2 {{ app()->getLocale() == 'en' ? 'active' : '' }}" 
               href="{{ route('language.switch', 'en') }}">
                <img src="{{ asset('images/flags/usa.png') }}" alt="English" class="flag-icon-small">
                {{ __('general.english') ?? 'English' }}
            </a>
        </li>
        <li>
            <a class="dropdown-item d-flex align-items-center gap-2 {{ app()->getLocale() == 'id' ? 'active' : '' }}" 
               href="{{ route('language.switch', 'id') }}">
                <img src="{{ asset('images/flags/indonesia.png') }}" alt="Indonesia" class="flag-icon-small">
                {{ __('general.indonesian') ?? 'Indonesian' }}
            </a>
        </li>
    </ul>
</div>

<style>
.language-switcher {
    position: relative;
}

.language-switcher .flag-icon {
    width: 20px;
    height: 15px;
    object-fit: cover;
    border-radius: 2px;
    border: 1px solid rgba(0, 0, 0, 0.1);
}

.language-switcher .flag-icon-small {
    width: 18px;
    height: 13px;
    object-fit: cover;
    border-radius: 2px;
    border: 1px solid rgba(0, 0, 0, 0.1);
}

.language-switcher .dropdown-item:hover .flag-icon-small {
    transform: scale(1.05);
    transition: transform 0.2s ease;
}

/* Default dropdown styling - for user pages (right-aligned) */
.language-switcher .dropdown-menu {
    display: none;
    position: absolute !important;
    top: 100% !important;
    bottom: auto !important;
    right: 0 !important;
    left: auto !important;
    z-index: 9999 !important;
    min-width: 160px;
    padding: 0.5rem 0;
    margin: 0.125rem 0 0;
    font-size: 0.875rem;
    color: #212529;
    text-align: left;
    list-style: none;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0,0,0,.15);
    border-radius: 0.375rem;
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,.175);
    transform: translateY(0) !important;
}

.language-switcher .dropdown-menu.show {
    display: block !important;
}

/* Admin pages - left-aligned dropdown */
.sidebar .language-switcher .dropdown-menu,
.admin .language-switcher .dropdown-menu {
    top: calc(100% + 2px) !important;
    bottom: auto !important;
    left: 0 !important;
    right: auto !important;
    transform: none !important;
}

/* For very small buttons, ensure minimum width */
.language-switcher .dropdown-menu {
    min-width: max(160px, 100%);
}

.language-switcher .dropdown-item {
    display: block;
    width: 100%;
    padding: 0.375rem 1rem;
    clear: both;
    font-weight: 400;
    color: #212529;
    text-align: inherit;
    text-decoration: none;
    white-space: nowrap;
    background-color: transparent;
    border: 0;
}

.language-switcher .dropdown-item:hover,
.language-switcher .dropdown-item:focus {
    color: #16181b;
    background-color: #e9ecef;
}

.language-switcher .dropdown-item.active {
    color: #fff;
    text-decoration: none;
    background-color: #0d6efd;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const languageDropdown = document.getElementById('languageDropdown');
    const languageDropdownMenu = document.getElementById('languageDropdownMenu');
    
    if (!languageDropdown || !languageDropdownMenu) return;
    
    // Simple click toggle function
    languageDropdown.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        // Close any other open dropdowns first
        document.querySelectorAll('.dropdown-menu.show').forEach(function(menu) {
            if (menu !== languageDropdownMenu) {
                menu.classList.remove('show');
            }
        });
        
        // Check if we're in admin page (sidebar exists) or user page
        const isAdminPage = document.querySelector('.sidebar') !== null;
        
        if (isAdminPage) {
            // Admin page - align to left
            languageDropdownMenu.style.top = 'calc(100% + 2px)';
            languageDropdownMenu.style.bottom = 'auto';
            languageDropdownMenu.style.left = '0';
            languageDropdownMenu.style.right = 'auto';
        } else {
            // User page - align to right
            languageDropdownMenu.style.top = 'calc(100% + 2px)';
            languageDropdownMenu.style.bottom = 'auto';
            languageDropdownMenu.style.left = 'auto';
            languageDropdownMenu.style.right = '0';
        }
        
        // Toggle this dropdown
        const isOpen = languageDropdownMenu.classList.contains('show');
        if (isOpen) {
            languageDropdownMenu.classList.remove('show');
            languageDropdown.setAttribute('aria-expanded', 'false');
        } else {
            languageDropdownMenu.classList.add('show');
            languageDropdown.setAttribute('aria-expanded', 'true');
        }
    });
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!languageDropdown.contains(e.target) && !languageDropdownMenu.contains(e.target)) {
            languageDropdownMenu.classList.remove('show');
            languageDropdown.setAttribute('aria-expanded', 'false');
        }
    });
    
    // Close dropdown when clicking on menu items
    languageDropdownMenu.querySelectorAll('a').forEach(function(link) {
        link.addEventListener('click', function(e) {
            languageDropdownMenu.classList.remove('show');
            languageDropdown.setAttribute('aria-expanded', 'false');
            // Allow navigation to proceed
        });
    });
});
</script>