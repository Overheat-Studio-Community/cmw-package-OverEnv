<?php

namespace CMW\Type\OverEnv\Keys;

/**
 * <p>Ignore this envs.</p>
 * <p>These envs are not displayed in the admin panel.</p>
 *
 * Enum: @EnvHidden
 * @package OverEnv
 */
enum EnvHidden
{
    case SALT;
    case SALT_PASS;
    case SALT_IV;
    case INSTALLSTEP;
    case LOCALE;

    public static function fromName(string $name): self
    {
        foreach (self::cases() as $method) {
            if ($name === $method->name) {
                return $method;
            }
        }
        throw new \ValueError("$name is not a valid backing value for enum EnvHidden");
    }
}
