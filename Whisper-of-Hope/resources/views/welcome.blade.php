@extends('user.layout.app')

@section('title', __('welcome.title'))

@section('content')
<style>
    /* Import Google Fonts */
    @import url('https://fonts.googleapis.com/css2?family=Gidugu&family=Yantramanav:wght@300;400;500;700&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Yantramanav', sans-serif;
        line-height: 1.6;
        color: #333;
        /* Hide scrollbar for the entire page */
        overflow-x: hidden;
        scrollbar-width: none; /* Firefox */
        -ms-overflow-style: none; /* Internet Explorer 10+ */
        padding-top: 80px; /* Add padding for fixed navbar */
    }

    /* Navbar Sticky Styles */
    .navbar, nav {
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        z-index: 1000 !important;
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
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

    /* Section base styles */
    section {
        min-height: auto;
        display: flex;
        align-items: center;
        padding: 2rem 0;
        width: 100vw;
        margin-left: calc(-50vw + 50%);
    }

    /* Hero Section */
    .hero-section {
        background: #FFFDFE;
    }

    .hero-container {
        max-width: 1200px;
        min-height: 80vh;
        margin: auto;
        padding: 0 1rem;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
        align-items: center;
        width: 100%;
    }

    .hero-content h1 {
        font-family: 'Gidugu', cursive;
        font-size: 6rem;
        color: #F791A9;
        margin-bottom: 1rem;
        line-height: 0.8;
    }

    .hero-content h1 .highlight {
        color: #000000;
    }

    .hero-content p {
        font-size: 1.1rem;
        color: #666;
        margin-bottom: 2rem;
        line-height: 1.6;
    }

    .hero-buttons {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .btn {
        padding: 0.75rem 2rem;
        border: none;
        border-radius: 2rem;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
        font-family: 'Yantramanav', sans-serif;
    }

    .btn-primary {
        background-color: #F9BCC4;
        color: #333;
    }

    .btn-primary:hover {
        background-color: #F791A9;
        transform: translateY(-2px);
    }

    .btn-primary:active,
    .btn-primary:focus {
        background-color: #F9BCC4 !important;
        color: #333 !important;
        outline: none;
        box-shadow: none;
        transform: translateY(0);
    }

    .btn-secondary {
        background-color: #F9BCC4;
        color: #333;
        border: 2px solid #F9BCC4;
    }

    .btn-secondary:hover {
        background-color: #f5a8c1;
        transform: translateY(-2px);
    }

    .btn-secondary:active,
    .btn-secondary:focus {
        background-color: #F9BCC4 !important;
        color: #333 !important;
        outline: none;
        box-shadow: none;
        transform: translateY(0);
    }

    .hero-image {
        /* margin-right: -10rem; */
        text-align: center;
    }

    .hero-image img {
        max-width: 100%;
        height: auto;
        /* border-radius: 1rem; */
        /* box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); */
    }

    /* Features Section */
    .features-section {
        background: linear-gradient(#FFDBDF 0%, #F9BCC4 69%, #FFFDFE 100%);;
    }

    .features-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
        margin-top: 3rem;
        text-align: center;
        width: 100%;
        position: relative;
    }

    .features-grid {
        display: grid;
        margin-bottom: 15rem;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
        position: relative;
    }

    .feature-item {
        position: relative;
        min-height: 400px;
        display: flex;
        flex-direction: column;
    }

    .feature-header {
        background: #C1D5F4;
        border-radius: 2rem 2rem 0 0;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        text-align: center;
        position: relative;
        z-index: 10;
    }

    .feature-header h3 {
        font-family: 'Gidugu', cursive; 
        font-weight: 100;
        color: #000;
        font-size: 3.5rem;
        margin: 0;
        padding: 1rem 1.5rem;
        border-radius: 0 0 2rem 2rem;
        white-space: normal;
        width: 100%;
        line-height: 0.8;
    }

    .feature-card {
        background: #FFF9EA;
        padding: 2rem;
        border-radius: 0 0 2rem 2rem;
        text-align: center;
        transition: transform 0.3s ease;
        position: relative;
        min-height: 200px;
        max-height: 350px;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        margin-top: 0;
        flex-grow: 1;
    }

    .feature-card:hover {
        transform: translateY(-5px);
    }


    .feature-card.special {
        position: relative;
        overflow: visible;
        padding: 2rem;
        justify-content: flex-end;
        border-radius: 2rem 2rem 0 0;
        padding-top: 4rem;
        min-height: 200px;
        max-height: 350px;
        flex-grow: 1;
        margin-bottom: 0;
    }

    .feature-card.special:hover {
        transform: translateY(5px);
    }

    .feature-card.special img {
        position: absolute;
        top: -75px;
        left: 50%;
        transform: translateX(-50%);
        width: 150px;
        height: 150px;
        z-index: 15;
    }

    .feature-footer {
        background: #C1D5F4;
        border-radius: 0 0 2rem 2rem;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        text-align: center;
        position: relative;
        z-index: 10;
        margin-top: 0;
    }

    .feature-footer h3 {
        font-family: 'Gidugu', cursive; 
        font-weight: 100;
        color: #000;
        font-size: 3.5rem;
        margin: 0;
        padding: 1rem 1.5rem;
        border-radius: 0 0 2rem 2rem;
        white-space: normal;
        width: 100%;
        line-height: 0.8;
    }

    .feature-card p {
        color: #333;
        line-height: 1.4;
        text-align: center;
        font-size: 1.15rem;
        margin: 0;
    }

    .feature-card ul {
        list-style: none;
        padding: 0;
        margin-top: 1rem;
    }

    .feature-card li {
        display: flex;
        align-items: center;
        margin-bottom: 0.75rem;
        color: #333;
        font-size: 1.15rem;
    }

    .feature-card li::before {
        content: "";
        background-image: url('{{ asset('images/landing/hairlist.png') }}');
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
        width: 1.2rem;
        height: 1.2rem;
        margin-right: 0.75rem;
        display: inline-block;
        flex-shrink: 0;
    }

    /* Whispers Preview Section */
    .whispers-section {
        padding: 5rem 0;
        margin-top: -15rem;
        position: relative;
        z-index: 20;
    }

    .whispers-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
        text-align: center;
        width: 100%;
    }

    .section-title {
        font-family: 'Gidugu', cursive;
        font-size: 5rem;
        font-weight: 500;
        color: #F791A9;
        letter-spacing: 0.1rem;
        margin-bottom:-4rem;
    }

    .section-subtitle {
        color: #333;
        font-size: 5rem;
        font-weight: 500;
        letter-spacing: 0.1rem;
        margin-bottom: 3rem;
        font-family: 'Gidugu', cursive;
    }

    /* Masonry layout for whispers */
    .whispers-masonry {
        column-count: 1;
        column-gap: 1.5rem;
        margin-bottom: 3rem;
    }

    @media (min-width: 640px) {
        .whispers-masonry {
            column-count: 2;
        }
    }

    @media (min-width: 1024px) {
        .whispers-masonry {
            column-count: 4;
        }
    }

    .whispers-masonry > div {
        break-inside: avoid;
        margin-bottom: 1.5rem;
    }

    .whisper-card {
        border-radius: 0.5rem;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .whisper-card:hover {
        transform: translateY(-5px);
    }

    .whisper-header {
        padding: 0.75rem 1rem;
        font-weight: 500;
        font-family: 'Yantramanav', sans-serif;
    }

    .whisper-body {
        background-color: #FFFCF5;
        padding: 1rem;
        font-family: 'Yantramanav', sans-serif;
    }

    .whisper-buttons {
        justify-content: flex-end;
        display: flex;
    }

    /* Carousel Section */
    .carousel-section {
        background-color: #FFDBDF;
        padding: 5rem 0;    
    }

    .carousel-container {
        max-width: 1200px;
        margin: 0 auto;
        margin-top: -3rem;
        padding: 0 2rem;
        text-align: center;
        width: 100%;
    }

    .carousel-section .section-title {
        font-family: 'Gidugu', cursive;
        font-size: 6rem;
        color: black;
        margin-bottom: 1rem;
        /* text-decoration: underline; */
        text-decoration-color: #333;
        text-underline-offset: 0.2rem;
        text-decoration-thickness: 3px;
        line-height: 0.8;
    }

    .carousel-section .section-subtitle {
        color: black;
        font-size: 1.4rem;
        font-family: 'Yantramanav', sans-serif;
        font-weight: normal;
        letter-spacing: 0ch;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
    }

    .carousel-wrapper {
        position: relative;
        /* margin-top: 5rem; */
        overflow: hidden;
        border-radius: 1rem;
        max-width: 1000px;
        margin-left: auto;
        margin-right: auto;
    }

    .carousel-track {
        display: flex;
        gap: 1rem;
        width: calc(180px * 24 + 1rem * 23); /* 12 original + 12 duplicates */
        animation: infiniteScroll 48s linear infinite;
        padding: 0 calc((1000px - (180px * 5 + 1rem * 4)) / 2);
    }

    .carousel-track:hover {
        animation-play-state: paused;
    }

    @keyframes infiniteScroll {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(calc(-180px * 12 - 1rem * 12)); /* Move exactly 12 slides */
        }
    }

    .carousel-slide {
        position: relative;
        width: 180px;
        height: 240px;
        flex-shrink: 0;
    }

    .carousel-slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 2rem;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        border: 4px solid rgba(255, 255, 255, 0.8);
    }

    .carousel-controls {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255, 255, 255, 0.8);
        border: none;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 1.5rem;
        color: #333;
        transition: all 0.3s ease;
        z-index: 10;
    }

    .carousel-controls:hover {
        background: white;
        transform: translateY(-50%) scale(1.1);
    }

    .carousel-prev {
        left: 1rem;
    }

    .carousel-next {
        right: 1rem;
    }

    .carousel-indicators {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        margin-top: 2rem;
    }

    .carousel-indicator {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(51, 51, 51, 0.3);
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .carousel-indicator.active {
        background: #333;
        transform: scale(1.2);
    }

    /* FAQ Section */
    .faq-section {
        background: #FFFFFF;
        padding-bottom: 1rem;
        padding-top: 3rem; /* Reduced from default 2rem */
        min-height: auto; /* Override the min-height: 100vh from section base styles */
    }

    .faq-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 0 2rem;
        width: 100%;
    }

    .faq-title {
        text-align: center;
        font-family: 'Gidugu', cursive;
        font-size: 6rem;
        color: #333;
        margin-bottom: 2rem; /* Reduced from 3rem */
    }

    .faq-item {
        margin-bottom: 0.75rem;
        border-radius: 0.5rem;
        overflow: hidden;
    }

    .faq-question {
        background-color: #C1D5F4;
        padding: 1rem 1.5rem;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-weight: 500;
        color: #333;
        transition: background-color 0.3s ease;
        border-radius: 0.5rem;
    }

    .faq-question:hover {
        background-color: #B4C6E2;
    }

    .faq-question .icon {
        font-size: 1.5rem;
        font-weight: bold;
        transition: transform 0.3s ease;
    }

    .faq-answer {
        background-color: #FFF9EA;
        padding: 0 1.5rem;
        max-height: 0;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .faq-answer.active {
        padding: 1.5rem;
        max-height: 200px;
    }

    .faq-answer p {
        color: #666;
        line-height: 1.6;
    }

    /* Contact Section */
    .contact-section {
        background: #FFFFFF;
        padding-top: 1rem;
        padding-bottom: 5rem;
        min-height: auto; 
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .contact-header {
        text-align: center;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
        margin-bottom: 1rem;
        width: 100%;
    }

    .contact-title {
        font-family: 'Gidugu', cursive;
        font-size: 5rem;
        color: #F791A9;
        margin-bottom: 1rem;
    }

    .contact-intro {
        color: #333;
        font-size: 1.1rem;
        line-height: 1.6;
        max-width: 900px;
        margin: 0 auto;
    }

    .contact-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 2rem;
        display: grid;
        grid-template-columns: 1fr 1.5fr;
        gap: 2rem;
        align-items: flex-start;
        width: 100%;
    }

    .contact-methods {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .contact-method {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 15rem;
        justify-content: center;
        padding: 2rem;
        background: #F1F1F1;
        border-radius: 2rem;
        text-align: center;
    }

    .contact-method .icon {
        width: 2rem;
        height: 2rem;
        margin-bottom: 0.5rem;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
    }

    .contact-method .icon.phone {
        background-image: url('{{ asset('images/landing/phone.png') }}');
    }

    .contact-method .icon.whatsapp {
        background-image: url('{{ asset('images/landing/whatsapp.png') }}');
    }

    .contact-method .icon.email {
        background-image: url('{{ asset('images/landing/email.png') }}');
    }

    .contact-method .label {
        font-weight: bold;
        margin-bottom: 0.25rem;
        color: #333;
    }

    .contact-method .value {
        color: #666;
    }

    .contact-form-container {
        background: white;
    }

    .contact-form-title {
        font-family: 'Yantramanav', sans-serif;
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 2rem;
        color: #333;
        text-align: center;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-input {
        width: 100%;
        padding: 1rem;
        padding-left: 1.8rem;
        border: none;
        border-radius: 2rem;
        font-size: 1rem;
        font-family: 'Yantramanav', sans-serif;
        background-color: #FFDBDF;
        transition: all 0.3s ease;
        border: 2px solid #000000;

    }

    .form-input:focus {
        outline: none;
        background-color: #FFDBDF;
    }

    .form-input::placeholder {
        color: #999;
    }

    .form-textarea {
        min-height: 250px;
        border-radius: 1.5rem;
        resize: none;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .send-btn {
        margin-top: 1rem;
        background: #F9BCC4;
        color: #333;
        border: none;
        padding: 1rem 2.5rem;
        border-radius: 2rem;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    .send-btn:hover {
        background: #f5a8c1;
        transform: translateY(-2px);
    }

    .send-btn:active,
    .send-btn:focus {
        background: #F9BCC4 !important;
        color: #333 !important;
        outline: none;
        box-shadow: none;
        transform: translateY(0);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-container,
        .contact-container {
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .hero-content h1 {
            font-size: 2.5rem;
        }

        .section-title {
            font-size: 2rem;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .carousel-slide {
            min-width: 50%; /* Show 2 images on mobile */
        }

        .carousel-track {
            width: 350%; /* 7 images * 50% each */
        }

        .carousel-slide img {
            height: 200px;
        }
    }
</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-container">
        <div class="hero-content">
            <h1>{!! __('welcome.hero.heading') !!}</h1>
            <p>{{ __('welcome.hero.description') }}</p>
            <div class="hero-buttons">
                <a href="{{ route('user.donate') }}" class="btn btn-primary">{{ __('welcome.hero.donate_button') }}</a>
                <a href="{{ route('user.request') }}" class="btn btn-primary">{{ __('welcome.hero.request_button') }}</a>
            </div>
        </div>
        <div class="hero-image">
            <img src="{{ asset('images/landing/landing_image.png') }}" alt="Helping Each Other" />
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section">
    <div class="features-container">
        <div class="features-grid">
            <!-- First Feature Item -->
            <div class="feature-item">
                <div class="feature-header">
                    <h3>{{ __('welcome.features.why_donate.title') }}</h3>
                </div>
                <div class="feature-card">
                    <p>{{ __('welcome.features.why_donate.content') }}</p>
                </div>
            </div>
            
            <!-- Second Feature Item (Special) -->
            <div class="feature-item">
                <div class="feature-card special">
                    <img src="{{ asset('images/landing/gift.png') }}" alt="Gift of Hair" class="gift-image" />
                    <p>{{ __('welcome.features.gift_system.content') }}</p>
                </div>
                <div class="feature-footer">
                    <h3>{{ __('welcome.features.gift_system.title') }}</h3>
                </div>
            </div>
            
            <!-- Third Feature Item -->
            <div class="feature-item">
                <div class="feature-header">
                    <h3>{{ __('welcome.features.hair_loss_causes.title') }}</h3>
                </div>
                <div class="feature-card">
                    <p>{{ __('welcome.features.hair_loss_causes.content') }}</p>
                    <ul style="text-align: left; margin-top: 1rem;">
                        @foreach(__('welcome.features.hair_loss_causes.causes') as $cause)
                            <li>{{ $cause }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Whispers Section -->
<section class="whispers-section">
    <div class="whispers-container">
        <h2 class="section-title">{{ __('welcome.whispers.title') }}</h2>
        <p class="section-subtitle">{{ __('welcome.whispers.subtitle') }}</p>
        <div class="whispers-masonry">
            @foreach(__('welcome.whispers.messages') as $index => $whisper)
                @php
                    $backgroundColors = ['#d4ebd1', '#f8bbd0', '#d1e2f5', '#fbdbc9', '#d4d1eb', '#d4ebd1'];
                    $bgColor = $backgroundColors[$index % count($backgroundColors)];
                @endphp
                <div class="whisper-card">
                    <div class="whisper-header" style="background-color: {{ $bgColor }}; color: {{ $whisper['color'] }};">
                        {{ $whisper['to'] }}
                    </div>
                    <div class="whisper-body" style="color: {{ $whisper['color'] }};">
                        {{ $whisper['message'] }}
                    </div>
                </div>
            @endforeach
            <div class="whisper-card">
                <div class="whisper-header" style="background-color: #f8bbd0; color: #753753;">
                    {{ __('welcome.whispers.sample_to') }}
                </div>
                <div class="whisper-body" style="color: #753753;">
                    {{ __('welcome.whispers.sample_message') }}
                </div>
            </div>
        </div>
        <div class="whisper-buttons">
            <a href="{{ route('user.whisper') }}" class="btn btn-primary">{{ __('welcome.whispers.see_more_button') }}</a>
        </div>
    </div>
</section>

<!-- Carousel Section -->
<section class="carousel-section">
    <div class="carousel-container">
        <h2 class="section-title" style="color: #333;">{!! __('welcome.carousel.title') !!}</h2>
        <p class="section-subtitle" style="color: #666;">{{ __('welcome.carousel.subtitle') }}</p>
        
        <div class="carousel-wrapper">
            <div class="carousel-track" id="carouselTrack">
                <div class="carousel-slide">
                    <img src="{{ asset('images/landing/carousel1.png') }}" alt="{{ __('welcome.carousel.alt_text') }} 1" />
                </div>
                <div class="carousel-slide">
                    <img src="{{ asset('images/landing/carousel2.png') }}" alt="{{ __('welcome.carousel.alt_text') }} 2" />
                </div>
                <div class="carousel-slide">
                    <img src="{{ asset('images/landing/carousel3.png') }}" alt="{{ __('welcome.carousel.alt_text') }} 3" />
                </div>
                <div class="carousel-slide">
                    <img src="{{ asset('images/landing/carousel4.png') }}" alt="{{ __('welcome.carousel.alt_text') }} 4" />
                </div>
                <div class="carousel-slide">
                    <img src="{{ asset('images/landing/carousel5.png') }}" alt="{{ __('welcome.carousel.alt_text') }} 5" />
                </div>
                <div class="carousel-slide">
                    <img src="{{ asset('images/landing/carousel6.png') }}" alt="{{ __('welcome.carousel.alt_text') }} 6" />
                </div>
                <div class="carousel-slide">
                    <img src="{{ asset('images/landing/carousel7.png') }}" alt="{{ __('welcome.carousel.alt_text') }} 7" />
                </div>
                <div class="carousel-slide">
                    <img src="{{ asset('images/landing/carousel8.png') }}" alt="{{ __('welcome.carousel.alt_text') }} 8" />
                </div>
                <div class="carousel-slide">
                    <img src="{{ asset('images/landing/carousel9.png') }}" alt="{{ __('welcome.carousel.alt_text') }} 9" />
                </div>
                <div class="carousel-slide">
                    <img src="{{ asset('images/landing/carousel10.png') }}" alt="{{ __('welcome.carousel.alt_text') }} 10" />
                </div>
                <div class="carousel-slide">
                    <img src="{{ asset('images/landing/carousel11.png') }}" alt="{{ __('welcome.carousel.alt_text') }} 11" />
                </div>
                <div class="carousel-slide">
                    <img src="{{ asset('images/landing/carousel12.png') }}" alt="{{ __('welcome.carousel.alt_text') }} 12" />
                </div>
                <!-- Duplicate images for infinite scroll effect -->
                <div class="carousel-slide">
                    <img src="{{ asset('images/landing/carousel1.png') }}" alt="{{ __('welcome.carousel.alt_text') }} 1" />
                </div>
                <div class="carousel-slide">
                    <img src="{{ asset('images/landing/carousel2.png') }}" alt="{{ __('welcome.carousel.alt_text') }} 2" />
                </div>
                <div class="carousel-slide">
                    <img src="{{ asset('images/landing/carousel3.png') }}" alt="{{ __('welcome.carousel.alt_text') }} 3" />
                </div>
                <div class="carousel-slide">
                    <img src="{{ asset('images/landing/carousel4.png') }}" alt="{{ __('welcome.carousel.alt_text') }} 4" />
                </div>
                <div class="carousel-slide">
                    <img src="{{ asset('images/landing/carousel5.png') }}" alt="{{ __('welcome.carousel.alt_text') }} 5" />
                </div>
                <div class="carousel-slide">
                    <img src="{{ asset('images/landing/carousel6.png') }}" alt="{{ __('welcome.carousel.alt_text') }} 6" />
                </div>
                <div class="carousel-slide">
                    <img src="{{ asset('images/landing/carousel7.png') }}" alt="{{ __('welcome.carousel.alt_text') }} 7" />
                </div>
                <div class="carousel-slide">
                    <img src="{{ asset('images/landing/carousel8.png') }}" alt="{{ __('welcome.carousel.alt_text') }} 8" />
                </div>
                <div class="carousel-slide">
                    <img src="{{ asset('images/landing/carousel9.png') }}" alt="{{ __('welcome.carousel.alt_text') }} 9" />
                </div>
                <div class="carousel-slide">
                    <img src="{{ asset('images/landing/carousel10.png') }}" alt="{{ __('welcome.carousel.alt_text') }} 10" />
                </div>
                <div class="carousel-slide">
                    <img src="{{ asset('images/landing/carousel11.png') }}" alt="{{ __('welcome.carousel.alt_text') }} 11" />
                </div>
                <div class="carousel-slide">
                    <img src="{{ asset('images/landing/carousel12.png') }}" alt="{{ __('welcome.carousel.alt_text') }} 12" />
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section">
    <div class="faq-container">
        <h2 class="faq-title">{{ __('welcome.faq.title') }}</h2>
        
        @foreach(__('welcome.faq.questions') as $faq)
        <div class="faq-item">
            <div class="faq-question" onclick="toggleFAQ(this)">
                <span>{{ $faq['question'] }}</span>
                <span class="icon">+</span>
            </div>
            <div class="faq-answer">
                <p>{{ $faq['answer'] }}</p>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- Contact Section -->
<section class="contact-section">
    <div class="contact-header">
        <h2 class="contact-title">{{ __('welcome.contact.title') }}</h2>
        <p class="contact-intro">{{ __('welcome.contact.intro') }}</p>
    </div>
    
    <div class="contact-container">
        <div class="contact-methods">
            <div class="contact-method">
                <div class="icon phone"></div>
                <div class="label">{{ __('welcome.contact.phone') }}</div>
                <div class="value">+62 XXX XXXX XXXX</div>
            </div>
            
            <div class="contact-method">
                <div class="icon whatsapp"></div>
                <div class="label">{{ __('welcome.contact.whatsapp') }}</div>
                <div class="value">+62 XXX XXXX XXXX</div>
            </div>
            
            <div class="contact-method">
                <div class="icon email"></div>
                <div class="label">{{ __('welcome.contact.email') }}</div>
                <div class="value">youremail@gmail.com</div>
            </div>
        </div>
        
        <div class="contact-form-container">
            <h3 class="contact-form-title">{{ __('welcome.contact.form_title') }}</h3>
            <form id="contactForm">
                <div class="form-group">
                    <input type="text" class="form-input" placeholder="{{ __('welcome.contact.form_placeholders.full_name') }}" required>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <input type="email" class="form-input" placeholder="{{ __('welcome.contact.form_placeholders.email') }}" required>
                    </div>
                    <div class="form-group">
                        <input type="tel" class="form-input" placeholder="{{ __('welcome.contact.form_placeholders.phone') }}">
                    </div>
                </div>
                
                <div class="form-group">
                    <textarea class="form-input form-textarea" placeholder="{{ __('welcome.contact.form_placeholders.message') }}" required></textarea>
                </div>
                
                <button type="submit" class="send-btn">{{ __('welcome.contact.send_button') }}</button>
            </form>
        </div>
    </div>
</section>

<script>
// Carousel functionality - now using pure CSS animation for infinite scroll
// No JavaScript needed for the continuous scroll effect

// FAQ functionality
function toggleFAQ(element) {
    const answer = element.nextElementSibling;
    const icon = element.querySelector('.icon');
    
    // Close all other FAQ items
    document.querySelectorAll('.faq-question').forEach(question => {
        if (question !== element) {
            question.classList.remove('active');
            question.nextElementSibling.classList.remove('active');
            question.querySelector('.icon').textContent = '+';
        }
    });
    
    // Toggle current FAQ item
    element.classList.toggle('active');
    answer.classList.toggle('active');
    icon.textContent = element.classList.contains('active') ? '−' : '+';
}

// Contact form functionality
document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Get form data
    const formData = new FormData(this);
    const name = this.querySelector('input[placeholder*="Name"], input[placeholder*="Nama"]').value;
    const email = this.querySelector('input[placeholder*="email"]').value;
    const phone = this.querySelector('input[placeholder*="+62"]').value;
    const subject = this.querySelector('input[placeholder="Subject"]')?.value || '';
    const message = this.querySelector('textarea').value;
    
    // Simple validation
    if (!name || !email || !message) {
        const validationMessage = window.contactFormStrings ? 
            window.contactFormStrings.validationMessage : 
            '{{ __('welcome.contact.validation_message') }}';
        alert(validationMessage);
        return;
    }
    
    // Simulate sending message
    const submitBtn = this.querySelector('.send-btn');
    const originalText = submitBtn.textContent;
    const sendingText = window.contactFormStrings ? 
        window.contactFormStrings.sending : 
        '{{ __('welcome.contact.sending') }}';
    
    submitBtn.textContent = sendingText;
    submitBtn.disabled = true;
    
    setTimeout(() => {
        const successMessage = window.contactFormStrings ? 
            window.contactFormStrings.successMessage : 
            '{{ __('welcome.contact.success_message') }}';
        alert(successMessage);
        this.reset();
        submitBtn.textContent = originalText;
        submitBtn.disabled = false;
    }, 2000);
});

// Initialize contact form strings
window.contactFormStrings = {
    validationMessage: '{{ __('welcome.contact.validation_message') }}',
    successMessage: '{{ __('welcome.contact.success_message') }}',
    sending: '{{ __('welcome.contact.sending') }}',
    sendButton: '{{ __('welcome.contact.send_button') }}'
};

// Smooth scrolling for navigation links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});
</script>
@endsection
