<?php

namespace App\Repositories;

use App\Collections\TaskCollection;
use App\Models\Task;
use Carbon\Carbon;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

class TaskRepository
{
    private Connection $conn;

    public function __construct()
    {
        $connectionParams = [
            'dbname' => $_ENV['DB_NAME'],
            'user' => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASSWORD'],
            'host' => $_ENV['DB_HOST'],
            'driver' => $_ENV['DB_DRIVER'],
        ];
        $this->conn = DriverManager::getConnection($connectionParams);
    }

    public function getAll(): TaskCollection
    {
        $response = $this->conn->createQueryBuilder()
            ->select('*')
            ->from('tasks')
            ->fetchAllAssociative();

        $taskCollection = new TaskCollection();

        foreach ($response as $task) {
            $taskCollection->add(new Task(
                $task['task_name'],
                $task['task_description'],
                Carbon::parse($task['created_at']),
                $task['id'],
            ));
        }

        return $taskCollection;
    }

    public function store(Task $task)
    {
        $this->conn->createQueryBuilder()
            ->insert('tasks')
            ->values([
                    'task_name' => ':name',
                    'task_description' => ':description',
                    'created_at' => ':created_at'
                ]
            )->setParameters([
                'name' => $task->getName(),
                'description' => $task->getDescription(),
                'created_at' => $task->getCreatedAt()
            ])->executeQuery();
    }

    public function delete(int $id): void
    {
        $this->conn->createQueryBuilder()
            ->delete('tasks')
            ->where('id = :id')
            ->setParameter('id', $id)
            ->executeQuery();
    }
}
