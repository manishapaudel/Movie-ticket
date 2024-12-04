// Hero Slideshow Functionality
document.addEventListener('DOMContentLoaded', () => {
    let heroIndex = 0;
    const heroSlides = document.querySelectorAll('.hero-slide');
  
    // Function to show the current slide
    function showHeroSlide(index) {
      heroSlides.forEach((slide, i) => {
        slide.style.display = i === index ? 'flex' : 'none';
      });
    }
  
    // Function to change slide
    function changeHeroSlide(n) {
      heroIndex += n;
      if (heroIndex >= heroSlides.length) heroIndex = 0;
      if (heroIndex < 0) heroIndex = heroSlides.length - 1;
      showHeroSlide(heroIndex);
    }
  
    // Initialize Slideshow
    showHeroSlide(heroIndex);
  
    // Auto-Slide
    setInterval(() => {
      changeHeroSlide(1);
    }, 8000); //
  });
  