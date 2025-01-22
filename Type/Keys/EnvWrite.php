<?php

namespace CMW\Type\OverEnv\Keys;

/**
 * <p>Write value without read permission.</p>
 * <p>This is the default env state when the key is not typed.</p>
 *
 * Enum: @EnvWrite
 * @package OverEnv
 */
enum EnvWrite
{
    case DB_HOST;
    case DB_NAME;
    case DB_USERNAME;
    case DB_PASSWORD;
    case DB_PORT;

    public static function fromName(string $name): self
    {
        foreach (self::cases() as $method) {
            if ($name === $method->name) {
                return $method;
            }
        }
        throw new \ValueError("$name is not a valid backing value for enum EnvWrite");
    }
}
