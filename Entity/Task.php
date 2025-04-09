<?php

class Task
{
    public function __construct(
        private ?int $id,
        private string $title,
        private string $description,
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
    public function isDone(): bool
    {
        return $this->isDone;
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
    public function setIsDone(bool $isDone): self
    {
        $this->isDone = $isDone;
        return $this;
    }
}
