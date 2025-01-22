<?php

namespace CMW\Model\OverEnv;

use CMW\Entity\OverEnv\EnvEntity;
use CMW\Manager\Env\EnvManager;
use CMW\Manager\Package\AbstractModel;
use CMW\Mapper\OverEnv\EnvMapper;
use CMW\Utils\Log;
use function is_null;

/**
 * Class: @EnvModel
 * @package OverEnv
 * @link https://craftmywebsite.fr/docs/fr/technical/creer-un-package/models
 */
class EnvModel extends AbstractModel
{
    /**
     * @return EnvEntity[]
     */
    public function getAllEnvs(): array
    {
        $envs = $_ENV ?? [];

        return EnvMapper::getInstance()->mapEnvs($envs);
    }

    /**
     * @param string $key
     * @return EnvEntity|null
     */
    public function getEnv(string $key): ?EnvEntity
    {
        $value = EnvManager::getInstance()->getValue($key);

        if (is_null($value)) {
            return null;
        }

        return EnvMapper::getInstance()->mapEnv($key, $value);
    }

    /**
     * @param string $key
     * @param string $value
     * @return bool
     */
    public function updateEnvValue(string $key, string $value): bool
    {
        EnvManager::getInstance()->editValue($key, $value);

        return EnvManager::getInstance()->getValue($key) === $value;
    }

    /**
     * @param string $key
     * @param string $value
     * @return bool
     */
    public function createEnv(string $key, string $value): bool
    {
        EnvManager::getInstance()->addValue($key, $value);

        return EnvManager::getInstance()->getValue($key) === $value;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function isValueExist(string $key): bool
    {
        return EnvManager::getInstance()->valueExist($key);
    }
}
