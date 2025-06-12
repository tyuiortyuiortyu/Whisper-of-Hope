

@extends('layout.app')

<style>
body::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 700px;
    background-image: url('{{ asset('/images/Donate_hair/donate.png') }}');
    background-size: cover;
    background-position: top center;
    background-repeat: no-repeat;
    z-index: -1;
}

/* Overlay putih di bawah gambar background */
body::after {
    content: '';
    position: absolute;
    left: 0;
    right: 0;
    top: 100px; /* Mulai overlay di bawah gambar, sesuaikan jika perlu */
    height: 600px; /* Tinggi overlay, sesuaikan jika perlu */
    background: linear-gradient(to bottom, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%);
    z-index: -1;
}

body {
    content: '';
    left: 0;
    right: 0;
    top: 0; /* Mulai overlay di bawah gambar, sesuaikan jika perlu */
    z-index: -1;
}
.container {
    background-color: transparent; /* Make container transparent so the gradient shows through */
}
.donate-bg {
    background: linear-gradient(to bottom, #fff 0%, #F9BCC4 45%, #fff 100%);
    position: relative;
    left: 0;
    right: 0;
    top: 0;
    width: 100vw;
    margin-left: calc(50% - 50vw);
    margin-right: calc(50% - 50vw);
}
</style>

@section('title', 'Request a Wig Page')

@section('content')
<div class="container" style="margin-top: 500px;">
    <!-- Header Section -->
    <h2 class="text-center fw-bold" style="font-size: 106px; font-family: 'Gidugu', sans-serif;">
        Is Your Hair Ready to Give Hope?
    </h2>
    <p class="text-center mb-6" style="font-size: 24px; font-family: 'Yantramanav', sans-serif; margin-top: -20px; margin-bottom: 50px;">
        Here’s everything you need to know to donate your hair and help someone feel whole again.
    </p>

    <!-- Criteria Section -->
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

    <!-- Reminders Section -->
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

    <!-- Info Section -->
    <div class="donate-bg">
    <div class="mx-auto" style="max-width: 1100px;">
        <p class="text-center" style="font-size: 24px;">
            Not all hair can be used, but many types are welcome! Make sure your donation meets the criteria below so it can be turned into something truly meaningful.
        </p>
    </div>

    <!-- How To Donate Section -->
    <div class="container py-5 d-flex flex-column align-items-center">
        <h2 class="text-center fw-bold" style="font-size: 96px; font-family: 'Gidugu', sans-serif;">
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
                                <h3 class="fw-bold" style="font-size: 36px;">{{ $step['title'] }}</h3>
                                <p style="font-size: 20px; text-align: justify;">{{ $step['desc'] }}</p>
                            </div>
                        </div>  
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    
    
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 200px;">
            <h2 class="text-center fw-bold" style="font-size: 96px; font-family: 'Gidugu', sans-serif;">
                Give the Gift of the Hair
            </h2>
            <p class="text-center mb-5" style="font-size: 24px; max-width: 1100px;">
                Your donation makes a difference! Take a moment to complete this form.
            </p>
        </div>
    </div>

    <!-- Donation Form Section -->
    <div class="request-form">
        <div class="container rounded-16 p-4 my-4" style="background-color: #FFF9EA; max-width: 1200px; box-shadow: 8px 8px 24px 0 rgba(0,0,0,0.12), 8px 8px 0 0 rgba(0,0,0,0.04); border-radius: 16px;">
            <h2 class="fw-bold" style="font-family: 'Yantramanav', sans-serif; margin-left: 15px; margin-top:20px; margin-bottom: 25px;">Donate Hair</h2>
            <hr class="border-dark border-1 opacity-100">

            <form id="requestWigForm" novalidate>
                <!-- Hair Donor Section -->
                <div class="row mb-3">
                    <label class="col-md-3 fw-bold" style="font-family: 'Yantramanav', sans-serif; margin-left:15px; margin-top:20px; font-size: 24px;">Hair Donor’s Details</label>
                    <div style="width: 70%; margin-top:20px; margin-bottom: 15px;">
                        @php
                            $fields = [
                                ['label' => 'Full Name', 'type' => 'text', 'name' => 'donor_name', 'placeholder' => 'Your full name', 'invalid' => 'Full Name is required.'],
                                ['label' => 'Age', 'type' => 'number', 'name' => 'donor_age', 'placeholder' => 'Your age', 'invalid' => 'Age is required.'],
                                ['label' => 'Email', 'type' => 'email', 'name' => 'donor_email', 'placeholder' => 'you@example.com', 'invalid' => 'Email is required.'],
                                ['label' => 'Phone Number', 'type' => 'tel', 'name' => 'donor_phone', 'placeholder' => '+62...', 'invalid' => 'Phone Number is required.'],
                                ['label' => 'The Length of Your Ponytails (cm)', 'type' => 'number', 'name' => 'donor_length', 'placeholder' => 'e.g. 35', 'invalid' => 'Length is required.'],
                            ];
                        @endphp
                        @foreach($fields as $field)
                            <div class="mb-3">
                                <label class="form-label">{{ $field['label'] }}</label>
                                <input type="{{ $field['type'] }}" name="{{ $field['name'] }}" class="form-control custom-input transparent-on-blur" placeholder="{{ $field['placeholder'] }}" required>
                                <div class="invalid-feedback">{{ $field['invalid'] }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <hr class="border-dark border-1 opacity-100">

                <!-- Note -->
                <div class="text-center mb-3" style="font-size: 20px;">
                    Thank you for your generosity! Your donation will help someone feel whole again.<br>
                    Click ‘Submit’ to complete your act of kindness.
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <button type="reset" class="btn px-4 py-2 fw-medium text-black" style="background-color: #E8E8E8; color: #000; border-radius: 50px; width: 200px">
                        Clear
                    </button>
                    <button type="submit" class="btn text-black px-4 py-2 fw-medium" style="background-color: #F9BCC4; border-radius: 50px; width: 200px">
                        Submit
                    </button>
                </div>

                <hr class="border-dark border-1 opacity-100">

            </form>

            <!-- Popup Modal -->
            <div id="thankYouModal" class="modal-overlay" style="display:none;">
                <div class="modal-content">
                    <h2 class="text-center fw-bold" style="font-size: 36px; font-family: 'Gidugu', sans-serif; font-weight: bold;">Thank you for your beautiful gift! </h2>
                    <p class="text-center mb-5" style="font-size: 18px;">Please mail your hair within 7 days to Jl. Pakuan No.3, Sumur Batu, Kec. Babakan Madang, Kabupaten Bogor, Jawa Barat 16810.</p>
                    <button id="closeModalBtn" class="btn btn-primary px-4 py-2" style="border-radius: 50px; background: #F9BCC4; color: #000; border: none; font-weight: 500; font-size: 18px;">OK</button>
                </div>
            </div>

            <!-- Styles -->
            <style>
                .custom-input {
                    background: transparent !important;
                    border: 1.5px solid #000 !important;
                    color: #000;
                }
                .custom-input::placeholder {
                    color: #888 !important;
                    opacity: 1;
                }
                .invalid-feedback {
                    display: none;
                    color: #dc3545;
                    font-size: 0.95em;
                }
                .custom-input.is-invalid ~ .invalid-feedback {
                    display: block;
                }
                .modal-overlay {
                    position: fixed;
                    top: 0; left: 0; right: 0; bottom: 0;
                    width: 100vw; height: 100vh;
                    background: rgba(128,128,128,0.5);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    z-index: 9999;
                }
                .modal-content {
                    background: #fff;
                    border-radius: 24px;
                    padding: 48px 32px 32px 32px;
                    box-shadow: 0 8px 32px rgba(0,0,0,0.18);
                    text-align: center;
                    min-width: 320px;
                    max-width: 50vw;
                }
            </style>

            <!-- Scripts -->
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const form = document.getElementById('requestWigForm');
                    const inputs = form.querySelectorAll('.custom-input');
                    const modal = document.getElementById('thankYouModal');
                    const closeModalBtn = document.getElementById('closeModalBtn');

                    form.addEventListener('submit', function (e) {
                        let valid = true;
                        inputs.forEach(function(input) {
                            if (!input.value.trim()) {
                                input.classList.add('is-invalid');
                                valid = false;
                            } else {
                                input.classList.remove('is-invalid');
                            }
                        });
                        if (!valid) {
                            e.preventDefault();
                            e.stopPropagation();
                        } else {
                            e.preventDefault();
                            modal.style.display = 'flex';
                            document.body.style.overflow = 'hidden';
                        }
                    });

                    inputs.forEach(function(input) {
                        input.addEventListener('blur', function() {
                            if (!input.value.trim()) {
                                input.classList.add('is-invalid');
                            } else {
                                input.classList.remove('is-invalid');
                            }
                        });
                        input.addEventListener('input', function() {
                            if (input.value.trim()) {
                                input.classList.remove('is-invalid');
                            }
                        });
                    });

                    form.addEventListener('reset', function() {
                        setTimeout(function() {
                            inputs.forEach(function(input) {
                                input.classList.remove('is-invalid');
                            });
                        }, 0);
                    });

                    closeModalBtn.addEventListener('click', function() {
                        modal.style.display = 'none';
                        document.body.style.overflow = '';
                        form.reset();
                    });

                    modal.addEventListener('click', function(e) {
                        if (e.target === modal) {
                            modal.style.display = 'none';
                            document.body.style.overflow = '';
                            form.reset();
                        }
                    });
                });
            </script>
        </div>
    </div>
</div>
@endsection
