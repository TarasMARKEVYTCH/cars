let nav = document.querySelector(".header");

// header animation on scroll 
window.addEventListener("scroll", (e) => {

  if (scrollY > 100) {
    nav.classList.add("active");
  } else {
    nav.classList.remove("active");
  }
});

// loaded image preview script
let loadFile = function (event) {
  let output = document.getElementById("output");
  output.src = URL.createObjectURL(event.target.files[0]);
  output.onload = function () {
    URL.revokeObjectURL(output.src);
  };
};
