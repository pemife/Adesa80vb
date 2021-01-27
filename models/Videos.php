<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "videos".
 *
 * @property int $id
 * @property string $titulo
 * @property string $descripcion
 * @property string $archivo_url
 * @property string $archivo_nombre
 * @property float $contadorvisitas
 */
class Videos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'videos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo', 'descripcion', 'archivo_url', 'archivo_nombre', 'contadorvisitas'], 'required'],
            [['descripcion'], 'string'],
            [['contadorvisitas'], 'number'],
            [['titulo', 'archivo_url', 'archivo_nombre'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo' => 'Titulo',
            'descripcion' => 'Descripcion',
            'archivo' => 'Archivo',
            'contadorvisitas' => 'Contadorvisitas',
        ];
    }
}
