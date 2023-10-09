<?php

function classAutoloader($class_name)
{   
    $name_arr = explode('\\', $class_name);
    $class_name = $name_arr[count($name_arr)  - 1];
    
    // List all the class directories in the array.
    $array_paths = array(
        '/models/',
        '/components/',
        '/controllers/'
    );

    foreach ($array_paths as $path) {
        $path = ROOT . $path . $class_name . '.php';
        if (is_file($path)) {
            include_once $path;
        }
    }
}
