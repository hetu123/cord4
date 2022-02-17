<aside class="main-sidebar">

    <section class="sidebar">

   
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                   // ['label' => 'Menu Homeocare', 'options' => ['class' => 'header']],
                    // ['label'=>'auth genrate','url'=>['/auth/rbac']],
                    ['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/']],
                    // ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                 
                    [
                        'label' => 'User',
                        'icon' => 'user',
                        'url' => '/user',

                    ],                    
                ],
            ]
        ) ?>

    </section>

</aside>