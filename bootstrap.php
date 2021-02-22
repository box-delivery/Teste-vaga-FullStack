
<?php

/**
 * Recupera o nome do método do Request
 *
 * @return string
 */
function getRequestMethod() 
{
    $method = $_SERVER['REQUEST_METHOD'];

    return $method;
}

/**
 * Recupera a rota do Request
 *
 * @return string
 */
function getRequestRoute() 
{
    $directory = current(explode('/index.php', $_SERVER["SCRIPT_NAME"])) ?? '';
    $route = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $route = str_replace($directory, '', $route);

    return $route;
}

/**
 * Verifica se uma string é um e-mail válido.
 *
 * @param string $email
 * @return boolean
 */
function validEmail($email) 
{
    return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) ? false : true;
}