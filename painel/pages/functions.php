<?php
 
/**
 * Conecta com o MySQL usando PDO
 */

 
/**
 * Verifica se o usu�rio est� logado
 */
function isLoggedIn()
{
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true)
    {
        return 'false';
    }
 
    return 'true';
}