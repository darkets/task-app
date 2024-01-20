<?php

namespace App\Models;

use Carbon\Carbon;

class Task
{
    private string $name;
    private string $description;
    private Carbon $createdAt;
    private ?int $id;

    public function __construct(
        string $name,
        string $description,
        Carbon $createdAt,
        ?int   $id = null
    )
    {
        $this->name = $name;
        $this->description = $description;
        $this->createdAt = $createdAt;
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }

    public function getId(): int
    {
        return $this->id;
    }
}