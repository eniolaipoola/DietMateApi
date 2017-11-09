<?php

/* @var $this yii\web\View */

$this->title = 'DietApp';
?>
<div class="site-index">

    <div class="jumbotron">
        <h2>Welcome!</h2>

        <p class="lead">You have successfully gotten to the Module part of the application.</p>
    </div>

    <div class="body-content">

        <form class="form-group">
            <div class="form-group">
                <label>Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input">
                    Check me out
                </label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
