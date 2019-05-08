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
    function dismount($object)
    {
        $reflectionClass = new ReflectionClass(get_class($object));
        $array = array();
        foreach ($reflectionClass->getProperties() as $property) {
            $property->setAccessible(true);

            if (is_array($property->getValue($object))) {
                $objectsArray = array();
                foreach ($property->getValue($object) as $key => $value) {
                    array_push($objectsArray, $this->dismount($value));
                }
                $array[$property->getName()] = $objectsArray;
            } else {
                $array[$property->getName()] = $property->getValue($object);
            }
            $property->setAccessible(false);
        }

        return $array;
    }
}
