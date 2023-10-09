<?php

namespace App\Core;

class Controller
{
    protected function render($view = null, $data = null, $title = '')
    {   
        if (!$view || !$data) return;
        extract($data['objects'], EXTR_SKIP);
        extract($data['vars'], EXTR_SKIP);

        require_once($view);
    }
}
