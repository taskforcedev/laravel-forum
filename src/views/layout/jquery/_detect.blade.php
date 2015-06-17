<?php
    /* This script detects if jQuery is not defined on the page and if so adds it into the head. */
?><script>
    if (typeof jQuery === 'undefined') {

        var s = document.createElement("script");
        s.type = "text/javascript";
        s.src = "//code.jquery.com/jquery-2.1.4.min.js";
        document.head.appendChild(s);
    }
</script>