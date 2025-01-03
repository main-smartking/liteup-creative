

document.getElementById('menu-icon').addEventListener('click', function () {
  const navbarMenu = document.querySelector('.navbar-menu');
  navbarMenu.classList.toggle('active');
  this.classList.toggle('bx-x');
});



  // STICKY HEADER SCROLL Y
  window.onscroll = function() {myFunction()};
    var header = document.getElementById("navbar-section");
    var sticky = header.offsetTop;

    function myFunction(){
      
    if (window.pageYOffset > sticky - 50) {
      header.classList.add("sticky");
    } else {
      header.classList.remove("sticky");
    }
  }

//   window.onscroll = function() { myFunction() };

// var header = document.getElementById("navbar-section");
// var sticky = header.offsetTop;

// function myFunction() {
//   if (window.pageYOffset > sticky + 5) { // After scrolling more than 40px
//     header.classList.add("sticky");
//     header.style.top = '2rem';  // Move the header to 2rem from the top
//   } else if (window.pageYOffset > sticky) { // When scrolling past the sticky point but less than 40px
//     header.classList.add("sticky");
//     header.style.top = '4.5rem';  // Default position when it's sticky but before moving up
//   } else {
//     header.classList.remove("sticky");
//     header.style.top = '4.5rem';  // Reset to initial position when not sticky
//   }
// }


// HOME PAGE AUTO TYPE STYLE
var typed = new Typed('.auto-type', {    
  strings: ['Digital Growth'],
  typeSpeed: 120,
  backSpeed: 100,
  loop: true,
});

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
document.querySelectorAll('.menu a').forEach(link => {
  link.addEventListener('click', () => {
    menu.classList.remove('active'); // Hide the menu
    menuIcon.classList.remove('bx-x'); // Change the icon back to hamburger
  });
});
// HANDLING SCROLLING SECTION
window.addEventListener('scroll', function() {
    const sections = document.querySelectorAll('section');
    const navLinks = document.querySelectorAll('.menu a');
  
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

