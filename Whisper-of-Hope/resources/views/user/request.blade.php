@extends('user.layout.app')

@section('title', 'Request a Wig Page')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

   <div class="z-0 content">
        <div class="z-1 img-gradient">
            <img src="{{ asset('images/request.jpg') }}" class="img-fluid" alt="Requesting Your Wig">
            <div class="z-2 overlay"></div>
            <div class="z-3 intro">
                <h1>Requesting Your Wig</h1>
                <p>Our free, high-quality wigs are specially crafted for individuals experiencing medical hair loss.
                    Apply in just 5 minutes to be matched with your perfect fit,
                    because you deserve to feel like yourself again.</p>
            </div>
        </div>

        <div class="guide">
            <div class="container">
                <div class="header-guide">
                    <h1>Find Your Perfect Hair Match</h1>
                    <p>Every wig tells a story of strength. Let us help you or your loved one feel whole again.</p>
                </div>
                <div class="container overflow-hidden text-center">
                    <div class="row gx-5">
                        <div class="col">
                            <div class="step-box">
                                <!-- <p>Step 1</p> -->
                                <img src="{{ asset('images/one.png') }}" alt="Step 1" class="img-fluid mb-3">
                                <h4>Complete<br>the Form</h4>
                                <p>Fill out a quick application with your basic details to help us understand your needs</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="step-box">
                                <!-- <p>Step 2</p> -->
                                <img src="{{ asset('images/two.png') }}" alt="Step 1" class="img-fluid mb-3">
                                <h4>Request<br>Reviewed</h4>
                                <p>Our team will verify your request and match you with an accredited wig fitter near to you</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="step-box">
                                <!-- <p>Step 3</p> -->
                                <img src="{{ asset('images/three.png') }}" alt="Step 1" class="img-fluid mb-3">
                                <h4>Book Your<br>Appointment</h4>
                                <p>We'll connect you directly with your wig specialist to schedule a private fitting at their salon or via virtual consultation</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="step-box">
                                <!-- <p>Step 4</p> -->
                                <img src="{{ asset('images/four.png') }}" alt="Step 1" class="img-fluid mb-3">
                                <h4>Receive<br>Your Wig</h4>
                                <p>Your wig will be handcrafted to your fit and style, with delivery in 2-3 weeks</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- </div -->

        @if (Auth::check())

        <div class="request-form">
            <div class="header-form">
                <h1>For Yourself or Someone You Care For</h1>
            </div>
                
            <div class="form-container">
                <h2>Request a Wig</h2>
                <hr>
                
                <form id="requestWigForm" method="POST" action="{{ route('request.wig.storeRequest') }}">
                    @csrf

                    <!-- Dropdown Option -->
                    <div style="padding: 0 1.2rem; margin-bottom: 2rem;">
                        <label class="dropdown-label" for="who_for">Who is this wig for?</label>
                        <select class="dropdown-select" id="who_for" name="who_for" required>
                            <option value="myself">I am applying for myself</option>
                            <option value="parent_guardian">I am applying for my child as their parent/guardian</option>
                            <option value="health_professional">I am applying for a patient as a medical professional</option>
                        </select>
                    </div>

                    <!-- For Myself -->
                    <div class="form-section-wrapper" id="myself">
                        <div class="form-section">
                            <div class="form-label">Your Details</div>
                            <div class="form-fields">
                                <label>Full Name</label>
                                <input type="text" name="recipient_full_name" required>
                                <label>Age</label>
                                <input type="number" name="recipient_age" required>
                                <label>Email</label>
                                <input type="email" name="recipient_email" required>
                                <label>Phone Number</label>
                                <input type="tel" name="recipient_phone" required>
                                <label>Reason for Hair Loss</label>
                                <input type="text" name="recipient_reason" required>
                            </div>
                        </div>
                    </div>

                    <!-- As Parent/Guardian -->
                    <div class="form-section-wrapper" id="parent_guardian">
                        <div class="form-section">
                            <div class="form-label">Recipient's Details</div>
                            <div class="form-fields">
                                <label>Full Name</label>
                                <input type="text" name="recipient_full_name" required>
                                <label>Age</label>
                                <input type="number" name="recipient_age" required>
                                <label>Reason for Hair Loss</label>
                                <input type="text" name="recipient_reason" required>
                            </div>
                        </div>
                        <hr>
                        <div class="form-section">
                            <div class="form-label">Your Details</div>
                            <div class="form-fields">
                                <label>Full Name</label>
                                <input type="text" name="requester_full_name" required>
                                <label>Email</label>
                                <input type="email" name="requester_email" required>
                                <label>Phone Number</label>
                                <input type="tel" name="requester_phone" required>
                                <label>Relationship to the Recipient</label>
                                <input type="text" name="relationship_to_recipient" required>
                            </div>
                        </div>
                    </div>

                    <!-- As Health Professional -->
                    <div class="form-section-wrapper" id="health_professional">
                        <div class="form-section">
                            <div class="form-label">Recipient's Details</div>
                            <div class="form-fields">
                                <label>Full Name</label>
                                <input type="text" name="recipient_full_name" required>
                                <label>Age</label>
                                <input type="number" name="recipient_age" required>
                                <label>Email</label>
                                <input type="email" name="recipient_email" required>
                                <label>Phone Number</label>
                                <input type="tel" name="recipient_phone" required>
                                <label>Reason for Hair Loss</label>
                                <input type="text" name="recipient_reason" required>
                            </div>
                        </div>
                        <hr>
                        <div class="form-section">
                            <div class="form-label">Your Details</div>
                            <div class="form-fields">
                                <label>Full Name</label>
                                <input type="text" name="requester_full_name" required>
                                <label>Email</label>
                                <input type="email" name="requester_email" required>
                                <label>Phone Number</label>
                                <input type="tel" name="requester_phone" required>
                                <label>Healthcare Location</label>
                                <input type="text" name="healthcare_location" required>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="form-note">
                        Thank you for trusting us! Our team will review your request promptly.<br>
                        Click ‘Submit’ to send us your information.
                    </div>
                    <div class="form-button">
                        <button type="button" id="clear-form-btn" class="btn btn-clear">Clear</button>
                        <button type="submit" class="btn btn-submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
                
    <div class="modal" id="submitFormModal" tabindex="-1" aria-labelledby="submitModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modalContent">
                <div class="modalHeader">
                    <h2>Your request have been received!</h2>
                </div>
                <div class="modalBody">
                    <p>Please know you’re not alone in this journey,
                        we’re honoured to walk this path with you.
                        Kindly check your email for further details.</p>
                </div>
                <div class="modalFooter">
                    <button type="button" class="btn btn-submit" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

@else
    <!-- if not logged in, pop up login -->

    <div class="z-0 container-guest">
        <h2>For Yourself or Someone You Care For</h2>
        <div class="hero-buttons">
            <a href="{{ route('user.request') }}" class="btn btn-primary">Request a Wig!</a>
        </div>
    </div>
    
    @include('user.auth.login')

    <!-- show modal -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginModalEl = document.getElementById('loginModal');
            
            const loginModal = new bootstrap.Modal(loginModalEl, {
                backdrop: 'static', // prevents closing on backdrop click
                keyboard: false     // prevents closing with the esc key
            });

            loginModal.show();
        });
    </script>
    
@endif

    <style>

        @import url('https://fonts.googleapis.com/css2?family=Gidugu&family=Yantramanav:wght@300;400;500;700&display=swap');
        
        html, body{
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            overflow-x: hidden;
            background-color : #FFFDFE;
            font-family: 'Yantramanav', sans-serif; 
        }

        .content {
            background: linear-gradient(to bottom, #FFDBDF 0%,#FFDBDF 50%, #FFFDFE 85%,  #FFFDFE 100%);
            width: 100%;
            height: auto;
            position: relative;
            overflow: hidden;
            /* z-index: 0; */
        }

        .img-gradient {
            position: relative;
            display: block;
            width: 100vw;
            height: 100vh;
            overflow: hidden;
            /* z-index: 1; */
        }

        .img-gradient img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                to bottom,
                rgba(255, 255, 255, 0) 0%,
                rgba(255, 219, 223, 0.2) 30%,
                rgba(255, 219, 223, 0.5) 70%,
                rgba(255, 219, 223, 1) 100%
            );
            pointer-events: none;
            /* z-index: 2; */
        }

        .intro {
            position: absolute;
            max-width: 40vw;
            margin: auto 5vw;
            /* z-index: 3; */
            transform: translateY(-50%);
            top: 80%;
            text-align: justify;
        }

        .intro h1 {
            font-family: 'Gidugu', sans-serif;
            font-size: 3.5rem;
        }
        
        .intro p {
            font-family: 'Yantramanav', sans-serif;
            font-size: 1.2rem;
            margin-top: -1rem;
        }

        .guide {
            /* margin: 15rem 0rem; */
            margin: 5rem 0 0 0;
        }
        
        .container {
            align-items: center;
            text-align: center;
        }

        .header-guide { 
            margin-bottom: 5rem;
        }
        
        .header-guide h1 {
            font-family: 'Gidugu', sans-serif;
            font-size: 4.5rem;
        }
        
        .header-guide p { 
            font-family: 'Yantramanav', sans-serif;
            font-size: 1.4rem;
            margin-top: -1.5rem;
            /* text-align: center; */
        }
        
        .step-box {
            height: 45vh;
            background-color: #FFF9EA;
            border-radius: 15px;
            box-shadow: 2px 4px 4px 0px rgba(0, 0, 0, 0.25);
            padding: 2.5rem 1.5rem;
            margin: 1rem 0rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .step-box img {
            width: 3rem;
            height: 3rem;
            margin: 0 auto 1.5rem auto;
            /* z-index: 4; */
        }
        
        .step-box h4 {
            /* font-family: 'Yantramanav', sans-serif;
            font-size: 1.5rem; */
            font-family: 'Gidugu', sans-serif;
            font-size: 3rem;
            font-weight: 500;
            line-height: 0.8;
            text-align: center;
        }
        
        .step-box p {
            font-size: 1rem;
            font-family: 'Yantramanav', sans-serif;
            text-align: justify;
            margin-top: 1rem;
        }

        .request-form {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-top: 8rem;
        }

        .header-form { 
            margin-bottom: 1rem;
            text-align: center;
        }

        .header-form h1 {
            font-family: 'Gidugu', sans-serif;
            font-size: 4.5rem;
        }

        .dropdown-label {
            font-size: 1rem;
            margin-right: 0.5rem;
        }

        .dropdown-select {
            font-family: 'Yantramanav', sans-serif;
            font-size: 1rem;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            border: 1px solid #A0A0A0;
            background-color: transparent;
        }

        .form-container {
            width: 80%;
            /* height: 100%; */
            background-color: #FFF9EA;
            border-radius: 15px;
            box-shadow: 2px 4px 4px 0px rgba(0, 0, 0, 0.25);
            padding: 2.5rem 3rem;
            margin: 1rem 0rem;
            margin-bottom: 4rem;
            display: flex;
            flex-direction: column;
            /* position: relative; */
            /* z-index: 5; */
        }

        .form-container h2 {
            font-family: 'Yantramanav', sans-serif;
            font-size: 1.5rem;
            /* margin-bottom: -0.8rem; */
            margin: 0 1.2rem -0.8rem 1.2rem;
        }

        .hr {
            border: none;
            border-top: 2px solid #000000;
            margin: 1rem 0;
        }

        .form-section {
            display: flex;
            gap: 2rem;
            margin: 1rem 1.2rem 0rem 1.2rem;
            width: 95%;
        }

        .form-label {
            flex: 1;
            font-weight: bold;
            margin-bottom: 0.5rem;
            font-size: 1rem;
        }

        .form-fields {
            flex: 4;
        }

        .form-fields input {
            width: 100%;
            padding: 0.5rem 1rem;
            margin-bottom: 1rem;
            border-radius: 5px;
            border: 1px solid #bbb;
            font-size: 1rem;
            background-color: transparent;
        }

        .form-button {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

        .for-child, .for-patient {
            display: none;
            flex-direction: column;
            width: 100%;
        }

        .btn {
            padding: 0.5rem 2.5rem;
            border: none;
            border-radius: 50px;
            font-size: 1rem;
            cursor: pointer;
        }

        .btn-clear {
            background-color: #E8E8E8;
            font-weight: 500;
        }

        .btn-submit {
            background-color: #F9BCC4;
            font-weight: 500;
        }

        .btn-clear:hover {
            background-color: #ccc;
            color: #FFFFFF;
        }

        .btn-submit:hover {
            background-color: #F791A9;
            color: #FFFFFF;
        }

        .form-note {
            text-align: center;
            font-size: 1rem;
        }

        #submitFormModal .modalContent {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #FEF0F0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            padding: 2rem;
            text-align: center;
            width: 28%;
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

        .container-guest {
            height: 50vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;  
        }

        .container-guest h2 {
            font-family: 'Gidugu', sans-serif;
            font-size: 4.5rem;
            /* margin-bottom: -0.8rem; */
            margin: 0 1.2rem -0.8rem 1.2rem;
        }

        .hero-buttons {
            display: flex;
            flex-wrap: wrap;
            margin: 1rem 0;
        }

        .btn {
            padding: 0.8rem 2.8rem;
            border: none;
            border-radius: 50px;
            font-size: 1rem;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #F9BCC4;
            font-weight: 500;
            color: #000000;
        }

        .btn-primary:hover {
            background-color: #F791A9;
            color: #FFFFFF;
        }

        .btn-primary:active,
        .btn-primary:focus {
            background-color: #F791A9 !important;
            border-color: #F791A9 !important;
            box-shadow: none !important;
        }

    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    @if (Auth::check())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdown = document.getElementById('who_for');
            const requestForm = document.getElementById('requestWigForm');
            const clearButton = document.getElementById('clear-form-btn');

            const formSections = {
                'myself': document.getElementById('myself'),
                'parent_guardian': document.getElementById('parent_guardian'),
                'health_professional': document.getElementById('health_professional')
            };

            function setFormState(selectedValue) {
                for (const key in formSections) {
                    const sectionDiv = formSections[key];
                    if (!sectionDiv) continue; // skip if a div is not found

                    const inputs = sectionDiv.querySelectorAll('input');

                    if (key === selectedValue) {
                        // section to show
                        sectionDiv.style.display = 'block';
                        inputs.forEach(input => {
                            input.disabled = false;
                        });
                    } else {
                        // section to hide
                        sectionDiv.style.display = 'none';
                        inputs.forEach(input => {
                            input.disabled = true;
                        });
                    }
                }
            }

            dropdown.addEventListener('change', function() {
                setFormState(this.value);
            });

            clearButton.addEventListener('click', function() {
                const currentSelectedValue = dropdown.value;
                const visibleSection = formSections[currentSelectedValue];
                if (visibleSection) {
                    const clearInputs = visibleSection.querySelectorAll('input[type="text"], input[type="email"], input[type="tel"], input[type="number"]');
                    clearInputs.forEach(input => {
                        input.value = '';
                    });
                }
            });

            requestForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                try {
                    const response = await fetch(this.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                        },
                        body: new FormData(this)
                    });
                    const data = await response.json();
                    if (response.ok) {
                        const submitModal = new bootstrap.Modal(document.getElementById('submitFormModal'));
                        submitModal.show();
                        document.getElementById('submitFormModal').addEventListener('hidden.bs.modal', () => {
                            requestForm.reset();
                            dropdown.dispatchEvent(new Event('change'));
                        });
                    } else {
                        let errorMsg = 'Error: ' + (data.message || 'Submission failed');
                        if (data.errors) {
                            errorMsg += '\n\n' + Object.values(data.errors).map(e => '• ' + e.join('\n')).join('\n');
                        }
                        alert(errorMsg);
                    }
                } catch (error) {
                    console.error("Submission Error:", error);
                    alert('An unexpected network or script error occurred. Please try again.');
                }
            });

            setFormState(dropdown.value);
        });
    </script>
    @endif
@endsection