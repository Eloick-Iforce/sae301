window.onload = function () {
    const burger = document.querySelector(".burger");
    const navbar = document.querySelector(".navbar");
    const navLink = document.querySelectorAll(".nav-link");
  
    burger.addEventListener("click", () => {
      navbar.classList.toggle("nav-open");
      burger.classList.toggle("burger-open");
      navLink.forEach((link) => {
        link.classList.toggle("nav-link-open");
      });
    });
  }


function delay(n) {
    return new Promise((resolve) => setTimeout(resolve, n));
}

function pageTransition() {
    var tl = gsap.timeline();
    tl.to(".loading-screen", {
        duration: 0.5,
        width: "100%",
        left: "0%",
        ease: "Expo.easeInOut",
    });

    tl.to(".loading-screen", {
        duration: 1,
        width: "100%",
        left: "100%",
        ease: "Expo.easeInOut",
        delay: 0.3,
    });
    tl.set(".loading-screen", { left: "-100%" });
}

function contentAnimation() {
    var tl = gsap.timeline();
    tl.from(".animate-this", {
        duration: 0.2,
        y: 30,
        opacity: 0,
        stagger: 0.4,
        delay: 0.2,
    });
}

$(function () {
    barba.init({
        transitions: [
            {
                async leave(data) {
                    const done = this.async();

                    pageTransition();
                    await delay(500);
                    done();
                },

                async enter(data) {
                    pageTransition();
                    await delay(400);
                    contentAnimation();
                    window.location.reload();
                },

                async once(data) {
                    contentAnimation();
                },
            },
        ],
    });
});



