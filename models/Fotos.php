<?php

namespace app\models;

use PhpOffice\PhpSpreadsheet\Shared\Date;
use Yii;

/**
 * This is the model class for table "fotos".
 *
 * @property int $id
 * @property string $titulo
 * @property string $archivo
 * @property string $fecha
 * @property int|null $equipo_id
 * @property float $contadorvisitas
 *
 * @property Equipos $equipo
 */
class Fotos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fotos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo', 'archivo', 'fecha', 'contadorvisitas'], 'required'],
            [['fecha'], 'date', 'format' => 'd-m-Y', 'min' => '1-1-1960', 'max' => date('d-m-Y')],
            [['equipo_id'], 'default', 'value' => null],
            [['equipo_id'], 'integer'],
            [['contadorvisitas'], 'default', 'value' => 0],
            [['contadorvisitas'], 'number'],
            [['titulo', 'archivo'], 'string', 'max' => 255],
            [['equipo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Equipos::class, 'targetAttribute' => ['equipo_id' => 'id']],
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
            'archivo' => 'Archivo',
            'fecha' => 'Fecha',
            'equipo_id' => 'Equipo',
            'contadorvisitas' => 'Contadorvisitas',
        ];
    }

    /**
     * Gets query for [[Equipo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipo()
    {
        return $this->hasOne(Equipos::class, ['id' => 'equipo_id'])->inverseOf('fotos');
    }
}
