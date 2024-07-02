<?php

namespace App\Controller;

use App\Entity\Task;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/tasks', name: 'api_tasks_')]
class TaskApiController extends AbstractController
{
    private $entityManager;
    private $taskRepository;

    public function __construct(EntityManagerInterface $entityManager, TaskRepository $taskRepository)
    {
        $this->entityManager = $entityManager;
        $this->taskRepository = $taskRepository;
    }

    #[Route('', name: 'index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $tasks = $this->taskRepository->findAll();
        return $this->json($tasks);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(int $id): JsonResponse
    {
        $task = $this->taskRepository->find($id);

        if (!$task) {
            return $this->json(['message' => 'Task not found'], 404);
        }

        return $this->json($task);
    }

    #[Route('', name: 'create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $task = new Task();
        $task->setTitle($data['title']);
        $task->setDescription($data['description']);
        $task->setStatus($data['status']);

        $this->entityManager->persist($task);
        $this->entityManager->flush();

        return $this->json($task, 201);
    }

    #[Route('/{id}', name: 'update', methods: ['PUT'])]
    public function update(Request $request, int $id): JsonResponse
    {
        $task = $this->taskRepository->find($id);

        if (!$task) {
            return $this->json(['message' => 'Task not found'], 404);
        }

        $data = json_decode($request->getContent(), true);

        $task->setTitle($data['title']);
        $task->setDescription($data['description']);
        $task->setStatus($data['status']);

        $this->entityManager->flush();

        return $this->json($task);
    }

    #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $task = $this->taskRepository->find($id);

        if (!$task) {
            return $this->json(['message' => 'Task not found'], 404);
        }

        $this->entityManager->remove($task);
        $this->entityManager->flush();

        return $this->json(['message' => 'Task deleted']);
    }
}


