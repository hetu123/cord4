<?php
$this->title = 'Starter Page';
$this->params['breadcrumbs'] = [['label' => $this->title]];
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Users',
                'number' =>  \common\models\User::find()->count() ,
                'theme' => 'gradient-warning',
                'icon' => 'fa fa-users',
            ]) ?>
        </div>
    </div>
</div>