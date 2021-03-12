 <?php
/**
 * @var \Core\Router
 */

$router->get('', 'PagesController@index');
$router->get('contacts', 'PagesController@contacts');
$router->post('contacts', 'PagesController@store');
