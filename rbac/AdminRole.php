<?php

namespace app\rbac;

class AdminRole extends \yii\rbac\Rule
{
    public $name = 'isAdmin';

    public function execute($user, $item, $params)
    {
        return $user && $user->role === 'admin';
    }
}