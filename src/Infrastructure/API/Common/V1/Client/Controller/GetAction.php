<?php

declare(strict_types=1);

namespace  Infrastructure\API\Common\V1\Client\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetAction
{
    /**
     * @Route("/api/v1/public/client/get/{id}", name="get", methods={"GET"})
     */
    public function get(): JsonResponse
    {
        return new JsonResponse(['message' => 'Customer was added!'], Response::HTTP_OK);
    }
}
