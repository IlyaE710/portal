<?php

namespace app\modules\group\models;

use app\models\User;
use app\modules\curriculum\models\Curriculum;

/**
 * This is the model class for table "group".
 *
 * @property int $id
 * @property string $name
 *
 * @property UserGroup[] $userGroups
 * @property User[] $users
 * @property Curriculum[] $curriculums
 */
class Group extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => 'Группа',
        ];
    }

    /**
     * Gets query for [[UserGroups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserGroups(): \yii\db\ActiveQuery
    {
        return $this->hasMany(UserGroup::class, ['group_id' => 'id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers(): \yii\db\ActiveQuery
    {
        return $this->hasMany(User::class, ['id' => 'user_id'])->viaTable('user_group', ['group_id' => 'id']);
    }

    /**
     * Gets query for [[Events]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCurriculums(): \yii\db\ActiveQuery
    {
        return $this->hasMany(Curriculum::class, ['groupId' => 'id']);
    }
}
