<?php

namespace app\modules\material\models;

use Yii;

/**
 * This is the model class for table "file".
 *
 * @property int $id
 * @property string $filename
 * @property string $path
 * @property int $size
 * @property string $extension
 * @property int $material_id
 * @property string|null $hashCode
 *
 * @property Material $material
 */
class File extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'file';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['filename', 'path', 'size', 'extension', 'material_id'], 'required'],
            [['filename', 'path'], 'string'],
            [['size', 'material_id'], 'default', 'value' => null],
            [['size', 'material_id'], 'integer'],
            [['extension'], 'string', 'max' => 10],
            [['hashCode'], 'string', 'max' => 32],
            [['material_id'], 'exist', 'skipOnError' => true, 'targetClass' => Material::class, 'targetAttribute' => ['material_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'filename' => 'Название',
            'path' => 'Путь',
            'size' => 'Размер',
            'extension' => 'Расширение',
            'material_id' => 'Material ID',
            'hashCode' => 'Хэш код',
        ];
    }

    /**
     * Gets query for [[Material]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaterial()
    {
        return $this->hasOne(Material::class, ['id' => 'material_id']);
    }
}
