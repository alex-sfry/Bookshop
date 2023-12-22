<?php

/**
 * @param Throwable $exception
 *
 * @return void
 */
function exception_handler(Throwable $exception): void
{
    echo $exception->getMessage();
}
