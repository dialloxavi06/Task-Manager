<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
// Vérifier si le nom d'utilisateur existe dans la session
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Utilisateur inconnu';


require_once '../config/Database.php';
require_once '../Entity/Task.php';
require_once '../Repository/TaskRepository.php';
require_once '../Controller/TaskController.php';

$db = Database::getConnection();
$repository = new TaskRepository($db);
$controller = new TaskController($repository);

$userId = $_SESSION['user_id'];
$tasks = $controller->getAllTasksByUser($userId);
?>


<?php include 'header.php'; ?>

<!-- Affichage du nom d'utilisateur et bouton de déconnexion -->
<div class="container">
    <h1 class="text-center">Bienvenue, <?= htmlspecialchars($username) ?>!</h1>
    <a href="logout.php" class="btn btn-danger">Se déconnecter</a>
</div>

<div class="container">
    <h1 class="text-center">Tasks Management</h1>
    <div class="box1">
        <h2>Mes tâches</h2>
        <a class="btn btn-primary" href="../templates/create.php">➕ Ajouter une tâche</a>
    </div>

    <table class="table table-hover table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Terminée ?</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tasks as $task): ?>
                <tr>
                    <td><?= htmlspecialchars($task->getId()) ?></td>
                    <td><?= htmlspecialchars($task->getTitle()) ?></td>
                    <td><?= htmlspecialchars($task->getDescription()) ?></td>
                    <td><?= $task->isDone() ? '✅' : '❌' ?></td>
                    <td>
                        <a href="../templates/edit.php?id=<?= $task->getId() ?>" class="btn btn-warning">Modifier</a>
                        <a href="../templates/delete.php?id=<?= $task->getId() ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>