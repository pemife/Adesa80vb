<?php

use kartik\date\DatePicker;
use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Fotos */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="fotos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'archivo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha')->widget(DatePicker::class, [
        'options' => ['placeholder' => 'Introduzca fecha de la foto'],
        'size' => 'sm',
        'pluginOptions' => [
            'autoclose'=> true,
            'format' => 'yyyy-mm-dd'
        ]
    ]) ?>

    <?= $form->field($model, 'equipo_id')->textInput()->label('Equipo') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
