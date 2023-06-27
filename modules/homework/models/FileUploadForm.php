<?php

namespace app\modules\homework\models;

use yii\base\Model;
use yii\web\UploadedFile;

class FileUploadForm extends Model
{
    /**
     * @var UploadedFile[] массив для хранения загруженных файлов
     */
    public $files;

    public function rules(): array
    {
        return [
            [['files'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, doc, docx, pdf, RAR, zip, 7Zip, pptx, xlsx', 'checkExtensionByMimeType' => false, 'maxFiles' => 5],
        ];
    }

    public function upload(): bool
    {
        if ($this->validate()) {
            foreach ($this->files as $file) {
                $filename = $this->generateUniqueFileName($file->name . '.' . $file->extension);
                $file->saveAs('uploads' . '/' . $filename);
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