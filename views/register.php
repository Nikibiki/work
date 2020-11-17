<?php
/**
 * @param app\controllers\AuthController $model
 */
?>

<h1>Create an account</h1>
<?php?>j
<form action="" method="post">
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label>First Name</label>
                <input type="text" class="form-control <?= $model->hasError('fname') ? 'is-invalid' : 'is-valid'?>" name="fname" value="<?= $model->fname;?>">
                <div class="invalid-feedback">
                    <?= $model->getFirstError('fname')?>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" class="form-control" name="lname" value="<?= $model->lname;?>">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="text" class="form-control" name="email">
    </div>
    <div class="form-group">
        <label>Password</label>
        <input class="form-control" name="password" type="password">
    </div>
    <div class="form-group">
        <label>Confirm Password</label>
        <input class="form-control" name="cpassword" type="password">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>