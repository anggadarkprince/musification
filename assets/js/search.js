$(function () {

    $(document).on('keyup', '.search-input', function (e) {
        clearTimeout(timer);

        timer = setTimeout(function () {
            var val = $('.search-input').val();
            openPage('search.php?q=' + val, false);
        }, 400);
    });
});