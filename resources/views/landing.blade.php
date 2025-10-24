@extends('layouts.master')

@section('title', 'Welcome')

@section('content')
    <div style="text-align: center; margin-top: 100px;">
        <h2>Welcome to Task Scheduler</h2>
        <p>Please use the navigation above to Login or Sign Up to continue.</p>
    </div>

    <!-- Image Slider -->
    <div class="slider-container" style="max-width: 600px; margin: 2rem auto; position: relative; overflow: hidden;">
       <div class="slides" style="display: flex; align-items: center; transition: transform 0.6s ease-in-out; width: 300%;">
          <img class="slide" src="{{ asset('images/landing-image-1.jpg') }}" 
              style="flex: 0 0 100%; width:100%; height:auto; max-height:400px; object-fit:contain; display:block;"
              onerror="this.style.display='none'; console.error('Failed to load image:', this.src)">
          <img class="slide" src="{{ asset('images/landing-image-2.jpg') }}" 
              style="flex: 0 0 100%; width:100%; height:auto; max-height:400px; object-fit:contain; display:block;"
              onerror="this.style.display='none'; console.error('Failed to load image:', this.src)">
          <img class="slide" src="{{ asset('images/landing-image-3.jpg') }}" 
              style="flex: 0 0 100%; width:100%; height:auto; max-height:400px; object-fit:contain; display:block;"
              onerror="this.style.display='none'; console.error('Failed to load image:', this.src)">
       </div>
       <button id="prevBtn" style="position: absolute; top: 50%; left: 10px; transform: translateY(-50%); background-color: rgba(0,0,0,0.5); color: white; border: none; border-radius: 50%; width: 30px; height: 30px; cursor: pointer; z-index: 2;">&#10094;</button>
       <button id="nextBtn" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); background-color: rgba(0,0,0,0.5); color: white; border: none; border-radius: 50%; width: 30px; height: 30px; cursor: pointer; z-index: 2;">&#10095;</button>
    </div>

    <!-- Debug info for images -->
    <div id="imageDebug">
        <p>Image paths (for debugging):</p>
        <ul>
            <li>{{ asset('images/landing-image-1.jpg') }}</li>
            <li>{{ asset('images/landing-image-2.jpg') }}</li>
            <li>{{ asset('images/landing-image-3.jpg') }}</li>
        </ul>
    </div>

    <script>
        // Ensure DOM is loaded before selecting elements
        document.addEventListener('DOMContentLoaded', function () {
            // Image load error tracking
            const slides = Array.from(document.querySelectorAll('.slide'));
            const slidesContainer = document.querySelector('.slides');
            const nextBtn = document.getElementById('nextBtn');
            const prevBtn = document.getElementById('prevBtn');
            const debugDiv = document.getElementById('imageDebug');

            if (slides.length && debugDiv) debugDiv.style.display = 'none';

            slides.forEach(img => {
                img.addEventListener('error', function () {
                    console.error('Image failed to load:', this.src);
                    if (debugDiv) debugDiv.style.display = 'block';
                    if (debugDiv) {
                        const errorMsg = document.createElement('p');
                        errorMsg.style.color = 'red';
                        errorMsg.textContent = 'Failed to load: ' + this.src;
                        debugDiv.appendChild(errorMsg);
                    }
                });
            });

            let totalSlides = slides.length;
            let slideIndex = 0;

            function layoutSlides() {
                totalSlides = slides.length || 1;
                // set container width to hold all slides side by side
                if (slidesContainer) slidesContainer.style.width = (100 * totalSlides) + '%';
                // set each slide's flex-basis so it occupies equal share
                slides.forEach(s => {
                    s.style.flex = '0 0 ' + (100 / totalSlides) + '%';
                });
            }

            function showSlide(index) {
                if (!slidesContainer || slides.length === 0) return;
                const slideWidth = slides[0].clientWidth; // pixel width of one slide
                const offsetPx = -index * slideWidth;
                slidesContainer.style.transform = 'translateX(' + offsetPx + 'px)';
            }

            // wire buttons
            if (nextBtn) {
                nextBtn.addEventListener('click', () => {
                    slideIndex = (slideIndex + 1) % totalSlides;
                    showSlide(slideIndex);
                });
            }
            if (prevBtn) {
                prevBtn.addEventListener('click', () => {
                    slideIndex = (slideIndex - 1 + totalSlides) % totalSlides;
                    showSlide(slideIndex);
                });
            }

            // handle window resize to recompute widths
            window.addEventListener('resize', function () {
                layoutSlides();
                showSlide(slideIndex);
            });

            // initialize layout and start
            layoutSlides();
            showSlide(slideIndex);

            if (totalSlides > 1) {
                setInterval(() => {
                    slideIndex = (slideIndex + 1) % totalSlides;
                    showSlide(slideIndex);
                }, 5000);
            }
        });
    </script>
@endsection
