var MenuItems=document.getElementById("MenuItems");
MenuItems.style.maxHeight="0px";
function menutoggle(){
    if(MenuItems.style.maxHeight=="0px"){
        MenuItems.style.maxHeight="200px";
    }
    else{
        MenuItems.style.maxHeight="0px";
    }
}
var productImage=document.getElementById("productImage");
var smallImage=document.getElementsByClassName("smallImage");
// smallImage[0].onclick=function(){
//     productImage.src=smallImage[0].src;
// }

function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
