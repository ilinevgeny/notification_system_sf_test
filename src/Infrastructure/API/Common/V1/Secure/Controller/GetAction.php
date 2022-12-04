<?php

declare(strict_types=1);

namespace Infrastructure\API\Common\V1\Secure\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetAction
{
    /**
     * @Route("/api/v1/secure/get", name="get", methods={"POST"})
     *
     */
    public function get(): JsonResponse
    {
        return new JsonResponse(['message' => 'ok, get'], Response::HTTP_OK);
    }
}
