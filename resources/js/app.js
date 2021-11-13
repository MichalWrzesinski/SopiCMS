require('./bootstrap');

/**
 *	Required input
 */
$('label *:required[required]').each(function() {
    if($(this).attr('type') == 'checkbox' || $(this).attr('type') == 'radio') {
        $(this).parent('label').append('<span class="red">*</span>');
    } else {
        if($.trim($(this).parent('label').clone().children().remove().end().text()).length > 0) {
            $(this).before('<span class="red">*</span>');
        }
    }
});
