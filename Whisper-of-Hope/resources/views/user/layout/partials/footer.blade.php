<footer class="py-3 shadow-sm" style="background-color: #FFDBDF; color: #000; font-weight: 600;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4 text-center text-md-start mb-2 mb-md-0">
                {{ __('footer.copyright', ['year' => date('Y')]) }}
            </div>
            <div class="col-md-4 text-center mb-2 mb-md-0">
                <a href="#" class="text-decoration-none text-dark mx-2">{{ __('footer.privacy_policy') }}</a> |
                <a href="#" class="text-decoration-none text-dark mx-2">{{ __('footer.terms_of_service') }}</a>
            </div>
            <div class="col-md-4 text-center text-md-end">
                <a href="#" class="text-dark mx-2"><i class="bi bi-instagram fs-5"></i></a>
                <a href="#" class="text-dark mx-2"><i class="bi bi-facebook fs-5"></i></a>
                <a href="#" class="text-dark mx-2"><i class="bi bi-tiktok fs-5"></i></a>
            </div>
        </div>
    </div>
</footer>