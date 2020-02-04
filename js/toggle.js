let toggleNavStatus = false;

let toggleBarHeight =
  document.querySelectorAll(".section-header__top-nav-menu li").length * 64;
console.log(toggleBarHeight);

let ToggleNav = function() {
  let getToggleBar = document.querySelector(".toggle");
  let getToggleBarMenu = document.querySelector(".toggle-menu");

  if (toggleNavStatus === false) {
    getToggleBar.style.height = toggleBarHeight + "px";
    getToggleBarMenu.style.visibility = "visible";

    toggleNavStatus = true;
  } else if (toggleNavStatus === true) {
    getToggleBar.style.height = "0";
    getToggleBarMenu.style.visibility = "hidden";

    toggleNavStatus = false;
  }
};
