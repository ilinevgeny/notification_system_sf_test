<?php

namespace Application\Common;

use ArrayObject;

interface ObjectNormalizer
{
    /**
     * Normalizes an object into a set of arrays/scalars.
     *
     * @param mixed  $object  Object to normalize
     * @param array  $context Context options for the normalizer
     *
     * @return array|ArrayObject|null \ArrayObject is used to make sure an empty object is encoded
     * as an object not an array
     */
    public function normalize($object, array $context = []);
}
