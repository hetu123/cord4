<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <a style=" color:white" href="user">
                <div class="info-box bg-pink" style="width: 20%;float: left;margin: 0 5px 50px 70px;">
                    <span class="info-box-icon"><i class="fa fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">All Users</span>
                        <h3><?= \common\models\User::find()->count() ?></h3>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </a>
        </div>

    </div>
</div>
