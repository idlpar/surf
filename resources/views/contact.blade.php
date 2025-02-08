@extends('layouts.app')

@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>

        <section class="contact-us container">
            <div class="mw-930">
                <h2 class="page-title">CONTACT US</h2>
            </div>
        </section>

        <hr class="mt-2 text-secondary" />
        <div class="mb-4 pb-4"></div>

        <section class="contact-us container">
            <div class="mw-930">
                <div class="contact-us__form">
                    @if(Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center fs-5 fw-bold" role="alert">
                            <i class="bi bi-check-circle-fill me-2 fs-4"></i>
                            <strong>{{ Session::get('success') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif(Session::has('error'))
                        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center fs-5 fw-bold" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2 fs-4"></i>
                            <strong>{{ Session::get('error') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form name="contact-us-form" class="needs-validation" novalidate=""
                          method="POST" action="{{ route('contact.send') }}">
                        @csrf

                        <h3 class="mb-5">Get In Touch</h3>

                        <div class="form-floating my-4">
                            <input type="text" class="form-control" name="name" placeholder="Name *" required value="{{ old('name') }}">
                            <label for="contact_us_name">Name *</label>
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-floating my-4">
                            <input type="text" class="form-control" name="phone" placeholder="Phone *" required value="{{ old('phone') }}">
                            <label for="contact_us_phone">Phone *</label>
                            @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-floating my-4">
                            <input type="email" class="form-control" name="email" placeholder="Email address *" required value="{{ old('email') }}">
                            <label for="contact_us_email">Email address *</label>
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-floating my-4">
                            <input type="text" class="form-control" name="subject" placeholder="Subject *" required value="{{ old('subject') }}">
                            <label for="contact_us_subject">Subject *</label>
                            @error('subject')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="my-4">
                            <textarea class="form-control form-control_gray" name="message" placeholder="Your Message" cols="30" rows="8" required>{{ old('message') }}</textarea>
                            @error('message')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="my-4">
                            <button type="submit" class="btn btn-outline-dark rounded-pill hover:btn-primary fs-5">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection
