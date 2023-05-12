$(function() {

    $(':input[type="submit"]').click(function() {
        $(':input[type="submit"]').addClass('disabled');
        $('span.d-none').removeClass('d-none');
        localStorage.clear();
    });

});