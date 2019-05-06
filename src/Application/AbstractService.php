<?php

namespace App\Application;

use ReflectionClass;

abstract class AbstractService
{
    /**
     * @param $object
     * @return array
     * @throws \ReflectionException
     */
    function dismount($object) {
        $reflectionClass = new ReflectionClass(get_class($object));
        $array = array();
        foreach ($reflectionClass->getProperties() as $property) {
            $property->setAccessible(true);
            $array[$property->getName()] = $property->getValue($object);
            $property->setAccessible(false);
        }

        return $array;
    }
}
