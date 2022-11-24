<?php 
session_start();

require "vendor/autoload.php";


function getActionByName($name) {
	$name = 'App\\Actions\\'.$name."Action";
	return new $name();
}

function getViewByName($name) {
	$name = 'App\\Views\\'.$name."View";
	return new $name();
}

function getAction() {
	if (!isset($_REQUEST['action'])) $action = 'Default';
	else $action = $_REQUEST['action'];

	$actions = [
			'Default',
			'SignUpForm',
			'SignUp',
			'Logout',
			'Login',
			'UpdateUserForm',
			'UpdateUser',
			'AddSurveyForm',
			'AddSurvey',
			'GetMySurveys',
			'Search',
			'Vote'
		];

	if (!in_array($action, $actions)) $action = 'Default';
	return getActionByName($action);
}

$action = getAction();
$action->run();
$view = $action->getView();
$model = $action->getModel();
$view->run($model);
?>

