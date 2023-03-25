const titre = document.querySelector(".page_title h1");
const titre2 = document.querySelector(".page_title h2");
const paragraphe = document.querySelector(".page_title p");
const alerte = document.querySelector(".alert");
const imgAccueil = document.querySelector("#imgAccueil");


gsap.from(titre, { x: -80, duration: 1.25, opacity: 0, delay:0.5 });
gsap.from(titre2, { x: 80, duration: 1.25, opacity: 0, delay:1 });
gsap.from(paragraphe, { y: 10, duration: 0.5, opacity: 0, delay: 1.5 });
gsap.from(imgAccueil, { x: -100, duration: 2.5, opacity: 0, delay: 1 });
gsap.to(alerte, { y: 10, duration: 0.5, opacity: 0, delay: 3.25, height: 0 });

const cordes = document.querySelectorAll(".corde");


cordes.forEach((corde) => {
  corde.addEventListener("mouseover", () => {
    gsap.to(corde, { y: 4, duration: 0.25 });
    gsap.to(corde, { y: -4, duration: 0.25, delay: 0.25 });
    gsap.to(corde, { y: 2, duration: 0.25, delay: 0.5 });
    gsap.to(corde, { y: -2, duration: 0.25, delay: 0.75 });
    gsap.to(corde, { y: 1, duration: 0.25, delay: 1 });
    gsap.to(corde, { y: -1, duration: 0.25, delay: 1.25 });
    gsap.to(corde, { y: 0, duration: 0.25, delay: 1.5 });
  });
});

const navbar = document.querySelector(".navbar");

gsap.from(navbar, { y: -80, duration: 1.25, opacity: 0 });
