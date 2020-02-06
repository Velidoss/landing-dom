let openUserStat = function(pageName) {
  // выбираем поля с контентом
  let tabContent = document.getElementsByClassName("section-account__userstatistics-tabcontent");

  for (i = 0; i < tabContent.length; i++) {
    tabContent[i].style.display = "none";
  } 


  document.getElementById(pageName).style.display = "flex";
  
};

document.getElementById("dafaulOpen").click();