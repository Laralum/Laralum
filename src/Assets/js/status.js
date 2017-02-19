$(function() {
    var timeout = null;
    function checkStatus() {
        clearTimeout(timeout);
        var status = $('#status');
        status.text(status.data('online-text'));
        status.removeClass('uk-label-warning');
        status.addClass('uk-label-success');
        timeout = setTimeout(function() {
            status.text(status.data('away-text'));
            status.removeClass('uk-label-success');
            status.addClass('uk-label-warning');
        }, status.data('interval'));
    }

    var status = $('#status');
    if( status.length ) {
        if( status.data('enabled') == true ) {
            checkStatus();
            $(document).on('mousemove', function() {
                checkStatus();
            });
        } else {
            status.css({'display': 'none'});
        }
    }

});
