import "./bootstrap";
import "preline";
import Swiper from "swiper";
// import Swiper and modules styles
import "swiper/css";
// import "swiper/css/navigation";
import "swiper/css/pagination";
import { Navigation, Pagination } from "swiper/modules";

const swiper = new Swiper(".swiper-banner", {
    slidesPerView: 1,
    spaceBetween: 10,
    loop: true,
    modules: [Navigation, Pagination],
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    autoplay: {
        delay: 2000,
        disableOnInteraction: false,
    },
});

const swiper_category = new Swiper(".swiper-category", {
    breakpoints: {
        100: { slidesPerView: 1, spaceBetween: 4 },
        300: { slidesPerView: 3, spaceBetween: 4 },
        470: { slidesPerView: 3, spaceBetween: 8 },
        600: { slidesPerView: 4, spaceBetween: 8 },
        780: { slidesPerView: 6, spaceBetween: 16 },
        1022: { slidesPerView: 7, spaceBetween: 16 },
    },

    slidesPerView: 7,
    spaceBetween: 20,
    loop: true,
    modules: [Navigation, Pagination],
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    autoplay: {
        delay: 2000,
        disableOnInteraction: false,
    },
});

const swiper_products = new Swiper(".swiper-product", {
    breakpoints: {
        300: { slidesPerView: 2, spaceBetween: 4 },
        470: { slidesPerView: 3, spaceBetween: 6 },
        600: { slidesPerView: 3, spaceBetween: 6 },
        780: { slidesPerView: 4, spaceBetween: 8 },
        1022: { slidesPerView: 5, spaceBetween: 8 },
    },

    slidesPerView: 5,
    spaceBetween: 8,
    loop: true,
    modules: [Navigation, Pagination],
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    autoplay: {
        delay: 2000,
        disableOnInteraction: false,
    },
});
