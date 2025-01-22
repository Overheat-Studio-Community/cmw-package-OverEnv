<?php

namespace CMW\Permissions\OverEnv;

use CMW\Manager\Lang\LangManager;
use CMW\Manager\Permission\IPermissionInit;
use CMW\Manager\Permission\PermissionInitType;

class Permissions implements IPermissionInit
{
    public function permissions(): array
    {
        return [
            new PermissionInitType(
                code: 'overenv.main',
                description: LangManager::translate('overenv.permissions.main'),
            ),
        ];
    }
}
