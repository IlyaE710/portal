<?php

namespace app\modules\curriculum\models;

use Yii;

/**
 * This is the model class for table "curriculum_pattern".
 *
 * @property int $id
 * @property int $subjectId
 * @property string $description
 *
 * @property EventPattern[] $eventPatterns
 * @property Subject $subject
 */
class CurriculumPattern extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'curriculum_pattern';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subjectId', 'description'], 'required'],
            [['subjectId'], 'default', 'value' => null],
            [['subjectId'], 'integer'],
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
        ];
    }

    /**
     * Gets query for [[EventPatterns]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEventPatterns()
    {
        return $this->hasMany(EventPattern::class, ['curriculumId' => 'id']);
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
