<?php

namespace App\Controllers;

use App\Models\Task;
use App\RedirectResponse;
use App\Repositories\TaskRepository;
use App\Response;
use App\ViewResponse;
use Carbon\Carbon;

class TaskController
{
    private TaskRepository $taskRepository;

    public function __construct()
    {
        $this->taskRepository = new TaskRepository();
    }

    public function index(): ViewResponse
    {
        $tasks = $this->taskRepository->getAll();

        return new ViewResponse('tasks/index', [
            'tasks' => $tasks
        ]);
    }

    public function create(): ViewResponse
    {
        return new ViewResponse('tasks/create');
    }

    public function store(): RedirectResponse
    {
        $task = new Task(
            $_POST['task-name'],
            $_POST['task-description'],
            Carbon::now(),
        );

        $this->taskRepository->store($task);

        return new RedirectResponse('/');
    }

    public function delete(int $id): RedirectResponse
    {
        $this->taskRepository->delete($id);

        return new RedirectResponse('/');
    }
}
