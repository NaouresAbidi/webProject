const body = document.querySelector("body"),
  sidebar = body.querySelector(".sidebar"),
  toggle = body.querySelector(".toggle"),
  searchBtn = body.querySelector(".search-box"),
  modeSwitch = body.querySelector(".toggle-switch"),
  modeText = body.querySelector(".mode-text");

let isScrolling = false;

function debounce(func, delay) {
  let timer;
  return function() {
    clearTimeout(timer);
    timer = setTimeout(() => {
      func.apply(this, arguments);
    }, delay);
  };
}

function throttle(func, delay) {
  let lastCalled = 0;
  return function() {
    const now = new Date().getTime();
    if (now - lastCalled >= delay) {
      func.apply(this, arguments);
      lastCalled = now;
    }
  };
}

function handleScroll() {
  if (!isScrolling) {
    isScrolling = true;
    requestAnimationFrame(() => {
      isScrolling = false;
      // Your scroll-related code here
    });
  }
}

modeSwitch.addEventListener("click", () => {
  body.classList.toggle("dark");
  modeText.innerText = body.classList.contains("dark") ? "Light Mode" : "Dark Mode";
});

toggle.addEventListener("click", () => {
  sidebar.classList.toggle("close");
});

searchBtn.addEventListener("click", () => {
  sidebar.classList.remove("close");
});

document.addEventListener("DOMContentLoaded", function() {
  const sliders = document.querySelectorAll(".slider-container");

  sliders.forEach(slider => {
    const cardsContainer = slider.querySelector(".cards");
    const cards = slider.querySelectorAll(".card");
    const cardWidth = cards[0].offsetWidth + 20; // 20px margin
    let scrollAmount = 0;

    slider.querySelector(".left").addEventListener("click", throttle(function() {
      if (scrollAmount === 0) {
        scrollAmount = cardsContainer.scrollWidth - cardsContainer.clientWidth;
      } else {
        scrollAmount = Math.max(scrollAmount - cardWidth, 0);
      }
      cardsContainer.scrollTo({
        top: 0,
        left: scrollAmount,
        behavior: "smooth"
      });
    }, 200));

    slider.querySelector(".right").addEventListener("click", throttle(function() {
      if (scrollAmount + cardsContainer.clientWidth >= cardsContainer.scrollWidth) {
        scrollAmount = 0;
      } else {
        scrollAmount = Math.min(scrollAmount + cardWidth, cardsContainer.scrollWidth - cardsContainer.clientWidth);
      }
      cardsContainer.scrollTo({
        top: 0,
        left: scrollAmount,
        behavior: "smooth"
      });
    }, 200));

    cardsContainer.addEventListener("scroll", debounce(handleScroll, 100));
  });
});
