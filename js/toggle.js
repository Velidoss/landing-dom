let toggleNavStatus = false;

let ToggleNav = function() {
  let getToggleBar = document.querySelector(".toggle");

  if (toggleNavStatus === false) {
    getToggleBar.style.visibility = "visible";

    toggleNavStatus = true;
  } else if (toggleNavStatus === true) {
    getToggleBar.style.visibility = "hidden";

    toggleNavStatus = false;
  }
};
