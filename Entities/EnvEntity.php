<?php

namespace CMW\Entity\OverEnv;

use CMW\Manager\Package\AbstractEntity;
use CMW\Type\OverEnv\EnvCategoryType;

/**
 * Class: @EnvEntity
 * @package OverEnv
 * @link https://craftmywebsite.fr/docs/fr/technical/creer-un-package/entities
 */
class EnvEntity extends AbstractEntity
{
    private string $key;
    private ?string $value;
    private EnvCategoryType $category;

    /**
     * @param string $key
     * @param string|null $value
     * @param EnvCategoryType $category
     */
    public function __construct(string $key, ?string $value, EnvCategoryType $category)
    {
        $this->key = $key;
        $this->value = $value;
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return string|null
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @return EnvCategoryType
     */
    public function getCategory(): EnvCategoryType
    {
        return $this->category;
    }

    /**
     * @return string
     */
    public function getCategoryIcon(): string
    {
        return match ($this->category) {
            EnvCategoryType::hidden => "<i class='fas fa-eye-slash'></i>",
            EnvCategoryType::restricted => "<i class='fas fa-lock'></i>",
            EnvCategoryType::read_write => "<i class='fas fa-eye'></i>/<i class='fas fa-pencil'></i>",
            EnvCategoryType::write => "<i class='fas fa-pencil'></i>",
            EnvCategoryType::read => "<i class='fas fa-eye'></i>",
        };

    }
}
