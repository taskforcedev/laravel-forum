<?php
/* This script detects if bootstrap is not defined on the page and if so adds it into the head. */
?><script>
$(document).ready(function() {

    var bootstrap_enabled = (typeof $().modal == 'function');
    if (!bootstrap_enabled) {
        $("head").prepend("<script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'><\/script>");
    }

    if( verifyStyle('form-inline') )
    {
    $("head").prepend("<link rel='stylesheet' href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css' type='text/css' media='screen'>");
    }
    else
    {
    //alert('bootstrap already loaded');
    }
});
</script>