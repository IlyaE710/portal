<?php

namespace app\rbac;

use Yii;
use yii\base\ActionFilter;
use yii\web\ForbiddenHttpException;

class RoleFilter extends ActionFilter
{
    public function beforeAction($action)
    {
        if (Yii::$app->user->identity->isBanned()) {
            throw new ForbiddenHttpException('Вам запрещен доступ к сайту.');
        }

        return parent::beforeAction($action);
    }
}