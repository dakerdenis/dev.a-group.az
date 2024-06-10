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