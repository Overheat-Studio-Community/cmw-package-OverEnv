<?php

namespace CMW\Type\OverEnv\Keys;

/**
 * <p>Show keys without any value. Editing is disabled.</p>
 *
 * Enum: @EnvRestricted
 * @package OverEnv
 */
enum EnvRestricted
{

    //Add restricted keys here

    public static function fromName(string $name): self
    {
        foreach (self::cases() as $method) {
            if ($name === $method->name) {
                return $method;
            }
        }
        throw new \ValueError("$name is not a valid backing value for enum EnvRestricted");
    }
}
