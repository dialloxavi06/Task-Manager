<?php
require_once '../Entity/Task.php';

class TaskRepository
{
    public function __construct(private \PDO $db) {}

    public function addTask(Task $task): void
    {
        $stmt = $this->db->prepare('INSERT INTO tache (title, description, is_done) VALUES (:title, :description, :is_done)');
        $stmt->execute([
            'title' => $task->getTitle(),
            'description' => $task->getDescription(),
            'is_done' => $task->isDone() ? 1 : 0,
        ]);
    }

    public function getAllTasks(): array
    {
        $stmt = $this->db->query('SELECT * FROM tache');
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn($row) => new Task($row['id'], $row['title'], $row['description'], (bool)$row['is_done']), $rows);
    }

    public function getTaskById(int $id): ?Task
    {
        $stmt = $this->db->prepare('SELECT * FROM tache WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? new Task($row['id'], $row['title'], $row['description'], (bool)$row['is_done']) : null;
    }

    public function updateTask(Task $task): bool
    {
        $stmt = $this->db->prepare('UPDATE tache SET title = :title, description = :description, is_done = :is_done WHERE id = :id');
        $stmt->execute([
            'id' => $task->getId(),
            'title' => $task->getTitle(),
            'description' => $task->getDescription(),
            'is_done' => $task->isDone() ? 1 : 0,
        ]);
        return $stmt->rowCount() > 0;
    }

    public function deleteTask(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM tache WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->rowCount() > 0;
    }
}
