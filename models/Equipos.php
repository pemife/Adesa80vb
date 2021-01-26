<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "equipos".
 *
 * @property int $id
 * @property string $categoria
 * @property string $genero
 * @property string $entrenador
 *
 * @property Fotos[] $fotos
 */
class Equipos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'equipos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['categoria', 'genero', 'entrenador'], 'required'],
            [['categoria'], 'string', 'max' => 15],
            [['genero'], 'string', 'max' => 1],
            [['entrenador'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'categoria' => 'Categoria',
            'genero' => 'Genero',
            'entrenador' => 'Entrenador',
        ];
    }

    /**
     * Gets query for [[Fotos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFotos()
    {
        return $this->hasMany(Fotos::class, ['equipo_id' => 'id'])->inverseOf('equipo');
    }
}
