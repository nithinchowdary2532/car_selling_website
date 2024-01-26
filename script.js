function toggleDropdown() {
    var dropdown = document.getElementById("dropdown");
    if (dropdown.style.display === "block") {
      dropdown.style.display = "none";
    dropdown.style.order = -1;
  } else {
    dropdown.style.display = "block";
  }
}

let currentSlide = 0;
const carousel = document.querySelector('.carousel');
const carouselItemWidth = document.querySelector('.carousel-item').offsetWidth;
const numCarouselItems = document.querySelectorAll('.carousel-item').length;

function moveCarousel(direction) {
  currentSlide += direction;
  currentSlide = Math.max(0, Math.min(currentSlide, numCarouselItems - 3));
  const newPosition = -currentSlide * carouselItemWidth;
  carousel.style.transform = `translateX(${newPosition}px)`;
}


const hr = document.querySelector('.animated-hr');
document.addEventListener('mouseenter', () => {
  hr.classList.add('hovered'); 
});

document.addEventListener('mouseleave', () => {
  hr.classList.remove('hovered');
});



let items = document.querySelectorAll('.carousel .carousel-item')

  items.forEach((el) => {
      const minPerSlide = 4
      let next = el.nextElementSibling
      for (var i=1; i<minPerSlide; i++) {
          if (!next) {
        // wrap carousel by using first child
        next = items[0]
    }
    let cloneChild = next.cloneNode(true)
    el.appendChild(cloneChild.children[0])
    next = next.nextElementSibling
}
})
let item = document.querySelectorAll('.carousel .carousel-item');
let currentIndex = 0;

function moveCarousel() {
  const nextIndex = (currentIndex + 1) % item.length;
  const nextButton = document.querySelector('.carousel-control-next');
  nextButton.click();
  currentIndex = nextIndex;
}
setInterval(moveCarousel, 3000);


window.addEventListener("scroll", () => {
const line1 = document.getElementById("line1");
const line2 = document.getElementById("line2");
const scrollPosition = window.scrollY;

if (scrollPosition > 100) {
  // Apply the scroll animation class when scrolled past a certain point
  line1.classList.add("scroll-animation");
  line2.classList.add("scroll-animation");
} else {
  // Remove the scroll animation class when not scrolled far enough
  line1.classList.remove("scroll-animation");
  line2.classList.remove("scroll-animation");
}
});