<?php

namespace app\rbac;

use yii\rbac\Rule;

class StudentRole extends Rule
{
    public $name = 'isStudent';

    public function execute($user, $item, $params)
    {
        // Проверяем, является ли пользователь студентом
        return $user && $user->role === 'student';
    }
}