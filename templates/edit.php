<?php
require_once '../config/Database.php';
require_once '../Entity/Task.php';
require_once '../Repository/TaskRepository.php';
require_once '../Controller/TaskController.php';

$db = Database::getConnection();
$repository = new TaskRepository($db);
$controller = new TaskController($repository);

// Traitement du formulaire de modification
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $title = trim($_POST['title']);
    $isdone = trim($_POST['is_done']);
    $description = trim($_POST['description']);

    $controller->updateTask($id, $title, $description, $isdone);


    header("Location: index.php");
    exit;
}

// Affichage du formulaire
if (!isset($_GET['id'])) {
    die("ID de la tâche manquant.");
}

$id = intval($_GET['id']);
$task = $controller->getTaskById($id);

if (!$task) {
    die("Tâche introuvable.");
}
?>

<?php include 'header.php'; ?>

<h2 class="text-center">Modifier la tâche</h2>

<div class="container">
    <form method="post" action="edit.php?id=<?= $task->getId() ?>">
        <input type="hidden" name="id" value="<?= htmlspecialchars($task->getId()) ?>">

        <div class="mb-3">
            <label for="title" class="form-label">Titre</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($task->getTitle()) ?>" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4" required><?= htmlspecialchars($task->getDescription()) ?></textarea>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" name="is_done">
            <label class="form-check-label" for="is_done">Terminée</label>
        </div>

        <button type="submit" class="btn btn-success">✅ Enregistrer les modifications</button>
        <a href="index.php" class="btn btn-secondary">↩️ Retour</a>
    </form>
</div>


<?php include 'footer.php'; ?>