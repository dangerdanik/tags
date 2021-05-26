<?php

namespace frontend\controllers;


use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\CloudTagRelation;
use common\models\CloudTag;

class TagController extends Controller
{
    use BaseController;

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex($tag_id)
    {
        $this->layout = 'main-new';
        $dataTags = new CloudTagRelation();
        $tags = CloudTag::findOne(['id' => $tag_id]);
        $tags->click_count++;
        $tags->save();
        $data = $dataTags->getTagsForFront($tag_id);
        return $this->render('index', ['data' => $data]);
    }
}