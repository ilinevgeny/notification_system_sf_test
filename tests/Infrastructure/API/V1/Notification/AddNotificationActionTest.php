<?php

declare(strict_types=1);

namespace Infrastructure\API\V1\Notification;

use Tests\ApiTestCase;

final class AddNotificationActionTest extends ApiTestCase
{
    public function testValidation(): void
    {
        $this->request('POST', '/api/v1/notification/add',
            [

            ]
        );

    }
    public function testAddOneNotification(): void
    {
        $this->request('POST', '/api/v1/notification/add',
            [
                'title' => 'test',
                'message' => 'test',
                'type' => 'test',
                'client_id' => 1,
            ]
        );

    }

    public function testAddBunchNotifications(): void
    {

    }
}