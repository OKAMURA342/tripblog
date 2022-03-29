let nav = document.querySelector("nav");
let button = document.querySelector(".open");
button.addEventListener("click", function() {
    nav.classList.toggle("show");
    button.classList.toggle("bar");
});
console.log($("body"));