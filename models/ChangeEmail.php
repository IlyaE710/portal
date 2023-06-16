<?php

namespace app\models;

use Yii;
use yii\base\Model;

class ChangeEmail extends Model
{
    public $email;

    public function rules(): array
    {
        return [
            [['email'], 'required'],
            [['email'], function ($attribute, $params, $validator) {
                if (User::findByEmail($this->{$attribute}) !== null) {
                    $this->addError($attribute, 'Такой Email уже есть в системе.');
                }
            }],
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
        ];
    }

    public function change(): bool
    {
        if ($this->validate()) {
            $user = Yii::$app->user->identity;
            $user->email = $this->email;
            $user->save();
            return true;
        }

        return false;
    }

}