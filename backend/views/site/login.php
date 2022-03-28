<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Вхід' . ' | ' . Yii::$app->name;
?>

<p class="login-box-msg">Для входу, заповніть поля нижче</p>

<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
<?php echo $form->errorSummary($model) ?>

<?php echo $form->field($model, 'username', [
    'inputTemplate' => '<div class="input-group">{input}<div class="input-group-append"><span class="input-group-text"><span class="fas fa-user"></span></span></div></div>'
])->textInput(['placeholder'=>'username'])->label(false) ?>

<?= $form->field($model, 'password', [ 'template'=>"{label}\n<div class=\"input-group\">{input}\n<div class=\"input-group-append\"><div class=\"input-group-text\"><span class=\"fas fa-lock\"></span></div></div></div>\n{hint}\n{error}" ])->passwordInput(['placeholder'=>'password'])->label(false) ?>

    <div class="row">
        <div class="col-8">
            <?= $form->field($model, 'rememberMe', ['options'=>['class'=>'icheck-primary']])->checkbox() ?>
        </div>
        <div class="col-4">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
        </div>
    </div>


<?php ActiveForm::end(); ?>

<div class="social-auth-links text-center mb-3 d-none">
    <p>- OR -</p>
    <a href="#" class="btn btn-block btn-primary">
        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
    </a>
    <a href="#" class="btn btn-block btn-danger">
        <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
    </a>
</div>
<!-- /.social-auth-links -->

<div class="pt-3">
    <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
    </p>
    <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
    </p>
</div>
