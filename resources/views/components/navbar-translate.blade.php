{{-- Component Navbar Translate --}}
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle fw-medium d-flex align-items-center" href="#" id="translateDropdown" 
       role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-globe me-1"></i>
        <span id="current-lang">ID</span>
    </a>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="translateDropdown">
        <li>
            <a class="dropdown-item lang-option" href="#" data-lang="id" data-lang-name="ID">
                <i class="fas fa-flag me-2"></i>Indonesia
            </a>
        </li>
        <li>
            <a class="dropdown-item lang-option" href="#" data-lang="en" data-lang-name="EN">
                <i class="fas fa-flag me-2"></i>English
            </a>
        </li>
    </ul>
</li>

{{-- Google Translate Element (Hidden) --}}
<div id="google_translate_element" style="display: none;"></div>

@push('styles')
<style>
    /* Hide Google Translate banner and toolbar */
    .goog-te-banner-frame.skiptranslate {
        display: none !important;
    }
    
    body {
        top: 0 !important;
    }
    
    .goog-te-gadget {
        display: none !important;
    }
    
    /* Style for language dropdown */
    .lang-option {
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    
    .lang-option:hover {
        background-color: #f8f9fa;
    }
    
    .lang-option.active {
        background-color: #e9ecef;
        font-weight: 600;
    }

    /* Prevent layout shift from Google Translate */
    .skiptranslate iframe {
        visibility: hidden !important;
    }
    
    body {
        position: relative !important;
    }
</style>
@endpush

@push('scripts')
<script type="text/javascript">
    // Fungsi untuk inisialisasi Google Translate
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'id',
            includedLanguages: 'id,en',
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
            autoDisplay: false
        }, 'google_translate_element');
    }

    // Load Google Translate script
    (function() {
        var gtScript = document.createElement('script');
        gtScript.type = 'text/javascript';
        gtScript.async = true;
        gtScript.src = '//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
        document.getElementsByTagName('head')[0].appendChild(gtScript);
    })();

    // Wait for DOM to be ready
    document.addEventListener('DOMContentLoaded', function() {
        // Get saved language from localStorage
        const savedLang = localStorage.getItem('selectedLanguage') || 'id';
        updateCurrentLangDisplay(savedLang);

        // Language selection handler
        document.querySelectorAll('.lang-option').forEach(function(element) {
            element.addEventListener('click', function(e) {
                e.preventDefault();
                const lang = this.getAttribute('data-lang');
                const langName = this.getAttribute('data-lang-name');
                
                // Update active state
                document.querySelectorAll('.lang-option').forEach(opt => opt.classList.remove('active'));
                this.classList.add('active');
                
                // Update display
                updateCurrentLangDisplay(langName);
                
                // Save to localStorage
                localStorage.setItem('selectedLanguage', langName);
                
                // Trigger Google Translate
                triggerGoogleTranslate(lang);
            });
        });

        // Apply saved language on page load
        setTimeout(function() {
            if (savedLang === 'EN') {
                triggerGoogleTranslate('en');
            }
        }, 1000);
    });

    function updateCurrentLangDisplay(langName) {
        document.getElementById('current-lang').textContent = langName;
        
        // Update active state
        document.querySelectorAll('.lang-option').forEach(function(opt) {
            if (opt.getAttribute('data-lang-name') === langName) {
                opt.classList.add('active');
            } else {
                opt.classList.remove('active');
            }
        });
    }

    function triggerGoogleTranslate(lang) {
        // Wait for Google Translate to be ready
        const checkGoogleTranslate = setInterval(function() {
            const selectElement = document.querySelector('.goog-te-combo');
            if (selectElement) {
                clearInterval(checkGoogleTranslate);
                
                // Set the language
                selectElement.value = lang;
                
                // Trigger change event
                selectElement.dispatchEvent(new Event('change'));
            }
        }, 100);

        // Timeout after 5 seconds
        setTimeout(function() {
            clearInterval(checkGoogleTranslate);
        }, 5000);
    }
</script>
@endpush