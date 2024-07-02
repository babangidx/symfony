<?php

// src/EventSubscriber/ApiKeySubscriber.php
namespace App\EventSubscriber;

use App\Repository\ApiKeyRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiKeySubscriber implements EventSubscriberInterface
{
    private $apiKeyRepository;

    public function __construct(ApiKeyRepository $apiKeyRepository)
    {
        $this->apiKeyRepository = $apiKeyRepository;
    }

    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();

        if (strpos($request->getPathInfo(), '/api/') === 0) {
            $apiKey = $request->headers->get('X-API-KEY');

            if (!$apiKey || !$this->apiKeyRepository->findOneBy(['key' => $apiKey])) {
                $response = new JsonResponse(['message' => 'Invalid API key'], 401);
                $event->setResponse($response);
            }
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => 'onKernelRequest',
        ];
    }
}
