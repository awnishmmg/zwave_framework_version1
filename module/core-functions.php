<?php


#this perticular file is responsible for showing the list function available in the data

function userfunclist($file, $sort = FALSE) {

    $file = join("\n",file($file));
    preg_match_all('/function\s+(\w+)/', $file, $m);
    $functions = $m[1];
    if ($sort===TRUE) {
        asort($functions);
    }
    return $functions;
}

?>