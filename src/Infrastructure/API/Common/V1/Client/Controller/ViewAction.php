<?php

declare(strict_types=1);

namespace Infrastructure\API\Common\V1\Client\Controller;

use Domain\Client\ClientRepositoryInterface;
use Infrastructure\Client\Dto\ViewActionDto;
use Infrastructure\Common\Http\JsonResponder;
use Infrastructure\Common\ObjectNormalizer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ViewAction
{
    private ClientRepositoryInterface $clientRepository;
    private JsonResponder $responder;
    private ObjectNormalizer $normalizer;

    public function __construct(
        ClientRepositoryInterface $clientRepository,
        JsonResponder $responder,
        ObjectNormalizer $normalizer
    )
    {
        $this->clientRepository = $clientRepository;
        $this->responder = $responder;
        $this->normalizer = $normalizer;
    }

    /**
     * @Route("/api/v1/public/client/view/{id}", name="view", methods={"GET"})
     */
    public function view(int $id): JsonResponse
    {
        $client = $this->clientRepository->findById($id);
        if ($client === null) {
            return $this->responder->respondNotFound('Client not found');
        }

        $dto = new ViewActionDto($client);
        return $this->responder->respondSuccess($this->normalizer->normalize($dto));
    }
}
