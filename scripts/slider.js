$(".single-item").slick({
  adaptiveHeight: true,
  cssEase: "linear",
  dots: false,
  fade: true,
  infinite: true,
  nextArrow: document.querySelector("#my-arrow-next"),
  prevArrow: document.querySelector("#my-arrow-prev"),
  slidesToScroll: 1,
  slidesToShow: 1,
  speed: 300
});

let n=1;
const prevbtn = document.getElementById("my-arrow-prev");
const nextbtn = document.getElementById("my-arrow-next");
let num = document.getElementById("slide-current-number");

prevbtn.addEventListener("click", function () {
  if (n === 1) {
      n = 8;
  } else {
      n -=1;
  }
  num.innerHTML = "0" + n;
});
nextbtn.addEventListener("click", function () {
  if (n === 8) {
      n = 1;
  } else {
      n +=1;
  }
  num.innerHTML = "0" + n;
});

$(".slider-1").slick({
  arrows: false,
  autoplay: true,
  autoplaySpeed: 3000,
  centerMode: true,
  cssEase: "linear",
  dots: false,
  infinite: true,
  responsive: [
      {
          breakpoint: 1400,
          settings: {
            arrows: false,
            centerMode: true,
            slidesToShow: 6
          }
      },
      {
          breakpoint: 1000,
          settings: {
            arrows: false,
            centerMode: true,
            slidesToShow: 4
          }
      },
      {
        breakpoint: 768,
        settings: {
          arrows: false,
          centerMode: true,
          slidesToShow: 3.1
        }
      },
      {
        breakpoint: 480,
        settings: {
          arrows: false,
          centerMode: true,
          slidesToShow: 2.5
        }
      }
    ],
  slidesToScroll: 1,
  slidesToShow: 7.8
});

$(".slider-2").slick({
  arrows: false,
  autoplay: true,
  autoplaySpeed: 3000,
  centerMode: true,
  cssEase: "linear",
  dots: false,
  infinite: true,
  responsive: [
      {
          breakpoint: 1400,
          settings: {
            arrows: false,
            centerMode: true,
            slidesToShow: 6.4
          }
      },
      {
          breakpoint: 1000,
          settings: {
            arrows: false,
            centerMode: true,
            slidesToShow: 4.4
          }
      },
      {
        breakpoint: 768,
        settings: {
          arrows: false,
          centerMode: true,
          slidesToShow: 3.4
        }
      },
      {
        breakpoint: 480,
        settings: {
          arrows: false,
          centerMode: true,
          slidesToShow: 2.2
        }
      }
    ],
  slidesToScroll: 1,
  slidesToShow: 7.3
});