<?php

namespace app\modules\homework\models;

use Yii;

/**
 * This is the model class for table "homework_answer".
 *
 * @property int $id
 * @property int $studentId
 * @property int $homeworkId
 * @property string|null $content
 *
 * @property Homework $homework
 * @property HomeworkFile[] $homeworkFiles
 * @property User $student
 */
class HomeworkAnswer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'homework_answer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['studentId', 'homeworkId'], 'required'],
            [['studentId', 'homeworkId'], 'default', 'value' => null],
            [['studentId', 'homeworkId'], 'integer'],
            [['content'], 'string'],
            [['homeworkId'], 'exist', 'skipOnError' => true, 'targetClass' => Homework::class, 'targetAttribute' => ['homeworkId' => 'id']],
            [['studentId'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['studentId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'studentId' => 'Student ID',
            'homeworkId' => 'Homework ID',
            'content' => 'Content',
        ];
    }

    /**
     * Gets query for [[Homework]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHomework()
    {
        return $this->hasOne(Homework::class, ['id' => 'homeworkId']);
    }

    /**
     * Gets query for [[HomeworkFiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHomeworkFiles()
    {
        return $this->hasMany(HomeworkFile::class, ['homeworkAnswerId' => 'id']);
    }

    /**
     * Gets query for [[Student]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(User::class, ['id' => 'studentId']);
    }
}
