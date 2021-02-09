<?php

/* @var $this yii\web\View */
use yii\bootstrap4\Html;

$this->title = 'Índice Adesa80vb';
$js = <<<SCRIPT
// $(w0).hide();
SCRIPT;
$this->registerJS($js);
$css = <<<CSS
.carousel {
  width: 70% ;
  margin-left: auto ;
  margin-right: auto ;
}

.carousel-control-prev-icon {
  color: 'red';
}
.carousel-control-next-icon {
  color: #f00;
}

.imagenFoto {
  text-align: center;
  height: 40% ;
  opacity: 0.6;
  transition: 0.3s;
}
CSS;
$this->registerCSS($css);

Yii::debug($fotosProvider);
?>
<div class="site-index">

    <div class="col-md-12 mb-2">

        <?= Html::img('', ['name' => 'logo','width' => 300, 'height' => 150]) ?>

        <!-- <label for="logo" class="">Adesa 80 Voleibol</label> -->

        <?= Html::label('Adesa 80 Voleibol', 'logo', ['class' => 'align-bottom h3']) ?>

        <!-- <h5>Adesa 80 Voleibol</h5> -->
    
    </div>

    <br>

    <div class="col-md-12 d-flex justify-content-around mt-2 mb-2">

        <?= Html::a('Fotos', ['fotos/index'], ['class' => 'h3']) ?>

        <?= Html::a('Videos', ['videos/index'], ['class' => 'h3']) ?>

    </div>

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <?php for ($i = 0; $i < $fotosProvider->count; $i++) : ?>
          <li data-target="#carouselExampleIndicators" data-slide-to="<?= $i ?>" <?= $i == 0 ? 'class="active"' : '' ?>></li>
        <?php endfor; ?>
      </ol>
        <div class="carousel-inner">
        <?php
        $esPrimero = true;
        foreach ($fotosProvider->getModels() as $foto) : ?>
          <div class="carousel-item<?= $esPrimero ? ' active' : '' ?>">
            <?php
            echo Html::a(
                Html::img($foto->imagen_url, [
                  'class' => 'd-block imagenFoto mx-auto',
                  'alt' => $foto->titulo,
                  'style' => 'max-height: 50vh;',
                ]),
                [
                  'fotos/view', 'id' => $foto->id
                ]
            );
            $esPrimero = false;
            ?>

          </div>
        <?php endforeach; ?>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    
</div>
