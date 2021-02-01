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

    <div class="container">
        <?php foreach($dataProvider->getModels() as $model) : ?>
            <?php  ?>
            <img src="<?= $model->imagen_url ?>" alt="<?= $model->imagen_nombre ?>">
            <?= $contador++ ?>
        <?php endforeach ?>
    </div>

</div>
