const menuIcon = document.querySelector(".hamburger-menu");
const navMenu = document.querySelector(".nav-menu");

menuIcon.addEventListener("click", () => {
  navMenu.classList.toggle("change");
});

document.getElementById("open-popup-btn").addEventListener("click",function(){
  document.getElementById("open-popup-btn").style.display = "block";
  document.getElementsByClassName("popup")[0].classList.add("active");
});
 
document.getElementById("dismiss-popup-btn").addEventListener("click",function(){
  document.getElementById("open-popup-btn").style.display = "block";
  document.getElementsByClassName("popup")[0].classList.remove("active");
});

document.getElementById("popup-login-download").addEventListener("click",function(){
  document.getElementById("open-popup-btn").style.display = "block";
  document.getElementsByClassName("popup")[0].classList.add("active");
});