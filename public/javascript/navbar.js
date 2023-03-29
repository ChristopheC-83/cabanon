const cleSol = document.querySelector(".cleSol");
const navbarMQ = document.getElementById("navbarMQ");
const overlay = document.querySelector(".overlay");
const lien = document.querySelectorAll(".navbar a");

if (window.matchMedia("(max-width: 767px)").matches) {
  let visible = false;

  if (!visible) {
    cleSol.addEventListener("click", () => {
      visible = true;
      console.log("cleSol click");
      console.log(visible);
      overlay.style.display = "block";
      overlay.style.zIndex = "9";
      navbarMQ.style.transform = "translateX(0)";
      navbarMQ.style.zIndex = "10";
    });
  }

  if (visible) {
    overlay.addEventListener("click", () => {
      visible = false;
      overlay.style.display = "none";
      overlay.style.zIndex = "4";
      navbarMQ.style.transform = "translateX(-50%)";
      navbarMQ.style.zIndex = "5";
      console.log("overlay cliké !")
    });
  }
}
