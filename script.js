// Initialize Swiper when DOM is fully loaded
document.addEventListener("DOMContentLoaded", function () {
  const swiper = new Swiper(".slider-wrapper", {
    loop: true,
    grabCursor: true,
    spaceBetween: 30,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    breakpoints: {
      0: {
        slidesPerView: 1,
      },
      580: {
        slidesPerView: 2,
      },
      820: {
        slidesPerView: 3,
      },
      1024: {
        slidesPerView: 4,
      },
    },
  });
});

const tabs = document.querySelectorAll(".sidebar .tab");
const productCards = document.querySelectorAll(".product-card");

tabs.forEach((tab) => {
  tab.addEventListener("click", () => {
    // Remove active class from all tabs
    tabs.forEach((t) => t.classList.remove("active"));
    tab.classList.add("active");

    // Filter products based on selected tab
    const category = tab.dataset.type;
    productCards.forEach((card) => {
      if (card.dataset.category === category) {
        card.style.display = "block";
      } else {
        card.style.display = "none";
      }
    });
  });
});
