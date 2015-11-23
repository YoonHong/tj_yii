<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UserManage */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User List';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="user-info-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User Info', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'User ID',
                'attribute' => 'username',
                'format'=>'raw',
                'value' => function($model){
                 $url = "/user-manage/view";

                 return Html::a($model['user']['username'], [$url, 'id' => $model->id], ['title' => 'Detail View']);
               },
            ],

            'full_name',
            'school',
            [
                'label' => 'Created Date',
                'attribute' => 'created_at',
                'filter' => false,
                'value' => function($model){
                    return Yii::$app->formatter->asDatetime($model['user']['created_at'], "php:d-M-Y");
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
