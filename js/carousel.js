//   Testimonial Carousel Slider Js Start
const testimonialSlides = document.querySelectorAll('.testimonial-slide');
const prevButton = document.querySelector('.testimonial-prev');
const nextButton = document.querySelector('.testimonial-next');
let slideIndex = 0;

function showSlide(n) {
  testimonialSlides.forEach(slide => slide.classList.remove('active'));
  testimonialSlides[n].classList.add('active');
}

function prevSlide() {
  slideIndex--;
  if (slideIndex < 0) {
    slideIndex = testimonialSlides.length - 1;
  }
  showSlide(slideIndex);
}

function nextSlide() {
  slideIndex++;
  if (slideIndex >= testimonialSlides.length) {
    slideIndex = 0;
  }
  showSlide(slideIndex);
}

prevButton.addEventListener('click', prevSlide);
nextButton.addEventListener('click', nextSlide);

setInterval(nextSlide, 6000);

//   Testimonial Carousel Slider Js End
