<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fotos".
 *
 * @property int $id
 * @property string $titulo
 * @property string $imagen_nombre
 * @property string $imagen_url
 * @property string $fecha
 * @property int|null $equipo_id
 * @property float $contadorvisitas
 *
 * @property Equipos $equipo
 */
class Fotos extends \yii\db\ActiveRecord
{
    public $imagen;

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
            [['titulo', 'imagen'], 'required'],
            [['fecha'], 'date', 'format' => 'd-m-Y', 'min' => '1-1-1960', 'max' => date('d-m-Y')],
            [['equipo_id'], 'default', 'value' => null],
            [['equipo_id'], 'integer'],
            [['contadorvisitas'], 'default', 'value' => 0],
            [['contadorvisitas'], 'number'],
            [['titulo', 'imagen_nombre', 'imagen_url'], 'string', 'max' => 255],
            [['equipo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Equipos::class, 'targetAttribute' => ['equipo_id' => 'id']],
            [['imagen'], 'image', 'extensions' => 'jpg, jpeg, gif, png', 'maxSize' => 3*1024*1024, 'message' => 'La imagen es demasiado grande, no puede tener mas de 3MiB'],
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
            'imagen_nombre' => 'Nombre',
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

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        if ($insert) {
            if ($this->imagen) {
                $this->imagen_nombre = str_replace(' ', '_', $this->imagen->baseName);
                $this->imagen_url = 'media/imagenes/' . $this->imagen_nombre . '.' . $this->imagen->extension;
                $this->imagen->saveAs($this->imagen_url);
                return true;
            }
            return false;
        }
        return false;
    }

    public function limiteTamanio($imagen)
    {
        if ($this->imagen->size > 3000000) {
            $this->addError($imagen, 'El archivo ' . $this->imagen->basename . ' es demasiado grande (como mi pene jaja salu2)');
        }
    }
}
