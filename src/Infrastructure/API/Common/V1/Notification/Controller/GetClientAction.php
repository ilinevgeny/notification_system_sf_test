<?php

declare(strict_types=1);

namespace Infrastructure\API\Common\V1\Notification\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetClientAction
{
    /**
     * @Route("/api/v1/notification/client/get/{id}", name="get", methods={"POST"})
     *
     */
    public function get(int $id): JsonResponse
    {
        return new JsonResponse(['message' => 'ok, get'], Response::HTTP_OK);
    }
}
