<?php

declare(strict_types=1);

namespace Infrastructure\Notification\Request;

use Infrastructure\Common\Http\RequestPayload;

class AddActionRequestPayload implements RequestPayload
{
    public string $content;

    public function fillFromPayload(array $payload): void
    {
        // TODO: Implement fillFromPayload() method.
    }
}