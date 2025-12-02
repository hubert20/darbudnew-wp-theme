require("bootstrap");
import { Modal } from 'bootstrap';

import Swiper from "swiper";
import { Navigation, Pagination } from "swiper/modules";
import { Autoplay } from "swiper/modules";

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
  //Rotate circle technology
  const textEl = document.querySelector(".circle-technology--text p");
  const text = textEl.innerText.trim();
  const chars = text.split(""); // litery osobno, ale odstępy też działają

  textEl.innerHTML = ""; // czyścimy

  chars.forEach((char, i) => {
    const span = document.createElement("span");
    span.innerText = char;

    const angle = (360 / chars.length) * i;

    span.style.transform = `rotate(${angle}deg) translate(100px) rotate(-${angle}deg)`;
    textEl.appendChild(span);
  });

});