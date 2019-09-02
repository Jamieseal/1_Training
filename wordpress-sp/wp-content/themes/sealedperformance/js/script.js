// declare ID's
let open = document.getElementById("openNav");
let mobileNav = document.getElementById("mobileNav");
let navToggleOpen = document.getElementById("nav-toggle-open");
let navToggleClose = document.getElementById("nav-toggle-close");

//open nav
open.addEventListener("click", function(e) {
 	mobileNav.style.height = "100%";
	navToggleOpen.style.display = "none";
	navToggleClose.style.display = "block";

});

//close nav
navToggleClose.addEventListener("click", function(e) {
 	mobileNav.style.height = "0";
	navToggleOpen.style.display = "block";
	navToggleClose.style.display = "none";
});
