function signup() {
      document.querySelector(".login-form-container").style.display = "none";
      document.querySelector(".signup-form-container").style.display = "block";
      document.querySelector(".container").style.background = "linear-gradient(to bottom, rgb(56, 189, 149), rgb(28, 139, 106))";
      document.querySelector(".button-1").style.display = "none";
      document.querySelector(".button-2").style.display = "block";
  }

  function login() {
      document.querySelector(".signup-form-container").style.display = "none";
      document.querySelector(".login-form-container").style.display = "block";
      document.querySelector(".container").style.background = "linear-gradient(to bottom, rgb(6, 108, 224), rgb(14, 48, 122))";
      document.querySelector(".button-2").style.display = "none";
      document.querySelector(".button-1").style.display = "block";
  }

  function openRegistrationPopup() {
      var overlay = document.getElementById('overlay');
      var popup = document.getElementById('registration-popup');
      overlay.style.display = 'block';
      popup.style.display = 'block';
      signup(); // Initially show signup form
  }

  function closePopup(popupId) {
      var overlay = document.getElementById('overlay');
      var popup = document.getElementById(popupId);
      overlay.style.display = 'none';
      popup.style.display = 'none';
  }

    // Carousel functionality
    let currentIndex = 0;
    const items = document.querySelectorAll('.carousel-item');

    function showNextSlide() {
        items[currentIndex].style.display = 'none';
        currentIndex = (currentIndex + 1) % items.length;
        items[currentIndex].style.display = 'flex';
    }

    // Initialize carousel
    

    /*FOR ACCOUNT LOCKOUT */

