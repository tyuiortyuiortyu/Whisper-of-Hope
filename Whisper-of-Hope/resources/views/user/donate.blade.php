@php use Illuminate\Support\Facades\Auth; @endphp
@extends('user.layout.app')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Yantramanav:wght@400;700&family=Gidugu&display=swap" rel="stylesheet">

<style>
    body::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 700px;
        background-image: url({{ asset('/images/Donate_hair/donate.png') }});
        background-size: cover;
        background-position: top center;
        background-repeat: no-repeat;
        z-index: -1;
    }
    body::after {
        content: '';
        position: absolute;
        left: 0;
        right: 0;
        top: 100px;
        height: 600px;
        background: linear-gradient(to bottom, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%);
        z-index: -1;
    }

    body {
        overflow: auto;
        scrollbar-width: none;
        -ms-overflow-style: none;
    }
    body::-webkit-scrollbar, html::-webkit-scrollbar {
        display: none;
    }

    .container {
        background-color: transparent;
    }

    .donate-bg {
        background: linear-gradient(to bottom, #fff 0%, #F9BCC4 45%, #fff 100%);
        position: relative;
        width: 100vw;
        margin-left: calc(50% - 50vw);
        margin-right: calc(50% - 50vw);
    }

    .spacing-custom {
        letter-spacing: 0.5px;
    }

    #submitFormModal .modalContent {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #FEF0F0;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        border-radius: 10px;
        padding: 2rem 3rem;
        text-align: center;
        width: 28%;
        min-width: 420px;
        height: auto;
        z-index: 1000;
        display: flex;
        flex-direction: column;
    }

    #submitFormModal .modalHeader {
        text-align: center;
        align-items: center;
    }

    #submitFormModal .modalBody {
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    #submitFormModal .modalHeader h2 {
        font-size: 1.5rem;
        font-weight: 500;
        font-family: 'Yantramanav', sans-serif;
    }

    #submitFormModal .modalBody p {
        font-size: 1rem;
        line-height: 1.2;
        font-family: 'Yantramanav', sans-serif;
    }

    #submitFormModal .modalFooter .btn-submit {
        background-color: #F9BCC4;
        font-weight: 500;
    }

    #submitFormModal .modalFooter .btn-submit:hover {
        background-color: #F791A9;
        color: #FFFFFF;
    }

    #submitFormModal .modalHeader .modalBody .btn-submit {
        margin-top: auto;
    }

    .form-label {
        flex: 1;
        font-weight: bold;
        margin-bottom: 8px;
        font-size: 16px;
    }
    .form-fields input {
        width: 100%;
        padding: 8px 16px;
        margin-bottom: 16px;
        border-radius: 5px;
        border: 1px solid #000;
        font-size: 16px;
        background-color: transparent;
    }

    .content-blurred {
        filter: blur(4px);
        transition: filter 0.3s ease-out;
        pointer-events: none;
    }

    .modal-backdrop.show {
        opacity: 0.5;
        z-index: 1040;
    }

    .btn-clear:hover {
        background-color: #ccc !important;
        color: #fff !important;
    }
    .btn-submit:hover {
        background-color: #F791A9 !important;
        color: #fff !important;
    }

    .donate-button {
        background-color: #F9BCC4;
        color: #000;
        border-radius: 30px;
        font-size: 18px;
        font-weight: 500;
        margin-top: -30px;
        padding: 10px 40px;
        min-width: 200px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .donate-button:hover {
        background-color: #F791A9;
        color: #FFFFFF;
    }
</style>
@endpush

@section('title', __('donation.donate_page_title'))

@section('content')

<div id="page-content-wrapper">
    <div class="container" style="margin-top: 500px;">
        <h2 class="text-center fw spacing-custom" style="font-size: 96px; font-family: 'Gidugu', sans-serif; font-weight:500; line-height: 0.7;">
            {{ __('donation.ready_to_give_hope') }}
        </h2>
        <p class="text-center mb-6" style="font-size: 24px; font-family: 'Yantramanav', sans-serif; margin-bottom: 50px; margin-top: 30px;">
            {{ __('donation.donate_hair_intro') }}
        </p>

        <div class="row text-center mb-5 justify-content-center align-items-stretch" style="font-family: 'Yantramanav', sans-serif; row-gap: 10px; margin-left: 0;">
            @php
                $criteria = [
                    [
                        'title' => __('donation.criteria_title_30'),
                        'subtitle' => __('donation.criteria_subtitle_30'),
                        'desc' => __('donation.criteria_desc_30'),
                        'style' => 'margin-top: -55px;',
                    ],
                    [
                        'title' => __('donation.criteria_title_natural'),
                        'desc' => __('donation.criteria_desc_natural'),
                    ],
                    [
                        'title' => __('donation.criteria_title_clean'),
                        'desc' => __('donation.criteria_desc_clean'),
                    ],
                    [
                        'title' => __('donation.criteria_title_healthy'),
                        'desc' => __('donation.criteria_desc_healthy'),
                    ],
                ];
            @endphp
            @foreach($criteria as $i => $item)
                <div class="col-md-2 d-flex flex-column justify-content-center px-1" style="{{ $item['style'] ?? '' }}">
                    <div class="d-flex flex-column mb-1">
                        @if(isset($item['subtitle']))
                            <h1 class="fw-bold mb-0" style="font-size: 40px; margin-top: 50px;">{{ $item['title'] }}</h1>
                            <p class="mb-0" style="font-size: 30px; font-weight: bold; margin-top: -10px;">{!! $item['subtitle'] !!}</p>
                        @else
                            <h5 class="fw-bold mb-1" style="font-size: 30px;">{!! $item['title'] !!}</h5>
                        @endif
                    </div>
                    <p class="mb-1" style="font-size: 18px;">{!! $item['desc'] !!}</p>
                </div>
                @if($i < count($criteria) - 1)
                    <div class="col-md-1 d-flex align-items-center justify-content-center px-0">
                        <div style="border-left: 2px solid #000; height: 200px;"></div>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="col-md-12 d-flex justify-content-center px-1 mb-5">
            <div class="p-4 rounded mb-3" style="background-color: #fcd6e2; max-width: 1150px; width: 100%;">
                <strong class="mb-2" style="font-size: 24px;">{{ __('donation.friendly_reminders_title') }}</strong>
                <ul class="mb-2 ps-3" style="font-size: 18px;">
                    <li>{{ __('donation.reminder_1') }}</li>
                    <li>{{ __('donation.reminder_2') }}</li>
                    <li>{{ __('donation.reminder_3') }}</li>
                </ul>
            </div>
        </div>

        <div class="donate-bg">
            <div class="mx-auto" style="max-width: 1100px;">
                <p class="text-center" style="font-size: 24px;">
                    {{ __('donation.hair_welcome_message') }}
                </p>
            </div>

            <div class="container py-5 d-flex flex-column align-items-center">
                <h2 class="text-center fw spacing-custom" style="font-size: 96px; font-family: 'Gidugu', sans-serif;">
                    {{ __('donation.how_to_donate_title') }}
                </h2>
                <p class="text-center mb-5" style="font-size: 24px; max-width: 1100px; margin-top: -20px;">
                    {{ __('donation.how_to_donate_intro') }}
                </p>
                <div class="d-flex align-items-center justify-content-center mb-5">
                    <div class="d-flex w-100">
                        <div class="row g-4 w-100" style="max-width: 1100px;">
                            @php
                                $steps = [
                                    [
                                        'img' => '/images/Donate_hair/1.png',
                                        'title' => __('donation.step_prepare_title'),
                                        'desc' => __('donation.step_prepare_desc'),
                                    ],
                                    [
                                        'img' => '/images/Donate_hair/2.png',
                                        'title' => __('donation.step_package_title'),
                                        'desc' => __('donation.step_package_desc'),
                                    ],
                                    [
                                        'img' => '/images/Donate_hair/3.png',
                                        'title' => __('donation.step_mail_title'),
                                        'desc' => __('donation.step_mail_desc'),
                                    ],
                                ];
                            @endphp
                            @foreach($steps as $step)
                                <div class="col-md-4 d-flex justify-content-center">
                                    <div class="p-4 rounded-30 text-center d-flex flex-column align-items-center"
                                        style="background-color: #FFF9EA; border-radius: 30px; margin: 0 15px; width: 400px; height: 400px;">
                                        <img src="{{ $step['img'] }}" style="width: 80px; height: auto;" class="mb-3">
                                        <h3 class="spacing-custom" style="font-size: 60px; font-family: 'Gidugu', sans-serif;">{{ $step['title'] }}</h3>
                                        <p style="font-size: 20px; text-align: justify;">{{ $step['desc'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 200px;">
                <h2 class="text-center spacing-custom" style="font-size: 96px; font-family: 'Gidugu', sans-serif;">
                    {{ __('donation.give_the_gift_title') }}
                </h2>
                <p class="text-center mb-5" style="font-size: 24px; max-width: 1100px;">
                    {{ __('donation.give_the_gift_intro') }}
                </p>
            </div>
        </div>

        <div id="donate-form-section" class="d-flex flex-column align-items-center justify-content-center mb-5">
            @guest
                <div class="d-flex justify-content-center align-items-start" style="min-height: 100px; position: relative;">
                    <a href="{{ route('user.donate') }}" class="btn donate-button">
                        {{ __('donation.donate_hair_button') }}
                    </a>
                </div>
            @else
                <div class="rounded-20 p-5 my-2 w-100"
                    style="background-color: #FFF9EA; border-radius: 20px; padding: 40px 64px; margin: 8px 0px; max-width: 1200px; display: flex; flex-direction: column;
                    box-shadow: 4px 4px 12px 0 rgba(0,0,0,0.3);">

                    <h2 class="mb-0" style="font-family: 'Yantramanav', sans-serif; font-size: 28px; margin-left: 20px; margin-bottom: 0;">{{ __('donation.form_title') }}</h2>
                    <hr style="border: none; border-top: 1px solid #000; margin-top: 0; margin-bottom: 28px;">

                    <form id="DonateHairForm" method="POST" action="{{ route('donate.hair.store') }}">
                        @csrf

                        {{-- Hair Donor's Details Section --}}
                        <div class="row mb-3" style="display: flex; margin-left: 10px;">
                            <div class="form-label col-md-3 fw-bold d-flex align-items-start flex-column justify-content-start mb-2">
                                {{ __('donation.donor_details_label') }}
                            </div>
                            <div class="form-fields col-md-9">
                                {{-- Full Name Field --}}
                                <div class="mb-1">
                                    <label for="full_name">{{ __('donation.full_name') }}</label>
                                    <input type="text" id="full_name" name="full_name" class="bg-transparent always-transparent" required value="{{ old('full_name', Auth::check() ? Auth::user()->name : '') }}">
                                    @error('full_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Age Field --}}
                                <div class="mb-1">
                                    <label for="age">{{ __('donation.age') }}</label>
                                    <input type="number" id="age" name="age" class="bg-transparent always-transparent" required value="{{ old('age') }}">
                                    @error('age')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Email Field --}}
                                <div class="mb-1">
                                    <label for="email">{{ __('donation.email') }}</label>
                                    <input type="email" id="email" class="bg-transparent always-transparent" name="email" required value="{{ old('email', Auth::check() ? Auth::user()->email : '') }}">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Phone Number Field --}}
                                <div class="mb-1">
                                    <label for="phone">{{ __('donation.phone_number') }}</label>
                                    <input type="tel" id="phone" class="bg-transparent always-transparent" name="phone" required value="{{ old('phone', Auth::check() ? Auth::user()->phone : '') }}">
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Hair Length Field --}}
                                <div class="mb-1">
                                    <label for="hair_length">{{ __('donation.hair_length_label') }}</label>
                                    <input type="number" id="hair_length" class="bg-transparent always-transparent" name="hair_length" required value="{{ old('hair_length') }}">
                                    @error('hair_length')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr style="border: none; border-top: 1px solid #000; margin: 16px 0;">

                        {{-- Thank You Message --}}
                        <div class="text-center mb-4">
                            {{ __('donation.form_thank_you_message') }}
                        </div>

                        {{-- Form Buttons --}}
                        <div class="form-button d-flex justify-content-center gap-3 mt-3">
                            <button type="reset" class="btn px-4 rounded-pill btn-clear" style="min-width: 150px; background-color: #E8E8E8; color: #000; border: none; font-weight: 500;">{{ __('donation.clear_button') }}</button>
                            <button type="submit" class="btn btn-pink px-4 rounded-pill btn-submit" style="min-width: 150px; background-color: #F9BCC4; color: #000; font-weight: 500;">{{ __('donation.submit_button') }}</button>
                        </div>
                    </form>
                </div>
            @endguest
        </div>
    </div>
</div>

@include('user.auth.login')

<div class="modal fade" id="submitFormModal" tabindex="-1" aria-labelledby="submitModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modalContent">
            <div class="modalHeader">
                <h2 style="margin-bottom: 18px;">{{ __('donation.modal_thank_you_title') }}</h2>
            </div>
            <div class="modalBody">
                <p>{{ __('donation.modal_address_message') }}</p>
            </div>
            <div class="modalFooter">
                <button type="button" class="btn btn-submit px-5 py-2 rounded-pill" style="min-width: 180px; border-radius: 30px; font-weight: 500;" data-bs-dismiss="modal">{{ __('donation.ok_button') }}</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const loginModalElement = document.getElementById('loginModal');
        const registerModalElement = document.getElementById('registerModal');
        const forgotPasswordModalElement = document.getElementById('forgotPasswordModal');
        const pageContentWrapper = document.getElementById('page-content-wrapper');
        const submitFormModalElement = document.getElementById('submitFormModal');

        const loginModal = loginModalElement ? new bootstrap.Modal(loginModalElement, { backdrop: 'static', keyboard: false }) : null;
        const registerModal = registerModalElement ? new bootstrap.Modal(registerModalElement, { backdrop: 'static', keyboard: false }) : null;
        const forgotPasswordModal = forgotPasswordModalElement ? new bootstrap.Modal(forgotPasswordModalElement, { backdrop: 'static', keyboard: false }) : null;
        const submitFormModal = submitFormModalElement ? new bootstrap.Modal(submitFormModalElement) : null;

        let openingAnotherModal = false;

        function hideModal(modalInstance) {
            if (modalInstance) {
                modalInstance.hide();
            }
        }

        function handleGuestLoginModal() {
            @guest
                if (loginModal) { 
                    if (!openingAnotherModal) {
                        loginModal.show();
                    }
                }
            @endguest
        }

        if (loginModalElement && loginModal) {
            @guest
                handleGuestLoginModal();

                const openLoginModalLink = document.getElementById('openLoginModalLink');
                if (openLoginModalLink) {
                    openLoginModalLink.addEventListener('click', function(event) {
                        event.preventDefault();
                        hideModal(registerModal);
                        hideModal(forgotPasswordModal);
                        loginModal.show();
                    });
                }

                loginModalElement.addEventListener('show.bs.modal', function () {
                    if (pageContentWrapper) {
                        pageContentWrapper.classList.add('content-blurred');
                    }
                });

                loginModalElement.addEventListener('hidden.bs.modal', function () {
                    if (pageContentWrapper) {
                        pageContentWrapper.classList.remove('content-blurred');
                    }
                });
            @endguest 
            
        }

        // --- Register Modal Logic ---
        if (registerModalElement && registerModal) {
            registerModalElement.addEventListener('show.bs.modal', function () {
                openingAnotherModal = true;
                hideModal(loginModal);
                hideModal(forgotPasswordModal);

                if (pageContentWrapper) {
                    pageContentWrapper.classList.add('content-blurred');
                }
            });

            registerModalElement.addEventListener('hidden.bs.modal', function () {
                openingAnotherModal = false;
                if (pageContentWrapper) {
                    pageContentWrapper.classList.remove('content-blurred');
                }
            });
        }

        if (forgotPasswordModalElement && forgotPasswordModal) {
            forgotPasswordModalElement.addEventListener('show.bs.modal', function () {
                openingAnotherModal = true;
                hideModal(loginModal);
                hideModal(registerModal);

                if (pageContentWrapper) {
                    pageContentWrapper.classList.add('content-blurred');
                }
            });

            forgotPasswordModalElement.addEventListener('hidden.bs.modal', function () {
                openingAnotherModal = false;
                if (pageContentWrapper) {
                    pageContentWrapper.classList.remove('content-blurred');
                }
            });
        }

        if (submitFormModalElement && submitFormModal) {
            @if(session('show_modal'))
                submitFormModal.show();
            @endif
        }
    });
</script>
@endpush