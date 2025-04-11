<?php

session_start();

require_once '../config/Database.php';
require_once '../Entity/Task.php';
require_once '../Repository/TaskRepository.php';
require_once '../Controller/TaskController.php';

// Vérifie que l'ID est présent et valide
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php?error=invalid_id');
    exit();
}

$taskId = (int)$_GET['id'];

// Vérifie que l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php?error=unauthorized');
    exit();
}

$userId = $_SESSION['user_id'];

// Instancie les objets nécessaires
$db = Database::getConnection();
$repository = new TaskRepository($db);
$controller = new TaskController($repository);

// Vérifie si la tâche appartient à l'utilisateur avant suppression (bonne pratique)
$task = $repository->findById($taskId);

if (!$task || $task->getUserId() !== $userId) {
    header('Location: index.php?error=not_found_or_forbidden');
    exit();
}

// Appelle le contrôleur pour supprimer la tâche

$success = $controller->deleteTask($taskId, $userId);

if ($success) {
    header('Location: index.php?success=deleted');
} else {
    header('Location: index.php?error=delete_failed');
}
exit();
