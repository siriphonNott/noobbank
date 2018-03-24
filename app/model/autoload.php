<?php

if (!isset($_SESSION)) {
    session_start();
}

function __autoload($class)
{
    $parts = explode('\\', $class);
    require_once end($parts) . '.php';
}
