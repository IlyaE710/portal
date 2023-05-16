<?php

namespace app\modules\curriculum\models;

use app\modules\group\models\Group;
use Yii;

/**
 * This is the model class for table "curriculum".
 *
 * @property int $id
 * @property int $subjectId
 * @property int $groupId
 * @property string $description
 * @property int $semester
 *
 * @property Event[] $events
 * @property Subject $subject
 * @property Group $group
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

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['subjectId', 'description'], 'required'],
            [['subjectId', 'semester', 'groupId'], 'default', 'value' => null],
            [['subjectId', 'semester', 'groupId'], 'integer'],
            [['description'], 'string'],
            [['subjectId'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::class, 'targetAttribute' => ['subjectId' => 'id']],
            [['groupId'], 'exist', 'skipOnError' => true, 'targetClass' => Group::class, 'targetAttribute' => ['groupId' => 'id']],
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
