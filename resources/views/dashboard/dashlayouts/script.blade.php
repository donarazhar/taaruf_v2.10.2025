<!-- All JavaScript Files -->
<script src="{{ asset('apk/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('apk/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('apk/assets/js/waypoints.min.js') }}"></script>
<script src="{{ asset('apk/assets/js/jquery.easing.min.js') }}"></script>
<script src="{{ asset('apk/assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('apk/assets/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('apk/assets/js/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('apk/assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.mask.min.js') }}"></script>

<!-- PWA -->
<script src="{{ asset('apk/assets/js/pwa.js') }}"></script>

<!-- Custom Modern Scripts -->
<script>
    $(document).ready(function() {
        'use strict';

        // ===== PRELOADER =====
        function hidePreloader() {
            setTimeout(function() {
                $('#preloader').addClass('hide');
                setTimeout(function() {
                    $('#preloader').remove();
                }, 300);
            }, 500);
        }

        $(window).on('load', function() {
            hidePreloader();
        });

        // Fallback if load event doesn't fire
        setTimeout(function() {
            if ($('#preloader').length) {
                hidePreloader();
            }
        }, 3000);

        // ===== INTERNET CONNECTION STATUS =====
        function updateOnlineStatus() {
            const statusElement = $('#internetStatus');
            
            if (navigator.onLine) {
                statusElement.removeClass('show').html('');
                setTimeout(function() {
                    statusElement.addClass('online').html('<i class="fa fa-wifi"></i> Kembali Online').addClass('show');
                    setTimeout(function() {
                        statusElement.removeClass('show');
                    }, 3000);
                }, 100);
            } else {
                statusElement.removeClass('online').html('<i class="fa fa-exclamation-triangle"></i> Tidak Ada Koneksi Internet').addClass('show');
            }
        }

        window.addEventListener('online', updateOnlineStatus);
        window.addEventListener('offline', updateOnlineStatus);

        // Initial check
        if (!navigator.onLine) {
            updateOnlineStatus();
        }

        // ===== SMOOTH SCROLL =====
        $('a[href^="#"]').on('click', function(e) {
            const target = $(this.getAttribute('href'));
            if (target.length) {
                e.preventDefault();
                $('html, body').stop().animate({
                    scrollTop: target.offset().top - 80
                }, 800, 'easeInOutExpo');
            }
        });

        // ===== HEADER SCROLL EFFECT =====
        let lastScroll = 0;
        const header = $('#headerArea');
        
        $(window).scroll(function() {
            const currentScroll = $(this).scrollTop();
            
            if (currentScroll > 100) {
                header.addClass('scrolled');
            } else {
                header.removeClass('scrolled');
            }
            
            // Auto-hide header on scroll down (mobile only)
            if ($(window).width() < 768) {
                if (currentScroll > lastScroll && currentScroll > 100) {
                    header.css('transform', 'translateY(-100%)');
                } else {
                    header.css('transform', 'translateY(0)');
                }
            }
            
            lastScroll = currentScroll;
        });

        // ===== OWL CAROUSEL =====
        if ($('.owl-carousel-one').length) {
            $('.owl-carousel-one').owlCarousel({
                items: 1,
                loop: true,
                autoplay: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                smartSpeed: 800,
                nav: false,
                dots: true,
                animateOut: 'fadeOut',
                animateIn: 'fadeIn'
            });
        }

        if ($('.testimonial-slide').length) {
            $('.testimonial-slide').owlCarousel({
                items: 1,
                loop: true,
                autoplay: true,
                autoplayTimeout: 4000,
                smartSpeed: 600,
                nav: false,
                dots: true,
                margin: 20
            });
        }

        // ===== ACTIVE MENU HIGHLIGHT =====
        function highlightActiveMenu() {
            const currentPath = window.location.pathname;
            $('.footer-nav li').removeClass('active');
            $('.footer-nav li a').each(function() {
                const href = $(this).attr('href');
                if (href && currentPath.includes(href.replace(/^\//, ''))) {
                    $(this).parent().addClass('active');
                }
            });
        }

        highlightActiveMenu();

        // ===== BACK TO TOP BUTTON =====
        const backToTop = $('<button>', {
            class: 'back-to-top',
            html: '<i class="fa fa-chevron-up"></i>',
            css: {
                position: 'fixed',
                bottom: '90px',
                right: '20px',
                width: '50px',
                height: '50px',
                borderRadius: '50%',
                background: 'var(--black)',
                color: 'var(--white)',
                border: 'none',
                cursor: 'pointer',
                opacity: '0',
                visibility: 'hidden',
                transition: 'all 0.3s ease',
                zIndex: '998',
                fontSize: '1.2rem',
                boxShadow: 'var(--shadow-lg)'
            }
        }).appendTo('body');

        $(window).scroll(function() {
            if ($(this).scrollTop() > 300) {
                backToTop.css({
                    opacity: '1',
                    visibility: 'visible'
                });
            } else {
                backToTop.css({
                    opacity: '0',
                    visibility: 'hidden'
                });
            }
        });

        backToTop.on('click', function() {
            $('html, body').animate({
                scrollTop: 0
            }, 800, 'easeInOutExpo');
        });

        backToTop.on('mouseenter', function() {
            $(this).css('transform', 'scale(1.1)');
        }).on('mouseleave', function() {
            $(this).css('transform', 'scale(1)');
        });

        // ===== RIPPLE EFFECT FOR BUTTONS =====
        $('.btn, .footer-nav a, .header-btn').on('click', function(e) {
            const ripple = $('<span class="ripple"></span>');
            const x = e.pageX - $(this).offset().left;
            const y = e.pageY - $(this).offset().top;
            
            ripple.css({
                left: x + 'px',
                top: y + 'px'
            });
            
            $(this).append(ripple);
            
            setTimeout(function() {
                ripple.remove();
            }, 600);
        });

        // ===== LAZY LOADING IMAGES =====
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        imageObserver.unobserve(img);
                    }
                });
            });

            document.querySelectorAll('img.lazy').forEach(function(img) {
                imageObserver.observe(img);
            });
        }

        // ===== PREVENT ZOOM ON INPUT FOCUS (iOS) =====
        if (/iPhone|iPad|iPod/i.test(navigator.userAgent)) {
            $('input, textarea, select').on('focus', function() {
                $('meta[name=viewport]').attr('content', 'width=device-width, initial-scale=1, maximum-scale=1');
            }).on('blur', function() {
                $('meta[name=viewport]').attr('content', 'width=device-width, initial-scale=1');
            });
        }

        // ===== FORM VALIDATION ENHANCEMENT =====
        $('form').on('submit', function() {
            const submitBtn = $(this).find('button[type="submit"]');
            submitBtn.prop('disabled', true);
            submitBtn.html('<i class="fa fa-spinner fa-spin"></i> Memproses...');
        });

        // ===== CONSOLE LOG BRANDING =====
        console.log('%c Ta\'aruf Jodohku v.2.0 ', 'background: #000; color: #fff; padding: 10px 20px; font-size: 16px; font-weight: bold;');
        console.log('%c YPI Al Azhar © 2024 ', 'background: #f5f5f5; color: #000; padding: 5px 20px; font-size: 12px;');
    });

    // ===== PWA INSTALL PROMPT =====
    let deferredPrompt;
    window.addEventListener('beforeinstallprompt', (e) => {
        e.preventDefault();
        deferredPrompt = e;
        console.log('PWA install prompt available');
    });
</script>

<style>
    /* Ripple Effect */
    .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        transform: scale(0);
        animation: ripple-animation 0.6s ease-out;
        pointer-events: none;
    }

    @keyframes ripple-animation {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }

    /* Header Scrolled State */
    .header-area.scrolled {
        box-shadow: var(--shadow-md);
    }

    /* Lazy Image Loading */
    img.lazy {
        opacity: 0;
        transition: opacity 0.3s;
    }

    img:not(.lazy) {
        opacity: 1;
    }
</style>

@stack('myscript')