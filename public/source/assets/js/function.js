
// SHOW MORE DOC
function showMore(){
    // var elmt = document.getElementsByClassName("recipe-layout__truncate");
    // var showbtn = document.getElementById("showmore-btn");
    // if(elmt.offsetHeight > 340){
    //     console.log("ALO ALO");
    // }
    // else{
    //     elmt.style.height="auto";
    // }
    let elmt = document.getElementsByClassName("recipe-layout__truncate");
    for(let i=0;i<elmt.length;i++){
        const e = elmt[i];
        if(e instanceof HTMLElement){
            e.style.height = "auto";
            e.classList.add("clear-psuedo");
        }
    }
    var btnShow = document.getElementById("showmore-btn");


}
// END SHOW MORE DOC


// CHANGE IMAGE
function changeImg(imgs){
    let idxImg = document.getElementById("photo-hero");
    idxImg.src = imgs.src;
    console.log(idxImg);
}

// Function form review
function changeAction(action_nane){
    let check = document.getElementById('check-form');
    let formID = document.getElementById('review-form');
    let valueTag = document.getElementById("post_action");
    let textArea = document.getElementById('input_comment');

    if(action_nane == 1){
        formID.style.display="block";
        formID.action= check.action+"/1";
        valueTag.textContent="UPLOAD";
        textArea.style.display="none";
    }
    else if(action_nane == 2){

        formID.style.display="block";
        formID.action=check.action+"/2";
        valueTag.textContent="REVIEW";
        textArea.style.display="block";
    }
    else{
        formID.style.display="block";
        formID.action=check.action+"/3";
        valueTag.textContent="ASK";
        textArea.style.display="block";
    }
}

// FUNCTION SWITCH TAB

function switchTab(s){
    let s2 = document.getElementById('updateProfile');
    let s3 = document.getElementById('comment');
    let s1 = document.getElementById('recipeData');
    let tabContainer = document.getElementById('tab-pannels');
    s2.style.display="none";
    s3.style.display="none";
    let main = document.getElementById('recipeData');
    if(s == 1){
        s2.style.display="none";
        s3.style.display="none";
        s1.style.display="block";
    }
    else if(s == 2){
        s1.style.display="none";
        s3.style.display="none";
        s2.style.display="block";
    }
    else{
        s2.style.display="none";
        s1.style.display="none";
        s3.style.display="block";
    }
}

