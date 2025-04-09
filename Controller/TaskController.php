<?php

class TaskController
{
    public function __construct(private TaskRepository $taskRepository) {}

    public function getAllTasks(): array
    {
        return $this->taskRepository->getAllTasks();
    }

    public function createTask(string $title, string $description, bool $isDone): void
    {
        $task = new Task(null, $title, $description, $isDone);
        $this->taskRepository->addTask($task);
    }

    public function deleteTask(int $id): void
    {
        $this->taskRepository->deleteTask($id);
    }

    public function getTaskById(int $id): ?Task
    {
        return $this->taskRepository->getTaskById($id);
    }

    public function updateTask(int $id, string $title, string $description, bool $isDone): void
    {
        $task = $this->getTaskById($id);
        if ($task) {
            $task->setTitle($title)->setDescription($description)->setIsDone($isDone);
            $this->taskRepository->updateTask($task);
        }
    }
}
