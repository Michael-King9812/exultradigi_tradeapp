// toast notification start
// window.onload = function() {
//     setTimeout(function() {
//       document.getElementById("toast1").classList.add("show", "slide-in");
//       setTimeout(function() {
//         document.getElementById("toast1").classList.remove("show", "slide-in");
//         document.getElementById("toast1").classList.add("slide-out");
//         setTimeout(function() {
//           document.getElementById("toast2").classList.add("show", "slide-in");
//           setTimeout(function() {
//             document.getElementById("toast2").classList.remove("show", "slide-in");
//             document.getElementById("toast2").classList.add("slide-out");
//             setTimeout(function() {
//               document.getElementById("toast3").classList.add("show", "slide-in");
//               setTimeout(function() {
//                 document.getElementById("toast3").classList.remove("show", "slide-in");
//                 document.getElementById("toast3").classList.add("slide-out");
//                 setTimeout(function() {
//                   document.getElementById("toast4").classList.add("show", "slide-in");
//                   setTimeout(function() {
//                     document.getElementById("toast4").classList.remove("show", "slide-in");
//                     document.getElementById("toast4").classList.add("slide-out");
//                   }, 4000);
//                 }, 4000);
//               }, 4000);
//             }, 4000);
//           }, 4000);
//         }, 4000);
//       }, 4000);
//     }, 4000);
//   };
  
// toast notification end

const toastContainer = document.querySelector('.toast-container');
const toastMessages = [  
    'Someone from Argentina has withdrawn $17,320',  
    'Someone from South Africa just made $2,580',  
    'Someone from United States just made a deposit of $5,000',  
    'Someone from Pakistan just made a withdrawal of $3,100',
];

let currentIndex = 0;

function showToast() {
  const toast = document.createElement('div');
  toast.classList.add('toast');
  toast.textContent = toastMessages[currentIndex];
  toastContainer.appendChild(toast);

  setTimeout(() => {
    toast.classList.add('toast-slide-in');
  }, 4000);

  setTimeout(() => {
    toast.classList.add('toast-slide-out');
  }, 8000);

  setTimeout(() => {
    toastContainer.removeChild(toast);
    currentIndex++;
    if (currentIndex < toastMessages.length) {
      showToast();
    } else {
      currentIndex = 0;
    }
  }, 12000);
}

setTimeout(() => {
  showToast();
}, 4000);