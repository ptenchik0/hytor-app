<?php

namespace backend\modules\nutrition\controllers;

use backend\modules\nutrition\models\search\OrderSearch;
use common\models\Apartment;
use common\models\Food;
use common\models\FoodOrderTypeItem;
use Yii;
use common\models\FoodOrder;
use backend\modules\nutrition\models\search\FoodOrderSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for FoodOrder model.
 */
class OrdersController extends Controller
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
     * Lists all FoodOrder models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        /*$s = new OrderSearch();
        $d = $s->search(Yii::$app->request->queryParams);*/

        $dp = $dataProvider->getModels();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FoodOrder model.
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
     * Creates a new FoodOrder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $dishes = Food::find()->asArray()->all();

        $model = new FoodOrder();

        $apartments = ArrayHelper::map(Apartment::findAll(['status' => Apartment::STATUS_PUBLISHED]), 'id', 'name');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->food_order_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'apartments' => $apartments,
            'dishes' => $dishes,
        ]);
    }

    /**
     * Updates an existing FoodOrder model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $dishes = Food::find()->asArray()->all();

        //$model = FoodOrder::find()->joinWith('foodOrderTypesWithItems')->where(['food_order_id'=>$id])->one();
        $model = FoodOrder::find()->joinWith('foodOrderTypesWithItems')->where(['food_order_id'=>$id])->one();
        //$model2 = $model->foodOrderTypesWithItems;


        $apartments = ArrayHelper::map(Apartment::findAll(['status' => Apartment::STATUS_PUBLISHED]), 'id', 'name');

        /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->food_order_id]);
        }*/

        if ($model->load(Yii::$app->request->post())){
            $postData = Yii::$app->request->post();
            $eqtypesIds = $postData['FoodOrderTypeItem'];
            //$eqtypes = FoodOrderTypeItem::findAll(array_keys($eqtypesIds));
            $eqtypes = FoodOrderTypeItem::find()->indexBy('food_order_item_id')->all();
            $transaction = Yii::$app->db->beginTransaction();
            $extraColumns = []; // extra columns to be saved to the many to many table
            $unlink = true; // unlink tags not in the list
            $delete = true; // delete unlinked tags

            /*foreach ($model->foodOrderTypesWithItems){

            }z*/

            $model->foodOrderTypesWithItems->foodOrderTypeItem = $postData['FoodOrderTypeItem'];

            try {
                //$model->linkAll('foodOrderTypeItems', $eqtypes, $extraColumns, $unlink, $delete);
                $model->save();

                $transaction->commit();
            } catch (Exception $e) {

                $transaction->rollBack();

            }
            return $this->redirect(['update', 'id' => $model->food_order_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'apartments' => $apartments,
            'dishes' => $dishes,
        ]);
    }

    /**
     * Deletes an existing FoodOrder model.
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
     * Finds the FoodOrder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FoodOrder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FoodOrder::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
