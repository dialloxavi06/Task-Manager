<?php
require_once '../config/Database.php';
require_once '../Entity/User.php';
require_once '../Repository/UserRepository.php';

$db = Database::getConnection();
$repo = new UserRepository($db);

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$user = new User();
$user->setUsername($username);
$user->setPassword($password);

$repo->save($user);
header("Location: login.php");
