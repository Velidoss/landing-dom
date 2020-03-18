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

// вывод поля для ввода комментария к посту
let toggleCommentFieldStatus = false;

let ToggleCommentField = function(){
  let getToggleBtn = document.querySelector(".section-postlist__post-actions-comment_btn");
  let getCommentField = document.querySelector(".section-postlist__post-actions-comment_make");
  

  if(toggleCommentFieldStatus ===false){
      getCommentField.style.display = "flex";
      getToggleBtn.style.display = "none";
      toggleCommentFieldStatus = true;
  } 
  else if (toggleCommentFieldStatus === true){
    getCommentField.style.display = "none";
    getToggleBtn.style.display = "flex";
    toggleCommentFieldStatus = false;
  }

}
