<?php

namespace app\modules\homework\models;

use Yii;

/**
 * This is the model class for table "homework_file".
 *
 * @property int $id
 * @property int $homeworkAnswerId
 * @property string $pathname
 *
 * @property HomeworkAnswer $homeworkAnswer
 */
class HomeworkFile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'homework_file';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['homeworkAnswerId', 'pathname'], 'required'],
            [['homeworkAnswerId'], 'default', 'value' => null],
            [['homeworkAnswerId'], 'integer'],
            [['pathname'], 'string'],
            [['homeworkAnswerId'], 'exist', 'skipOnError' => true, 'targetClass' => HomeworkAnswer::class, 'targetAttribute' => ['homeworkAnswerId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'homeworkAnswerId' => 'Homework Answer ID',
            'pathname' => 'Pathname',
        ];
    }

    /**
     * Gets query for [[HomeworkAnswer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHomeworkAnswer()
    {
        return $this->hasOne(HomeworkAnswer::class, ['id' => 'homeworkAnswerId']);
    }
}
