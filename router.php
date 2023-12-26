<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = [
    //'/' => 'index.php',
    // '/admin' => 'dashboard.php',
    // '/admin/books' => 'controllers/admin/books/allbooks.php',
    // '/books/add' => 'controllers/forms/addbook.php',
    // '/books/update' => 'controllers/forms/updatebook.php',
    // '/books/delete' => 'controllers/forms/deletebook.php',
    // '/categories/add' =>    'controllers/forms/addcategory.php',
    // '/categories/update' => 'controllers/forms/updatecategory.php',
    // '/categories/delete' => 'controllers/forms/deletecategory.php',
    
];

function routeToController($uri, $routes){
    
if(array_key_exists($uri, $routes)){
    require $routes[$uri];

}else{
    abort();
}
}

function abort($code = 404){
    http_response_code($code);

    require "views/{$code}.php";
    die();
}
routeToController($uri, $routes);

?>