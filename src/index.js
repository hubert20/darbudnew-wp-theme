require("bootstrap");
import { Modal } from 'bootstrap';

import Swiper from "swiper";
import { Navigation, Pagination } from "swiper/modules";

import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";

document.addEventListener("DOMContentLoaded", () => {

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
  // 🔹 Slider partnerów
  if (document.querySelector('.partners-slider')) {
    new Swiper(".partners-slider", {
      loop: true,
      speed: 3000, // płynniejszy ruch (większa wartość = wolniej)
      autoplay: {
        delay: 0, // brak przerwy między przesunięciami
        disableOnInteraction: false,
      },
      allowTouchMove: false, // wyłącza przeciąganie myszką/palcem
      freeMode: true, // płynny ciągły ruch
      slidesPerView: 2, // wartość bazowa
      spaceBetween: 30,
      breakpoints: {
        576: { slidesPerView: 3 },
        768: { slidesPerView: 4 },
        992: { slidesPerView: 5 },
        1200: { slidesPerView: 6 },
      },
    });
  }

  // Modal Video
  // Declare a variable to store the video source
  let videoSrc;

  // Add click event listener to all elements with class "video-btn"
  document.querySelectorAll('.video-btn').forEach(button => {
    button.addEventListener('click', () => {
      // Get the video source from the data-src attribute
      videoSrc = button.dataset.src;
      console.log(videoSrc);
    });
  });

  // Add event listener for when the modal is opened
  document.getElementById('videoModal').addEventListener('shown.bs.modal', () => {
    // Update the video source with autoplay and other options
    document.getElementById('video').src = videoSrc + "?modestbranding=1&rel=0&controls=1&showinfo=0&html5=1&autoplay=1";
  });

  // Add event listener for when the modal is closed
  document.getElementById('videoModal').addEventListener('hide.bs.modal', () => {
    // Stop the video by resetting the source
    document.getElementById('video').src = videoSrc;
  });
});