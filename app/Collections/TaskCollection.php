<?php

namespace App\Collections;

use App\Models\Task;

class TaskCollection
{
    private array $tasks = [];

    public function add(Task $task)
    {
        $this->tasks[] = $task;
    }

    public function get(): array
    {
        return $this->tasks;
    }
}