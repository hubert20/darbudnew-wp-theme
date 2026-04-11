require("bootstrap");
import { Modal } from 'bootstrap';

import Swiper from "swiper";
import { Navigation, Pagination, Thumbs } from "swiper/modules";
import { Autoplay } from "swiper/modules";

import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";
import "swiper/css/thumbs";

document.addEventListener("DOMContentLoaded", () => {
  
  // Video source variable (used by modal)
  let videoSrc;

  // Slider produktów
  if (document.querySelector('.my-slider')) {
    new Swiper(".my-slider", {
      modules: [Navigation, Pagination],
      loop: false,
      navigation: {
        nextEl: ".main-products-slider__next",
        prevEl: ".main-products-slider__prev",
      },
      pagination: {
        el: ".main-products-slider__pagination",
        clickable: true,
      },
      slidesPerView: 1,
      spaceBetween: 20,
      breakpoints: {
        576: { slidesPerView: 2 },
        768: { slidesPerView: 3 },
        992: { slidesPerView: 3 },
        1200: { slidesPerView: 3 },
      },
    });
  }

  // Slider partnerów
  if (document.querySelector('.partners-slider')) {
    new Swiper(".partners-slider", {
      modules: [Autoplay], // 🔥 MUSI BYĆ DODANE
      loop: true,
      speed: 6000,
      autoplay: {
        delay: 1, // Swiper 11 wymaga > 0
        disableOnInteraction: false,
      },
      slidesPerView: 2,
      spaceBetween: 30,
      allowTouchMove: false,
      grabCursor: false,
      breakpoints: {
        576: { slidesPerView: 3 },
        768: { slidesPerView: 4 },
        992: { slidesPerView: 5 },
        1200: { slidesPerView: 6 },
      },
      on: {
        init(swiper) {
          swiper.wrapperEl.style.transitionTimingFunction = 'linear';
        },
        setTranslate(swiper) {
          swiper.wrapperEl.style.transitionTimingFunction = 'linear';
        }
      }
    });
  }

  // Modal Video - only if elements exist
  const videoModal = document.getElementById('videoModal');
  const videoEl = document.getElementById('video');
  
  if (videoModal && videoEl) {
    // Add click event listener to all elements with class "video-btn"
    document.querySelectorAll('.video-btn').forEach(button => {
      button.addEventListener('click', () => {
        // Get the video source from the data-src attribute
        videoSrc = button.dataset.src;
        console.log(videoSrc);
      });
    });

    // Add event listener for when the modal is opened
    videoModal.addEventListener('shown.bs.modal', () => {
      // Update the video source with autoplay and other options
      videoEl.src = videoSrc + "?modestbranding=1&rel=0&controls=1&showinfo=0&html5=1&autoplay=1";
    });

    // Add event listener for when the modal is closed
    videoModal.addEventListener('hide.bs.modal', () => {
      // Stop the video by resetting the source
      videoEl.src = videoSrc;
    });
  }

  // Galeria domku (house slider z miniaturkami) - MUSI BYĆ PRZED COUNTER!
  const houseGallery = document.querySelector('[data-swiper-gallery]');
  
  if (houseGallery) {
    console.log('House gallery found');
    const houseThumbs = houseGallery.querySelector('.house-gallery-thumbs');
    const houseSlider = houseGallery.querySelector('.house-gallery-slider');

    if (houseSlider) {
      console.log('House slider found, initializing...');
      let thumbsSwiper = null;
      
      // Inicjalizacja miniatur (jeśli istnieją)
      if (houseThumbs) {
        console.log('House thumbs found, initializing thumbs swiper...');
        thumbsSwiper = new Swiper(houseThumbs, {
          modules: [Navigation],
          spaceBetween: 10,
          slidesPerView: 4,
          freeMode: true,
          grabCursor: true,
          watchSlidesProgress: true,
          lazy: false,
          slideToClickedSlide: true,
          navigation: {
            nextEl: ".thumbs-button__next",
            prevEl: ".thumbs-button__prev",
          },
          breakpoints: {
            576: { slidesPerView: 5 },
            768: { slidesPerView: 6 },
          },
        });
        console.log('Thumbs swiper initialized:', thumbsSwiper);
      }

      // Konfiguracja głównego slidera
      const mainConfig = {
        modules: [Navigation, Thumbs],
        spaceBetween: 10,
        lazy: false,
        preloadImages: true,
        navigation: {
          nextEl: ".gallery-button__next",
          prevEl: ".gallery-button__prev",
        },
      };

      // Dodaj thumbs tylko jeśli istnieją miniatury
      if (thumbsSwiper) {
        mainConfig.thumbs = {
          swiper: thumbsSwiper,
        };
        console.log('Thumbs added to main config');
      }

      // Inicjalizacja głównego slidera
      const mainSwiper = new Swiper(houseSlider, mainConfig);
      console.log('Main swiper initialized:', mainSwiper);
    }
  }

  //Counter - tylko jeśli elementy istnieją
  const section = document.querySelector('.main-technology');
  const counterEl = document.getElementById('experience-counter');

  if (section && counterEl) {
    const targetValue = parseInt(counterEl.textContent, 10);
    let hasAnimated = false;

    const animateCounter = () => {
      let current = 0;
      const duration = 1500; // ms
      const stepTime = 30;
      const increment = Math.ceil(targetValue / (duration / stepTime));

      const timer = setInterval(() => {
        current += increment;

        if (current >= targetValue) {
          counterEl.textContent = targetValue;
          clearInterval(timer);
        } else {
          counterEl.textContent = current;
        }
      }, stepTime);
    };

    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting && !hasAnimated) {
            hasAnimated = true;
            animateCounter();
            observer.disconnect();
          }
        });
      },
      {
        threshold: 0.4 // ile sekcji ma być widoczne
      }
    );

    observer.observe(section);
  }

});