<?php
    // Required Fields: $count, $title, $class
    // Optional Fields: $size

    if (!isset($size)) {
        $size = 1;
    }

    switch ($size) {
        case 1:
            $sizeClass = " col-xs-3 col-sm-3 col-md-3 col-lg-3";
            break;
        case 2:
            $sizeClass = " col-xs-6 col-sm-6 col-md-6 col-lg-6";
            break;
        case 3:
            $sizeClass = " col-xs-9 col-sm-9 col-md-9 col-lg-9";
            break;
        case 4:
            $sizeClass = " col-xs-12 col-sm-12 col-md-12 col-lg-12";
            break;
        default:
            $sizeClass = " col-xs-12 col-sm-12 col-md-12 col-lg-12";
            break;
    }
?><div class="{{ $sizeClass }}" style="margin-bottom: 10px;">
    <div class="{{ $class }} text-center" style="vertical-align: center; border: 1px solid #666;">
        &nbsp;
            <h4>{{ $title }}</h4>
            <h4>{{ $count }}</h4><br/>
        </div>
</div>
