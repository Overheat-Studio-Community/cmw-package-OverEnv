<?php

namespace CMW\Type\OverEnv\Keys;

/**
 * <p>Read the value of the key.</p>
 *
 * Enum: @EnvRead
 * @package OverEnv
 */
enum EnvRead
{
    case CMW_KEY;

    public static function fromName(string $name): self
    {
        foreach (self::cases() as $method) {
            if ($name === $method->name) {
                return $method;
            }
        }
        throw new \ValueError("$name is not a valid backing value for enum EnvRead");
    }
}
