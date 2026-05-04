<?php

declare(strict_types=1);

namespace App\Tests\Support;

trait EntityIdTrait
{
    private static function setEntityId(object $entity, int $id, string $property = 'id'): void
    {
        $reflection = new \ReflectionObject($entity);
        while (!$reflection->hasProperty($property)) {
            $parent = $reflection->getParentClass();
            if (!$parent instanceof \ReflectionClass) {
                throw new \LogicException(sprintf('Property "%s" was not found on %s.', $property, $entity::class));
            }

            $reflection = $parent;
        }

        $idProperty = $reflection->getProperty($property);
        $idProperty->setAccessible(true);
        $idProperty->setValue($entity, $id);
    }
}
