<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserInfo */

$this->title = 'Update User: ' . ' ' . $model->user->username;
$this->params['breadcrumbs'][] = ['label' => 'User Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-info-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="user-info-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($user_model, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'school')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'etc')->textInput(['maxlength' => true]) ?>

        <?= $form->field($user_model, 'password')->passwordInput()->label('New Password')->hint('Only if you want to change password, enter it!') ?>

        <div class="form-group">
            <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Go Back', Yii::$app->request->referrer, ['class' => 'btn btn-default']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
