<?php

namespace app\modules\curriculum\models;

use app\models\User;
use app\modules\group\models\Group;
use Yii;

/**
 * This is the model class for table "curriculum".
 *
 * @property int $id
 * @property int $subjectId
 * @property int $groupId
 * @property string $description
 * @property string $image
 * @property int $semester
 * @property int $authorId
 *
 * @property Event[] $events
 * @property Subject $subject
 * @property Group $group
 * @property User $author
 */

class Curriculum extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'curriculum';
    }
    public function rules(): array
    {
        return [
            [['subjectId', 'description', 'semester'], 'required'],
            [['subjectId', 'semester', 'groupId', 'authorId'], 'default', 'value' => null],
            [['subjectId', 'semester', 'groupId'], 'integer'],
            [['description'], 'string'],
            [['subjectId'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::class, 'targetAttribute' => ['subjectId' => 'id']],
            [['groupId'], 'exist', 'skipOnError' => true, 'targetClass' => Group::class, 'targetAttribute' => ['groupId' => 'id']],
            [['authorId'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['authorId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'subjectId' => 'Subject ID',
            'subject' => 'Предмет',
            'groupId' => 'Группа',
            'group' => 'Группа',
            'description' => 'Описание',
            'semester' => 'Семестр',
            'author' => 'Автор',
        ];
    }

    /**
     * Gets query for [[Events]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvents(): \yii\db\ActiveQuery
    {
        return $this->hasMany(Event::class, ['curriculumId' => 'id']);
    }

    /**
     * Gets query for [[Subject]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubject(): \yii\db\ActiveQuery
    {
        return $this->hasOne(Subject::class, ['id' => 'subjectId']);
    }

    public function getAuthor(): \yii\db\ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'authorId']);
    }

    /**
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroup(): \yii\db\ActiveQuery
    {
        return $this->hasOne(Group::class, ['id' => 'groupId']);
    }
}
