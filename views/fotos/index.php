<?php

use yii\bootstrap4\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fotos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fotos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Fotos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'titulo',
            'archivo',
            'fecha',
            'equipo_id',
            //'contadorvisitas',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
