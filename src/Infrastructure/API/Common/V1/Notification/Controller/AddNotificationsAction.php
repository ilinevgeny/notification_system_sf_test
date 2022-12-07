<?php

declare(strict_types=1);

namespace Infrastructure\API\Common\V1\Notification\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddNotificationsAction
{

    public function __construct()
    {
    }

    public function add(): JsonResponse
    {
        return new JsonResponse(['message' => 'ok, add'], Response::HTTP_OK);
    }
}
