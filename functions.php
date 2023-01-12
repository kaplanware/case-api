<?php

if (! function_exists('codeprint')) {
    function codeprint($par, $bool = false, $height = "100%")
    {
        echo "<pre style='overflow:auto;height: " . (!$bool ? '' : $height) ."'>";
        print_r($par);
        echo "</pre>";
        if ($bool) die;
    }
}

if (! function_exists('codeprintTable')) {
    function codeprintTable($parArrays, $bool = false, $height = "100%")
    {
        echo "<table border='1' >";
        echo "<tr style='overflow:auto;height: " . (!$bool ? '' : $height) . "'>";
        foreach ($parArrays as $par) {
            echo "<td valign='top' style='min-width: 400px; padding-left: 50px;'>";
            codeprint($par, 0, $height);
            echo "</td>";
        }
        echo "</tr>";
        echo "</table>";
        if ($bool) die;
    }
}

function apiUrl($par){
    return 'https://api.organikhaberlesme.com/' . $par;
}

function session($par){
    return $_SESSION[$par];
}