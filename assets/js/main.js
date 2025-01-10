// Initialize variables
let lastScrollTop = 0;
const navbar = document.getElementById("navbar-section");
const menuIcon = document.getElementById("menu-icon");
const menu = document.querySelector('.navbar-menu');
const SCROLL_THRESHOLD = 5;

// Menu toggle
menuIcon.addEventListener('click', (e) => {
    e.preventDefault();
    e.stopPropagation();
    menu.classList.toggle('active');
    menuIcon.classList.toggle('bx-x');
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

// Scroll handler with throttling
let ticking = false;

window.addEventListener('scroll', () => {
    if (!ticking) {
        window.requestAnimationFrame(() => {
            const currentScroll = window.pageYOffset || document.documentElement.scrollTop;
            
            if (currentScroll > lastScrollTop && currentScroll > SCROLL_THRESHOLD) {
                // Scrolling down
                navbar.classList.add('nav-hidden');
            } else {
                // Scrolling up
                navbar.classList.remove('nav-hidden');
            }
            
            lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
            ticking = false;
        });
        
        ticking = true;
    }
});

// Close menu when clicking links
document.querySelectorAll('.navbar-menu a').forEach(link => {
    link.addEventListener('click', () => {
        menu.classList.remove('active');
        menuIcon.classList.remove('bx-x');
    });
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

