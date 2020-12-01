<?php
/**
 * @param app\controllers\AuthController $model
 */
use app\core\form\Form;
?>

<h1>Create an account</h1>
<? $form = Form::begin('', 'post')?>
    <div class="row">
        <div class="col">
            <?= $form->field( $model, 'fname');?>
        </div>
        <div class="col">
            <?= $form->field( $model, 'lname');?>
        </div>
    </div>
    <?= $form->field( $model, 'email');?>
    <?= $form->field( $model, 'password')->passwordField();?>
    <?= $form->field( $model, 'cpassword')->passwordField();?>
    <button type="submit" class="btn btn-primary">Submit</button>
<? Form::end()?>
