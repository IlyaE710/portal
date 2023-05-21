<?php

namespace app\modules\group\models;

use Yii;
use yii\base\Model;

class GroupForm extends Model
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
            ['name', 'unique', 'targetClass' =>Group::class, 'message' => 'Такая группа уже есть.'],
            [['users'], 'safe'],
            [['users'], 'default', 'value' => null],
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
            'name' => 'Название',
            'users' => 'Студенты',
            'newUsers' => 'Студенты',
        ];
    }
}