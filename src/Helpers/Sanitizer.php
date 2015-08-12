<?php namespace Taskforcedev\LaravelForum\Helpers;

use \DOMDocument;

class Sanitizer
{
    public function sanitize($html = '')
    {
        $html = $this->domDocSanitize($html);
        $html = $this->removeBloat($html);
        return trim($html);
    }

    public function domDocSanitize($html)
    {
        $dom = new DOMDocument();

        $dom->loadHTML($html);

        $script = $dom->getElementsByTagName('script');

        $remove = [];
        foreach($script as $item)
        {
            $remove[] = $item;
        }

        foreach ($remove as $item)
        {
            $item->parentNode->removeChild($item);
        }

        $html = $dom->saveHTML();

        return $html;
    }

    public function removeBloat($html)
    {
        $removals = [
            '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">',
            '<html>',
            '<body>',
            '</body>',
            '</html>'
        ];

        foreach ($removals as $rem) {
            $html = str_replace($rem, '', $html);
        }

        return $html;
    }
}
