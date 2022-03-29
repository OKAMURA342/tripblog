$(function() {
    $('.btn-trigger').on('click', function() {
        $(this).toggleClass('active');
        $(".nav").toggleClass("show");
        return false;
    });
});