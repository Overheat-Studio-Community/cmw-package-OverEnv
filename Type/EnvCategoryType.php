<?php

namespace CMW\Type\OverEnv;

/**
 * Enum: @EnvCategoryType
 * @package OverEnv
 */
enum EnvCategoryType
{
    case hidden;
    case restricted; //Default
    case read_write;
    case write;
    case read;

    public static function fromName(string $name): self
    {
        foreach (self::cases() as $method) {
            if ($name === $method->name) {
                return $method;
            }
        }
        throw new \ValueError("$name is not a valid backing value for enum EnvCategoryType");
    }
}
