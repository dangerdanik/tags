<?php

use yii\helpers\Url;

$tags = null;
$style = null;
$tagId = \Yii::$app->request->get('tag_id');

if ($data) {
    foreach ($data as $tag) {
        if ($tag['count'] != 0) {
            $title = $tag['description'];
            $active = false;
            if ($tagId == $tag['id']) {
                $active = 'active';
            }
            $tags[] = "<a class='cloudTags btn btn-primary $active' title='$title' role='button' href=" . Url::toRoute(['/tag', 'tag_id' => $tag['id']]) . ">" . $tag['name'] . "</a>";
        }
    }
    echo implode(" ", $tags) . "<br>";
}

?>

<style>
    .cloudTags {
        margin-top: 10px;
        border-radius: 40px;
        font-size: .775rem;
        font-weight: 300;
        outline: none;
        border-color: #5a7b8c;
        background: #b0b0b0;
        /*width: 250px;*/
        transition: all 0.6s ease;
        /*height: 40px;*/

    }

    .cloudTags:hover {
        margin-top: 10px;
        border-radius: 40px;
        font-size: .775rem;
        font-weight: 300;
        outline: none;
        border-color: rgba(51, 51, 51, 1);
        background: #b0b0b0;
        /*width: 250px;*/
        transition: all 0.6s ease;
        /*height: 40px;*/
    }

    .cloudTags:active {
        margin-top: 10px;
        border-radius: 40px;
        /*width: 250px*/;
        font-size: .775rem;
        font-weight: 300;
        border-color: rgba(51, 51, 51, 1);
        background: #b0b0b0;
        /*height: 40px;*/
        outline: none;
        transition: all 0.6s ease;
    }
</style>