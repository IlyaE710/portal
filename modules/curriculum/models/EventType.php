<?php

namespace app\modules\curriculum\models;

use Yii;

/**
 * This is the model class for table "event_type".
 *
 * @property int $id
 * @property string $name
 *
 * @property EventPattern[] $eventPatterns
 * @property Event[] $events
 */
class EventType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'event_type';
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
     * Gets query for [[EventPatterns]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEventPatterns(): \yii\db\ActiveQuery
    {
        return $this->hasMany(EventPattern::class, ['typeId' => 'id']);
    }

    /**
     * Gets query for [[Events]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvents(): \yii\db\ActiveQuery
    {
        return $this->hasMany(Event::class, ['typeId' => 'id']);
    }
}
