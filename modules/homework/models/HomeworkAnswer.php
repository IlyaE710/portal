<?php

namespace app\modules\homework\models;

use app\models\User;
use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "homework_answer".
 *
 * @property int $id
 * @property int $studentId
 * @property int $homeworkId
 * @property string|null $content
 * @property string $comment
 * @property string $mark
 *
 * @property Homework $homework
 * @property HomeworkFile[] $homeworkFiles
 * @property User $student
 */
class HomeworkAnswer extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile[] массив для хранения загруженных файлов
     */
    public $files;
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
            [['content', 'comment', 'mark'], 'string'],
            [['homeworkId'], 'exist', 'skipOnError' => true, 'targetClass' => Homework::class, 'targetAttribute' => ['homeworkId' => 'id']],
            [['files'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, doc, docx, pdf, RAR, zip, 7Zip, pptx, xlsx, 7z', 'checkExtensionByMimeType' => false, 'maxFiles' => 5, 'maxSize' => 40 * 1024 * 1024],
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
            'comment' => 'Комментарий',
            'mark' => 'Оценка',
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

    public function upload(): bool
    {
        if (empty($this->files)) return false;
        if ($this->validate()) {
            foreach ($this->files as $file) {
                $filename = $this->generateUniqueFileName($file->name);
                $file->name = $filename;
                $file->saveAs('uploads' . '/homeworks/' . $filename);
            }
            return true;
        }
        return false;
    }

    protected function generateUniqueFileName($filename): string
    {
        return uniqid() . '_' . $filename;
    }
}
