<?php

declare(strict_types=1);

namespace  Infrastructure\API\Common\V1\Client\Controller;

use Application\Client\Command\AddClientCommand;
use Application\Client\Command\AddClientHandler;
use Infrastructure\Client\Request\AddActionRequestPayload;
use Infrastructure\Common\Http\JsonResponder;
use Infrastructure\Common\Service\ValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AddAction
{
    private AddClientHandler $handler;
    private JsonResponder $responder;
    private ValidatorInterface $validator;

    public function __construct(AddClientHandler $handler, ValidatorInterface $validator, JsonResponder $responder)
    {
        $this->handler = $handler;
        $this->validator = $validator;
        $this->responder = $responder;
    }
    /**
     * @Route("/api/v1/public/client/add", name="add", methods={"POST"})
     */
    public function add(AddActionRequestPayload $payload): JsonResponse
    {
        try {
            if (!$this->validator->isRequestValid($payload)) {
                return $this->responder->respondFailValidation($this->validator->getErrors());
            }

            $this->handler->handle(new AddClientCommand(
                $payload->firstName,
                $payload->lastName,
                $payload->email,
                $payload->phone
            ));

        } catch (\RuntimeException | \InvalidArgumentException | \DomainException $exception) {
            return $this->responder->respondFail($exception->getMessage());
        }

        return $this->responder->respondSuccess();
    }
}
