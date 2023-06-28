<?php

namespace app\models;

use Yii;
use yii\base\Model;

class ChangeEmail extends Model
{
    public $email;
    public $firstname;
    public $lastname;
    public $patronymic;

    public function rules(): array
    {
        return [
            [['email'], function ($attribute, $params, $validator) {
                $findUser = User::findByEmail($this->{$attribute});
                if ($findUser->id === Yii::$app->user->id) {
                    return;
                }
                if ($findUser !== null) {
                    $this->addError($attribute, 'Такой Email уже есть в системе.');
                }
            }],
            ['email', 'email'],
            [['firstname', 'lastname', 'patronymic'], 'string'],
            ['email', 'email'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels(): array
    {
        return [
            'email' => 'Email',
            'firstname' => 'Имя',
            'lastname' => 'Фамилия',
            'patronymic' => 'Отчество',
        ];
    }

    public function change(): bool
    {
        if ($this->validate()) {
            $user = Yii::$app->user->identity;
            $user->email = $this->email;
            $user->firstname = $this->firstname;
            $user->lastname = $this->lastname;
            $user->patronymic = $this->patronymic;
            $user->save();
            return true;
        }
        return false;
    }

}