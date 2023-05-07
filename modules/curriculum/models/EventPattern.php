<?php

namespace app\modules\curriculum\models;

use app\modules\material\models\Material;
use Yii;

/**
 * This is the model class for table "event_pattern".
 *
 * @property int $id
 * @property string $title
 * @property int $typeId
 * @property int $curriculumId
 *
 * @property CurriculumPattern $curriculum
 * @property MaterialEventPattern[] $materialEventPatterns
 * @property Material[] $materials
 * @property EventType $type
 */
class EventPattern extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event_pattern';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'typeId', 'curriculumId'], 'required'],
            [['typeId', 'curriculumId'], 'default', 'value' => null],
            [['typeId', 'curriculumId'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['curriculumId'], 'exist', 'skipOnError' => true, 'targetClass' => CurriculumPattern::class, 'targetAttribute' => ['curriculumId' => 'id']],
            [['typeId'], 'exist', 'skipOnError' => true, 'targetClass' => EventType::class, 'targetAttribute' => ['typeId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'typeId' => 'Type ID',
            'curriculumId' => 'Curriculum ID',
        ];
    }

    /**
     * Gets query for [[Curriculum]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCurriculum()
    {
        return $this->hasOne(CurriculumPattern::class, ['id' => 'curriculumId']);
    }

    /**
     * Gets query for [[MaterialEventPatterns]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaterialEventPatterns()
    {
        return $this->hasMany(MaterialEventPattern::class, ['event_pattern_id' => 'id']);
    }

    /**
     * Gets query for [[Materials]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaterials()
    {
        return $this->hasMany(Material::class, ['id' => 'material_id'])->viaTable('material_event_pattern', ['event_pattern_id' => 'id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(EventType::class, ['id' => 'typeId']);
    }
}
