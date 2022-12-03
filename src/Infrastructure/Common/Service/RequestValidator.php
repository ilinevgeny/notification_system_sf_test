<?php

namespace Infrastructure\Common\Service;

use Infrastructure\Common\Http\RequestPayload;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface as SymfonyValidator;
use JsonException;

class RequestValidator implements ValidatorInterface
{
    private RequestStack $requestStack;
    protected SymfonyValidator $validator;
    protected ConstraintViolationListInterface $errors;

    public function __construct(RequestStack $requestStack, SymfonyValidator $validator)
    {
        $this->requestStack = $requestStack;
        $this->validator = $validator;
    }

    public function isRequestValid(RequestPayload $payload): bool
    {
        $payload->fillFromPayload($this->getRequestData());
        $this->errors = $this->validator->validate($payload);
        if ($this->errors->count()) {
            return false;
        }

        return true;
    }

    protected function getRequestData(): array
    {
        if (
            $this->requestStack->getCurrentRequest()->request->count() ||
            $this->requestStack->getCurrentRequest()->files->count()
        ) {
            return array_merge(
                $this->requestStack->getCurrentRequest()->request->all(),
                $this->requestStack->getCurrentRequest()->files->all()
            );
        }

        if ($this->requestStack->getCurrentRequest()->isMethod('GET')) {
            return $this->requestStack->getCurrentRequest()->query->all();
        }

        $content = (string)$this->requestStack->getCurrentRequest()->getContent();

        if (empty($content)) {
            throw new InvalidArgumentException('Empty POST request.');
        }

        try {
            $content = \json_decode(
                $content,
                true,
                512,
                JSON_BIGINT_AS_STRING | (\PHP_VERSION_ID >= 70300 ? JSON_THROW_ON_ERROR : 0)
            );
        } catch (JsonException $e) {
            throw new InvalidArgumentException($e->getMessage());
        }

        if (\PHP_VERSION_ID < 70300 && JSON_ERROR_NONE !== json_last_error()) {
            throw new InvalidArgumentException(json_last_error_msg());
        }

        if (!\is_array($content)) {
            throw new InvalidArgumentException(sprintf(
                'JSON content was expected to decode to an array, "%s"',
                get_debug_type($content)
            ));
        }

        return $content;
    }

    public function getErrors(): ConstraintViolationListInterface
    {
        return $this->errors;
    }
}
