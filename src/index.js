require("bootstrap");
import { Modal } from 'bootstrap';

import Swiper from "swiper";
import { Navigation, Pagination } from "swiper/modules";

import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";

document.addEventListener("DOMContentLoaded", () => {
    new Swiper(".swiper", {
        modules: [Navigation, Pagination],
        loop: false,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
            addIcons: true, // nowość w 12.0.2
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        slidesPerView: 1,
        spaceBetween: 20,
        breakpoints: {
            576: { slidesPerView: 2 }, // ≥576px
            768: { slidesPerView: 3 }, // ≥768px
            992: { slidesPerView: 4 }, // ≥992px
            1200: { slidesPerView: 5 }, // ≥1200px
        },
    });
});


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
  document.getElementById('video').src = videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0";
});

// Add event listener for when the modal is closed
document.getElementById('videoModal').addEventListener('hide.bs.modal', () => {
  // Stop the video by resetting the source
  document.getElementById('video').src = videoSrc;
});
