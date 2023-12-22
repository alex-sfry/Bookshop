<?php

namespace App\Core;

/**
 * [class Controller]
 */
class Controller
{
    /**
     * @param mixed|null $view
     * @param mixed|null $data
     * @param string $title
     *
     * @return void
     */
    protected function render(mixed $view = null, mixed $data = null, string $title = ''): void
    {
        if (!$view || !$data) {
            return;
        }

        extract($data['objects'], EXTR_SKIP);
        extract($data['vars'], EXTR_SKIP);

        require_once($view);
    }
}
