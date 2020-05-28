let header = document.getElementById("admin_menu");
let btns = header.getElementsByClassName("food-menu-item");
for (var i = 0; i < btns.length; i++) {
    btns[i].addEventListener("click", function() {
        let current = document.getElementsByClassName("active-menu");
        if (current.length > 0) {
            current[0].className = current[0].className.replace(" active-menu", "");
        }
        this.className += " active-menu";
    });
}

document.getElementById('recipe_fillter').ingre_cat.onchange = function() {
    let newaction = this.value;
    document.getElementById('recipe_fillter').action = newaction;
};
