<?php


require_once '../config/Database.php';
require_once '../Entity/Task.php';
require_once '../Repository/TaskRepository.php';
require_once '../Controller/TaskController.php';

$db = Database::getConnection();
$repository = new TaskRepository($db);
$controller = new TaskController($repository);

$tasks = $controller->getAllTasks();
?>

<?php include 'header.php'; ?>

<body>
    <h1 class="text-center">Tasks Management</h1>


    <div class="container">
        <table class="table table-hover table-bordered table-striped" border="1" cellpadding="5" cellspacing="0">
            <div class="box1">
                <h2>All TASKS</h2>
                <button> <a class="btn btn-primary" href="../templates/create.php">➕ ADD TASK</a> </button>
            </div>

            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Is Done?</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?= htmlspecialchars($task->getId()) ?></td>
                        <td><?= htmlspecialchars($task->getTitle()) ?></td>
                        <td><?= htmlspecialchars($task->getDescription()) ?></td>
                        <td><?= htmlspecialchars($task->isDone()) ?></td>
                        <td>
                            <a href="../templates/edit.php?id=<?= $task->getId() ?>" class="btn btn-warning">Modifier</a>
                            <a href="../templates/delete.php?id=<?= $task->getId() ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?');">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>


        </table>

    </div>
    <?php include 'footer.php'; ?>