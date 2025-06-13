@extends('layout.app')

@push('styles')
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
.add-modal-overlay {
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    width: 100vw; height: 100vh;
    background: rgba(128,128,128,0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
}
.add-modal-content {
    background: #fff;
    border-radius: 24px;
    padding: 24px 16px 16px 16px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.18);
    text-align: center;
}
.form-label {
    flex: 1;
    font-weight: bold;
    margin-bottom: 8px; /* 0.5rem = 8px */
    font-size: 16px;    /* 1rem = 16px */
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

</style>
@endpush

@section('title', 'Request a Wig Page')

@section('content')
<div class="container" style="margin-top: 500px;">
    <!-- Header Section -->
    <h2 class="text-center fw spacing-custom" style="font-size: 96px; font-family: 'Gidugu', sans-serif; font-weight:500;">
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

    <!-- Donation Form Section -->
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
                            <input type="text" name="donator_name" class="bg-transparent always-transparent" required>
                        </div>
                        <div class="mb-1">
                            <label>Age</label>
                            <input type="number" name="donator_age" class="bg-transparent always-transparent" required>
                        </div>
                        <div class="mb-1">
                            <label>Email</label>
                            <input type="email" name="donator_email" class="bg-transparent always-transparent" required>
                        </div>
                        <div class="mb-1">
                            <label>Phone Number</label>
                            <input type="tel" name="donator_phone" class="bg-transparent always-transparent" required>
                        </div>
                        <div class="mb-1">
                            <label>The Length of Your Ponytails (cm)</label>
                            <input type="number" name="hair_length" class="bg-transparent always-transparent" required>
                        </div>
                    </div>
                </div>
                <hr style="border: none; border-top: 1px solid #000; margin: 16px 0;">
                <div class="text-center mb-4">
                    Thank you for your generosity! Your donation will help someone feel whole again.<br>
Click               ‘Submit’ to complete your act of kindness.
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

    <!-- Modal Section -->
    <div class id="submitFormModal" tabindex="-1" aria-labelledby="submitModalLabel" aria-hidden="true">
        <div class style="max-width: 700px;">
            <div class="add-modal-content" style="background-color: #FEF0F0; border-radius: 10px; width: 400px; margin: 0 auto; height: auto;">
                <div class="border-0 d-flex flex-column align-items-center">
                    <h2 class="w-100 text-center" style="font-size: 26px; font-family: 'Yantramanav', sans-serif;">Thank you for your beautiful gift! </h2>
                </div>
                <div class="modal-body text-center">
                    <p style="font-size: 16px; line-height: 1.2; font-family: 'Yantramanav', sans-serif;">
                        Please mail your hair within 7 days to
                        Jl. Pakuan No.3, Sumur Batu, Kec. Babakan Madang,
                        Kabupaten Bogor, Jawa Barat 16810.
                    </p>
                </div>
                <div class="modal-footer border-0 d-flex justify-content-center">
                    <button type="button" class="btn btn-pink px-4 rounded-pill" data-bs-dismiss="modal" style="background-color: #F9BCC4; font-weight: 500; min-width: 200px;">OK</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('requestWigForm');
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                // Show Bootstrap modal
                const modal = new bootstrap.Modal(document.getElementById('submitFormModal'));
                modal.show();
                // Optionally reset the form
                form.reset();
            });
        });
    </script>
    @endpush
    @endsection
