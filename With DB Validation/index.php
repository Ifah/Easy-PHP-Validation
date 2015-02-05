<?php
require_once 'classes/Database.php';
require_once 'classes/ErrorHandler.php';
require_once 'classes/Validator.php';

$db = new Database;
$errorHandler = new ErrorHandler;

if(!empty($_POST)){
	$validator = new Validator($db, $errorHandler);

	$validation = $validator->check($_POST, [
		'username' => [
			'required' => true,
			'maxlength' => 20,
			'minlength' => 3,
			'alnum' => true,
			'unique_entry' => 'users'
		],
		'email' => [
			'required' => true,
			'maxlength' => 255,
			'email' => true,
			'unique_entry' => 'users'
		],
		'password' => [
			'required' => true,
			'minlength' => 6
		],
		'password_again' => [
			'required' => true,
			'match' => 'password'
		]
	]);

	if($validation->fails()){
		echo '<pre>', print_r($validation->errors()->all()), '</pre>';
		// echo '<pre>', print_r($validation->errors()->all('username')), '</pre>';
		// echo '<pre>', print_r($validation->errors()->first('username')), '</pre>';
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Validation</title>
</head>
<body>
	<form action="index.php" method="post">
		<div>
			Username: <input type="text" name="username">
		</div>
		<div>
			Email: <input type="text" name="email">
		</div>
		<div>
			Password: <input type="password" name="password">
		</div>
		<div>
			Confirm Password: <input type="password" name="password_again">
		</div>
		<div>
			<input type="submit">
		</div>
	</form>
</body>
</html>