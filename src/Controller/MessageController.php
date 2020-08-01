<?php

namespace App\Controller;

use App\Service\MessageService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class MessageController
{
    private $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    /**
     * @Route("/send-message/{numberOfMessages}", name="send_message", methods={"GET"})
     */
    public function createMessages($numberOfMessages): JsonResponse
    {
        $this->messageService->createMessage($numberOfMessages);

        return new JsonResponse(['status' => 'Sent!']);
    }
}