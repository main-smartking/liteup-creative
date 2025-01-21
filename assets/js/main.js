document.addEventListener('DOMContentLoaded', () => {
    const navbar = document.getElementById("navbar-section");
    const menuIcon = document.getElementById("menu-icon");
    const menu = document.querySelector('.navbar-menu');
    const dropdowns = document.querySelectorAll('.dropdown-toggle');
    const navLinks = document.querySelectorAll('.navbar-link:not(.dropdown-toggle)');
    let lastScrollTop = 0;

    // Mobile menu toggle
    if (menuIcon) {
        menuIcon.addEventListener('click', () => {
            menu.classList.toggle('active');
            menuIcon.classList.toggle('bx-x');
        });
    }

    // Close menu when clicking links
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth <= 991) {
                menu.classList.remove('active');
                menuIcon.classList.remove('bx-x');
            }
        });
    });

    // Dropdown toggles for mobile
    dropdowns.forEach(dropdown => {
        dropdown.addEventListener('click', (e) => {
            if (window.innerWidth <= 768) {
                e.preventDefault();
                const parent = dropdown.parentElement;
                parent.classList.toggle('active');
            }
        });
    });

    // Handle category link clicks
    const categoryLinks = document.querySelectorAll('.category-link');
    categoryLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth <= 768) {
                menu.classList.remove('active');
                menuIcon.classList.remove('bx-x');
                dropdowns.forEach(dropdown => {
                    dropdown.parentElement.classList.remove('active');
                });
            }
        });
    });

    // Navbar scroll behavior
    window.addEventListener('scroll', () => {
        const currentScroll = window.pageYOffset;
        
        if (currentScroll > lastScrollTop && currentScroll > 100) {
            navbar.classList.add('nav-hidden');
        } else {
            navbar.classList.remove('nav-hidden');
        }
        lastScrollTop = currentScroll;
    });

    // Close mobile menu when clicking outside
    document.addEventListener('click', (e) => {
        if (window.innerWidth <= 768) {
            const isMenuClick = menu.contains(e.target);
            const isMenuIconClick = menuIcon.contains(e.target);
            
            if (!isMenuClick && !isMenuIconClick) {
                menu.classList.remove('active');
                menuIcon.classList.remove('bx-x');
            }
        }
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
  }, 1000); // 100ms delay
});

