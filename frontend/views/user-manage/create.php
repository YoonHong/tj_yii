<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserInfo */

$this->title = 'Create User Info';
$this->params['breadcrumbs'][] = ['label' => 'User Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="user-info-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($user_model, 'username')->textInput(['maxlength' => true])->label('User ID') ?>

        <?= $form->field($user_model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'school')->textInput(['maxlength' => true]) ?>

        <?= $form->field($user_model, 'email') ?>

        <?= $form->field($model, 'etc')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
