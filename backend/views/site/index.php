<?php

/* @var $this yii\web\View */

$this->title = 'Інформація';
//$this->params['breadcrumbs'][] = 'Інформація';
?>

<div class="row">
    <div class="col-sm-6 col-md-5 col-xl-4">
        <div class="small-box bg-info shadow">
            <div class="inner pl-4">
                <?php $foodOrdersCount = \common\models\FoodOrder::find()->active()->count(); ?>
                <h3><?= $foodOrdersCount; ?> <small class="h5"><?= Yii::$app->i18n->messageFormatter->format('{delta, plural, one{замовлення} few{замовлення} many{замовлень} other{замовленя}}', ['delta' => $foodOrdersCount], \Yii::$app->language) ?></small></h3>
                <p class="text-uppercase">Харчування</p>
            </div>
            <div class="icon">
                <i class="fas fa-utensils mr-3"></i>
            </div>
            <?= \yii\bootstrap4\Html::a('Перейти до замовлень ' . \rmrevin\yii\fontawesome\FAS::icon('arrow-circle-right'), \yii\helpers\Url::to(['nutrition/orders']), ['class'=>'small-box-footer'])?>
        </div>
    </div>
    <div class="col-sm-6 col-md-5 col-xl-4">
        <div class="small-box bg-info shadow">
            <div class="inner pl-4">
                <?php $hataOrdersCount = 6; ?>
                <h3><?= $hataOrdersCount; ?>  <small class="h5"><?= Yii::$app->i18n->messageFormatter->format('{delta, plural, one{замовлення} few{замовлення} many{замовлень} other{замовленя}}', ['delta' => $hataOrdersCount], \Yii::$app->language) ?></small></h3>
                <p class="text-uppercase">
                    Садиби
                    <?/*= Yii::$app->i18n->messageFormatter->format('{delta, plural, one{Активне замовлення} few{Активних замовлення} many{Активних замовлень} other{Активних замовленя}}', ['delta' => $foodOrdersCount], \Yii::$app->language) */?>
                </p>
            </div>
            <div class="icon">
                <i class="fas fa-vihara mr-3"></i>
            </div>
            <?= \yii\bootstrap4\Html::a('Перейти до замовлень ' . \rmrevin\yii\fontawesome\FAS::icon('arrow-circle-right'), \yii\helpers\Url::to(['nutrition/orders']), ['class'=>'small-box-footer'])?>
        </div>
    </div>
</div>

<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title"></h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="maximize">
                <i class="fas fa-expand"></i>
            </button>
        </div>
    </div>
    <div class="card-body p-0">
        <!--<table class="table table-striped projects">
            <thead>
            <tr>
                <th style="width: 1%">
                    #
                </th>
                <th style="width: 20%">
                    Project Name
                </th>
                <th style="width: 30%">
                    Team Members
                </th>
                <th>
                    Project Progress
                </th>
                <th style="width: 8%" class="text-center">
                    Status
                </th>
                <th style="width: 20%">
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    #
                </td>
                <td>
                    <a>
                        AdminLTE v3
                    </a>
                    <br/>
                    <small>
                        Created 01.01.2019
                    </small>
                </td>
                <td>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            O
                        </li>
                        <li class="list-inline-item">
                            O2
                        </li>
                        <li class="list-inline-item">
                            O3
                        </li>
                        <li class="list-inline-item">
                            O4
                        </li>
                    </ul>
                </td>
                <td class="project_progress">
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: 57%">
                        </div>
                    </div>
                    <small>
                        57% Complete
                    </small>
                </td>
                <td class="project-state">
                    <span class="badge badge-success">Success</span>
                </td>
                <td class="project-actions text-right">
                    <a class="btn btn-primary btn-sm" href="#">
                        <i class="fas fa-folder">
                        </i>
                        View
                    </a>
                    <a class="btn btn-info btn-sm" href="#">
                        <i class="fas fa-pencil-alt">
                        </i>
                        Edit
                    </a>
                    <a class="btn btn-danger btn-sm" href="#">
                        <i class="fas fa-trash">
                        </i>
                        Delete
                    </a>
                </td>
            </tr>
            <tr>
                <td>
                    #
                </td>
                <td>
                    <a>
                        AdminLTE v3
                    </a>
                    <br/>
                    <small>
                        Created 01.01.2019
                    </small>
                </td>
                <td>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            O
                        </li>
                        <li class="list-inline-item">
                            O2
                        </li>
                    </ul>
                </td>
                <td class="project_progress">
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="47" aria-valuemin="0" aria-valuemax="100" style="width: 47%">
                        </div>
                    </div>
                    <small>
                        47% Complete
                    </small>
                </td>
                <td class="project-state">
                    <span class="badge badge-success">Success</span>
                </td>
                <td class="project-actions text-right">
                    <a class="btn btn-primary btn-sm" href="#">
                        <i class="fas fa-folder">
                        </i>
                        View
                    </a>
                    <a class="btn btn-info btn-sm" href="#">
                        <i class="fas fa-pencil-alt">
                        </i>
                        Edit
                    </a>
                    <a class="btn btn-danger btn-sm" href="#">
                        <i class="fas fa-trash">
                        </i>
                        Delete
                    </a>
                </td>
            </tr>
            <tr>
                <td>
                    #
                </td>
                <td>
                    <a>
                        AdminLTE v3
                    </a>
                    <br/>
                    <small>
                        Created 01.01.2019
                    </small>
                </td>
                <td>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            O
                        </li>
                        <li class="list-inline-item">
                            O2
                        </li>
                        <li class="list-inline-item">
                            O3
                        </li>
                    </ul>
                </td>
                <td class="project_progress">
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100" style="width: 77%">
                        </div>
                    </div>
                    <small>
                        77% Complete
                    </small>
                </td>
                <td class="project-state">
                    <span class="badge badge-success">Success</span>
                </td>
                <td class="project-actions text-right">
                    <a class="btn btn-primary btn-sm" href="#">
                        <i class="fas fa-folder">
                        </i>
                        View
                    </a>
                    <a class="btn btn-info btn-sm" href="#">
                        <i class="fas fa-pencil-alt">
                        </i>
                        Edit
                    </a>
                    <a class="btn btn-danger btn-sm" href="#">
                        <i class="fas fa-trash">
                        </i>
                        Delete
                    </a>
                </td>
            </tr>
            <tr>
                <td>
                    #
                </td>
                <td>
                    <a>
                        AdminLTE v3
                    </a>
                    <br/>
                    <small>
                        Created 01.01.2019
                    </small>
                </td>
                <td>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            O
                        </li>
                        <li class="list-inline-item">
                            O2
                        </li>
                        <li class="list-inline-item">
                            O3
                        </li>
                        <li class="list-inline-item">
                            O4
                        </li>
                    </ul>
                </td>
                <td class="project_progress">
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                        </div>
                    </div>
                    <small>
                        60% Complete
                    </small>
                </td>
                <td class="project-state">
                    <span class="badge badge-success">Success</span>
                </td>
                <td class="project-actions text-right">
                    <a class="btn btn-primary btn-sm" href="#">
                        <i class="fas fa-folder">
                        </i>
                        View
                    </a>
                    <a class="btn btn-info btn-sm" href="#">
                        <i class="fas fa-pencil-alt">
                        </i>
                        Edit
                    </a>
                    <a class="btn btn-danger btn-sm" href="#">
                        <i class="fas fa-trash">
                        </i>
                        Delete
                    </a>
                </td>
            </tr>
            <tr>
                <td>
                    #
                </td>
                <td>
                    <a>
                        AdminLTE v3
                    </a>
                    <br/>
                    <small>
                        Created 01.01.2019
                    </small>
                </td>
                <td>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            O
                        </li>
                        <li class="list-inline-item">
                            O4
                        </li>
                        <li class="list-inline-item">
                            O5
                        </li>
                    </ul>
                </td>
                <td class="project_progress">
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100" style="width: 12%">
                        </div>
                    </div>
                    <small>
                        12% Complete
                    </small>
                </td>
                <td class="project-state">
                    <span class="badge badge-success">Success</span>
                </td>
                <td class="project-actions text-right">
                    <a class="btn btn-primary btn-sm" href="#">
                        <i class="fas fa-folder">
                        </i>
                        View
                    </a>
                    <a class="btn btn-info btn-sm" href="#">
                        <i class="fas fa-pencil-alt">
                        </i>
                        Edit
                    </a>
                    <a class="btn btn-danger btn-sm" href="#">
                        <i class="fas fa-trash">
                        </i>
                        Delete
                    </a>
                </td>
            </tr>
            <tr>
                <td>
                    #
                </td>
                <td>
                    <a>
                        AdminLTE v3
                    </a>
                    <br/>
                    <small>
                        Created 01.01.2019
                    </small>
                </td>
                <td>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            O
                        </li>
                        <li class="list-inline-item">
                            O2
                        </li>
                        <li class="list-inline-item">
                            O3
                        </li>
                        <li class="list-inline-item">
                            O4
                        </li>
                    </ul>
                </td>
                <td class="project_progress">
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" style="width: 35%">
                        </div>
                    </div>
                    <small>
                        35% Complete
                    </small>
                </td>
                <td class="project-state">
                    <span class="badge badge-success">Success</span>
                </td>
                <td class="project-actions text-right">
                    <a class="btn btn-primary btn-sm" href="#">
                        <i class="fas fa-folder">
                        </i>
                        View
                    </a>
                    <a class="btn btn-info btn-sm" href="#">
                        <i class="fas fa-pencil-alt">
                        </i>
                        Edit
                    </a>
                    <a class="btn btn-danger btn-sm" href="#">
                        <i class="fas fa-trash">
                        </i>
                        Delete
                    </a>
                </td>
            </tr>
            <tr>
                <td>
                    #
                </td>
                <td>
                    <a>
                        AdminLTE v3
                    </a>
                    <br/>
                    <small>
                        Created 01.01.2019
                    </small>
                </td>
                <td>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            O4
                        </li>
                        <li class="list-inline-item">
                            O5
                        </li>
                    </ul>
                </td>
                <td class="project_progress">
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100" style="width: 87%">
                        </div>
                    </div>
                    <small>
                        87% Complete
                    </small>
                </td>
                <td class="project-state">
                    <span class="badge badge-success">Success</span>
                </td>
                <td class="project-actions text-right">
                    <a class="btn btn-primary btn-sm" href="#">
                        <i class="fas fa-folder">
                        </i>
                        View
                    </a>
                    <a class="btn btn-info btn-sm" href="#">
                        <i class="fas fa-pencil-alt">
                        </i>
                        Edit
                    </a>
                    <a class="btn btn-danger btn-sm" href="#">
                        <i class="fas fa-trash">
                        </i>
                        Delete
                    </a>
                </td>
            </tr>
            <tr>
                <td>
                    #
                </td>
                <td>
                    <a>
                        AdminLTE v3
                    </a>
                    <br/>
                    <small>
                        Created 01.01.2019
                    </small>
                </td>
                <td>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            O
                        </li>
                        <li class="list-inline-item">
                            O3
                        </li>
                        <li class="list-inline-item">
                            O4
                        </li>
                    </ul>
                </td>
                <td class="project_progress">
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100" style="width: 77%">
                        </div>
                    </div>
                    <small>
                        77% Complete
                    </small>
                </td>
                <td class="project-state">
                    <span class="badge badge-success">Success</span>
                </td>
                <td class="project-actions text-right">
                    <a class="btn btn-primary btn-sm" href="#">
                        <i class="fas fa-folder">
                        </i>
                        View
                    </a>
                    <a class="btn btn-info btn-sm" href="#">
                        <i class="fas fa-pencil-alt">
                        </i>
                        Edit
                    </a>
                    <a class="btn btn-danger btn-sm" href="#">
                        <i class="fas fa-trash">
                        </i>
                        Delete
                    </a>
                </td>
            </tr>
            <tr>
                <td>
                    #
                </td>
                <td>
                    <a>
                        AdminLTE v3
                    </a>
                    <br/>
                    <small>
                        Created 01.01.2019
                    </small>
                </td>
                <td>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            O
                        </li>
                        <li class="list-inline-item">
                            O3
                        </li>
                        <li class="list-inline-item">
                            O4
                        </li>
                        <li class="list-inline-item">
                            O5
                        </li>
                    </ul>
                </td>
                <td class="project_progress">
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100" style="width: 77%">
                        </div>
                    </div>
                    <small>
                        77% Complete
                    </small>
                </td>
                <td class="project-state">
                    <span class="badge badge-success">Success</span>
                </td>
                <td class="project-actions text-right">
                    <a class="btn btn-primary btn-sm" href="#">
                        <i class="fas fa-folder">
                        </i>
                        View
                    </a>
                    <a class="btn btn-info btn-sm" href="#">
                        <i class="fas fa-pencil-alt">
                        </i>
                        Edit
                    </a>
                    <a class="btn btn-danger btn-sm" href="#">
                        <i class="fas fa-trash">
                        </i>
                        Delete
                    </a>
                </td>
            </tr>
            </tbody>
        </table>-->
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->