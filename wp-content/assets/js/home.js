// VIDEO SECTION 
class HomeVideoPlayer {
    constructor(_options) {
        this.storeHandlesToDOM()
        this.setLoopVideo()
        this.setListeners()
    }
    storeHandlesToDOM() {
        this.$container = document.querySelector('.section-landing-video')
        this.media = document.querySelector('.section-landing-video video')
        this.$source = this.media.querySelector('source')

        this.$startBtn = document.querySelector('.start-video')

        this.desktop = {}
        this.desktop.mainURL = this.media.dataset.mainUrl
    }
    playMainVideo() {
        document.querySelector('.video-overlay').classList.add('hidden')

        this.$source.setAttribute('src', this.desktop.mainURL)
        this.media.load()
        this.media.play()

        // this.media.setAttribute('controls', true)
        this.media.controls = true
        // this.media.removeAttribute('muted')
        this.media.muted = false
    }
    setLoopVideo() {
        this.media.pause()
        this.$source.setAttribute('src', this.desktop.mainURL)
        this.media.muted = true
        this.media.load()
        this.media.play()
    }
    
    setListeners() {

        this.$startBtn.addEventListener('click', () => {
            this.playMainVideo()
        })
        
        // TEMP MUTE
        this.media.addEventListener('click', () => {
            (this.media.muted === true) ? this.media.muted = false : this.media.muted = true;
        })

    }
}

const videoPlayer = new HomeVideoPlayer();

// SCRATCH SECTION

const scratchArea = document.querySelector('.section-landing-scratch');
var width = $(window).width(),
    height = $(window).height();

var canvas = document.getElementById('scratch'),
    bridgeCanvas = canvas.getContext('2d'),
    brushRadius = (canvas.width / 100) * 5,
    img = new Image();

resizeCanvas();

if (isDesktop) {
    scratchImage();

    canvas.addEventListener("click", function(e) {
        var brushPos = getBrushPos(e.clientX, e.clientY);
        drawDot(brushPos.x, brushPos.y);
    }, false);


    canvas.addEventListener("mousemove", function(e) {
        var brushPos = getBrushPos(e.clientX, e.clientY);
        var leftBut = detectLeftButton(e);
        if (leftBut == 1) {
            drawDot(brushPos.x, brushPos.y);
        }
    }, false);

    canvas.addEventListener("touchmove", function(e) {
        e.preventDefault();
        var touch = e.targetTouches[0];
        if (touch) {
            var brushPos = getBrushPos(touch.pageX, touch.pageY);
            drawDot(brushPos.x, brushPos.y);
        }
    }, false);
}

function scratchImage() {
    if (brushRadius < 50) { brushRadius = 100 }

    var offsetX = -1.5;
    var offsetY = -0.8;

    img.onload = function() {
        drawImageProp(bridgeCanvas, img, 0, 0, canvas.width, canvas.height, offsetX, offsetY);
    }

    img.src = canvas.getAttribute('data-before-url');
    setTimeout(function() {
        canvas.style.backgroundImage = "url(" + canvas.getAttribute('data-after-url') + ")";
    }, 1500);

}

function detectLeftButton(event) {
    if ('buttons' in event) {
        return event.buttons === 1;
    }
    else if ('which' in event) {
        return event.which === 1;
    }
    else {
        return event.button === 1;
    }
}

function getBrushPos(xRef, yRef) {
    var bridgeRect = canvas.getBoundingClientRect();
    return {
        x: 40 + Math.floor((xRef - bridgeRect.left) / (bridgeRect.right - bridgeRect.left) * canvas.width),
        y: 40 + Math.floor((yRef - bridgeRect.top) / (bridgeRect.bottom - bridgeRect.top) * canvas.height)
    };
}

function drawDot(mouseX, mouseY) {
    bridgeCanvas.beginPath();
    bridgeCanvas.arc(mouseX, mouseY, brushRadius, 0, 2 * Math.PI, true);
    bridgeCanvas.globalAlpha = 0.3;
    bridgeCanvas.fillStyle = '#000';
    bridgeCanvas.globalCompositeOperation = "destination-out";
    bridgeCanvas.fill();
}

window.addEventListener('resize', function() {
    if ($(window).width() != width || $(window).height() != height) {
        resizeCanvas();
        scratchImage()

    }
})

function isDesktop() {
    if (window.matchMedia('(min-width: 1024px)').matches) {
        return true
    }
    else {
        return false
    }
}

function resizeCanvas() {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
}

function drawImageProp(ctx, img, x, y, w, h, offsetX, offsetY) {

    if (arguments.length === 2) {
        x = y = 0;
        w = ctx.canvas.width;
        h = ctx.canvas.height;
    }

    // default offset is center
    offsetX = typeof offsetX === "number" ? offsetX : 0.5;
    offsetY = typeof offsetY === "number" ? offsetY : 0.5;

    // keep bounds [0.0, 1.0]
    if (offsetX < 0) offsetX = 0;
    if (offsetY < 0) offsetY = 0;
    if (offsetX > 1) offsetX = 1;
    if (offsetY > 1) offsetY = 1;

    var iw = img.width,
        ih = img.height,
        r = Math.min(w / iw, h / ih),
        nw = iw * r, // new prop. width
        nh = ih * r, // new prop. height
        cx, cy, cw, ch, ar = 1;

    // decide which gap to fill    
    if (nw < w) ar = w / nw;
    if (Math.abs(ar - 1) < 1e-14 && nh < h) ar = h / nh; // updated
    nw *= ar;
    nh *= ar;

    // calc source rectangle
    cw = iw / (nw / w);
    ch = ih / (nh / h);

    cx = (iw - cw) * offsetX;
    cy = (ih - ch) * offsetY;

    // make sure source rectangle is valid
    if (cx < 0) cx = 0;
    if (cy < 0) cy = 0;
    if (cw > iw) cw = iw;
    if (ch > ih) ch = ih;

    // fill image in dest. rectangle
    ctx.drawImage(img, cx, cy, cw, ch, x, y, w, h);
}


// HOMEPAGES SLIDER
const gammeSlider = new Swiper('.swiper-container.gamme-slider', {
    slidesPerView: 1,
    loop: false,
    centeredSlides: true,
    grabCursor: true,
    speed:1000,
    touchRatio:1.5,
    effect: "fade",
    fadeEffect: {
        crossFade: true
    },
    threshold: 10,
    navigation: {
        nextEl: '.gamme-btn-next',
        prevEl: '.gamme-btn-previous',
    },
    pagination: {
        el: '.gamme-slide-pagination',
        clickable: true,
        renderBullet: function(index, className) {
            return '<span class="bullet-gamme-slider ' + className + '"></span>';
        },
    },
});
