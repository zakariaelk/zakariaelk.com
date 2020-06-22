// ("use strict");

// import $ from "jquery";
// import anime from "animejs/lib/anime.es.js";
// import { gsap } from "gsap";
// import * as THREE from "three";
// import hoverEffect from "hover-effect";
// import "./vendors/jquery.ripples-min.js";
// import "./vendor.js";

/*-----------------------------------------------------------------------------------*/
/*  Masonry Grid Init
/*-----------------------------------------------------------------------------------*/

var grid = document.querySelector(".project-grid");

if (grid) {
  var msnry = new Masonry(grid, {
    columnWidth: ".grid-sizer",
    gutter: ".gutter-sizer",
    itemSelector: ".grid-item",
    percentPosition: true,
  });

  msnry.on("layoutComplete", function (items) {
    console.log(items.length);
  });
  // trigger initial layout
  msnry.layout();
}

/*-----------------------------------------------------------------------------------*/
/*  InViewPort ?
/*-----------------------------------------------------------------------------------*/

function inViewPort(elem) {
  var elemPos = elem.getBoundingClientRect();
  return !(elemPos.top > 900);
}

/*-----------------------------------------------------------------------------------*/
/*  Image Preload
/*-----------------------------------------------------------------------------------*/

function preloadimages(arr) {
  let newimages = [];
  let loadedimages = 0;
  let postaction = function () { }
  arr = (typeof arr != "object") ? [arr] : arr

  function imageloadpost() {
    loadedimages++
    if (loadedimages == arr.length) {
      postaction(newimages)
    }
  }

  for (var i = 0; i < arr.length; i++) {
    newimages[i] = new Image()
    newimages[i].src = arr[i].src
    newimages[i].onload = function () {
      imageloadpost()
    }
    newimages[i].onerror = function () {
      imageloadpost()
    }
  }
  return { //return blank object with done() method
    done: function (f) {
      postaction = f || postaction //remember user defined callback functions to be called when images load
    }
  }
}

/*-----------------------------------------------------------------------------------*/
/*  Reveal Page Content On Scroll
/*-----------------------------------------------------------------------------------*/

var revealX = document.querySelectorAll(".page-content .reveal-x");
var revealY = document.querySelectorAll(".page-content .reveal-y");

function revealHor(elem) {
  // ES6 Way
  [].forEach.call(elem, function (xElem) {
    if (inViewPort(xElem)) {
      xElem.style.opacity = "1";
      xElem.style.transform = "translateY(0px)";
    } else {
      xElem.style.opacity = "0";
      xElem.style.transform = "translateX(-70px)";
    }
  });
}

function revealVer(elem) {
  [].forEach.call(elem, function (yElem) {
    if (inViewPort(yElem)) {
      yElem.style.opacity = "1";
      yElem.style.transform = "translateY(0px)";
    } else {
      yElem.style.opacity = "0";
      yElem.style.transform = "translateY(100px)";
    }
  });
}

/*-----------------------------------------------------------------------------------*/
/*  Reveal Work & Visual Item
/*-----------------------------------------------------------------------------------*/

const workItem = document.querySelectorAll(".project-container");
const workVisual = document.querySelectorAll(".project-visual a");
const workText = document.querySelectorAll(".project-text");
const visualItem = document.querySelectorAll(".visual-figure img");

function revealWork(itemReveal) {
  [].forEach.call(itemReveal, function (item) {
    if (inViewPort(item)) {
      item.classList.add("on");
    } else {
      // item.classList.remove("on");
    }
  });
}

/*-----------------------------------------------------------------------------------*/
/*  Reveal About Section
/*-----------------------------------------------------------------------------------*/

const aboutText = document.querySelector("#about");

function revealAbout() {
  inViewPort(aboutText) ? aboutText.classList.add("on") : aboutText.classList.remove("on");
}

/*-----------------------------------------------------------------------------------*/
/*  Update On First Scroll
/*-----------------------------------------------------------------------------------*/

var scrollPos = 0;

const header = document.querySelector("header");
const navWrapper = document.querySelector(".nav-wrapper");
const body = document.querySelector("body");
const logoMask = document.querySelector(".bottom-part");
const bottomInfo = document.querySelector("#about");

function updateOnScroll() {
  var topY = body.getBoundingClientRect().top;
  var bottomY = bottomInfo.getBoundingClientRect().top;
  topY < 0
    ? (header.classList.add("scrolled"), logoMask.classList.add("scrolled"), navWrapper.classList.add("scrolled"))
    : (header.classList.remove("scrolled"), logoMask.classList.remove("scrolled"), navWrapper.classList.remove("scrolled"));

  if (bottomY < window.innerHeight / 2) {
    // logoMask.classList.remove("scrolled");
  }
}

/*-----------------------------------------------------------------------------------*/
/*  Anchor Smooth Scroll
/*-----------------------------------------------------------------------------------*/

function anchorLinkHandler(e) {
  const distanceToTop = (el) => Math.floor(el.getBoundingClientRect().top);

  e.preventDefault();
  const targetID = this.getAttribute("href");
  const targetAnchor = document.querySelector(targetID);
  if (!targetAnchor) return;
  const originalTop = distanceToTop(targetAnchor);
  window.scrollBy({ top: originalTop, left: 0, behavior: "smooth" });

  const checkIfDone = setInterval(function () {
    const atBottom = window.innerHeight + window.pageYOffset >= document.body.offsetHeight - 2;
  }, 2000);
}

const linksToAnchors = document.querySelectorAll('a[href^="#"]');
linksToAnchors.forEach((each) => (each.onclick = anchorLinkHandler));

/*-----------------------------------------------------------------------------------*/
/*  Ripple
/*-----------------------------------------------------------------------------------*/

const rippleObj = document.querySelector(".side-visual");

if (rippleObj) {
  jQuery(document).ready(function () {
    "use strict";

    let screenSize = $(window).width();

    if ($(window).width() < 768) {
      screenSize = 512;
    } else {
      screenSize = 256;
    }

    $(".side-visual").ripples({
      dropRadius: 20,
      perturbance: 0.04,
      resolution: screenSize,
      imageUrl: window.location.href + "wp-content/themes/zakariaelk/src/img/png/water-shape.png",
    });

    // Automatic drops
    setInterval(function () {
      var $el = $(".side-visual");
      var x = Math.random() * $el.outerWidth();
      var y = Math.random() * $el.outerHeight();
      var dropRadius = 20;
      var strength = 0.01;

      $el.ripples("drop", x, y, dropRadius, strength);
    }, 400);
  });
}

/*-----------------------------------------------------------------------------------*/
/*  Liquid Onhover Transition
/*-----------------------------------------------------------------------------------*/

const workImg = Array.from(document.querySelectorAll('.project-visual img'));


preloadimages(workImg).done(function () {

  [].forEach.call(workItem, function (item) {
    const imgWrapper = item.querySelector('.project-visual');
    const img1 = item.querySelector(".img-1").src;
    const img2 = item.querySelector(".img-2").src;


    const myAnimation = new hoverEffect({
      parent: imgWrapper,
      intensity: 0.2,
      speedIn: 1.8,
      speedOut: 1.6,
      image1: img1,
      image2: img2,
      displacementImage: window.location.href + "wp-content/themes/zakariaelk/src/img/png/heightMap.png",
      imagesRatio: 640 / 1140,
    });

    item.addEventListener('mouseover', myAnimation.next);
    item.addEventListener('mouseout', myAnimation.previous);
  });

})




/*-----------------------------------------------------------------------------------*/
/*  Animation Timeline
/*-----------------------------------------------------------------------------------*/

const loader = document.querySelector("#loader");
const htmlDom = document.querySelector("html");
/* 1. Home Anime */

const welcomeTxt = document.querySelector(".welcome-statement");
const discoverBtn = document.querySelector(".discover");
const homeCanvas = document.querySelector(".side-visual");

function homeAnim() {
  let homeAnim = anime.timeline({
    duration: 250,
  });

  homeAnim
    .add({
      targets: loader,
      complete: function () {
        loader.classList.add("off");
      },
    })
    .add({
      targets: htmlDom,
      complete: function () {
        htmlDom.classList.remove("no-scroll");
      },
    })
    .add({
      targets: homeCanvas,
      begin: function () {
        homeCanvas.classList.add("on");
      },
    })
    .add({
      targets: welcomeTxt,
      complete: function () {
        welcomeTxt.classList.add("on");
      },
    })
    .add({
      targets: discoverBtn,
      complete: function () {
        discoverBtn.style.opacity = 1;
      },
    });
}

/* 2. Work Page Anime */

const bannerTxt = document.querySelector(".banner-txt");
const bannerVisual = document.querySelector(".banner-visual");

function workAnim() {
  let workAnim = anime.timeline({
    duration: 250,
  });

  workAnim
    .add({
      targets: loader,
      complete: function () {
        loader.classList.add("off");
      },
    })
    .add({
      targets: htmlDom,
      complete: function () {
        htmlDom.classList.remove("no-scroll");
      },
    })
    .add({
      targets: bannerTxt,
      begin: function () {
        bannerTxt.classList.add("on");
      },
    })
    .add({
      targets: bannerVisual,
      begin: function () {
        bannerVisual.classList.add("on");
      },
    });
}

/* 3. Default */

function defaultAnim() {
  let defaultAnim = anime.timeline({
    duration: 250,
  });

  defaultAnim
    .add({
      targets: loader,
      complete: function () {
        loader.classList.add("off");
      },
    })
    .add({
      targets: htmlDom,
      complete: function () {
        htmlDom.classList.remove("no-scroll");
      },
    });
}

/*-----------------------------------------------------------------------------------*/
/*  Time Zone Custom Welcome Txt
/*-----------------------------------------------------------------------------------*/

const dynamicWelcome = document.querySelector(".dynamic-welcome span");
const today = new Date();
const time = today.getHours();

if (dynamicWelcome) {
  if (time >= 6 && time <= 12) {
    dynamicWelcome.innerHTML = "Good morning!";
  } else if (time >= 12 && time <= 17) {
    dynamicWelcome.innerHTML = "Good afternoon!";
  } else {
    dynamicWelcome.innerHTML = "Greetings!";
  }
}

console.log(time);

/*-----------------------------------------------------------------------------------*/
/*  Global Event Listeners
/*-----------------------------------------------------------------------------------*/

window.addEventListener("scroll", function () {
  requestAnimationFrame(updateOnScroll);
  revealWork(workVisual);
  revealWork(workText);
  revealWork(visualItem);
  revealAbout();
});

/*-----------------------------------------------------------------------------------*/
/*  On Load - Functions
/*-----------------------------------------------------------------------------------*/

function init() {
  if (document.body.contains(welcomeTxt)) {
    homeAnim();
  } else if (document.body.contains(bannerVisual)) {
    workAnim();
  } else {
    defaultAnim();
  }
  revealWork(workVisual);
  revealWork(workText);
  revealWork(visualItem);
  revealAbout();

  // console.log("Height of the doc is: " + docHeight);
}

window.onload = init;
