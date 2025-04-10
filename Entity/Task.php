<?php

class Task
{
    public function __construct(
        private ?int $id,
        private string $title,
        private string $description,
        private int $user_id,
        private bool $isDone
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getTitle(): string
    {
        return $this->title;
    }
    public function getDescription(): string
    {
        return $this->description;
    }
    public function getUserId(): int
    {
        return $this->user_id;
    }
    public function isDone(): bool
    {
        return $this->isDone;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function setIsDone(bool $isDone): self
    {
        $this->isDone = $isDone;
        return $this;
    }
}
