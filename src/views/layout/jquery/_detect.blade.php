<?php
    /* This script detects if jQuery is not defined on the page and if so adds it into the head. */
?><script>
    if (typeof jQuery === 'undefined') {
        $("head").prepend("<script src='//code.jquery.com/jquery-2.1.4.min.js'><\/script>");
    }
</script>