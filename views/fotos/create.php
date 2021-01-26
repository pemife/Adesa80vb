<?php

use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Fotos */

$this->title = 'Subir una Foto';
$this->params['breadcrumbs'][] = ['label' => 'Fotos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$js = <<<SCRIPT
$(botonAvanzado).click(opcionesAvanzadas);

function opcionesAvanzadas(e){
    e.preventDefault();
    $(".field-fotos-fecha").show();
    $(".field-fotos-equipo_id").show();
    $(botonAvanzado).hide();
}
SCRIPT;
$this->registerJs($js);
?>

<div class="fotos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'archivo')->textInput(['maxlength' => true]) ?>

    <?= Html::a('','javascript:void(0)', [
        'class' => 'fas fa-plus mb-4',
        'id' => 'botonAvanzado'
    ]) ?>
    
    <?= $form->field($model, 'fecha', [
            'options' => [
                'style' => 'display: none',
                'class' => 'mb-3'
            ]
        ])->widget(DatePicker::class, [
            'options' => [
                'placeholder' => 'Introduzca fecha de la foto',
            ],
            'size' => 'sm',
            'pluginOptions' => [
                'autoclose'=> true,
                'format' => 'dd-mm-yyyy',
            ]
    ]) ?>

    <?= $form->field($model, 'equipo_id', [
            'options' => [
                'style' => 'display: none',
                'class' => 'mb-3'
            ]
        ])->widget(Select2::class, [
        'data' => $equiposId,
        'options' => [
            'placeholder' => 'Selecciona un equipo ...'
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
