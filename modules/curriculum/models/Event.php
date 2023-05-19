<?php

namespace app\modules\curriculum\models;

use app\modules\material\models\Material;
use Yii;

/**
 * This is the model class for table "event".
 *
 * @property int $id
 * @property string $title
 * @property int $duration
 * @property int $typeId
 * @property int $curriculumId
 *
 * @property Curriculum $curriculum
 * @property MaterialEvent[] $materialEvents
 * @property Material[] $materials
 * @property EventType $type
 */
class Event extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'event';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['title', 'typeId', 'curriculumId'], 'required'],
            [['duration', 'typeId', 'curriculumId'], 'default', 'value' => null],
            [['duration', 'typeId', 'curriculumId'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['curriculumId'], 'exist', 'skipOnError' => true, 'targetClass' => Curriculum::class, 'targetAttribute' => ['curriculumId' => 'id']],
            [['typeId'], 'exist', 'skipOnError' => true, 'targetClass' => EventType::class, 'targetAttribute' => ['typeId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'duration' => 'Время',
            'typeId' => 'Type ID',
            'type' => 'Тип',
            'curriculumId' => 'Curriculum ID',
            'materials' => 'Материалы',
            'curriculum' => 'Курс',
        ];
    }

    /**
     * Gets query for [[Curriculum]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCurriculum(): \yii\db\ActiveQuery
    {
        return $this->hasOne(Curriculum::class, ['id' => 'curriculumId']);
    }

    /**
     * Gets query for [[MaterialEvents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaterialEvents(): \yii\db\ActiveQuery
    {
        return $this->hasMany(MaterialEvent::class, ['event_id' => 'id']);
    }

    /**
     * Gets query for [[Materials]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaterials(): \yii\db\ActiveQuery
    {
        return $this->hasMany(Material::class, ['id' => 'material_id'])->viaTable('material_event', ['event_id' => 'id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType(): \yii\db\ActiveQuery
    {
        return $this->hasOne(EventType::class, ['id' => 'typeId']);
    }
}
