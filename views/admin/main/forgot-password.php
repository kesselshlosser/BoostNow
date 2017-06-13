<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\assets\AuthAsset;

AuthAsset::register($this);
?>

<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3 text-center">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3>Reset Password</h3>
		</div>

		<?php
			$smsg = Yii::$app->session->getFlash('emsg');
			if ($smsg) {
		?>
			<div class="alert alert-danger"><?= $smsg ?></div>
		<?php
			}
		?>
		
		<?php $form = ActiveForm::begin([
			'id' => 'form1',
			'method' => 'post',
			'fieldConfig' => [
				'template' => "<div class=\"field\"><div class=\"row\"><div class=\"col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3 text-center\">{label}{input}{error}</div></div></div>",
				'labelOptions' => [],
			],
		]); ?>

		<div class="panel-body">
			<div class="login-fields">
				<p>Please provide your email to recover your password</p>
						
				<?= $form->field($model, 'email')->textInput(['autofocus' => true, 'id' => 'email', 'placeholder' => 'Enter Your Email', 'class' => 'form-control']) ?>
			</div> <!-- /login-fields -->

			<div class="login-actions">
				<?= Html::submitButton('Reset', ['class' => 'button btn btn-success btn-large signin-btn', 'name' => 'cmd']) ?>
			</div> <!-- .actions -->
		</div>

		<?php ActiveForm::end(); ?>
</div> <!-- /content -->
<div class="clear"></div>

<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3 text-center">
	<a href="<?= Yii::$app->params['adminUrl']; ?>">Login to Your Account</a>
</div> <!-- /login-extra -->