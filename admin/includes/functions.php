<?php 
// __autoload will be scanning our application and will look for undeclared objects
// classAutoLoader = is a safety precautions just in case I forget to include
function classAutoLoader($class) {

    $class = strtolower($class);
    // $the_path = "includes/{$class}.php"; // This code is wrong
    $the_path = __DIR__.DS."{$class}.php"; // {} isn't required in newer php versions

    if(is_file($the_path) && !class_exists($class)){
        require_once($the_path);
    } else {
        // I had a really 
        die("Test");
    }
}

function redirect($location) {
    header("Location: {$location}");
}
// CHECK ABOVE CODE, NOT SURE IF CORRECT

spl_autoload_register('classAutoLoader');

?>