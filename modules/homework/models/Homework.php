<?php

namespace app\modules\homework\models;

use Yii;

/**
 * This is the model class for table "homework".
 *
 * @property int $id
 *
 * @property EventPattern[] $eventPatterns
 * @property Event[] $events
 * @property HomeworkAnswer[] $homeworkAnswers
 * @property string $content
 * @property HomeworkEventPattern[] $homeworkEventPatterns
 * @property HomeworkEvent[] $homeworkEvents
 */
class Homework extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'homework';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content', 'title'], 'required'],
            [['content', 'title'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Контенте',
            'title' => 'Название',
        ];
    }

    /**
     * Gets query for [[EventPatterns]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEventPatterns()
    {
        return $this->hasMany(EventPattern::class, ['id' => 'event_pattern_id'])->viaTable('homework_event_pattern', ['homework_id' => 'id']);
    }

    /**
     * Gets query for [[Events]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::class, ['id' => 'event_id'])->viaTable('homework_event', ['homework_id' => 'id']);
    }

    /**
     * Gets query for [[HomeworkAnswers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers()
    {
        return $this->hasMany(HomeworkAnswer::class, ['homeworkId' => 'id']);
    }

    /**
     * Gets query for [[HomeworkEventPatterns]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHomeworkEventPatterns()
    {
        return $this->hasMany(HomeworkEventPattern::class, ['homework_id' => 'id']);
    }

    /**
     * Gets query for [[HomeworkEvents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHomeworkEvents()
    {
        return $this->hasMany(HomeworkEvent::class, ['homework_id' => 'id']);
    }
}
