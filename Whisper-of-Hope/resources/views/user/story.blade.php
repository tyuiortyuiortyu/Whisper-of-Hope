@extends('layout.app')
@section('title', 'Story Page')

@section('hero')
<div class="w-100">
    <div class="hero-section text-center text-white d-flex align-items-center justify-content-center" style="height: 300px; background-image: url('{{ asset('images/background.png') }}'); background-size: cover; background-position: center;">
        <div>
            <h1 class="fw-bold display-4" style="font-family: 'Gidugu'">Community stories</h1>
            <p class="lead mt-3 font-gidugu" style="font-family: 'Gidugu'">
                Whether you have a question, feedback, or just want to say hi, we're always here for you. <br>
                Reach out and let us know how we can make your experience even better.
            </p>
        </div>
    </div>
</div>
@endsection