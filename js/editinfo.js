const openFormButtons = document.querySelectorAll(".open-form-btn");
const changeDataButtons = document.querySelectorAll(".change-data-btn");
const currentDataFields = document.querySelectorAll(".data-item-info");
const newDataFields = document.querySelectorAll(".change-data-form");

const sectionInfoList = document.getElementsByClassName(
  "section-account__userinfo-data-item"
);

let changeData = function() {
  this.document.querySelector(".data-item-info").style.display = "none";
  this.document.querySelector(".open-form-btn").style.display = "none";
  this.document.querySelector(".change-data-form").style.display = "flex";
};

let confirmData = function() {
  this.document.querySelector(".data-item-info").style.display = "flex";
  this.document.querySelector(".open-form-btn").style.display = "flex";
  this.document.querySelector(".change-data-form").style.display = "none";
};
console.log(sectionInfoList[1]);
for (let i = 0; i < sectionInfoList.length; i++) {
  sectionInfoList[i].addEventListener("click", changeData);
  sectionInfoList[i].addEventListener("click", confirmData);
}
