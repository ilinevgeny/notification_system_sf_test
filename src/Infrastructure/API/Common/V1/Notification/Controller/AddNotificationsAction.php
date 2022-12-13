<?php

declare(strict_types=1);

namespace Infrastructure\API\Common\V1\Notification\Controller;

use Application\Notification\AddNotificationCommand;
use Application\Notification\AddNotificationHandler;
use Infrastructure\Common\Http\JsonResponder;
use Infrastructure\Common\Service\RequestValidator;
use Infrastructure\Common\Service\ValidatorInterface;
use Infrastructure\Notification\Request\AddActionRequestPayload;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddNotificationsAction
{
    private ValidatorInterface $validator;
    private JsonResponder $responder;
    private AddNotificationHandler $handler;

    public function __construct(
        ValidatorInterface $validator,
        JsonResponder $responder,
        AddNotificationHandler $handler
    )
    {
        $this->validator = $validator;
        $this->responder = $responder;
        $this->handler = $handler;
    }

    /**
     * @Route("/api/v1/notification/add", methods={"POST"})
     */
    public function add(AddActionRequestPayload $payload): JsonResponse
    {
        try {
            if (!$this->validator->isRequestValid($payload)) {
                return $this->responder->respondFailValidation($this->validator->getErrors());
            }

           $this->handler->handle(new AddNotificationCommand($payload->payload));
        } catch (\RuntimeException | \InvalidArgumentException | \DomainException $exception) {
            return $this->responder->respondFail($exception->getMessage());
        }
        return $this->responder->respondSuccess();
    }
}
