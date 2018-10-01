(function ($) {
    $(document).ready(function () {
        $('.topmenubutton').click(function () {
            $('.mobilemenu').toggleClass('active');
            // setMenuTop()
        });


        $('.mobilebutton, .content').click(function () {
            $('.mobilemenu').toggleClass('active');
        });
    });

    // function setMenuTop() {
    //     var h = $(window).scrollTop();
    //     $('.mobilemenu').animate({top:h}, 0)
    //     console.log(h)
    // }
})(jQuery);