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
    public static function tableName()
    {
        return 'event';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
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
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'duration' => 'Duration',
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
        return $this->hasOne(Curriculum::class, ['id' => 'curriculumId']);
    }

    /**
     * Gets query for [[MaterialEvents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaterialEvents()
    {
        return $this->hasMany(MaterialEvent::class, ['event_id' => 'id']);
    }

    /**
     * Gets query for [[Materials]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaterials()
    {
        return $this->hasMany(Material::class, ['id' => 'material_id'])->viaTable('material_event', ['event_id' => 'id']);
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
