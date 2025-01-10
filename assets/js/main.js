document.getElementById('menu-icon').addEventListener('click', function () {
  const navbarMenu = document.querySelector('.navbar-menu');
  navbarMenu.classList.toggle('active');
  this.classList.toggle('bx-x');
});

// Scroll functionality
let lastScrollTop = 0;
const navbar = document.getElementById("navbar-section");
const SCROLL_THRESHOLD = 5;

function throttle(func, limit) {
  let inThrottle;
  return function() {
    const args = arguments;
    const context = this;
    if (!inThrottle) {
      func.apply(context, args);
      inThrottle = true;
      setTimeout(() => inThrottle = false, limit);
    }
  }
}

window.addEventListener('scroll', throttle(function() {
  const currentScroll = window.scrollY;
  
  if (Math.abs(currentScroll - lastScrollTop) <= SCROLL_THRESHOLD) {
    return;
  }
  
  if (currentScroll > lastScrollTop) {
    // Scrolling down
    navbar.classList.add("nav-hidden");
  } else {
    // Scrolling up
    navbar.classList.remove("nav-hidden");
  }
  
  if (currentScroll > SCROLL_THRESHOLD) {
    navbar.classList.add("sticky");
  } else {
    navbar.classList.remove("sticky");
  }
  
  lastScrollTop = currentScroll;
}, 150));


// TOGGLE NAVBAR ICON
// Select the menu icon and the navigation menu
let menuIcon = document.querySelector('#menu-icon');
let menu = document.querySelector('.menu');

// Toggle the active class on the menu and icon when the menu icon is clicked
menuIcon.addEventListener('click', () => {
  menu.classList.toggle('active'); // Show or hide the menu
  menuIcon.classList.toggle('bx-x'); // Change the menu icon to 'X' when active
});

// Close the menu when a link is clicked
document.querySelectorAll('.navbar-menu a').forEach(link => {
  link.addEventListener('click', () => {
    menu.classList.remove('active'); // Hide the menu
    menuIcon.classList.remove('bx-x'); // Change the icon back to hamburger
  });
});

// Close menu when clicking outside
document.addEventListener('click', (e) => {
    const isMenuClick = menu.contains(e.target);
    const isMenuIconClick = menuIcon.contains(e.target);
    
    if (!isMenuClick && !isMenuIconClick) {
        menu.classList.remove('active');
        menuIcon.classList.remove('bx-x');
    }
});

// HANDLING SCROLLING SECTION
window.addEventListener('scroll', function() {
    const sections = document.querySelectorAll('section');
    const navLinks = document.querySelectorAll('.navbar-menu a');
  
    let current = '';
  
    sections.forEach(section => {
      const sectionTop = section.offsetTop;
      if (pageYOffset >= sectionTop - 50) {
        current = section.getAttribute('id');
      }
    });
  
    navLinks.forEach(link => {
      link.classList.remove('active');
      if (link.getAttribute('href').includes(current)) {
        link.classList.add('active');
      }
    });
  });

  let isScrolling;
window.addEventListener('scroll', function() {
  window.clearTimeout(isScrolling);

  isScrolling = setTimeout(function() {
    // Your scroll handling code
  }, 100); // 100ms delay
});

