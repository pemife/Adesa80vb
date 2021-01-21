<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "videos".
 *
 * @property int $id
 * @property string $titulo
 * @property string $descripcion
 * @property string $archivo
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
            [['titulo', 'descripcion', 'archivo', 'contadorvisitas'], 'required'],
            [['descripcion'], 'string'],
            [['contadorvisitas'], 'number'],
            [['titulo', 'archivo'], 'string', 'max' => 255],
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
