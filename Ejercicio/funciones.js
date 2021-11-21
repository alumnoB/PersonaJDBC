$(document).ready(function() {
    selected = true;
    $('#BtnSeleccionar').click(function() {
        if (selected) {
            $('#idiomas input[type=checkbox]').prop("checked", true);
            $('#BtnSeleccionar').val('Deseleccionar');
        } else {
            $('#idiomas input[type=checkbox]').prop("checked", false);
            $('#BtnSeleccionar').val('Seleccionar');
        }
        selected = !selected;
    });
});

$('#selectall').click(function() {
    $('select#estudios option').prop("selected",true);
});   

$('#deselectall').click(function() {
    $('select#estudios option').prop("selected",false);
});