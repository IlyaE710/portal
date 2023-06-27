<?php

namespace app\models;

use app\modules\material\models\File;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile[] массив для хранения загруженных файлов
     */
    public $files;

    public function rules(): array
    {
        return [
            [['files'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, doc, docx, pdf, RAR, zip, 7Zip, pptx, xlsx', 'checkExtensionByMimeType' => false, 'maxFiles' => 5, 'maxSize' => '5M'],
        ];
    }

    public function upload(string $uploadDir = 'uploads'): bool
    {
        if ($this->validate()) {
            foreach ($this->files as $file) {
                $file->saveAs($uploadDir . '/' . md5($file->name) . '.' .$file->extension);
            }
            return true;
        }
        echo '<pre>' . print_r($this->errors, true) . '</pre>';die;
        return false;
    }
}