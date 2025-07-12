@extends('user.layout.app')

@section('title', 'About Us Page')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Gidugu&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Yantramanav:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

<!-- Hero Section with Background Image and Foreground Text -->
{{-- Gambar Bagian paling atas --}}
@section('hero')
<div>
    <section style="background-image: url('/images/about/hero.png'); background-size: cover; background-position: center; margin: 0; padding: 0; height: 351px; position: relative; left: 50%; transform: translateX(-50%); top: 0%;">
        <div class="d-flex justify-content-center align-items-center" style="height: 100%;">
            <h1 class="text-black m-0 spacing-custom" style="font-size: 96px; font-family: 'Gidugu';">About Us</h1>
        </div>
    </div>
</div>
@endsection

<div class="container" style="margin-bottom: 50px;">
    <!-- Rest of the content below (Mission, Vision, Team) -->
    <div class="container-fluid py-5 align-items-center">
        <!-- Mission Section -->
        <div class="row justify-content-between align-items-center mb-5 mt-5">
            <div class="col-md-6 d-flex flex-column align-items-start text-start">
            <span class="mb-2 d-inline-block"
                  style="width:140px; height:35px; border-radius:20px;  background-color:#F9BCC4; color:#000; font-weight:400; font-size:18px; line-height:35px; text-align:center; font-family: 'Yantramanav', sans-serif; letter-spacing: 0.2px;">
                Why We Here
            </span>
            <h3 style="font-weight: 500; font-size: 40px; font-family: 'Yantramanav'; text-align: left;">Our Mission</h3>
            <div style="text-align: left; font-size: 20px;">
                <p>1. To provide a simple and trustworthy platform for donating and requesting hair in a fair and transparent way.</p>
                <p>2. To support the emotional healing and self-confidence of individuals affected by hair loss due to illness or medical treatments.</p>
                <p>3. To build a caring and empathetic community that values health, dignity, and human connection.</p>
            </div>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
            <img src="/images/about/mission.png" alt="Mission Image" class="img-fluid rounded" style="width: 600px; height: 340px; object-fit: cover;">
            </div>
        </div>

        <div style="height: 20px;"></div>
        
        <!-- Vision Section -->
        <div class="row align-items-center justify-content-between flex-md-row-reverse mb-5 mt-5" style="margin-bottom: 50px;">
            <div class="col-md-6 d-flex flex-column align-items-start text-start ps-md-5">
            <span class="mb-2 d-inline-block" style="width:140px; height:35px; border-radius:20px; background-color:#F9BCC4; color:#000; font-family:'Yantramanav'; font-weight:400; font-size:18px; line-height:35px; text-align:center;">
            The Goals
            </span>
            <h3 style="font-weight: 500; font-size: 40px; font-family: 'Yantramanav'; text-align: left;">Our Vision</h3>
            <p style="font-size: 20px; text-align: left;">
            To become a bridge of hope for those who have lost their hair due to medical conditions, by building a compassionate community connected through kindness and donation.
            </p>
            </div>
            <div class="col-md-6 d-flex justify-content-start">
            <div class="row g-3 justify-content-center">
                <div class="col-6 d-flex flex-column gap-3">
                <img src="/images/about/vission1a.png" alt="Vision 1" class="img-fluid rounded mb-2" style="width: 250px; height: 215px; object-fit: cover;">
                <img src="/images/about/vission1b.png" alt="Vision 2" class="img-fluid rounded" style="width: 250px; height: 215px; object-fit: cover;">
                </div>
                <div class="col-6">
                <img src="/images/about/vision2.png" alt="Vision 3" class="img-fluid rounded" style="width: 250px; height: 470px; object-fit: cover;">
                </div>
            </div>
            </div>
        </div>

        <div style="height: 40px;"></div>
    
        <!-- Our Team Section -->
        <div class="text-center mb-4">
            <span class="mb-2 d-inline-block" style="width:140px; height:35px; border-radius:20px; background-color:#F9BCC4; color:#000; font-family:'Yantramanav'; font-weight:400; font-size:18px; line-height:35px; text-align:center;">
                Our Team
            </span>
            <h1 class="text-black m-0 text-wrap spacing-custom" style="font-size: 84px; word-break: break-word; font-family: 'Gidugu'; line-height: 0.7;">
                Learn more about Whisper of Hope<br>
                <span style="display: inline-block;">dedicated team members!</span>
            </h1>
        </div>
    
        <div class="row row-cols-1 row-cols-md-5 g-4">
            @php
                $teamMembers = [
                    ['name' => 'Amel', 'image' => 'Amel.jpg', 'NIM' => '2702363683'],
                    ['name' => 'Bodhi', 'image' => 'Bodhi.jpg', 'NIM' => '2702363821'],
                    ['name' => 'Gavin', 'image' => 'Gavin.jpg', 'NIM' => '2702365303'],
                    ['name' => 'Nikita', 'image' => 'Nikita.JPG', 'NIM' => '2702364061'],
                    ['name' => 'Ria', 'image' => 'Ria.jpg', 'NIM' => '2702364364'],
                ];
            @endphp
            @foreach ($teamMembers as $member)
    <div class="col d-flex justify-content-center">
        <div class="card position-relative border border-3 border-black rounded-30 overflow-hidden" style="width: 220px; height: 280px; border-radius: 42px;">
            <div class="d-flex justify-content-center align-items-center" style="height: 75%;">
                <img src="/images/about/{{ $member['image'] }}" 
                     alt="Team Member {{ $member['name'] }}" 
                     style="width: 90%; height: 90%; object-fit: cover; border-top-left-radius: 30px; border-top-right-radius: 30px;">
            </div>

            <!-- Kotak -->
            <div class="position-absolute d-flex justify-content-center align-items-center"
                 style="height: 70px; background: #F791A9; border-bottom-left-radius: 30px; border-bottom-right-radius: 30px; z-index: 1; bottom: 12px; left: 50%; transform: translateX(-50%); width: 90%;">
                <span style="color: #fff; font-size: 22px; font-family: 'Yantramanav', sans-serif; font-weight: 700; margin-top: 15px; display: inline-block;">
                    {{ $member['NIM'] }}
                </span>
            </div>

            <!-- Badge nama di atas kotak -->
            <div class="position-absolute start-50 translate-middle-x text-dark fw-bold rounded-pill text-center"
                 style="bottom: 65px; width: 120px; height: 36px; line-height: 36px; font-size: 20px; z-index: 2; background: #FFDBDF; font-family: 'Yantramanav';">
                {{ $member['name'] }}
            </div>

        </div>
    </div>
    @endforeach
        </div>
    </div>
</div>

<style>
body, html {
    margin: 0;
    padding: 0;
    overflow: auto;
    scrollbar-width: none; /* Firefox */
    -ms-overflow-style: none;  /* IE and Edge */
}
body::-webkit-scrollbar, html::-webkit-scrollbar {
    display: none; /* Chrome, Safari, Opera */
}

  .spacing-custom {
    letter-spacing: 2px;
  }

  .hero-about {
    background-image: url('/images/about-hero.png');
    background-size: cover;
    background-position: center;
    width: 100%;
    height: 300px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .hero-about h1 {
    color: black;
    font-weight: bold;
    margin: 0;
  }
</style>

@endsection