<?php

declare(strict_types=1);

namespace Infrastructure\API\Common\V1\Client\Controller;

use Application\Client\Command\AddClientCommand;
use Application\Client\Command\AddClientHandler;
use Application\Client\Command\UpdateClientCommand;
use Application\Client\Command\UpdateClientHandler;
use Domain\Client\ClientRepositoryInterface;
use Infrastructure\Client\Dto\ViewActionDto;
use Infrastructure\Client\Request\AddActionRequestPayload;
use Infrastructure\Client\Request\UpdateActionRequestPayload;
use Infrastructure\Common\Http\JsonResponder;
use Infrastructure\Common\ObjectNormalizer;
use Infrastructure\Common\Service\ValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UpdateAction
{
    public function __construct(UpdateClientHandler $handler, ValidatorInterface $validator, JsonResponder $responder)
    {
        $this->handler = $handler;
        $this->validator = $validator;
        $this->responder = $responder;
    }
    /**
     * @Route("/api/v1/public/client/update", name="update", methods={"POST"})
     */
    public function update(UpdateActionRequestPayload $payload): JsonResponse
    {
        try {
            if (!$this->validator->isRequestValid($payload)) {
                return $this->responder->respondFailValidation($this->validator->getErrors());
            }
            echo '$payload->firstName, ' . $payload->lastName . PHP_EOL;
            $this->handler->handle(
                $payload->id,
                new UpdateClientCommand(
                    $payload->firstName,
                    $payload->lastName,
                    $payload->email,
                    $payload->phone
                )
            );

        } catch (\RuntimeException | \InvalidArgumentException | \DomainException $exception) {
            return $this->responder->respondFail($exception->getMessage());
        }

        return $this->responder->respondSuccess();
    }
}
