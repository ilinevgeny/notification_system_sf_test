<?php

declare(strict_types=1);

namespace Tests;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;

class ApiTestCase extends WebTestCase
{
    protected ?Response $lastResponse = null;
    protected static KernelBrowser $client;

    protected function setUp(): void
    {
        self::$client = self::createClient();
       // self::bootKernel();
//        self::$client = static::createClient();
    }

    public function request(string $method, string $uri, array $parameters = [], array $files = []): Response
    {

        static::$client->request($method, $uri, $parameters, $files);
        $this->lastResponse = static::$client->getResponse();

        return $this->lastResponse;
    }

    public function getPostRequest(array $data = []): RequestStack
    {
        $request = new Request([], [], [], [], [], [], (string)\json_encode($data));

        $requestStack = new RequestStack();
        $requestStack->push($request);

        return $requestStack;
    }
}