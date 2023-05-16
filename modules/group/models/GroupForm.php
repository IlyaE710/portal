<?php

namespace app\modules\group\models;

class GroupForm extends \yii\base\Model
{
    public $id;
    public $name;
    public $users;
    public $newUsers;

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['users'], 'safe'],
            [['newUsers'], 'safe'],
            [['newUsers'], 'default', 'value' => null],
            [['id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'users' => 'Студенты',
        ];
    }
}