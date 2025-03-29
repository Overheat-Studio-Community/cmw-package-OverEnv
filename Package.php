<?php

namespace CMW\Package\OverEnv;

use CMW\Manager\Package\IPackageConfig;
use CMW\Manager\Package\PackageMenuType;

class Package implements IPackageConfig
{
    public function name(): string
    {
        return 'OverEnv';
    }

    public function version(): string
    {
        return '1.0.1';
    }

    public function authors(): array
    {
        return ['OverheatStudio'];
    }

    public function isGame(): bool
    {
        return false;
    }

    public function isCore(): bool
    {
        return false;
    }

    public function menus(): ?array
    {
        return [
            new PackageMenuType(
                icon: 'fa-solid fa-key',
                title: 'OverEnv',
                url: 'overenv/manage',
                permission: 'overenv.manage',
            ),
        ];
    }

    public function requiredPackages(): array
    {
        return ['Core', 'Users'];
    }

    public function uninstall(): bool
    {
        // Return true, we don't need other operations for uninstall.
        return false;
    }
}
