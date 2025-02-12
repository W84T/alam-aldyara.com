import "./bootstrap";
import "preline";
import Swiper from "swiper";
import "swiper/css";
import "swiper/css/pagination";
import { Navigation, Pagination } from "swiper/modules";

document.addEventListener("livewire:navigated", () => {
    window.HSStaticMethods.autoInit();
    initializeSwipers();
});

function initializeSwipers() {
    // Destroy existing Swiper instances if they exist
    if (window.swiperInstances) {
        window.swiperInstances.forEach((swiper) => swiper.destroy());
    }

    // Find all Swiper elements before initializing
    const bannerEl = document.querySelector(".swiper-banner");
    const categoryEl = document.querySelector(".swiper-category");
    const productEl = document.querySelector(".swiper-product");

    // Store instances in a global array
    window.swiperInstances = [];

    if (bannerEl) {
        window.swiperInstances.push(
            new Swiper(bannerEl, {
                slidesPerView: 1,
                spaceBetween: 10,
                loop: true,
                modules: [Navigation, Pagination],
                pagination: { el: ".swiper-pagination", clickable: true },
                navigation: {
                    nextEl: ".banner-next",
                    prevEl: ".banner-prev",
                },
                autoplay: { delay: 2000, disableOnInteraction: false },
            }),
        );
    }

    if (categoryEl) {
        window.swiperInstances.push(
            new Swiper(categoryEl, {
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
                pagination: { el: ".swiper-pagination", clickable: true },
                navigation: {
                    nextEl: ".category-next",
                    prevEl: ".category-prev",
                },
                autoplay: { delay: 2000, disableOnInteraction: false },
            }),
        );
    }

    if (productEl) {
        window.swiperInstances.push(
            new Swiper(productEl, {
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
                pagination: { el: ".swiper-pagination", clickable: true },
                navigation: {
                    nextEl: ".product-next",
                    prevEl: ".product-prev",
                },
                autoplay: { delay: 2000, disableOnInteraction: false },
            }),
        );
    }
}
