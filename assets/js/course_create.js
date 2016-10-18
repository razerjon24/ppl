function check_file(){
    str=document.getElementById('file').value.toUpperCase();
    suffix=".CSV";
    if(str.indexOf(suffix, str.length - suffix.length) == -1){
        alert('File type not allowed,\nAllowed file: *.csv');
        document.getElementById('file').value='';
    }
}
// function show_popup(){
//     // bg_disabler = document.getElementById("background_disabler");
//     popup = document.getElementById("popup_preview");
//     $this(popup).bPopup();
//     // bg_disabler.style.visibility = "visible";
//     // popup.style.visibility = "visible";
// }

// function close_popup(){
//     bg_disabler = document.getElementById("background_disabler");
//     popup = document.getElementById("popup_preview");
//     bg_disabler.style.visibility = "hidden";
//     popup.style.visibility = "hidden";
// }



$(document).on('change', '.btn-file :file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
});

$(document).ready( function() {
    $('.btn-file :file').on('fileselect', function(event, numFiles, label) {

        var input = $(this).parents('.input-group').find(':text'),
            log = numFiles > 1 ? numFiles + ' files selected' : label;

        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }

    });
});