
let trigger = document.getElementById("trigger");
let mobileNav = document.getElementById("mobileNav");


trigger.addEventListener("click", function(e) {
	mobileNav.classList.toggle('sidenavopen');
});