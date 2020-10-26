<?php

namespace App\Model;

abstract class Entity
{
    public array $errors = [];

    /**
     * @param array $data
     * @return void
     */
    public function bindValues(array $data): void
    {
        $entityName = $this->getEntityName();
        $entityData = $data['data'][$entityName];
        foreach ($entityData as $field => $input) {
            if (property_exists($this, $field)) {
                $funcName = 'set' . ucwords($field);
                if (method_exists($this, $funcName)) {
                    $this->{$funcName}($input);
                }
            }
        }
    }

    /**
     * @return string
     */
    public function getEntityName(): string
    {
        $className = get_class($this);
        return substr($className, strrpos($className, '\\') + 1);
    }
}