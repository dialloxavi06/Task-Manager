<?php

class TaskController
{
    public function __construct(private TaskRepository $taskRepository) {}

    // Récupérer toutes les tâches pour un utilisateur spécifique
    public function getAllTasksByUser(int $userId): array
    {
        return $this->taskRepository->findAllByUserId($userId);
    }

    // Récupérer une tâche par son ID et vérifier qu'elle appartient à un utilisateur
    public function getTaskById(int $id, int $userId): ?Task
    {
        $task = $this->taskRepository->findById($id);
        if ($task && $task->getUserId() === $userId) {
            return $task;
        }
        return null; // Retourne null si la tâche n'appartient pas à l'utilisateur
    }

    // Créer une nouvelle tâche pour un utilisateur
    public function createTask(string $title, string $description, bool $isDone, int $userId): void
    {
        $task = new Task(null, $title, $description, $userId, $isDone);
        $this->taskRepository->addTask($task);
    }

    // Mettre à jour une tâche existante pour un utilisateur
    public function updateTask(int $id, string $title, string $description, bool $isDone, int $userId): void
    {
        $task = $this->getTaskById($id, $userId);
        if ($task) {
            $task->setTitle($title)
                ->setDescription($description)
                ->setIsDone($isDone);
            $this->taskRepository->updateTask($task);
        }
    }

    // Supprimer une tâche pour un utilisateur
    public function deleteTask(int $id, int $userId): void
    {
        $task = $this->getTaskById($id, $userId);
        if ($task) {
            $this->taskRepository->deleteTask($id);
        }
    }

    // Récupérer toutes les tâches (sans filtrer par utilisateur)
    public function getAllTasks(): array
    {
        return $this->taskRepository->getAllTasks();
    }


    public function findAllTasksByUser(): array
    {
        // Cette méthode récupère TOUTES les tâches avec les utilisateurs → pas ce qu'on veut ici
        // Corrige en :
        throw new \Exception("Méthode obsolète. Utilisez getAllTasksByUser(int \$userId) à la place.");
    }
}
