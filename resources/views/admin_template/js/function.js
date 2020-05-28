// Add active class to menu item
let header = document.getElementById("admin_menu");
let menu_item = header.getElementsByClassName("food-menu-item");
for( let i = 0; i <= menu_item.length ; i++){
    menu_item[i].addEventListener("click", function () {
       let current = document.getElementsByClassName("active-menu");
       current[0].className = current[0].className.replace(" active-menu","");
       this.className += " active-menu";
    });
}

// add active class to menu navbar
let x = document.getElementById("pagination");
let pagination_item = header.getElementsByClassName("pagination_item");
for(let k = 0; k<= pagination_item.length ; k++){
    pagination_item[i].addEventListener("click",function(){
       let current = document.getElementsByClassName("active");
       current[0].className = current[0].className.replace("active-menu","");
       this.className += " active-menu";
    });
}

// function set visibility for div
// let m = document.getElementsByClassName("col-title");
// for(let t = 0 ; t <= m.length; t++){
//    m[t].addEventListener("mouseover","over");
//    m[t].addEventListener("mouseout","out");
// }
// function over() {
//     for( let i = 0 ; i<= m.length ; i++){
//
//     }
// }
