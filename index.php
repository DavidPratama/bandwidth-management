<?php
	include "vendor/autoload.php";
	
	date_default_timezone_set('Asia/Jakarta');	

	$router = new Phroute\RouteCollector();

	$router->get('/bwmg/manage', array('Manage', 'index'));

	$router->post('/bwmg/manage/add', array('Manage', 'doAdd'));

	$router->post('/bwmg/manage/edit/{ip:[a-zA-Z0-9/.]+}', array('Manage', 'doEdit'));

	$router->get('/bwmg/manage/delete/{ip:[a-zA-Z0-9/.]+}', array('Manage', 'doDelete'));

	$router->post('/bwmg/manage/shape', array('Manage', 'doShape'));	

	$router->get('/bwmg', array('Monitor', 'index'));

	$router->get('/bwmg/setup', array('Setting', 'setup'));	

	$router->post('/bwmg/setup/save', array('Setting', 'save'));

	$router->get('/bwmg/getBwUsage', array('System', 'getBwUsage'));

	$router->get('/bwmg/getIPBwUsage/{ip:[a-zA-Z0-9/.]+}', array('System', 'getIPBwUsage'));

	$router->get('/bwmg/getPortBwUsage/{port:[0-9]+}', array('System', 'getPortBwUsage'));

	$router->get('/bwmg/getPortsBwUsage', array('System', 'getPortsBwUsage'));

	$router->get('/bwmg/getClientsBwUsage', array('System', 'getClientsBwUsage'));

	$router->get('/bwmg/getResourceUsage', array('System', 'getResourceUsage'));	

	$router->post('/bwmg/report', array('Report', 'index'));

	$router->get('/bwmg/getGraphData', array('Report', 'getGraphData'));

	# NB. You can cache this object so you don't have to create the routes each request - massive speed gains
	$dispatcher = new Phroute\Dispatcher($router);

	$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

	// Print out the value returned from the dispatched function
	echo $response;