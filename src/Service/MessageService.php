<?php

namespace App\Service;

use App\Rabbit\MessagingProducer;
use Faker\Factory;
use Symfony\Component\HttpFoundation\JsonResponse;

class MessageService
{
    private $messagingProducer;

    public function __construct(MessagingProducer $messagingProducer)
    {
        $this->messagingProducer = $messagingProducer;
    }

    public function createMessage(int $numberOfUsers): array
    {
        $messages = [];
        $faker = Factory::create();

        for ($i=0; $i<$numberOfUsers; $i++) {
            $message = json_encode([
                'uuid' => $faker->uuid,
                'name' => $faker->name,
                'companyEmail' => $faker->companyEmail,
                'message' => $faker->text,
            ]);

            $this->messagingProducer->publish($message);
            $messages[] = json_decode($message);
        }

        return ['messages' => $messages];
    }
}