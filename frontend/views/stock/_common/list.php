<?php

/**
 * @var $this View
 * @var $models \common\models\Stock
 */

use yii\helpers\Url;
use yii\web\View;

?>


<div class="card-news card-news--3col">
    <?php
    foreach ($models as $model) { ?>
        <div class="card-news__item">
            <a class="card-news__image" href="<?= Url::toRoute(['stock/view', 'id' => $model->id]); ?>" style="background-image: url(<?= $model->getImage('article') ?>)">
                <div class="home-news__type">Акция</div>
            </a>
            <a class="card-news__link"
               href="<?= Url::toRoute(['stock/view', 'id' => $model->id]); ?>"><?= $model->title ?></a>
        </div>
    <?php } ?>
</div>