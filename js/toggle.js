let toggleNavStatus = false;

let ToggleNav = function() {
  let getToggleBar = document.querySelector(".toggle");
  let getToggleBarMenu = document.querySelector(".toggle-menu");

  

  if (toggleNavStatus === false) {
    getToggleBar.style.height = "200px";
    getToggleBarMenu .style.visibility = "visible";


    toggleNavStatus = true;
  } else if (toggleNavStatus === true) {
    getToggleBar.style.height = "0";
    getToggleBarMenu .style.visibility = "hidden";

    toggleNavStatus = false;
  }
};
