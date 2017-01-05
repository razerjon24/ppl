editActivated = 0;
AddStudentVisibility = 0;
RemoveStudentVisibility = 0;



// function hideCreateEvaluation(){
//     overlay = document.getElementById("overlay");
//     popup = document.getElementById("create-evaluation_popup");
//     overlay.style.visibility= "hidden";
//     popup.style.visibility= "hidden";
// }

function showCreateEvaluation(){
//    overlay = document.getElementById("overlay");
    popup = document.getElementById("create-evaluation_popup");
//    overlay.style.visibility= "visible";
//    popup.style.visibility= "visible";
    $(popup).bPopup({
        onOpen: function() { $('#evaluation_start').datepicker(); }
    });
}

function groupsActive(){
    groups = document.getElementsByClassName("groups_field");
    saveButton = document.getElementById("saveGroups");
    i=0;
    if(editActivated == 0){
        editActivated = 1;
        saveButton.setAttribute('type', 'submit');
        while(i < groups.length){
            groups[i].disabled = false;
            i++;
        }
    }
    else{
        editActivated = 0;
        saveButton.setAttribute('type', 'button');
        while(i < groups.length){
            groups[i].disabled = true;
            i++;
        }
    }

}

function verifyEdit(){
    if(editActivated == 0){
        alert('Edit groups before saving!');
    }
}

function date_checker(){
    evaluation_start = document.getElementById("evaluation_start");
    evaluation_end = document.getElementById("evaluation_end");
    submit_evaluation = document.getElementById("submit_evaluation");
    Start_date = new Date(evaluation_start.value);
    End_date = new Date(evaluation_end.value);
    if(Start_date>End_date){
        alert('Start date must be set before end date');
        submit_evaluation.setAttribute('type', 'button');
    }
    else{
        submit_evaluation.setAttribute('type', 'submit');
    }
}

function showBar(){
    loading = document.getElementById("loading-bar");
    // popup = document.getElementById("create-evaluation_popup");
    // popup.style.visibility= "hidden";
    // loading.style.visibility= "visible";
    $(loading).bPopup({
        modalClose :  false,
        escClose : false
    });
}
