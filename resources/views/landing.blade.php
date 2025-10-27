@extends('layouts.master')

@section('title', 'Welcome - Task Scheduler')

@push('styles')
<style>
    .hero-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 4rem 2rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/><circle cx="10" cy="60" r="0.5" fill="white" opacity="0.1"/><circle cx="90" cy="40" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        opacity: 0.3;
    }

    .hero-content {
        position: relative;
        z-index: 1;
        max-width: 800px;
        margin: 0 auto;
    }

    .hero-title {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .hero-subtitle {
        font-size: 1.25rem;
        font-weight: 400;
        margin-bottom: 2rem;
        opacity: 0.9;
        line-height: 1.6;
    }

    .hero-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-hero {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: white;
        padding: 1rem 2rem;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-hero:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        color: white;
    }

    .btn-hero.primary {
        background: rgba(255, 255, 255, 0.9);
        color: #667eea;
    }

    .btn-hero.primary:hover {
        background: white;
        color: #667eea;
    }


    .slider-section {
        padding: 4rem 2rem;
        background: #f8fafc;
    }

    .slider-container {
        max-width: 1200px;
        margin: 0 auto;
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    .slides {
        display: flex;
        transition: transform 2s ease-in-out;
        width: 300%;
    }

    .slide {
        width: 33.3333%;
        height: 600px;
        object-fit: cover;
    }

    .slider-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0, 0, 0, 0.5);
        color: white;
        border: none;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        cursor: pointer;
        font-size: 1.5rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .slider-nav:hover {
        background: rgba(0, 0, 0, 0.7);
        transform: translateY(-50%) scale(1.1);
    }

    .slider-prev {
        left: 20px;
    }

    .slider-next {
        right: 20px;
    }

    .slider-dots {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 0.5rem;
    }

    .slider-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .slider-dot.active {
        background: white;
        transform: scale(1.2);
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }

        .hero-subtitle {
            font-size: 1.1rem;
        }

        .hero-buttons {
            flex-direction: column;
            align-items: center;
        }

        .btn-hero {
            width: 100%;
            max-width: 300px;
        }

        .slide {
            height: 400px;
        }
    }
</style>
@endpush

@section('content')
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">Welcome to Task Scheduler</h1>
            <p class="hero-subtitle">
                Streamline your workflow and boost productivity with our powerful task management system.
                Organize, prioritize, and track your tasks with ease.
            </p>
            @auth
                <div class="hero-buttons">
                    <a href="{{ url('/account_sync') }}" class="btn-hero primary">Manage Account Sync</a>
                </div>
            @endauth
        </div>
    </div>


    <!-- Image Slider Section -->
    <div class="slider-section">
        <div class="slider-container">
            <div class="slides">
                <img class="slide" src="{{ asset('images/landing page image1.jpg') }}" alt="Task Management">
                <img class="slide" src="{{ asset('images/landing page image2.jpg') }}" alt="Productivity Tools">
                <img class="slide" src="{{ asset('images/landing page image3.jpg') }}" alt="Team Collaboration">
            </div>
            <button class="slider-nav slider-prev" id="prevBtn">‹</button>
            <button class="slider-nav slider-next" id="nextBtn">›</button>
            <div class="slider-dots">
                <button class="slider-dot active" data-slide="0"></button>
                <button class="slider-dot" data-slide="1"></button>
                <button class="slider-dot" data-slide="2"></button>
            </div>
        </div>
    </div>

    <script>
        const slidesContainer = document.querySelector('.slides');
        const totalSlides = 3;
        let slideIndex = 0;

        function showSlide(index) {
            const offset = -index * 100 / totalSlides;
            slidesContainer.style.transform = `translateX(${offset}%)`;

            // Update dots
            document.querySelectorAll('.slider-dot').forEach((dot, i) => {
                dot.classList.toggle('active', i === index);
            });
        }

        document.getElementById('nextBtn').addEventListener('click', () => {
            slideIndex = (slideIndex + 1) % totalSlides;
            showSlide(slideIndex);
        });

        document.getElementById('prevBtn').addEventListener('click', () => {
            slideIndex = (slideIndex - 1 + totalSlides) % totalSlides;
            showSlide(slideIndex);
        });

        // Dot navigation
        document.querySelectorAll('.slider-dot').forEach((dot, index) => {
            dot.addEventListener('click', () => {
                slideIndex = index;
                showSlide(slideIndex);
            });
        });

        showSlide(slideIndex);

        // Auto-advance slides
        setInterval(() => {
            slideIndex = (slideIndex + 1) % totalSlides;
            showSlide(slideIndex);
        }, 5000);
    </script>
@endsection
