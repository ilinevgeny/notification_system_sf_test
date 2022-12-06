<?php

declare(strict_types=1);

namespace Infrastructure\API\V1\Client;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Client\Client;
use Infrastructure\Client\Repository\OrmClientRepository;
use Tests\ApiTestCase;

class UpdateActionTest extends ApiTestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        $this->em = self::$container->get(EntityManagerInterface::class);

        if (!$this->em instanceof EntityManagerInterface) {
            self::fail('symfony not initialized');
        }

        $this->em->beginTransaction();
    }

    public function tearDown(): void
    {
        $this->em->rollback();
        $this->em->close();
        $this->em = null;

        parent::tearDown();
    }

    public function testParamsValidation(): void
    {
        $phoneWrongFormat = 1234567890000;
        $emailWrongFormat = 'wrong@EmailFormat.';
        $this->request('POST', '/api/v1/public/client/update',
            [
                'phone' => $phoneWrongFormat,
                'email' => $emailWrongFormat
            ]
        );
        $responseData = json_decode($this->lastResponse->getContent(), true);

        self::assertEquals('fail', $this->lastResponse->getStatus());
        self::assertEquals('Validation errors', $responseData['message']);
        self::assertArrayHasKey('id', $responseData['data']);
        self::assertArrayHasKey('phone', $responseData['data']);
        self::assertArrayHasKey('email', $responseData['data']);
        self::assertEquals('This value should not be blank.', $responseData['data']['id']);
        self::assertEquals('This value is not a valid phone number.', $responseData['data']['phone']);
        self::assertEquals('This value is not a valid email address.', $responseData['data']['email']);
    }

    public function testUpdateSuccess(): void
    {
        $newClientFirstName = 'newFirstName';
        $client = new Client(
            'John',
            'Doe',
            'test@mail.com',
            '1234567890',
        );
        $this->em->persist($client);
        $this->em->flush();
        $manager = self::$container->get(ManagerRegistry::class);
        $ormRepository = new OrmClientRepository($manager);
        $this->request('POST', '/api/v1/public/client/update',
            [
                'id' => $client->getId(),
                'firstName' => $newClientFirstName
            ]
        );
        $clientAfterUpdate = $ormRepository->findById($client->getId());
        self::assertEquals('success', $this->lastResponse->getStatus());
        self::assertEquals($newClientFirstName, $clientAfterUpdate->getFirstName());
    }
}
