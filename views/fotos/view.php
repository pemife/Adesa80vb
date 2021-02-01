<?php

use yii\bootstrap4\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Fotos */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Fotos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="fotos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->id === 1) : ?>

        <p>
            <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Borrar', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => '¿Estas segur@ de que quieres borrar esta imagen?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>

    <?php endif ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'titulo',
            'fecha',
            'equipo_id',
            'contadorvisitas',
            'imagen_nombre',
            'imagen_url:image',
        ],
    ]) ?>

    <img src="<?= $model->imagen_url ?>" alt="<?= $model->imagen_nombre ?>">

</div>
