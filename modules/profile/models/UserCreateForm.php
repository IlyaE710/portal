<?php

namespace app\modules\profile\models;

use app\models\User;
use Yii;

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

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'role' => 'Роль',
        ];
    }

    public function sendEmail(): bool
    {
        /* @var $user User */
        $user = User::findOne([
            'email' => $this->email,
        ]);

        if ($user) {
            $password = Yii::$app->security->generateRandomString();
            $user->passwordHash = Yii::$app->security->generatePasswordHash($password);
            $user->save();

            return Yii::$app
                ->mailer
                ->compose(
                    ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                    ['user' => $user, 'password' => $password],
                )
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
                ->setTo($this->email)
                ->setSubject('Получение доступа к учебному порталу вуза')
                ->send();
        }

        return false;
    }
}