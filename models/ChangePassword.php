<?php

namespace app\models;

use Yii;
use yii\base\Model;

class ChangePassword extends Model
{
    public $currentPassword;
    public $newPassword;
    public $confirmNewPassword;

    public function rules()
    {
        return [
            [['currentPassword', 'newPassword', 'confirmNewPassword'], 'required'],
            ['currentPassword', function ($attribute, $params, $validator) {
                if (!Yii::$app->security->validatePassword($this->currentPassword, Yii::$app->user->identity->passwordHash))
                {
                    $this->addError($attribute, 'Неправильный пароль');
                }
            }],
            ['confirmNewPassword', 'compare', 'compareAttribute' => 'newPassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'currentPassword' => 'Текущий пароль',
            'newPassword' => 'Новый пароль',
            'confirmNewPassword' => 'Подтвердите новый пароль',
        ];
    }

    public function change(): bool
    {
        if ($this->validate()) {
            $user = Yii::$app->user->identity;
            $user->passwordHash = Yii::$app->security->generatePasswordHash($this->newPassword);
            $user->save();
            return true;
        }

        return false;
    }

}