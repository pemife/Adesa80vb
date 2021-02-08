<?php

use yii\bootstrap4\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Galería de imágenes';
$this->params['breadcrumbs'][] = $this->title;

$css = <<<STYLE

STYLE;
$this->registerCSS($css);
?>
<div class="fotos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->id === 1) : ?> 
        <p>
            <?= Html::a('Subir una Foto', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif ?>

    <!-- <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'titulo',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::encode($model->titulo) . '<br>' . Html::a(
                        Html::img($model->imagen_url, ['class' => 'mt-2', 'height' => 85, 'width' => 170, 'alt' => $model->titulo]),
                        ['fotos/view', 'id' => $model->id]
                    );
                }
            ],
            'fecha',
            'equipo_id',
        ],
    ]); ?> -->

    <?php if (empty($dataProvider->getModels())) : ?>
        <?= Html::tag('div', 'No hay imágenes todavía', ['class' => 'alert alert-info']) ?>
    <?php else : ?>

        <div class="container">
            <div class="row">
                <?php $contador = 0 ?>
                <?php foreach($dataProvider->getModels() as $model) : ?>
                    <?= Html::a(
                            Html::img(
                                $model->imagen_url,
                                [
                                    'title' => $model->imagen_nombre,
                                    'alt' => $model->imagen_nombre,
                                    'class' => 'img-fluid img-thumbnail border border-2 p-2 rounded m-2',
                                    'style' => 'max-height: 50vh'
                                ]
                            ),
                            ['fotos/view', 'id' => $model->id],
                            ['class' => 'col-lg-6']
                        ) ?>
                    <?php $contador++ ?>
                <?php endforeach ?>
            </div>
        </div>
    <?php endif ?>

</div>
