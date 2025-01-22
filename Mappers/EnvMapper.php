<?php

namespace CMW\Mapper\OverEnv;

use CMW\Entity\OverEnv\EnvEntity;
use CMW\Manager\Package\GlobalObject;
use CMW\Type\OverEnv\EnvCategoryType;
use CMW\Type\OverEnv\Keys\EnvHidden;
use CMW\Type\OverEnv\Keys\EnvRead;
use CMW\Type\OverEnv\Keys\EnvReadWrite;
use CMW\Type\OverEnv\Keys\EnvRestricted;
use CMW\Type\OverEnv\Keys\EnvWrite;

class EnvMapper extends GlobalObject
{
    /**
     * @param array $envs
     * @return EnvEntity[]
     */
    public function mapEnvs(array $envs): array
    {
        return array_map([$this, 'mapEnv'], array_keys($envs), $envs);
    }

    /**
     * <p>Map env with correct category.</p>
     * <p>If env is not in write or read_write category, we set the value to null.</p>
     *
     * @param string $key
     * @param string $value
     * @return EnvEntity
     */
    public function mapEnv(string $key, string $value): EnvEntity
    {
        $category = $this->mapKeyCategory($key);

        return new EnvEntity(
            key: $key,
            value: $category === EnvCategoryType::read || $category === EnvCategoryType::read_write ? $value : null,
            category: $category,
        );
    }

    /**
     * @param string $key
     * @return EnvCategoryType
     */
    private function mapKeyCategory(string $key): EnvCategoryType
    {
        return match (true) {
            $this->isHidden($key) => EnvCategoryType::hidden,
            $this->isRead($key) => EnvCategoryType::read,
            $this->isReadWrite($key) => EnvCategoryType::read_write,
            $this->isRestricted($key) => EnvCategoryType::restricted,
            $this->isWrite($key) => EnvCategoryType::write,
            default => EnvCategoryType::write,
        };
    }

    private function isHidden(string $key): bool
    {
        return $this->keyExistsInEnum($key, EnvHidden::class);
    }

    private function isRead(string $key): bool
    {
        return $this->keyExistsInEnum($key, EnvRead::class);
    }

    private function isReadWrite(string $key): bool
    {
        return $this->keyExistsInEnum($key, EnvReadWrite::class);
    }

    private function isRestricted(string $key): bool
    {
        return $this->keyExistsInEnum($key, EnvRestricted::class);
    }

    private function isWrite(string $key): bool
    {
        return $this->keyExistsInEnum($key, EnvWrite::class);
    }

    private function keyExistsInEnum(string $key, string $enumClass): bool
    {
        try {
            $enumClass::fromName($key);
            return true;
        } catch (\ValueError) {
            return false;
        }
    }
}