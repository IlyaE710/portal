<?php

namespace app\modules\curriculum\models;

use Yii;

/**
 * This is the model class for table "subject".
 *
 * @property int $id
 * @property string $name
 *
 * @property CurriculumPattern[] $curriculumPatterns
 * @property Curriculum[] $curriculums
 */
class Subject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subject';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * Gets query for [[CurriculumPatterns]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCurriculumPatterns()
    {
        return $this->hasMany(CurriculumPattern::class, ['subjectId' => 'id']);
    }

    /**
     * Gets query for [[Curriculums]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCurriculums()
    {
        return $this->hasMany(Curriculum::class, ['subjectId' => 'id']);
    }
}
