@extends('layouts.master')

@section('title', 'Welcome')

@section('content')
    <div style="text-align: center; margin-top: 100px;">
        <h2>Welcome to Task Scheduler</h2>
        <p>Please use the navigation above to Login or Sign Up to continue.</p>
    </div>

    <!-- Image Slider -->
    <div class="slider-container" style="max-width: 600px; margin: 2rem auto; position: relative; overflow: hidden;">
        <div class="slides" style="display: flex; transition: transform 2s ease-in-out; width: 300%;">
            <img class="slide" src="{{ asset('images/landing page image1.jpg') }}" style="width: 33.3333%;">
            <img class="slide" src="{{ asset('images/landing page image2.jpg') }}" style="width: 33.3333%;">
            <img class="slide" src="{{ asset('images/landing page image3.jpg') }}" style="width: 33.3333%;">
        </div>
        <button id="prevBtn" style="position: absolute; top: 50%; left: 10px; transform: translateY(-50%); background-color: rgba(0,0,0,0.5); color: white; border: none; border-radius: 50%; width: 30px; height: 30px; cursor: pointer;">&#10094;</button>
        <button id="nextBtn" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); background-color: rgba(0,0,0,0.5); color: white; border: none; border-radius: 50%; width: 30px; height: 30px; cursor: pointer;">&#10095;</button>
    </div>

    <script>
        const slidesContainer = document.querySelector('.slides');
        const totalSlides = 3;
        let slideIndex = 0;

        function showSlide(index) {
            const offset = -index * 100 / totalSlides;
            slidesContainer.style.transform = `translateX(${offset}%)`;
        }

        document.getElementById('nextBtn').addEventListener('click', () => {
            slideIndex = (slideIndex + 1) % totalSlides;
            showSlide(slideIndex);
        });

        document.getElementById('prevBtn').addEventListener('click', () => {
            slideIndex = (slideIndex - 1 + totalSlides) % totalSlides;
            showSlide(slideIndex);
        });

        showSlide(slideIndex);

        setInterval(() => {
            slideIndex = (slideIndex + 1) % totalSlides;
            showSlide(slideIndex);
        }, 5000);
    </script>
@endsection
