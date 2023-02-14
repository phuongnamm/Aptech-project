document.addEventListener('DOMContentLoaded', function () {
    console.log("loaded!");
    // phải viết code ở chế độ nghiêm ngặt
    "use strict";

    var swiper = new Swiper(".mySwiper", {
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: "auto",
         autoplay: {
             delay: 2500,
             disableOnInteraction: false,
         },
        coverflowEffect: {
            rotate: 50,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows: true,
        },
        pagination: {
            el: ".swiper-pagination",
        },
        navigation: {
            nextEl: ".btn-prev",
            prevEl: ".btn-next",
        },
    });

    var swiper_2 = new Swiper(".mySwiper-2", {
        slidesPerView: 3,
        spaceBetween: 30,
        slidesPerGroup: 3,
        loop: true,
        loopFillGroupWithBlank: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });

    // active show data - show khi scroll đến //
    function reveal() {
        var reveals = document.querySelectorAll('[data-show="startbox"]');

        for (var i = 0; i < reveals.length; i++) {
            var windowHeight = window.innerHeight;
            var elementTop = reveals[i].getBoundingClientRect().top;
            var elementVisible = 50;

            if (elementTop < windowHeight - elementVisible) {
                reveals[i].classList.add("activeShow");
            } else {
                reveals[i].classList.remove("activeShow");
            }
        }
    }
    window.addEventListener("scroll", reveal);
    // end //
});

