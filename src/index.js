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
