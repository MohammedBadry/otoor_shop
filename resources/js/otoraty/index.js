$(document).ready(function () {

        $('.owl-product').owlCarousel({
            loop: true,
            margin: 10,
            rtl: true,
            responsiveClass: true,
            nav: true,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 1,
                },
                1000: {
                    items: 6,
                    loop: true,
                    nav: true
                }
            }
        })
        $(".owl-prev").html('<i class="fa fa-chevron-left"></i>');
        $(".owl-next").html('<i class="fa fa-chevron-right"></i>');

        // product Gallery and Zoom

        // activation carousel plugin
        var galleryThumbs = new Swiper('.gallery-thumbs', {
            spaceBetween: 5,
            freeMode: true,
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
            breakpoints: {
                0: {
                    slidesPerView: 3,
                },
                992: {
                    slidesPerView: 4,
                },
            }
        });
        var galleryTop = new Swiper('.gallery-top', {
            spaceBetween: 10,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            thumbs: {
                swiper: galleryThumbs
            },
        });
        // change carousel item height
        // gallery-top
        let productCarouselTopWidth = $('.gallery-top').outerWidth();
        $('.gallery-top').css('height', productCarouselTopWidth);

        // gallery-thumbs
        let productCarouselThumbsItemWith = $('.gallery-thumbs .swiper-slide').outerWidth();
        $('.gallery-thumbs').css('height', productCarouselThumbsItemWith);

        // activation zoom plugin
        var $easyzoom = $('.easyzoom').easyZoom();

        $('.add').click(function () {
            if ($(this).prev().val() < 3) {
                $(this).prev().val(+$(this).prev().val() + 1);
            }
        });
        $('.sub').click(function () {
            if ($(this).next().val() > 1) {
                if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
            }
        });

        var parent = document.querySelector("#rangeSlider");
        if (!parent) return;

        var
            rangeS = parent.querySelectorAll("input[type=range]"),
            numberS = parent.querySelectorAll("input[type=number]");

        rangeS.forEach(function (el) {
            el.oninput = function () {
                var slide1 = parseFloat(rangeS[0].value),
                    slide2 = parseFloat(rangeS[1].value);

                if (slide1 > slide2) {
                    [slide1, slide2] = [slide2, slide1];
                    // var tmp = slide2;
                    // slide2 = slide1;
                    // slide1 = tmp;
                }

                numberS[0].value = slide1;
                numberS[1].value = slide2;
            }
        });

        numberS.forEach(function (el) {
            el.oninput = function () {
                var number1 = parseFloat(numberS[0].value),
                    number2 = parseFloat(numberS[1].value);

                if (number1 > number2) {
                    var tmp = number1;
                    numberS[0].value = number2;
                    numberS[1].value = tmp;
                }

                rangeS[0].value = number1;
                rangeS[1].value = number2;

            }
        });

        
})