<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
$session = Yii::$app->session;
if($session->get('type') == 'admin'){
    $action_list = '{view} {update} {delete}';
}else{
    $action_list = '{view}';
}

?>
<div class="user-index">

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php Pjax::begin(); echo \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [ 'attribute' => 'id', 'value' => function ($model) {
                return Html::a($model->id, \yii\helpers\Url::toRoute(['update', 'id'=>base64_encode($model->id)]), [ 'title' => Yii::t('app', 'Click to edit')]);
                }, 'format' => 'raw', 'filter' => true,
            ],
            'username',
            'email:email',
            'mobile_no',
            [
                'attribute' => 'role',
                'value' => function ($model) {
                    if ($model->role == "admin") {
                        return "Admin";
                    } else if ($model->role == "user") {
                        return "User";
                    } else{
                        return "Employee";
                    }
                }, 'format' => 'raw', 'filter' => Html::activeDropDownList($searchModel, 'role', ['' => 'All', 'admin' => 'Admin', 'user' => 'User','employee' => 'Employee'], ['class' => 'form-control'])
            ],
            [
                'label' => 'Status',
                'attribute' => 'status',
                // 'class' => 'yii\grid\ActionColumn',


                'filter' => [
                    '10' => 'active',
                    '9' => 'inactive'
                ],

                // translate lookup value
                'value' => function ($model) {
                    $active = [
                        '10' => 'active',
                        '9' => 'inactive'
                    ];

                    return $active[$model->status];
                },
                'contentOptions' =>function ($model, $key, $index, $column)
                {
                    if($model->status=='10'){
                        return ['style' =>'width:100px','class'=>'btn btn-success','onclick'=>"activeUser($model->id)"];

                    }
                    else
                    {
                        return ['style' =>'width:100px','class'=>'btn btn-danger','onclick'=>"activeUser($model->id)"];
                    }

                },
            ],
            [
                'header' => 'Action',
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['style' => 'width:92px'],
                'template' => $action_list,
                'buttons' => [
                    'update' => function ($url, $model) {
                        $url = Url::toRoute(['/user/update', 'id' => base64_encode($model->id)]);

                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => Yii::t('app', 'Update User'),
                            'data-pjax' => '0'
                        ]);
                    },
                    'delete' => function($url, $model){

                        $url = Yii::$app->urlManager->createUrl(['/user/delete/', 'id' => base64_encode($model->id)]);
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => Yii::t('app', 'Delete'),
                            'data-pjax' => '0',
                            'data-method' => 'POST',
                            'data-confirm' => Yii::t('yii', 'Are you sure you want to deactivate this user?'),
                        ]);
                    },
                ]

            ],
        ],
    ]); Pjax::end(); ?>


</div>
<script>
    function activeUser($id){
        $.ajax({
            url: '<?php echo Url::toRoute(['/user/active']) ?>',
            type: 'post',
            data: {id: $id },
            success: function (data) {
                location. reload(true);
                alert(data);

            }
        });
    }

</script>