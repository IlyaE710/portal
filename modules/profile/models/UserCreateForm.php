<?php

namespace app\modules\profile\models;

class UserCreateForm extends \yii\base\Model
{
    public $email;
    public $role;

    public function rules(): array
    {
        return [
            // username and password are both required
            [['email', 'role'], 'required'],
            // rememberMe must be a boolean value
            [['role'], 'string'],
            [['email'], 'email'],
        ];
    }
}