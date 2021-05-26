<?php

namespace frontend\widgets\tag;

use yii\base\Widget;
use yii\helpers\Url;

class CloudTagWidget extends Widget
{
    public $data;

    public function run()
    {
        return $this->render('index',['data' => $this->data]);
    }
}