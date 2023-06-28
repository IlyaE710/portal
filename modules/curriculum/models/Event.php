<?php

namespace app\modules\curriculum\models;

use app\models\User;
use app\modules\homework\models\Homework;
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
 * @property string $startDate
 *
 * @property Curriculum $curriculum
 * @property MaterialEvent[] $materialEvents
 * @property Material[] $materials
 * @property Homework[] $homeworks
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
            [['duration', 'typeId', 'curriculumId', 'lectorId'], 'default', 'value' => null],
            [['duration', 'typeId', 'curriculumId', 'lectorId'], 'integer'],
            [['startDate'], 'date', 'format' => 'y-m-d H:i:s', 'min' => date('y-m-d H:i:s')],
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
            'typeId' => 'Тип',
            'type' => 'Тип',
            'curriculumId' => 'Curriculum ID',
            'materials' => 'Материалы',
            'homeworks' => 'Д/З',
            'curriculum' => 'Курс',
            'startDate' => 'Дата начала',
            'lectorId' => 'Лектор',
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
     * Gets query for [[Materials]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHomeworks(): \yii\db\ActiveQuery
    {
        return $this->hasMany(Homework::class, ['id' => 'homework_id'])->viaTable('homework_event', ['event_id' => 'id']);
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

    public function getLector(): \yii\db\ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'lectorId']);
    }
}
