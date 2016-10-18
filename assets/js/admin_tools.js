editActivated = 0;
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
        alert('Edit groups before proceeding to save');
    }
    else{
        $(document.getElementById('saveGroups')).closest('form').submit();
    }
}

function hideAddStudent(){
    overlay = document.getElementById("overlay");
    popup = document.getElementById("add-student_popup");
    overlay.style.visibility= "hidden";
    popup.style.visibility= "hidden";
}

function showAddStudent(){
    overlay = document.getElementById("overlay");
    popup = document.getElementById("add-student_popup");
    overlay.style.visibility= "visible";
    popup.style.visibility= "visible";
    popup.style.display = "inline";
}
function hideRemoveStudent(){
    overlay = document.getElementById("overlay");
    popup = document.getElementById("remove-student_popup");
    overlay.style.visibility= "hidden";
    popup.style.visibility= "hidden";
}

function showRemoveStudent(){
    overlay = document.getElementById("overlay");
    popup = document.getElementById("remove-student_popup");
    overlay.style.visibility= "visible";
    popup.style.visibility= "visible";
    popup.style.display = "inline";
}

function verifySelect(){
    select = document.getElementById("remove-student_ID");
    submit = document.getElementById("remove-student_submit");
    if(select.value != "default"){
        submit.setAttribute('type', 'submit');
    }
}