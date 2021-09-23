$(document).ready(function() {
    $('.go-down').click(function() {
        $('body, html').animate({
            scrollTop: $(document).height()
        }, 300);
    })
});