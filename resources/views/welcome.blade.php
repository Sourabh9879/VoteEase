<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Voting System - Welcome</title>
        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- FontAwesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <!-- Custom CSS -->
        <style>
            body {
                background-color: #f8f9fa;
            }
            .hero-section {
                background: linear-gradient(135deg, #3498db, #2c3e50);
                color: white;
                padding: 5rem 0;
                position: relative;
                overflow: hidden;
            }
            .hero-section::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: url('https://images.unsplash.com/photo-1577563908411-5077b6dc7624?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') no-repeat center center/cover;
                opacity: 0.2;
                z-index: 0;
            }
            .hero-content {
                position: relative;
                z-index: 1;
            }
            .feature-card {
                border-radius: 10px;
                box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
                transition: transform 0.3s ease;
                background-color: white;
            }
            .feature-card:hover {
                transform: translateY(-5px);
            }
            .feature-icon {
                font-size: 2.5rem;
                color: #3490dc;
                margin-bottom: 1rem;
            }
            .btn-primary {
                background-color: #3490dc;
                border-color: #3490dc;
            }
            .btn-primary:hover {
                background-color: #2779bd;
                border-color: #2779bd;
            }
            .footer {
                background-color: #2c3e50;
                color: white;
                padding: 2rem 0;
            }
            .social-icons a {
                color: white;
                margin-right: 1rem;
                font-size: 1.25rem;
            }
            .navbar {
                background-color: #2c3e50 !important;
            }
        </style>
    </head>
    <body>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <i class="fas fa-vote-yea me-2"></i>Voting System
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('signup') }}">Register</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('user.dashboard') }}">Dashboard</a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="hero-section">
            <div class="container hero-content">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h1 class="display-4 fw-bold mb-4">Your Vote Matters!</h1>
                        <p class="lead mb-4">
                            Welcome to our secure online voting platform where every vote counts. Register today and be part of the democratic process.
                        </p>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                            @guest
                                <a href="{{ route('signup') }}" class="btn btn-primary btn-lg px-4 me-md-2">Register Now</a>
                                <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-4">Login</a>
                            @else
                                <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('user.dashboard') }}" class="btn btn-primary btn-lg px-4 me-md-2">Go to Dashboard</a>
                            @endguest
                        </div>
                    </div>
                    <div class="col-lg-6 d-none d-lg-block">
                        <img src="https://cdni.iconscout.com/illustration/premium/thumb/online-voting-3862343-3213828.png" alt="Voting Illustration" class="img-fluid">
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="py-5">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="fw-bold">Why Choose Our Voting System?</h2>
                    <p class="text-muted">Secure, transparent, and accessible voting for everyone</p>
                </div>
                
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="feature-card p-4 h-100">
                            <div class="feature-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <h4>Secure Authentication</h4>
                            <p class="text-muted">
                                Your identity is verified using your Aadhar number, ensuring a secure and reliable authentication process.
                            </p>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="feature-card p-4 h-100">
                            <div class="feature-icon">
                                <i class="fas fa-lock"></i>
                            </div>
                            <h4>Data Protection</h4>
                            <p class="text-muted">
                                All your data is encrypted and protected with the highest security standards available.
                            </p>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="feature-card p-4 h-100">
                            <div class="feature-icon">
                                <i class="fas fa-chart-pie"></i>
                            </div>
                            <h4>Real-time Results</h4>
                            <p class="text-muted">
                                View election results in real-time with interactive charts and detailed analytics.
                            </p>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="feature-card p-4 h-100">
                            <div class="feature-icon">
                                <i class="fas fa-universal-access"></i>
                            </div>
                            <h4>Accessibility</h4>
                            <p class="text-muted">
                                Our platform is designed to be accessible for everyone, including people with disabilities.
                            </p>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="feature-card p-4 h-100">
                            <div class="feature-icon">
                                <i class="fas fa-mobile-alt"></i>
                            </div>
                            <h4>Mobile Friendly</h4>
                            <p class="text-muted">
                                Vote from anywhere using your mobile device with our responsive design.
                            </p>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="feature-card p-4 h-100">
                            <div class="feature-icon">
                                <i class="fas fa-check-double"></i>
                            </div>
                            <h4>Transparent Process</h4>
                            <p class="text-muted">
                                Our voting process is completely transparent and verifiable, ensuring the integrity of each election.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- How It Works Section -->
        <section class="py-5 bg-light">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="fw-bold">How It Works</h2>
                    <p class="text-muted">Simple steps to participate in the voting process</p>
                </div>
                
                <div class="row">
                    <div class="col-md-3">
                        <div class="text-center mb-4">
                            <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                <h3 class="text-white mb-0">1</h3>
                            </div>
                            <h4 class="mt-3">Register</h4>
                            <p class="text-muted">Create an account using your Aadhar number and personal details.</p>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="text-center mb-4">
                            <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                <h3 class="text-white mb-0">2</h3>
                            </div>
                            <h4 class="mt-3">Login</h4>
                            <p class="text-muted">Securely log in to the voting platform using your credentials.</p>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="text-center mb-4">
                            <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                <h3 class="text-white mb-0">3</h3>
                            </div>
                            <h4 class="mt-3">Cast Vote</h4>
                            <p class="text-muted">Review the candidates and cast your vote securely and privately.</p>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="text-center mb-4">
                            <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                <h3 class="text-white mb-0">4</h3>
                            </div>
                            <h4 class="mt-3">View Results</h4>
                            <p class="text-muted">Check the election results in real-time with detailed analytics.</p>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <a href="{{ route('signup') }}" class="btn btn-primary btn-lg">Get Started Now</a>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="bg-primary text-white p-5 rounded-3">
                            <div class="row align-items-center">
                                <div class="col-lg-8">
                                    <h2 class="fw-bold">Ready to make your voice heard?</h2>
                                    <p class="lead mb-0">
                                        Join our secure voting platform today and be part of the democratic process.
                                    </p>
                                </div>
                                <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                                    <a href="{{ route('signup') }}" class="btn btn-light btn-lg px-4">Register Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <h5><i class="fas fa-vote-yea me-2"></i>Voting System</h5>
                        <p class="text-muted">
                            A secure and transparent platform for online voting.
                        </p>
                        <div class="social-icons">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    
                    <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                        <h5>Links</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="{{ route('home') }}" class="text-white text-decoration-none">Home</a></li>
                            <li class="mb-2"><a href="{{ route('login') }}" class="text-white text-decoration-none">Login</a></li>
                            <li class="mb-2"><a href="{{ route('signup') }}" class="text-white text-decoration-none">Register</a></li>
                        </ul>
                    </div>
                    
                    <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                        <h5>Resources</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Help Center</a></li>
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Privacy Policy</a></li>
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Terms of Service</a></li>
                        </ul>
                    </div>
                    
                    <div class="col-lg-3 col-md-6">
                        <h5>Contact Us</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-envelope me-2"></i> info@votingsystem.com</li>
                            <li class="mb-2"><i class="fas fa-phone me-2"></i> +1 (555) 123-4567</li>
                            <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> 123 Democracy Street, Voting City</li>
                        </ul>
                    </div>
                </div>
                
                <hr class="my-4 bg-white">
                
                <div class="text-center">
                    <p class="mb-0">
                        &copy; {{ date('Y') }} Voting System. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>

        <!-- Bootstrap 5 JS Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </body>
</html>
