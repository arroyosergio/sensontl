$(document).ready(function () {
    activarOpcionMenu();
});


function activarOpcionMenu() {
    var id = $('#navbar li.active').attr('id');
    $('#' + id).removeClass('active');
    $('#li-programa').addClass('active');
}