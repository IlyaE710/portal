<?php

namespace app\rbac;

use yii\rbac\Rule;

class TeacherRole extends Rule
{
    public $name = 'isTeacher';

    public function execute($user, $item, $params)
    {
        // Проверяем, является ли пользователь учителем
        return $user && $user->role === 'teacher';
    }
}