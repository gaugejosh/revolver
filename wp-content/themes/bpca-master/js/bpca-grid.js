// wait for document to load before running script
$(document).ready(function () {

    // cache some variables
    var $grid = $('.grid');

    // setup click action on .grid-button element
    $grid.on('click', function () {
        // define some variables
        var $target = $(this).find('.grid-description').parent().nextAll('.grid-alt:first');

        // toggle the active class on current element
        $(this).toggleClass('active');

        // close any open description containers
        if ($('.grid').not($(this)).hasClass('active')) {
            $('.grid').removeClass('active');
        }

        // copy description and append it to container
        var $content = $(this).find('.grid-description').html();

        // display content
        $target.html($content).toggle();

    });

});