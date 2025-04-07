// Menangani masalah pada animasi semua logo
const logoContainer = document.querySelector('.logo-container');
const logos = logoContainer.innerHTML;
logoContainer.innerHTML += logos;

//  // Menangani scroll dan collapse navbar
//         document.querySelectorAll('.nav-scroll').forEach(link => {
//             link.addEventListener('click', function(e) {
//                 e.preventDefault();

//                 // Menutup navbar mobile jika terbuka
//                 const navbarCollapse = document.querySelector('.navbar-collapse');
//                 if (navbarCollapse.classList.contains('show')) {
//                     navbarCollapse.classList.remove('show');
//                 }

//                 // Scroll ke section yang dituju
//                 const targetId = this.getAttribute('href');
//                 const targetSection = document.querySelector(targetId);
//                 if (targetSection) {
//                     const offsetTop = targetSection.offsetTop - 75; // Sesuaikan dengan tinggi navbar
//                     window.scrollTo({
//                         top: offsetTop,
//                         behavior: 'smooth'
//                     });
//                 }
//             });
//         });


