let changeData = function() {
  const openFormButton = document.querySelector(".open-form-btn");
  const changeDataButton = document.querySelector(".change-data-btn");
  const currentDataField = document.querySelector(".data-item-info");
  const newDataField = document.querySelector(".change-data-form");
  let changeFormStatus = false;

  if (changeFormStatus === false) {
    newDataField.style.display = "flex";
    openFormButton.style.display = "none";
    currentDataField.style.display = "none";
    changeFormStatus = true;
  } else if (changeFormStatus === true) {
    newDataField.style.display = "flex";
    openFormButton.style.display = "none";
    currentDataField.style.display = "none";
    changeFormStatus = false;
  }
};
