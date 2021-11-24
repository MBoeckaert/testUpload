<?php
// set routes
$routes = array(
  'home' => array(
    'controller' => 'Pages',
    'action' => 'index'
  ),
  'profile' => array(
    'controller' => 'Pages',
    'action' => 'profile'
  ),
  'login' => array(
    'controller' => 'Pages',
    'action' => 'login'
  ),
  'task-api' => array(
    'controller' => 'Pages',
    'action' => 'taskApi'
  )
);

if(empty($_GET['page'])) {
  $_GET['page'] = 'home';
}
if(empty($routes[$_GET['page']])) {
  header('Location: index.php');
  exit();
}

$route = $routes[$_GET['page']];
