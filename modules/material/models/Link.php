<?php

namespace app\modules\material\models;

use Yii;

/**
 * This is the model class for table "link".
 *
 * @property int $id
 * @property string $url
 * @property string|null $description
 * @property int $material_id
 *
 * @property Material $material
 */
class Link extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'link';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url', 'material_id'], 'required'],
            [['description'], 'string'],
            [['material_id'], 'default', 'value' => null],
            [['material_id'], 'integer'],
            [['url'], 'string', 'max' => 255],
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
            'url' => 'Url',
            'description' => 'Description',
            'material_id' => 'Material ID',
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
