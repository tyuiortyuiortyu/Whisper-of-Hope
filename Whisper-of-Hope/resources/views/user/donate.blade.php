@php use Illuminate\Support\Facades\Auth; @endphp
@extends('layout.app')

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
    position: relative;
    background-color: #FEF0F0;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 10px;
    padding: 2rem;
    text-align: center;
    width: 100%;
    height: auto;
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

#loginRequiredModal .modal-dialog {
    max-width: 400px;
    margin: 0 auto;
    height: auto;
}

#loginRequiredModal .add-modal-content {
    background-color: #FEF0F0;
    border-radius: 10px;
    width: 400px;
    margin-top: 24px;
    height: auto;
    padding: 2rem;
}

.content-blur-container {
    filter: blur(4px);
    transition: filter 0.3s ease-out;
}

.modal-backdrop.show {
    opacity: 0.5;
    z-index: 1040;
}

</style>
@endpush

@section('title', 'Donate Hair Page')

@section('content')

<div id="page-content-wrapper">
    <div class="container" style="margin-top: 500px;">
        <h2 class="text-center fw spacing-custom" style="font-size: 96px; font-family: 'Gidugu', sans-serif; font-weight:500;">
            Is Your Hair Ready to Give Hope?
        </h2>
        <p class="text-center mb-6" style="font-size: 24px; font-family: 'Yantramanav', sans-serif; margin-top: -20px; margin-bottom: 50px;">
            Here’s everything you need to know to donate your hair and help someone feel whole again.
        </p>

        <div class="row text-center mb-5 justify-content-center align-items-stretch" style="font-family: 'Yantramanav', sans-serif; row-gap: 10px; margin-left: 0;">
            @php
                $criteria = [
                    [
                        'title' => '30',
                        'subtitle' => 'Centimeters',
                        'desc' => 'at least 30 cms<br>Longer is better!',
                        'style' => 'margin-top: -55px;',
                    ],
                    [
                        'title' => 'Natural and<br>Unprocessed',
                        'desc' => 'No dyes, bleach, or chemical treatments',
                    ],
                    [
                        'title' => 'Clean<br>and Dry',
                        'desc' => 'Washed, fully dried, and free of styling products',
                    ],
                    [
                        'title' => 'Healthy Condition',
                        'desc' => 'No mold, excessive split ends, or damage',
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
                <strong class="mb-2" style="font-size: 24px;">Friendly Reminders</strong>
                <ul class="mb-2 ps-3" style="font-size: 18px;">
                    <li>Hair must be secured in a ponytail or braid before being cut.</li>
                    <li>Please ensure your hair is clean and thoroughly dry before you have it cut.</li>
                    <li>Please ensure conditioner or other products are completely washed out prior to your final hair cut.</li>
                </ul>
            </div>
        </div>

        <div class="donate-bg">
            <div class="mx-auto" style="max-width: 1100px;">
                <p class="text-center" style="font-size: 24px;">
                    Not all hair can be used, but many types are welcome! Make sure your donation meets the criteria below so it can be turned into something truly meaningful.
                </p>
            </div>

            <div class="container py-5 d-flex flex-column align-items-center">
                <h2 class="text-center fw spacing-custom" style="font-size: 96px; font-family: 'Gidugu', sans-serif;">
                    HOW TO DONATE YOUR HAIR?
                </h2>
                <p class="text-center mb-5" style="font-size: 24px; max-width: 1100px; margin-top: -20px;">
                    This guide will walk you through each step to ensure your generous act becomes a meaningful source of hope and strength for someone on a healing journey.
                </p>
                <div class="d-flex align-items-center justify-content-center mb-5">
                    <div class="d-flex w-100">
                        <div class="row g-4 w-100" style="max-width: 1100px;">
                            @php
                                $steps = [
                                    [
                                        'img' => '/images/Donate_hair/1.png',
                                        'title' => 'PREPARE',
                                        'desc' => 'Ensure your hair meets our donation requirements. Don’t forget to tie your hair securely in a ponytail or braid before cutting.',
                                    ],
                                    [
                                        'img' => '/images/Donate_hair/2.png',
                                        'title' => 'PACKAGE',
                                        'desc' => 'Place the tied hair in a zip-lock or sealed plastic bag, then insert it into a waterproof envelope. Be sure to include your completed donation form.',
                                    ],
                                    [
                                        'img' => '/images/Donate_hair/3.png',
                                        'title' => 'MAIL',
                                        'desc' => 'Ship your donation to the designated address listed on our website. For optimal quality, please send the hair within 2 weeks of cutting.',
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
                    Give the Gift of the Hair
                </h2>
                <p class="text-center mb-5" style="font-size: 24px; max-width: 1100px;">
                    Your donation makes a difference! Take a moment to complete this form.
                </p>
            </div>
        </div>

        <div class="d-flex flex-column align-items-center justify-content-center">
            <div class="rounded-20 p-5 my-2 w-100"
                style="background-color: #FFF9EA; border-radius: 20px; padding: 40px 64px; margin: 8px 0px; max-width: 1200px; display: flex; flex-direction: column;
                box-shadow: 4px 4px 12px 0 rgba(0,0,0,0.3);">
                <h2 class="mb-0" style="font-family: 'Yantramanav', sans-serif; font-size: 28px; margin-left: 20px; margin-bottom: 0;">Donate Hair</h2>
                <hr style="border: none; border-top: 1px solid #000; margin-top: 0; margin-bottom: 28px;">
                <form id="DonateHairForm" method="POST" action="{{ route('donate.hair.store') }}">
                    @csrf
                    <div class="row mb-3" style="display: flex; margin-left: 10px;">
                        <div class="form-label col-md-3 fw-bold d-flex align-items-start flex-column justify-content-start mb-2">
                            Hair Donor's Detail
                        </div>
                        <div class="form-fields col-md-9">
                            <div class="mb-1">
                                <label>Full Name</label>
                                <input type="text" name="full_name" class="bg-transparent always-transparent" required value="{{ old('full_name', Auth::check() ? Auth::user()->name : '') }}">
                                @error('full_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label>Age</label>
                                <input type="number" name="age" class="bg-transparent always-transparent" required value="{{ old('age') }}">
                                @error('age')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label>Email</label>
                                <input type="email" class="bg-transparent always-transparent" name="email" required value="{{ old('email', Auth::check() ? Auth::user()->email : '') }}">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label>Phone Number</label>
                                <input type="tel" class="bg-transparent always-transparent" name="phone" required value="{{ old('phone', Auth::check() ? Auth::user()->phone : '') }}">
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label>The Length of Your Ponytails (cm)</label>
                                <input type="number" class="bg-transparent always-transparent" name="hair_length" required value="{{ old('hair_length') }}">
                                @error('hair_length')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <hr style="border: none; border-top: 1px solid #000; margin: 16px 0;">
                    <div class="text-center mb-4">
                        Thank you for your generosity! Your donation will help someone feel whole again.<br>
                        Click ‘Submit’ to complete your act of kindness.
                    </div>
                    <div class="form-button d-flex justify-content-center gap-3 mt-3">
                        <button type="reset" class="btn px-4 rounded-pill btn-clear" style="min-width: 150px; background-color: #E8E8E8; color: #000; border: none; font-weight: 500;">Clear</button>
                        <button type="submit" class="btn btn-pink px-4 rounded-pill btn-submit" style="min-width: 150px; background-color: #F9BCC4; color: #000; font-weight: 500;">Submit</button>
                    </div>
                    <style>
                        .btn-clear:hover {
                            background-color: #ccc !important;
                            color: #fff !important;
                        }
                        .btn-submit:hover {
                            background-color: #F791A9 !important;
                            color: #fff !important;
                        }
                    </style>
                </form>
            </div>
        </div>

        <script>
            function showTestModal() {
                if (typeof bootstrap !== 'undefined') {
                    const modal = new bootstrap.Modal(document.getElementById('submitFormModal'));
                    modal.show();
                }
            }
        </script>
    </div>
</div>

@if (!Auth::check())
<div class="modal fade" id="loginRequiredModal" tabindex="-1" aria-labelledby="loginRequiredModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content add-modal-content">
            <div class="modal-header border-0 d-flex flex-column align-items-center pb-0">
                <h2 class="modal-title w-100 text-center" id="loginRequiredModalLabel" style="font-size: 32px; font-family: 'Yantramanav', sans-serif;">Login Required</h2>
            </div>
            <div class="modal-body text-center px-3 pb-3">
                <p style="font-size: 20px; line-height: 1.2; font-family: 'Yantramanav', sans-serif;">
                    You need to log in before accessing this page.
                </p>
                <a class="btn btn-pink px-4 rounded-pill mt-2" style="background-color: #F9BCC4; font-weight: 500; min-width: 200px; cursor: pointer;" href="#" id="showLoginModalBtn">Login
                    <i class="bi bi-person-circle ms-2"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endif

<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
                <hr>
                <p class="text-center">
                    Belum punya akun? <a href="#" id="showRegisterFromLoginBtn" class="text-decoration-none">Daftar di sini</a>
                </p>
                <p class="text-center">
                    <a href="#" id="showForgotPwdFromLoginBtn" class="text-decoration-none">Lupa Kata Sandi?</a>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Register</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="register_name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="register_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="register_email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="register_email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="register_password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="register_password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="register_password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="register_password_confirmation" name="password_confirmation" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Register</button>
                </form>
                <hr>
                <p class="text-center">
                    Sudah punya akun? <a href="#" id="showLoginFromRegisterBtn" class="text-decoration-none">Login di sini</a>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="forgotPasswordModalLabel">Forgot Password</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('password.email') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="forgot_email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="forgot_email" name="email" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Send Password Reset Link</button>
                </form>
                <hr>
                <p class="text-center">
                    Ingat akun Anda? <a href="#" id="showLoginFromForgotPwdBtn" class="text-decoration-none">Login di sini</a>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="submitFormModal" tabindex="-1" aria-labelledby="submitModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modalContent">
            <div class="modalHeader">
                <h2>Thank you for your beautiful gift!</h2>
            </div>
            <div class="modalBody" style="margin-top: 24px;">
                <p>Please mail your hair within 7 days to<br>
                Jl. Pakuan No.3, Sumur Batu, Kec. Babakan Madang,<br>
                Kabupaten Bogor, Jawa Barat 16810.</p>
            </div>
            <div class="modalFooter d-flex flex-column align-items-center mt-4" style="cursor: pointer !important;">
                <button type="button" class="btn btn-submit px-4 rounded-pill" data-bs-dismiss="modal" style="min-width: 150px; cursor: pointer !important;">
                    OK
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@if(session('show_modal'))
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const submitFormModal = new bootstrap.Modal(document.getElementById('submitFormModal'));
            submitFormModal.show();
        });
    </script>
@endpush
@endif

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const loginRequiredModalElement = document.getElementById('loginRequiredModal');
        const loginRequiredModal = new bootstrap.Modal(loginRequiredModalElement);

        const loginModalElement = document.getElementById('loginModal');
        let loginModal = null;
        if (loginModalElement) {
             loginModal = new bootstrap.Modal(loginModalElement);
        }

        const registerModalElement = document.getElementById('registerModal');
        let registerModal = null;
        if (registerModalElement) {
            registerModal = new bootstrap.Modal(registerModalElement);
        }

        const forgotPasswordModalElement = document.getElementById('forgotPasswordModal');
        let forgotPasswordModal = null;
        if (forgotPasswordModalElement) {
            forgotPasswordModal = new bootstrap.Modal(forgotPasswordModalElement);
        }

        const pageContentWrapper = document.getElementById('page-content-wrapper');

        if (!{!! json_encode(Auth::check()) !!}) {
            if (!document.querySelector('.modal.show')) {
                loginRequiredModal.show();
                if (pageContentWrapper) {
                    pageContentWrapper.classList.add('content-blur-container');
                }
                document.body.style.overflow = 'hidden';
            }
        } else {
            if (pageContentWrapper) {
                pageContentWrapper.classList.remove('content-blur-container');
            }
            document.body.style.overflow = '';
        }

        const showLoginModalBtn = document.getElementById('showLoginModalBtn');
        if (showLoginModalBtn) {
            showLoginModalBtn.addEventListener('click', function (e) {
                e.preventDefault();
                loginRequiredModal.hide();
                if (loginModal) {
                    loginModal.show();
                }
            });
        }

        const showRegisterFromLoginBtn = document.getElementById('showRegisterFromLoginBtn');
        if (showRegisterFromLoginBtn) {
            showRegisterFromLoginBtn.addEventListener('click', function (e) {
                e.preventDefault();
                if (loginModal) {
                    loginModal.hide();
                }
                if (registerModal) {
                    registerModal.show();
                }
            });
        }

        const showForgotPwdFromLoginBtn = document.getElementById('showForgotPwdFromLoginBtn');
        if (showForgotPwdFromLoginBtn) {
            showForgotPwdFromLoginBtn.addEventListener('click', function (e) {
                e.preventDefault();
                if (loginModal) {
                    loginModal.hide();
                }
                if (forgotPasswordModal) {
                    forgotPasswordModal.show();
                }
            });
        }

        const showLoginFromRegisterBtn = document.getElementById('showLoginFromRegisterBtn');
        if (showLoginFromRegisterBtn) {
            showLoginFromRegisterBtn.addEventListener('click', function (e) {
                e.preventDefault();
                if (registerModal) {
                    registerModal.hide();
                }
                if (loginModal) {
                    loginModal.show();
                }
            });
        }

        const showLoginFromForgotPwdBtn = document.getElementById('showLoginFromForgotPwdBtn');
        if (showLoginFromForgotPwdBtn) {
            showLoginFromForgotPwdBtn.addEventListener('click', function (e) {
                e.preventDefault();
                if (forgotPasswordModal) {
                    forgotPasswordModal.hide();
                }
                if (loginModal) {
                    loginModal.show();
                }
            });
        }

        if (loginModalElement) {
            loginModalElement.addEventListener('hidden.bs.modal', function () {
                if (!{!! json_encode(Auth::check()) !!}) {
                    if (!document.querySelector('.modal.show')) {
                        loginRequiredModal.show();
                        if (pageContentWrapper) {
                            pageContentWrapper.classList.add('content-blur-container');
                        }
                        document.body.style.overflow = 'hidden';
                    }
                } else {
                    if (pageContentWrapper) {
                        pageContentWrapper.classList.remove('content-blur-container');
                    }
                    document.body.style.overflow = '';
                }
            });
        }

        if (registerModalElement) {
            registerModalElement.addEventListener('hidden.bs.modal', function () {
                if (!{!! json_encode(Auth::check()) !!}) {
                    if (!document.querySelector('.modal.show')) {
                        if (loginModal) {
                            loginModal.show();
                        } else {
                            loginRequiredModal.show();
                        }
                        if (pageContentWrapper) {
                            pageContentWrapper.classList.add('content-blur-container');
                        }
                        document.body.style.overflow = 'hidden';
                    }
                } else {
                    if (pageContentWrapper) {
                        pageContentWrapper.classList.remove('content-blur-container');
                    }
                    document.body.style.overflow = '';
                }
            });
        }

        if (forgotPasswordModalElement) {
            forgotPasswordModalElement.addEventListener('hidden.bs.modal', function () {
                if (!{!! json_encode(Auth::check()) !!}) {
                    if (!document.querySelector('.modal.show')) {
                        if (loginModal) {
                            loginModal.show();
                        } else {
                            loginRequiredModal.show();
                        }
                        if (pageContentWrapper) {
                            pageContentWrapper.classList.add('content-blur-container');
                        }
                        document.body.style.overflow = 'hidden';
                    }
                } else {
                    if (pageContentWrapper) {
                        pageContentWrapper.classList.remove('content-blur-container');
                    }
                    document.body.style.overflow = '';
                }
            });
        }
    });
</script>
@endpush