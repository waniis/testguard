/* global $*/
jQuery(function($) {
    $(document).ready(function() {

        const productGallerySlider = new Swiper('.swiper-container.product-single-slider', {
            slidesPerView: 1,
            grabCursor: true,
            speed: 1000,
            touchRatio: 1.5,
            navigation: {
                nextEl: '.slider-pagination-next',
                prevEl: '.slider-pagination-previous',
            },
            pagination: {
                el: '.slider-product-single-pagination',
                clickable: true,
                renderBullet: function(index, className) {
                    return '<span class=" bullet-product-single ' + className + '"></span>';
                },
            },
        });

        const referenceGallerySlider = new Swiper('.swiper-container.reference-slider', {
            slidesPerView: 1,
            speed: 1000,
            touchRatio: 1.5,
            loop: true,
            grabCursor: true,
            autoplay: {
                delay: 2000,
            },
            navigation: {
                nextEl: '.slider-reference-next',
                prevEl: '.slider-reference-previous',
            },
            pagination: {
                el: '.reference-pagination',
                clickable: true,
                renderBullet: function(index, className) {
                    return '<span class=" bullet-product-single ' + className + '"></span>';
                },
            },
        });

        const relatedLength = $('.product-slider .swiper-slide').length;
        const productRelatedSlider = new Swiper('.swiper-container.product-slider', {
            slidesPerView: 1.3,
            loop: false,
            centeredSlides: true,
            grabCursor: true,
            threshold: 10,
            initialSlide: (Math.ceil(relatedLength / 2) - 1),
            navigation: {
                nextEl: '.slider-product-next',
                prevEl: '.slider-product-previous',
            },
            breakpoints: {
                768: {
                    slidesPerView: "auto",
                    slidesPerGroup: 1,
                }

            },
        });

        const referenceLength = $('.reference-related-slider .swiper-slide').length;
        const referenceRelatedSlider = new Swiper('.swiper-container.reference-related-slider', {
            slidesPerView: "auto",
            loop: true,
            centeredSlides: true,
            grabCursor: true,
            threshold: 10,
            initialSlide: (Math.ceil(referenceLength / 2) - 1),
            navigation: {
                nextEl: '.slider-reference-related-next',
                prevEl: '.slider-reference-related-previous',
            }
        });

        const videoSlider = new Swiper('.swiper-container.video-slider', {
            slidesPerView: 1.3,
            loop: false,
            centeredSlides: true,
            grabCursor: true,
            threshold: 10,
            navigation: {
                nextEl: '.video-btn-next',
                prevEl: '.video-btn-previous',
            },
            breakpoints: {
                768: {
                    slidesPerView: "auto",
                    slidesPerGroup: 1,
                    centeredSlides: false,
                }

            },
        });

        const adviceSlider = new Swiper('.swiper-container.advice-slider', {
            slidesPerView: "auto",
            loop: true,
            effect: "fade",
            watchOverflow: true,
            fadeEffect: {
                crossFade: true
            },
            centeredSlides: true,
            threshold: 10,
            navigation: {
                nextEl: '.advice-btn-next',
                prevEl: '.advice-btn-previous',
            },
            pagination: {
                el: '.advice-slide-pagination',
                clickable: true,
                renderBullet: function(index, className) {
                    return '<span class="bullet-advice-slider ' + className + '"></span>';
                },
            },
        });

        const testimonySlider = new Swiper('.swiper-container.testimony-slider', {
            slidesPerView: 1,
            loop: true,
            watchOverflow: true,
            effect: "fade",
            fadeEffect: {
                crossFade: true
            },
            centeredSlides: true,
            navigation: {
                nextEl: '.testimony-btn-next',
                prevEl: '.testimony-btn-previous',
            },
            pagination: {
                el: '.testimony-slide-pagination',
                clickable: true,
                renderBullet: function(index, className) {
                    return '<span class="bullet-advice-slider ' + className + '"></span>';
                },
            },
        });


        // DROPDOWN
        $('.product-description-trigger').on('click', function() {
            $(this).toggleClass('active');
            $('.product-description').toggleClass('active');
        });
        $('.product-dropdown_title').each(function(index) {
            $(this).on('click', function() {
                $(this).toggleClass('active');
                $('.product-dropdown_content').eq(index).toggleClass('active');
            });

        });
        $('.filter-title-trigger').each(function(index) {
            $(this).on('click', function() {
                $(this).toggleClass('active');
                $('.filter-container').eq(index).toggleClass('active');
            });

        });
        jQuery('form.variations_form').on('found_variation',
            function(event, variation) {

                function show_discount(string) {
                    var new_price = parseFloat(string.slice(0, -1).replace(',', '.')) * .85;

                    new_price = Math.round(new_price * 100) / 100;
                    new_price = new_price.toString();

                    console.log(new_price.replace('.', ',') + "€")
                    $('.product-price .woocommerce-Price-amount').html(new_price.replace('.', ',') + "€");
                }



                if (parseInt($('.product-price-promo .woocommerce-Price-amount').html())) {
                    show_discount($('.product-price-promo .woocommerce-Price-amount').html())
                }
                else {
                    show_discount($('.product-price bdi').html()+"€")
                }
            }
        );
    });
    
    
    //notice

    $(document).on('click',()=>{
        $('.woocommerce-NoticeGroup').remove();
    })
});

/**
 * Push navigation
 */

document.querySelector('.close-push-nav ').addEventListener('click', () => {
    document.querySelector('.nav-push').classList.add('off')
    document.body.classList.add('off')
    sessionStorage.setItem('disablePush', 'true');
})

if (!sessionStorage.getItem('disablePush')) {
    document.querySelector('.nav-push').classList.remove('off')
    document.body.classList.add('with-nav-push')
}

document.querySelector('.sub-menu').addEventListener('mouseover', () => {
    document.querySelector('.sub-menu').classList.add('visible')
})

document.querySelector('.sub-menu').addEventListener('mouseout', () => {
    document.querySelector('.sub-menu').classList.remove('visible')
})


document.querySelector('.has-submenu').addEventListener('mouseover', () => {
    document.querySelector('.sub-menu').classList.add('visible')
})

document.querySelector('.has-submenu').addEventListener('mouseout', () => {
    document.querySelector('.sub-menu').classList.remove('visible')
})


document.querySelector('.menu-burger').addEventListener('click', () => {
    document.querySelector('.nav-mobile-wrapper').classList.toggle('open')
})


document.querySelectorAll('.has-mobile-menu').forEach(item => {
  item.addEventListener('click', e => {
     e.preventDefault();
     e.currentTarget.parentNode.querySelector('.sub-nav-mobile').classList.add('open');
  })
})
