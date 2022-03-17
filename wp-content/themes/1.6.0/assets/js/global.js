/* global $*/


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

const teamGallerySlider = new Swiper('.swiper-container.team-slider', {
    slidesPerView: 1,
    speed: 900,
    touchRatio: 1.5,
    loop: true,
    grabCursor: true,
    autoplay: {
        delay: 2000,
    },
    spaceBetween: 1000,
    navigation: {
        nextEl: '.slider-team-next',
        prevEl: '.slider-team-previous',
    },
    pagination: {
        el: '.team-pagination',
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
    autoHeight: true,
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
    autoplay: {
        delay: 3500,
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

const nuanceSlider = new Swiper('.swiper-container.nuance-slider', {
    slidesPerView: 3,
    spaceBetween: 30,
    loop: true,
    watchOverflow: true,
    autoplay: {
        delay: 2500,
    },
    centeredSlides: true,
    navigation: {
        nextEl: '.slider-nuance-next',
        prevEl: '.slider-nuance-previous',
    }
});

const testimonyAdviceGallerySlider = new Swiper('.swiper-container.testimony-advice-slider', {
    slidesPerView: 1,
    speed: 1000,
    touchRatio: 1.5,
    loop: true,
    grabCursor: true,
    autoplay: {
        delay: 2000,
    },
    navigation: {
        nextEl: '.slider-testimony-next',
        prevEl: '.slider-testimony-previous',
    },
    pagination: {
        el: '.testimony-pagination',
        clickable: true,
        renderBullet: function(index, className) {
            return '<span class=" bullet-product-single ' + className + '"></span>';
        },
    },
});




$(document).ready(function() {
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


    // CHECKOUT SCROLL

/*
    $(document).on("click", ".w-commerce-commercecheckoutlabel", function() {
        $('html, body').animate({
            scrollTop: ($("#place_order").offset().top - 200)
        }, 1000);

    });
*/


    // MAP RESULTS

    $('.close-map-results').on('click', function() {
        $('.map-grid-container').removeClass('open');
        $('.acplt-clear').trigger('click');
    });
    
    
    //NUANCIER
    function removeActiveClass(element) {
        element.each(function(){
           $(this).removeClass('active');
        });
    }
    
    
    $('.nuancier-selector.nuancier-standard').on('click', function(){
        removeActiveClass($('.nuancier-selector'));
        removeActiveClass($('.nuancier'));
        $(this).addClass('active');
        $('.nuancier.nuancier-standard ').addClass('active');
    });
    
    $('.nuancier-selector.nuancier-metallique').on('click', function(){
        removeActiveClass($('.nuancier-selector'));
        removeActiveClass($('.nuancier'));
        $(this).addClass('active');
        $('.nuancier.nuancier-metallique ').addClass('active');
    });


    //DISCOUNT
    
    jQuery('form.variations_form').on('found_variation',
        function(event, variation) {
            $('.product-price').html(variation.price_html);
            $('.product-price-promo').html(variation.price_html);
        }
    );




    //notice

    $(document).on('click', () => {
        $('.woocommerce-NoticeGroup,.woocommerce-notices-wrapper').remove();

    })
});

/**
 * Push navigation
 */
if (document.querySelector('.close-push-nav ')) {

    document.querySelector('.close-push-nav ').addEventListener('click', () => {
        document.querySelector('.nav-push').classList.add('off')
        document.body.classList.add('off')
        sessionStorage.setItem('disablePush', 'true');
    })

    if (!sessionStorage.getItem('disablePush')) {
        document.querySelector('.nav-push').classList.remove('off')
        document.body.classList.add('with-nav-push')
    }
}

resizing();

window.addEventListener('resize', function(event) {
    resizing();
});



function resizing() {

    if (window.matchMedia("(min-width: 1025px)").matches) {
        if (document.querySelectorAll('.has-submenu')) {

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

            //RESSOURCES
            document.querySelector('.has-submenu-ressource').addEventListener('mouseover', () => {
                document.querySelector('.sub-menu-ressource').classList.add('visible')
            })
            document.querySelector('.has-submenu-ressource').addEventListener('mouseout', () => {
                document.querySelector('.sub-menu-ressource').classList.remove('visible')
            })

            document.querySelector('.sub-menu-ressource').addEventListener('mouseover', () => {
                document.querySelector('.sub-menu-ressource').classList.add('visible')
            })
            document.querySelector('.sub-menu-ressource').addEventListener('mouseout', () => {
                document.querySelector('.sub-menu-ressource').classList.remove('visible')
            })

            //PROJET
            if(document.querySelector('.has-submenu-projet')) {
                document.querySelector('.has-submenu-projet').addEventListener('mouseover', () => {
                    document.querySelector('.sub-menu-projet').classList.add('visible')
                })
                document.querySelector('.has-submenu-projet').addEventListener('mouseout', () => {
                    document.querySelector('.sub-menu-projet').classList.remove('visible')
                })
            }

            document.querySelector('.sub-menu-projet').addEventListener('mouseover', () => {
                document.querySelector('.sub-menu-projet').classList.add('visible')
            })
            document.querySelector('.sub-menu-projet').addEventListener('mouseout', () => {
                document.querySelector('.sub-menu-projet').classList.remove('visible')
            })
            
            //EXPERTISES
            
            document.querySelector('.has-submenu-expertise').addEventListener('mouseover', () => {
                document.querySelector('.sub-menu-expertise').classList.add('visible')
            })
            document.querySelector('.has-submenu-expertise').addEventListener('mouseout', () => {
                document.querySelector('.sub-menu-expertise').classList.remove('visible')
            })

            document.querySelector('.sub-menu-expertise').addEventListener('mouseover', () => {
                document.querySelector('.sub-menu-expertise').classList.add('visible')
            })
            document.querySelector('.sub-menu-expertise').addEventListener('mouseout', () => {
                document.querySelector('.sub-menu-expertise').classList.remove('visible')
            })
        }

    }
    else {
        document.querySelectorAll('.has-submenu').forEach(item => {
            item.addEventListener('click', e => {
                e.preventDefault();
                e.stopPropagation();
                e.currentTarget.closest('.nav-item-mobile').querySelector('.sub-menu-mobile').classList.add('open');
            })
        })
    }

}


document.querySelector('.menu-burger').addEventListener('click', () => {
    if (document.querySelector('.nav-mobile-wrapper').classList.contains('open')) {
        document.querySelectorAll('.sub-nav-mobile, .sub-nav-mobile, .sub-menu-mobile, .sub-menu-ressource-mobile, .sub-menu-projet-mobile, .sub-menu-expertise-mobile').forEach(item => {
            item.classList.remove('open');
        })
    }
    document.querySelector('.nav-mobile-wrapper').classList.toggle('open');
})

document.querySelectorAll('.has-mobile-menu').forEach(item => {
    item.addEventListener('click', e => {
        e.preventDefault();
        e.currentTarget.parentNode.querySelector('.sub-nav-mobile').classList.add('open');
    })
})

document.querySelectorAll('.sub-nav-header').forEach(item => {
    item.addEventListener('click', e => {
        e.preventDefault();
        e.currentTarget.parentNode.classList.remove('open');
    })
})

document.querySelectorAll('.has-submenu').forEach(item => {
    if (window.matchMedia("(max-width: 1024px)").matches) {
        item.addEventListener('click', e => {
            e.preventDefault();
            e.currentTarget.closest('.nav-item-mobile').querySelector('.sub-menu-mobile').classList.add('open');
        })
    }
})

document.querySelectorAll('.has-submenu-ressource').forEach(item => {
    if (window.matchMedia("(max-width: 1024px)").matches) {
        item.addEventListener('click', e => {
            e.preventDefault();
            e.currentTarget.closest('.nav-item-mobile').querySelector('.sub-menu-ressource-mobile').classList.add('open');
        })
    }
})

document.querySelectorAll('.has-submenu-expertise').forEach(item => {
    if (window.matchMedia("(max-width: 1024px)").matches) {
        item.addEventListener('click', e => {
            e.preventDefault();
            e.currentTarget.closest('.nav-item-mobile').querySelector('.sub-menu-expertise-mobile').classList.add('open');
        })
    }
})

document.querySelectorAll('.has-submenu-projet').forEach(item => {
    if (window.matchMedia("(max-width: 1024px)").matches) {
        item.addEventListener('click', e => {
            e.preventDefault();
            e.currentTarget.closest('.nav-item-mobile').querySelector('.sub-menu-projet-mobile').classList.add('open');
        })
    }
})

document.querySelectorAll('.submenu-mobile-header').forEach(item => {
    item.addEventListener('click', e => {
        e.preventDefault();
        e.currentTarget.closest('.sub-menu-mobile, .sub-menu-ressource-mobile, .sub-menu-projet-mobile, .sub-menu-expertise-mobile').classList.remove('open');
    })
})
