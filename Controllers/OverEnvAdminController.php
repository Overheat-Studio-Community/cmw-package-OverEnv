<?php

namespace CMW\Controller\OverEnv;

use CMW\Controller\Users\UsersController;
use CMW\Manager\Filter\FilterManager;
use CMW\Manager\Flash\Alert;
use CMW\Manager\Flash\Flash;
use CMW\Manager\Lang\LangManager;
use CMW\Manager\Package\AbstractController;
use CMW\Manager\Router\Link;
use CMW\Manager\Views\View;
use CMW\Model\OverEnv\EnvModel;
use CMW\Type\OverEnv\EnvCategoryType;
use CMW\Utils\Redirect;
use JetBrains\PhpStorm\NoReturn;
use function is_null;

/**
 * Class: @OverEnvAdminController
 * @package OverEnv
 * @link https://craftmywebsite.fr/docs/fr/technical/creer-un-package/controllers
 */
class OverEnvAdminController extends AbstractController
{
    #[Link("/manage", Link::GET, scope: "/cmw-admin/overenv")]
    private function manageAdmin(): void
    {
        UsersController::hasPermission('core.dashboard', 'overenv.manage');

        $envs = EnvModel::getInstance()->getAllEnvs();

        View::createAdminView('OverEnv', 'main')
            ->addVariableList(['envs' => $envs])
            ->view();
    }

    #[NoReturn] #[Link("/manage/edit", Link::POST, scope: "/cmw-admin/overenv")]
    private function editKey(): void
    {
        UsersController::hasPermission('core.dashboard', 'overenv.manage');

        if (!isset($_POST['key'], $_POST['value'])) {
            Flash::send(
                Alert::ERROR,
                LangManager::translate('core.toaster.error'),
                LangManager::translate('OverEnv.toaster.error.fields_missing'),
            );
            Redirect::redirectPreviousRoute();
        }

        $key = FilterManager::filterInputStringPost('key');
        $env = EnvModel::getInstance()->getEnv($key);

        if (is_null($env)) {
            Flash::send(
                Alert::ERROR,
                LangManager::translate('core.toaster.error'),
                LangManager::translate('OverEnv.toaster.error.variable_not_found'),
            );
            Redirect::redirectPreviousRoute();
        }

        if ($env->getCategory() !== EnvCategoryType::read_write && $env->getCategory() !== EnvCategoryType::write) {
            Flash::send(
                Alert::ERROR,
                LangManager::translate('core.toaster.error'),
                LangManager::translate('OverEnv.toaster.error.unmodifiable_variable'),
            );
            Redirect::redirectPreviousRoute();
        }

        $value = FilterManager::filterInputStringPost('value', null);

        if (!EnvModel::getInstance()->updateEnvValue($key, $value)) {
            Flash::send(
                Alert::ERROR,
                LangManager::translate('core.toaster.error'),
                LangManager::translate('OverEnv.toaster.error.unable_to_update_variable'),
            );
            Redirect::redirectPreviousRoute();
        }

        Flash::send(
            Alert::SUCCESS,
            LangManager::translate('core.toaster.success'),
            LangManager::translate('OverEnv.toaster.success.variable_updated', ['key' => $key]),
        );
        Redirect::redirectPreviousRoute();
    }

    #[NoReturn] #[Link("/manage/create", Link::POST, scope: "/cmw-admin/overenv")]
    private function createKey(): void
    {
        UsersController::hasPermission('core.dashboard', 'overenv.manage');

        if (!isset($_POST['create_key'], $_POST['create_value'])) {
            Flash::send(
                Alert::ERROR,
                LangManager::translate('core.toaster.error'),
                LangManager::translate('OverEnv.toaster.error.fields_missing'),
            );
            Redirect::redirectPreviousRoute();
        }

        $key = FilterManager::filterInputStringPost('create_key');
        $value = FilterManager::filterInputStringPost('create_value', null);

        if (EnvModel::getInstance()->isValueExist($key)) {
            Flash::send(
                Alert::ERROR,
                LangManager::translate('core.toaster.error'),
                LangManager::translate('OverEnv.toaster.error.variable_exists'),
            );
            Redirect::redirectPreviousRoute();
        }

        if (!EnvModel::getInstance()->createEnv($key, $value)) {
            Flash::send(
                Alert::ERROR,
                LangManager::translate('core.toaster.error'),
                LangManager::translate('OverEnv.toaster.error.unable_to_create_variable'),
            );
            Redirect::redirectPreviousRoute();
        }

        Flash::send(
            Alert::SUCCESS,
            LangManager::translate('core.toaster.success'),
            LangManager::translate('OverEnv.toaster.success.variable_created', ['key' => $key]),
        );
        Redirect::redirectPreviousRoute();
    }
}
