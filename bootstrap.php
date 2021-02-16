
<?php

/**
 * Recupera o nome do método do Request
 *
 * @return void
 */
function getRequestMethod() {
    $method = $_SERVER['REQUEST_METHOD'];

    return $method;
}

/**
 * Recupera a rota do Request
 *
 * @return void
 */
function getRequestRoute() {
    $directory = current( explode('/index.php', $_SERVER["SCRIPT_NAME"]) ) ?? '';
    $route = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $route = str_replace($directory, '', $route);

    return $route;
}