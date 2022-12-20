<?php

spl_autoload_register(function ($name){
    $name = str_replace(["khamdullaevuz", "\\"], ["", "/"], $name);
    $name = __DIR__ . $name . ".php";
    require $name;
});

(new \khamdullaevuz\telegram\Polling())->handle();