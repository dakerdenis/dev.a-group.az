document.addEventListener('DOMContentLoaded', function () {

    const wysiwygGalleryLinks = document.querySelectorAll('[data-fancybox="wysiwyg-gallery"]');
    let wysiwygImagesArr = []
    wysiwygGalleryLinks.forEach(function (link) {
        const img = link.querySelector('img')
        wysiwygImagesArr.push({
            src: link.href,
            type: 'image',
            alt: img.alt,
            thumb: img.src,
            caption: img.alt
        })
    })
    wysiwygGalleryLinks.forEach(function (link) {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            Fancybox.show(wysiwygImagesArr, {
                zoom: true
            });
        });
    });

    const galleryLinks = document.querySelectorAll('[data-fancybox="gallery"]');
    let imagesArr = []
    galleryLinks.forEach(function (link) {
        const img = link.querySelector('img')
        imagesArr.push({
            src: link.href,
            type: 'image',
            alt: img.alt,
            thumb: img.src,
            caption: img.alt
        })
    })
    galleryLinks.forEach(function (link) {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            Fancybox.show(imagesArr, {
                zoom: true
            });
        });
    });
});

const animateOnScroll = document.querySelectorAll('.animate-on-scroll');

const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const animationName = entry.target.getAttribute('data-animation');
            entry.target.classList.add('animate-on-scroll-show');
            entry.target.classList.add('animate__' + animationName);
        }
    });
});

animateOnScroll.forEach(element => {
    observer.observe(element);
});

// HEADER POPOVERS
const langSwithcer = document.querySelector('.lang-switcher');
const langSwithcerPopover = document.querySelector('.lang-switcher-popover');
const menuTrigger = document.querySelector('.menu-trigger');
const menuTriggerPopover = document.querySelector('.menu-trigger-popover');
const navItem1 = document.querySelector('.nav-item-1');
const navItem1Popover = document.querySelector('.nav-item-1-popover');
const navItem2 = document.querySelector('.nav-item-2');
const navItem2Popover = document.querySelector('.nav-item-2-popover');

const popoverTriggers = document.querySelectorAll('.popover-trigger')
const popovers = document.querySelectorAll('.popover');

let langSwithcerTimeoutId,
    menuTriggerTimeoutId,
    navItem1TimeoutId,
    navItem2TimeoutId;

function clearPopoversTimeout() {
    clearTimeout(langSwithcerTimeoutId);
    clearTimeout(menuTriggerTimeoutId);
    clearTimeout(navItem1TimeoutId);
    clearTimeout(navItem2TimeoutId);
}

langSwithcer.addEventListener('mouseover', function(e) {
    e.preventDefault();
    clearPopoversTimeout()

    popoverTriggers.forEach((item, i) => {
        item.classList.remove('hovered')
    })

    popovers.forEach((item, i) => {
        item.classList.remove('show')
    })

    langSwithcer.classList.add('hovered')
    langSwithcerPopover.classList.add('show')
})

langSwithcer.addEventListener('mouseout', function(e) {
    e.preventDefault();
    langSwithcerTimeoutId = setTimeout(() => {
        langSwithcer.classList.remove('hovered')
        langSwithcerPopover.classList.remove('show')
    }, 500)
})

menuTrigger.addEventListener('mouseover', function(e) {
    e.preventDefault();
    clearPopoversTimeout()

    popoverTriggers.forEach((item, i) => {
        item.classList.remove('hovered')
    })

    popovers.forEach((item, i) => {
        item.classList.remove('show')
    })

    menuTrigger.classList.add('hovered')
    menuTriggerPopover.classList.add('show')
})

menuTrigger.addEventListener('mouseout', function(e) {
    e.preventDefault();
    menuTriggerTimeoutId = setTimeout(() => {
        menuTrigger.classList.remove('hovered')
        menuTriggerPopover.classList.remove('show')
    }, 500)
})

navItem1.addEventListener('mouseover', function(e) {
    e.preventDefault();
    clearPopoversTimeout()

    popoverTriggers.forEach((item, i) => {
        item.classList.remove('hovered')
    })

    popovers.forEach((item, i) => {
        item.classList.remove('show')
    })

    navItem1.classList.add('hovered')
    navItem1Popover.classList.add('show')
})

navItem1.addEventListener('mouseout', function(e) {
    e.preventDefault();
    navItem1TimeoutId = setTimeout(() => {
        navItem1.classList.remove('hovered')
        navItem1Popover.classList.remove('show')
    }, 500)
})

navItem2.addEventListener('mouseover', function(e) {
    e.preventDefault();
    clearPopoversTimeout()

    popoverTriggers.forEach((item, i) => {
        item.classList.remove('hovered')
    })

    popovers.forEach((item, i) => {
        item.classList.remove('show')
    })

    navItem2.classList.add('hovered')
    navItem2Popover.classList.add('show')
})

navItem2.addEventListener('mouseout', function(e) {
    e.preventDefault();
    navItem2TimeoutId = setTimeout(() => {
        navItem2.classList.remove('hovered')
        navItem2Popover.classList.remove('show')
    }, 500)
})
// ---

// SIDEBAR
const sidebarDrawer = document.querySelector('.sidebar-drawer')
const closeSidebarBtn = document.querySelector('.sidebar-close-btn')

menuTrigger.addEventListener('click', function(e) {
    // e.preventDefault();
    menuTrigger.classList.add('hovered')
    sidebarDrawer.classList.add('show')
    document.body.classList.add('no-scroll')
}) 

closeSidebarBtn.addEventListener('click', function(e) {
    e.preventDefault();
    menuTrigger.classList.remove('hovered')
    sidebarDrawer.classList.remove('show')
    document.body.classList.remove('no-scroll')
})

const sidebarSubmenuTriggers = document.querySelectorAll('.submenu-trigger')

sidebarSubmenuTriggers.forEach((accordion) => {
    accordion.addEventListener('click', () => {
        // Find the parent element with the "menu-section-title" class
        const parentTitle = accordion.closest('.menu-section').querySelector('.menu-section-title');

        if (parentTitle.classList.contains('active')) {
            // If the parent element is already active, remove the "active" class
            parentTitle.classList.remove('active');
            let content = parentTitle.nextElementSibling;
            if (content?.style.maxHeight) {
                content.style.maxHeight = null;
            }
        } else {
            // Remove the "active" class from all elements with the "menu-section-title" class
            const menuSectionTitles = document.querySelectorAll('.menu-section-title');
            menuSectionTitles.forEach((title) => {
                title.classList.remove('active');
                let content = title.nextElementSibling;
                // console.log('content ', content)
                if (content?.style.maxHeight) {
                    content.style.maxHeight = null;
                }
            });

            // Add the "active" class to the parent element
            parentTitle.classList.add('active');

            let content = parentTitle.nextElementSibling;
            if (content?.style.maxHeight) {
                content.style.maxHeight = null;
            } else {
                content.style.maxHeight = content.scrollHeight + "px";
            }
        }
    });
})
//

// MAIN BANNER
const progressPaginationItems = document.querySelectorAll(".pagination-item");
const mainBannerCollapses = document.querySelectorAll(".mainBanner-collapsed")

const mainBannerSwiper = new window.Swiper('.mainBannerSwiper', {
    speed: 3000,
    spaceBetween: 0,
    loop: true,
    allowTouchMove: false,
    effect: 'fade',
    fadeEffect: {
      crossFade: true
    },
    autoplay: {
        delay: 6000,
        disableOnInteraction: false
    },
    on: {
        autoplayTimeLeft(s, time, progress) {
            progressPaginationItems[s.realIndex].childNodes[0].style.width=`${(1-progress)*100}%`
        },
        init: function () {
            mainBannerCollapses[0].style.maxHeight = mainBannerCollapses[0].scrollHeight + "px";
        }
    },
});

mainBannerSwiper.on('slideChange', function (s) {
    progressPaginationItems.forEach(item => item.childNodes[0].style.width='0')

    progressPaginationItems.forEach((item, i) => {
        if(i < s.realIndex) {
            item.classList.add('prevActive')
        } else {
            item.classList.remove('prevActive')
        }
    })

    mainBannerCollapses.forEach((item, i) => {
        if(i === s.realIndex) {
            item.style.maxHeight = item.scrollHeight + "px";
        } else {
            item.style.maxHeight = 0;
        }
    })
});

progressPaginationItems.forEach((item, i) => {
    item.addEventListener('click', function (event) {
        event.preventDefault();
        mainBannerSwiper.slideToLoop(i)
    });
})
// ---

// GALLERY SWIPER
const gallerySwiper = new window.Swiper('.gallerySwiper', {
    speed: 400,
    spaceBetween: 100,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets: true,
        dynamicMainBullets: 1,
        renderBullet: function (index, className) {
            return '<span class="' + className + '">' + (index + 1) + "</span>";
        },
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
});
// ---

// SPECIAL OFFERS SWIPER
const specialOffersSwiper = new window.Swiper('.specialOffersSwiper', {
    speed: 400,
    spaceBetween: 100,
    pagination: {
        el: ".swiper-pagination",
        // clickable: true,
        dynamicBullets: true,
        dynamicMainBullets: 1,
        renderBullet: function (index, className) {
            return '<span class="' + className + '">' + (index + 1) + "</span>";
        },
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
});
// ---

// 
document.getElementById('sendCV_form')?.addEventListener('submit', function(event) {
    event.preventDefault();
    const formResult = document.getElementById('sendCV_form_result');

    event.target.style.display = 'none'
    formResult.style.display = 'flex'
    formResult.scrollIntoView({ behavior: 'smooth', block: "center" });
});
// ---

// 
function handleIntersection(entries, observer) {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const image = entry.target.querySelector('.image');

            if (image) {
                image.src = image.getAttribute('data-src');
                image.addEventListener('load', () => {
                    image.classList.remove('lazy')
                });
                observer.unobserve(image);
            }
        }
    });
}

const imageObserver = new IntersectionObserver(handleIntersection, {
    root: null,
    rootMargin: '0px',
    threshold: 0.1,
});

const imageContainers = document.querySelectorAll('.lazy-block');
imageContainers.forEach(container => imageObserver.observe(container));
// ---

// On customer click event
const customerBlocks = document.querySelectorAll('.customer-block');

customerBlocks.forEach(block => {
    block.addEventListener('click', () => {
        customerBlocks.forEach(b => b.classList.remove('active'));
        block.classList.add('active');
    });
});

document.addEventListener('click', event => {
    if (!event.target.closest('.customer-block')) {
        customerBlocks.forEach(b => b.classList.remove('active'));
    }
});
// ---

// COLLAPSE
document.addEventListener("DOMContentLoaded", function () {
    const accordionBtns = document.querySelectorAll(".collapse-button");

    accordionBtns.forEach((accordion) => {
        accordion.onclick = function () {
            if(!this.classList.contains('active')) {
                accordionBtns.forEach(b => {
                    b.classList.remove('active')
                    let content = b.nextElementSibling;
                    if (content.style.maxHeight) {
                        content.style.maxHeight = null;
                    }
                });
            }

            this.classList.toggle("active");

            let content = this.nextElementSibling;
            if (content.style.maxHeight) {
                content.style.maxHeight = null;
            } else {
                content.style.maxHeight = content.scrollHeight + "px";
            }
        };
    });
});
// ---

// 
function updateFileInputText() {
    const fileInput = document.getElementById('fileInput');
    const fileInputText = document.getElementById('fileInputText');

    if (fileInput.files.length > 0) {
        fileInputText.value = fileInput.files[0].name;
    } else {
        fileInputText.value = '';
    }
}
// ---