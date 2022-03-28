<?php

namespace backend\modules\nutrition\controllers;

use common\models\Food;
use common\models\FoodToSet;
use Yii;
use common\models\FoodSet;
use backend\modules\nutrition\models\search\FoodSetSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FoodSetController implements the CRUD actions for FoodSet model.
 */
class FoodSetController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all FoodSet models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FoodSetSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FoodSet model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new FoodSet model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FoodSet();

        /*$dishes = ArrayHelper::map(Food::find()->asArray()->all(), 'id', 'title', function($val){
            return $val['status'] == 0 ? $val['status'] = ArrayHelper::getValue(Food::statuses(), Food::STATUS_DRAFT) : $val['status'] = ArrayHelper::getValue(Food::statuses(), Food::STATUS_PUBLISHED);
        });*/
        $dishes = Food::find()->asArray()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'dishes' => $dishes,
        ]);
    }

    /**
     * Updates an existing FoodSet model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        /*$dishes = ArrayHelper::map(Food::find()->asArray()->all(), 'id', 'title', function($val){
            return $val['status'] == 0 ? $val['status'] = ArrayHelper::getValue(Food::statuses(), Food::STATUS_DRAFT) : $val['status'] = ArrayHelper::getValue(Food::statuses(), Food::STATUS_PUBLISHED);
        });*/
        //$dishes = ArrayHelper::map(Food::find()->asArray()->all(), 'id', 'title');
        $dishes = Food::find()->asArray()->all();
        $dishess = ArrayHelper::map(Food::find()->where(['status' => Food::STATUS_DRAFT])->asArray()->all(), 'id', function ($tt){
            return array('disabled' => true);
        });
        /*$dishes_d = ArrayHelper::toArray($model->foods, [
            'common\models\Food' => [
                'id',
                'status' => function ($post) {
                    return $post->status == 0 ? 'danger' : 'success';
                },
            ],
        ]);*/
            //ArrayHelper::map(Food::find()->where(['status' => Food::STATUS_DRAFT])->asArray()->all(), 'id', 'title');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'dishes' => $dishes,
            'dished_d' => $dishess
        ]);
    }

    /**
     * Deletes an existing FoodSet model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FoodSet model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FoodSet the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FoodSet::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
