$(document).ready(function() {
    $('.index input').focus();
    $('.index input').keydown(function(e) {
        if (13 == e.which) {
            $(location).attr('href', '/' + $(this).val());
        }
    });
});
