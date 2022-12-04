<?php

namespace Infrastructure\Common;

use Application\Common\ObjectNormalizer as ApplicationObjectNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer as SymfonyObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ObjectNormalizer implements ApplicationObjectNormalizer
{
    private Serializer $serializer;

    public function __construct()
    {
        $this->serializer = new Serializer([new SymfonyObjectNormalizer()], [new JsonEncoder()]);
    }

    /**
     * @inheritdoc
     */
    public function normalize($object, array $context = [])
    {
        return (array)$this->serializer->normalize($object, null, $context);
    }
}
