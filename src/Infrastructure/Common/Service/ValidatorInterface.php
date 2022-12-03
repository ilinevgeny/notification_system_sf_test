<?php

namespace Infrastructure\Common\Service;

use Infrastructure\Common\Http\RequestPayload;
use Symfony\Component\Validator\ConstraintViolationListInterface;

interface ValidatorInterface
{
    public function isRequestValid(RequestPayload $payload): bool;
    public function getErrors(): ConstraintViolationListInterface;
}
