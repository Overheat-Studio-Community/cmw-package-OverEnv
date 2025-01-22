<?php

use CMW\Entity\OverEnv\EnvEntity;
use CMW\Manager\Lang\LangManager;
use CMW\Manager\Security\SecurityManager;
use CMW\Type\OverEnv\EnvCategoryType;
use CMW\Utils\Website;

/* @var EnvEntity[] $envs */

Website::setTitle(LangManager::translate('overenv.pages.main.title'));
Website::setDescription(LangManager::translate('overenv.pages.main.description'));
?>

<h3><i class="fa-solid fa-key"></i> <?= LangManager::translate('overenv.pages.main.title') ?></h3>

<div class="grid-4 mt-4">
    <div class="col col-span-1">
        <div class="card">
            <div class="space-y-3">
                <h6><?= LangManager::translate('overenv.pages.main.add.title') ?></h6>
            </div>

            <form method="post" action="manage/create">
                <?php SecurityManager::getInstance()->insertHiddenToken(); ?>

                <div class="mt-4 space-y-3">
                    <div>
                        <label for="create_key">
                            <?= LangManager::translate('overenv.pages.main.add.key') ?>
                        </label>
                        <input type="text" class="input" id="create_key" name="create_key" required/>
                    </div>

                    <div>
                        <label for="create_value">
                            <?= LangManager::translate('overenv.pages.main.add.value') ?>
                        </label>
                        <input type="text" class="input" id="create_value" name="create_value" required/>
                    </div>

                    <button type="submit" class="btn btn-primary w-full">
                        <?= LangManager::translate('core.btn.send') ?>
                    </button>
                </div>
        </div>
    </div>
    <div class="card col-span-3">
        <div class="space-y-3">
            <?php foreach ($envs as $env): ?>
                <?php if ($env->getCategory() === EnvCategoryType::read_write): ?>
                    <!-- read_write -->
                    <form method="post" action="manage/edit">
                        <?php SecurityManager::getInstance()->insertHiddenToken(); ?>

                        <label for="<?= $env->getKey() ?>">
                            <small><?= $env->getCategoryIcon() ?></small> <?= $env->getKey() ?>
                        </label>
                        <div class="input-btn-sm">
                            <input type="hidden" name="key" value="<?= $env->getKey() ?>" hidden/>
                            <input type="text" id="<?= $env->getKey() ?>" name="value"
                                   value="<?= $env->getValue() ?>" required/>
                            <button type="submit">
                                <?= LangManager::translate('core.btn.edit') ?>
                            </button>
                        </div>
                    </form>
                <?php endif; ?>
                <?php if ($env->getCategory() === EnvCategoryType::write): ?>
                    <!-- write -->
                    <form method="post" action="manage/edit">
                        <?php SecurityManager::getInstance()->insertHiddenToken(); ?>

                        <label for="<?= $env->getKey() ?>">
                            <small><?= $env->getCategoryIcon() ?></small> <?= $env->getKey() ?>
                        </label>
                        <div class="input-btn-sm">
                            <input type="hidden" name="key" value="<?= $env->getKey() ?>" hidden/>
                            <input type="text" id="<?= $env->getKey() ?>" name="value" required/>
                            <button type="submit">
                                <?= LangManager::translate('core.btn.edit') ?>
                            </button>
                        </div>
                    </form>
                <?php endif; ?>
                <?php if ($env->getCategory() === EnvCategoryType::restricted): ?>
                    <!-- restricted -->
                    <div>
                        <label for="<?= $env->getKey() ?>">
                            <small><?= $env->getCategoryIcon() ?></small> <?= $env->getKey() ?>
                        </label>
                        <input type="password" class="input" id="<?= $env->getKey() ?>" name="<?= $env->getKey() ?>"
                               value="*****************" disabled/>
                    </div>
                <?php endif; ?>
                <?php if ($env->getCategory() === EnvCategoryType::read): ?>
                    <!-- read -->
                    <div>
                        <label for="<?= $env->getKey() ?>">
                            <small><?= $env->getCategoryIcon() ?></small> <?= $env->getKey() ?>
                        </label>
                        <input type="text" class="input" id="<?= $env->getKey() ?>" name="<?= $env->getKey() ?>"
                               value="<?= $env->getValue() ?>" disabled/>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>