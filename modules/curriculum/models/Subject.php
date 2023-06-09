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
    public static function tableName(): string
    {
        return 'subject';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['name'], 'unique'],
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
            'name' => 'Название',
        ];
    }

    /**
     * Gets query for [[CurriculumPatterns]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCurriculumPatterns(): \yii\db\ActiveQuery
    {
        return $this->hasMany(CurriculumPattern::class, ['subjectId' => 'id']);
    }

    /**
     * Gets query for [[Curriculums]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCurriculums(): \yii\db\ActiveQuery
    {
        return $this->hasMany(Curriculum::class, ['subjectId' => 'id']);
    }
}
