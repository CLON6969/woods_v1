let slideIndex = [1, 1, 1, 1];
const slideContainers = document.querySelectorAll('.slideshow');

function showSlides(n, slideNumber) {
    const slides = slideContainers[slideNumber - 1].querySelectorAll('.slide');
    const dots = slideContainers[slideNumber - 1].querySelectorAll('.dot');
    if (n > slides.length) slideIndex[slideNumber - 1] = 1;
    if (n < 1) slideIndex[slideNumber - 1] = slides.length;
    slides.forEach(slide => slide.style.display = 'none');
    dots.forEach(dot => dot.className = dot.className.replace(' active', ''));
    slides[slideIndex[slideNumber - 1] - 1].style.display = 'block';
    dots[slideIndex[slideNumber - 1] - 1].className += ' active';
}

function plusSlides(n, slideNumber) {
    showSlides(slideIndex[slideNumber - 1] += n, slideNumber);
}

function currentSlide(n, slideNumber) {
    showSlides(slideIndex[slideNumber - 1] = n, slideNumber);
}

// Initialize slideshows
document.addEventListener('DOMContentLoaded', () => {
    slideContainers.forEach((container, index) => showSlides(1, index + 1));
});