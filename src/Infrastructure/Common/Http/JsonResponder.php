<?php

namespace Infrastructure\Common\Http;

use Symfony\Component\Validator\ConstraintViolationListInterface;

final class JsonResponder
{
    /**
     * @param array|string|null $payload
     * @param string|null $message
     * @param int $status
     * @param array $headers
     * @return JsonResponse
     */
    public function respond(
        $payload = null,
        string $message = null,
        int $status = JsonResponse::HTTP_OK,
        array $headers = []
    ): JsonResponse {
        $data = [];

        if ($status === JsonResponse::HTTP_OK) {
            $data['status'] = 'success';
            $data['data'] = $payload;
        } else {
            if ($status >= JsonResponse::HTTP_BAD_REQUEST && $status < JsonResponse::HTTP_INTERNAL_SERVER_ERROR) {
                $data['status'] = 'fail';
            } else {
                $data['status'] = 'error';
            }

            $data['message'] = $message;
            if (!empty($payload)) {
                $data['data'] = $payload;
            }
        }

        return new JsonResponse($data, $status, $headers);
    }

    public function respondError(
        string $message,
        int $status = JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
        array $payload = null
    ): JsonResponse {
        return $this->respond($payload, $message, $status);
    }

    public function respondFailValidation(ConstraintViolationListInterface $errors): JsonResponse
    {
        $messages = [];
        foreach ($errors as $error) {
            $messages[$error->getPropertyPath()] = $error->getMessage();
        }

        return $this->respondFail('Validation errors', JsonResponse::HTTP_BAD_REQUEST, $messages);
    }

    public function respondFail(
        string $message,
        int $status = JsonResponse::HTTP_BAD_REQUEST,
        array $payload = null
    ): JsonResponse {
        return $this->respond($payload, $message, $status);
    }

    public function respondNotFound(
        string $message,
        int $status = JsonResponse::HTTP_NOT_FOUND,
        array $payload = null
    ): JsonResponse {
        return $this->respond($payload, $message, $status);
    }

    public function respondForbidden(
        string $message,
        int $status = JsonResponse::HTTP_FORBIDDEN,
        array $payload = null
    ): JsonResponse {
        return $this->respond($payload, $message, $status);
    }

    /**
     * @param mixed $payload
     * @param string|null $message
     * @return JsonResponse
     */
    public function respondSuccess($payload = null, string $message = null): JsonResponse
    {
        return $this->respond($payload, $message);
    }
}
