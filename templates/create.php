<?php
require_once '../config/Database.php';
require_once '../Entity/Task.php';
require_once '../Repository/TaskRepository.php';
require_once '../Controller/TaskController.php';

$db = Database::getConnection();
$controller = new TaskController(new TaskRepository($db));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $isDone = isset($_POST['is_done']);
    $controller->createTask($title, $description, $isDone);
    header('Location: index.php');
    exit;
}
?>


<?php include 'header.php'; ?>
<div class="container">


    <form method="post">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input class="form-control" name="title" id="title">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" name="is_done">
            <label class="form-check-label" for="is_done">Terminée</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="index.php" class="btn btn-secondary">↩️ Retour</a>
    </form>
</div>
<?php include 'footer.php'; ?>