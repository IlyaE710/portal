<?php

namespace app\modules\curriculum\models;

use Yii;

/**
 * This is the model class for table "curriculum".
 *
 * @property int $id
 * @property int $subjectId
 * @property string $description
 * @property int $semester
 *
 * @property Event[] $events
 * @property Subject $subject
 */
class Curriculum extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'curriculum';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subjectId', 'description'], 'required'],
            [['subjectId', 'semester'], 'default', 'value' => null],
            [['subjectId', 'semester'], 'integer'],
            [['description'], 'string'],
            [['subjectId'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::class, 'targetAttribute' => ['subjectId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subjectId' => 'Subject ID',
            'description' => 'Description',
            'semester' => 'Semester',
        ];
    }

    /**
     * Gets query for [[Events]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::class, ['curriculumId' => 'id']);
    }

    /**
     * Gets query for [[Subject]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subject::class, ['id' => 'subjectId']);
    }
}
