<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\widgets\MainSidebarMenu;
use rmrevin\yii\fontawesome\FAR;
use rmrevin\yii\fontawesome\FAS;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

\backend\assets\AdminLteAsset::register($this);

$bodyClass = $this->params['body-class'] ?? null;
Html::addCssClass($bodyClass, ['hold-transition', 'sidebar-mini', 'layout-fixed', 'layout-navbar-fixed']);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="<?= implode(' ', $bodyClass['class']); ?>">
<?php $this->beginBody() ?>
<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
    <?php
    NavBar::begin([
        'brandUrl' => Yii::$app->homeUrl,
        'togglerOptions' => ['data-widget' => 'pushmenu', 'type' => 'link', 'widget'=>'nav-link'],
        'renderInnerContainer' => false,
        'options' => [
            'class' => 'main-header navbar navbar-expand navbar-light',
        ],
    ]);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => '<i class="fas fa-bars"></i>', 'linkOptions' => ['data-widget' => 'pushmenu'], 'encode' => false],
        ],
    ]);

    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li class="nav-item">'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    };
    $menuItems[] = ['label' => 'Home2', 'url' => ['/site/index'], 'linkOptions' => ['data-widget' => 'control-sidebar']];
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ml-auto'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-success elevation-4">
        <!-- Brand Logo -->
        <a href="<?= Yii::$app->homeUrl; ?>" class="brand-link navbar-dark text-center text-uppercase">
            <span class="brand-text font-weight-light"><?= Yii::$app->name; ?></span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel border-0 mt-3 pb-3 mb-3">
                <div class="text-center">
                    <?= Html::img('@web/img/logo.png', ['alt' => Yii::$app->name, 'style' => 'width: 30%', 'class'=>'mx-auto']);  ?>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <?php
                echo MainSidebarMenu::widget([
                    'options' => [
                        'class' => 'nav nav-pills nav-sidebar flex-column nav-child-indent',
                        'data' => [
                            'widget' => 'treeview',
                            'accordion' => 'false'
                        ],
                        'role' => 'menu',
                    ],
                    //'encodeLabels' => false,
                    //'activateParents' => true,
                    'items' => [
                        [
                            'icon' => FAS::icon('tachometer-alt', ['class' => ['nav-icon']]),
                            'label' => 'Інфо панель',
                            'url' => Yii::$app->homeUrl,
                            'active' => Yii::$app->controller->id === 'site',
                        ],
                        [
                            'icon' => FAS::icon('utensils', ['class' => ['nav-icon']]),
                            'label' => 'Харчування',
                            'url' => '#',
                            'options' => ['class' => 'nav-item has-treeview'],
                            'items' => [
                                [
                                    'icon' => FAR::icon('circle', ['class' => ['nav-icon']]),
                                    'label' => 'Замовлення',
                                    'url' => ['/nutrition/orders'],
                                    'active' => Yii::$app->controller->module->id == 'nutrition' && Yii::$app->controller->id === 'orders'
                                ],
                                [
                                    'icon' => FAR::icon('circle', ['class' => ['nav-icon']]),
                                    'label' => 'Страви',
                                    'url' => ['/nutrition/food'],
                                    'active' => Yii::$app->controller->id === 'food'
                                ],
                                [
                                    'icon' => FAR::icon('circle', ['class' => ['nav-icon']]),
                                    'label' => 'Сети',
                                    'url' => ['/nutrition/food-set'],
                                    'active' => Yii::$app->controller->id === 'food-set'
                                ],
                            ]
                        ],
                        [
                            'icon' => FAS::icon('calendar-alt', ['class' => ['nav-icon']]),
                            'label' => 'Проживання',
                            'url' => '#',
                            'options' => ['class' => 'nav-item has-treeview'],
                            'active' => Yii::$app->controller->id === 'apartment',
                            'items' => [
                                [
                                    'icon' => FAR::icon('circle', ['class' => ['nav-icon']]),
                                    'label' => 'Замовлення',
                                    'url' =>  ['/apartment/orders'],
                                    //'active' => Yii::$app->controller->id === 'apartment',
                                ],
                                [
                                    'icon' => FAR::icon('circle', ['class' => ['nav-icon']]),
                                    'label' => 'Хатини',
                                    'url' =>  ['/apartment/index'],
                                    'active' => Yii::$app->controller->id === 'apartment', //Yii::$app->controller->route
                                ],
                            ]
                        ],
                        [
                            'icon' => FAS::icon('users', ['class' => ['nav-icon']]),
                            'label' => 'Користувачі',
                            'url' => ['/user/index'],
                        ],
                        [
                            'icon' => FAS::icon('cog', ['class' => ['nav-icon']]),
                            'label' => 'Налаштування',
                            'url' => Yii::$app->homeUrl,
                        ],
                    ],
                ]);
                ?>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><?= Html::encode($this->title); ?></h1>
                    </div>
                    <div class="col-sm-6 align-self-end">
                        <?= Breadcrumbs::widget([
                            'homeLink' => [
                                'label' =>  FAS::icon('home', ['class' => ['nav-icon']]),
                                'url' => Yii::$app->homeUrl,
                                'class' => 'text-secondary',
                                'encode' => false,
                            ],
                            'tag' => 'ol',
                            'options' => [
                                'class' => 'breadcrumb text-sm float-sm-right'
                            ],
                            'itemTemplate' => "<li class=\"breadcrumb-item\">{link}</li>\n",
                            'activeItemTemplate' => "<li class=\"breadcrumb-item active\">{link}</li>\n",
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]) ?>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="container-fluid">
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>

        </section>
        <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer text-sm">
        <div class="float-right d-none d-sm-block">
            Розробка: <a href="mailto:o_kononchuk@mail.ru">OneWebD</a>
        </div>
        <strong>Copyright &copy; <?= date('Y') ?> <?= Html::encode(Yii::$app->name) ?>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <p class="p-5">123</p>
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
