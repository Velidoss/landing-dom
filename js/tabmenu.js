let openUserStat = function() {
  let tabContent = document.getElementsByClassName("tab-item");

  for (i = 0; i < tabContent.length; i++) {
    tabContent[i].style.display = "none";
  }
  let tabLinks = document.getElementsByClassName(
    "section-account__userstatistics-tabs-tablink"
  );
  for (i = 0; i < tabLinks.length; i++) {
    tabLinks[i].className = tabLinks[i].className.replace("active", "");
  }
  document.getElementsById("domain").style.display = "flex";
  event.currentTarget.className += "active";
};
