// emailjs.init("PyH29-umGbaGbPpwR");
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

emailjs.init("PyH29-umGbaGbPpwR");
function sendContactEmail(event) {
  event.preventDefault(); // Prevent form submission
  let email = document.getElementById("email").value;
  let message = document.getElementById("message").value;
  let firstName = document.getElementById("firstName").value;
  let lastName = document.getElementById("lastName").value;
  let phoneNumber = document.getElementById("phoneNumber").value;

  emailjs
    .send("service_ld7b7zm", "template_2mfy5fg", {
      email: email,
      message: message,
      first_name: firstName,
      last_name: lastName,
      phone_number: phoneNumber,
    })
    .then((response) => {
      Swal.fire({
        icon: "success",
        title: "Email Sent",
        text: "We will get back to you soon.",
        showConfirmButton: true,
        timer: 5000,
        timerProgressBar: true,
        backdrop: false,
      });
    })
    .catch((error) => {
      Swal.fire({
        icon: "error",
        title: "Error",
        text: "Failed to send email. Please try again later.",
        showConfirmButton: true,
        timer: 5000,
        timerProgressBar: true,
        backdrop: false,
      });
      console.error("Failed to send email:", error);
    });
}
