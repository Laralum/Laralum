$(function() {

    // Sidebar Toggler
    function sidebarToggle(toogle) {
        var sidebar = $('#sidebar');
        var padder = $('.content-padder');
        if( toogle ) {
            sidebar.css({'display': 'inherit', 'x': -300});
            sidebar.transition({opacity: 1, x: 0}, 250, 'in-out');
            if( $( window ).width() > 960 ) {
                padder.transition({marginLeft: sidebar.css('width')}, 250, 'in-out');
            }
        } else {
            sidebar.css({'display': 'inherit', 'x': '0px'});
            sidebar.transition({x: -300, opacity: 0}, 250, 'in-out');
            padder.transition({marginLeft: 0}, 250, 'in-out');
        }
    }

    $('#sidebar_toggle').click(function() {
        var sidebar = $('#sidebar');
        var padder = $('.content-padder');
        if( sidebar.css('x') == '-300px' ) {
            sidebarToggle(true)
        } else {
            sidebarToggle(false)
        }
    });

    $('.content-padder').click(function() {
        if( $( window ).width() < 960 ) {
            sidebarToggle(false);
        }
    });

})
