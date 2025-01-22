<?php

namespace CMW\Type\OverEnv\Keys;

/**
 * <p>Read and write value.</p>
 *
 * Enum: @EnvReadWrite
 * @package OverEnv
 */
enum EnvReadWrite
{
    case DIR;
    case PATH_SUBFOLDER;
    case PATH_URL;
    case TIMEZONE;
    case DEVMODE;
    case UPDATE_CHECKER;
    case ENABLE_BACKEND_MODE;

    public static function fromName(string $name): self
    {
        foreach (self::cases() as $method) {
            if ($name === $method->name) {
                return $method;
            }
        }
        throw new \ValueError("$name is not a valid backing value for enum EnvReadWrite");
    }
}
