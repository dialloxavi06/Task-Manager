<?php
require_once '../Entity/Task.php';

class TaskRepository
{
    public function __construct(private \PDO $db) {}

    // Ajouter une tâche
    public function addTask(Task $task): void
    {

        $stmt = $this->db->prepare('INSERT INTO tache (title, description, user_id, is_done) VALUES (:title, :description, :user_id, :is_done)');
        $stmt->execute([
            'title' => $task->getTitle(),
            'description' => $task->getDescription(),
            'user_id' => $task->getUserId(),
            'is_done' => $task->isDone() ? 1 : 0,
        ]);
    }

    // Récupérer toutes les tâches pour un utilisateur spécifique
    public function findAllByUserId(int $userId): array
    {
        $stmt = $this->db->prepare("SELECT * FROM tache WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        $tasks = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $tasks[] = new Task(
                $row['id'],
                $row['title'],
                $row['description'],
                $row['user_id'],
                (bool)$row['is_done']
            );
        }
        return $tasks;
    }

    // Sauvegarder une nouvelle tâche
    public function save(Task $task): void
    {
        $stmt = $this->db->prepare("INSERT INTO tache (title, description, user_id, is_done) VALUES (:title, :description, :user_id, :is_done)");
        $stmt->execute([
            'title' => $task->getTitle(),
            'description' => $task->getDescription(),
            'user_id' => $task->getUserId(),
            'is_done' => $task->isDone() ? 1 : 0,
        ]);
    }

    // Mettre à jour une tâche existante
    public function updateTask(Task $task): bool
    {
        $stmt = $this->db->prepare('UPDATE tache SET title = :title, description = :description, user_id = :user_id, is_done = :is_done WHERE id = :id');
        $stmt->execute([
            'id' => $task->getId(),
            'title' => $task->getTitle(),
            'description' => $task->getDescription(),
            'user_id' => $task->getUserId(),
            'is_done' => $task->isDone() ? 1 : 0,
        ]);
        return $stmt->rowCount() > 0;
    }

    // Supprimer une tâche par son ID
    public function deleteTask(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM tache WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->rowCount() > 0;
    }

    // Récupérer une tâche par son ID
    public function findById(int $id): ?Task
    {
        $stmt = $this->db->prepare("SELECT * FROM tache WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($row) {
            return new Task(
                $row['id'],
                $row['title'],
                $row['description'],
                $row['user_id'],
                (bool)$row['is_done']
            );
        }

        return null; // Retourne null si aucune tâche n'est trouvée
    }

    // Récupérer toutes les tâches (sans filtrer par utilisateur)
    public function getAllTasks(): array
    {
        $stmt = $this->db->query("SELECT * FROM tache");
        $tasks = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $tasks[] = new Task(
                $row['id'],
                $row['title'],
                $row['description'],
                $row['user_id'],
                (bool)$row['is_done']
            );
        }
        return $tasks;
    }

    public function findAllTaskDetailsWithUsers(): array
    {
        $sql = "SELECT title, description, created_at, is_done 
            FROM user 
            JOIN tache ON user.id = tache.user_id";
        $stmt = $this->db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
