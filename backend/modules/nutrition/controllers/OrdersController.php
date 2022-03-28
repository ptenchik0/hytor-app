<?php

namespace backend\modules\nutrition\controllers;

use backend\modules\nutrition\models\search\OrderSearch;
use common\models\Apartment;
use common\models\Customer;
use common\models\Food;
use common\models\FoodOrderType;
use common\models\FoodOrderTypeItem;
use common\models\FoodSet;
use common\models\Model;
use Yii;
use common\models\FoodOrder;
use backend\modules\nutrition\models\search\FoodOrderSearch;
use yii\bootstrap4\ActiveForm;
use yii\db\Query;
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
        $dishes = Food::getDishes();//ArrayHelper::map(, 'id', 'title');
        $sets = FoodSet::find()->where(['status'=>FoodSet::STATUS_PUBLISHED])->indexBy('type')->all();

        $modelPerson = new FoodOrder;

        foreach (Food::rationTypes() as $key => $val){
            $modelsHouse[] = new FoodOrderType(['order_type' => $key]);
            $modelsRoom[$key] = [new FoodOrderTypeItem];
        }

        if ($modelPerson->load(Yii::$app->request->post())) {

            $modelsHouse = Model::createMultiple(House::classname());
            Model::loadMultiple($modelsHouse, Yii::$app->request->post());

            // validate person and houses models
            $valid = $modelPerson->validate();
            $valid = Model::validateMultiple($modelsHouse) && $valid;

            if (isset($_POST['Room'][0][0])) {
                foreach ($_POST['Room'] as $indexHouse => $rooms) {
                    foreach ($rooms as $indexRoom => $room) {
                        $data['Room'] = $room;
                        $modelRoom = new Room;
                        $modelRoom->load($data);
                        $modelsRoom[$indexHouse][$indexRoom] = $modelRoom;
                        $valid = $modelRoom->validate();
                    }
                }
            }

            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelPerson->save(false)) {
                        foreach ($modelsHouse as $indexHouse => $modelHouse) {

                            if ($flag === false) {
                                break;
                            }

                            $modelHouse->person_id = $modelPerson->id;

                            if (!($flag = $modelHouse->save(false))) {
                                break;
                            }

                            if (isset($modelsRoom[$indexHouse]) && is_array($modelsRoom[$indexHouse])) {
                                foreach ($modelsRoom[$indexHouse] as $indexRoom => $modelRoom) {
                                    $modelRoom->house_id = $modelHouse->id;
                                    if (!($flag = $modelRoom->save(false))) {
                                        break;
                                    }
                                }
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $modelPerson->id]);
                    } else {
                        $transaction->rollBack();
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }


        return $this->render('create', [
            'dishes' => $dishes,
            'sets' => $sets,

            'modelOrder' => $modelPerson,
            'modelsType' => (empty($modelsHouse)) ? [new FoodOrderType] : $modelsHouse,
            'modelsItem' => (empty($modelsRoom)) ? [[new FoodOrderTypeItem]] : $modelsRoom
        ]);
    }

    /**
     * Updates an existing Person model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $dishes = Food::getDishes();//ArrayHelper::map(, 'id', 'title');
        $sets = FoodSet::find()->where(['status'=>FoodSet::STATUS_PUBLISHED])->indexBy('type')->all();
        $sets2 = ArrayHelper::getColumn($sets, 'foods');

        $modelPerson = $this->findModel($id);
        $modelsHouse = $modelPerson->foodOrderTypes;
        $modelsRoom = [];
        $oldRooms = [];
        $_empty = [];

        $d = ArrayHelper::getColumn($modelsHouse, 'order_type');

        foreach (Food::rationTypes() as $key => $val){
            if(!in_array($key, $d)){
                $c = new FoodOrderType(['order_type' => $key]);
                //Model::loadMultiple($modelsHouse, $c);
                $modelsHouse[] = $c;
                //$modelsRoom[][] = new FoodOrderTypeItem(['order_type_id'=>$key]);
            }
        }
        ArrayHelper::multisort($modelsHouse, ['order_type']);

        if (!empty($modelsHouse)) {
            foreach ($modelsHouse as $indexHouse => $modelHouse) {
               // if(!in_array($modelHouse->order_type, Food::rationTypes())) $_empty[] = $modelHouse->order_type;
                $rooms = $modelHouse->foodOrderTypeItems;
                $modelsRoom[$indexHouse] = empty($rooms) ? [new FoodOrderTypeItem] : $rooms;
                $oldRooms = ArrayHelper::merge(ArrayHelper::index($rooms, 'id'), $oldRooms);
            }
        }


        //$ff = Model::createMultiple(FoodOrderType::classname(), $modelsHouse);
        //$modelsHouse2 = ;
        //ArrayHelper::multisort($modelsHouse, ['order_type']);
        //ArrayHelper::multisort($modelsRoom, ['order_type_id']);

        /*if (!empty($modelsHouse)) {
            foreach ($modelsHouse as $indexHouse => $modelHouse) {
                $rooms = $modelHouse->foodOrderTypeItems;
                $modelsRoom[$indexHouse] = $rooms;
                $oldRooms = ArrayHelper::merge(ArrayHelper::index($rooms, 'id'), $oldRooms);
            }
        }*/

        if ($modelPerson->load(Yii::$app->request->post())) {
            // reset
            $modelsRoom = [];

            $oldHouseIDs = ArrayHelper::map($modelsHouse, 'id', 'id');
            $_items = ArrayHelper::map($modelsHouse, 'id', 'id');
            $_items2 = ArrayHelper::getColumn($modelsHouse, function ($element) {
                return $element['id'];
            });
            /*foreach ($modelsHouse as $indexHouse => $modelHouse) {
                $e = empty($modelHouse->foodOrderTypeItems);
                if (empty($modelHouse->foodOrderTypeItems)) {
                    ArrayHelper::remove($modelsHouse, $indexHouse);
                }
            }*/

            $modelsHouse = Model::createMultipleOrder(FoodOrderType::classname(), $modelsHouse);
            Model::loadMultiple($modelsHouse, Yii::$app->request->post());
            $deletedHouseIDs = array_diff($oldHouseIDs, array_filter(ArrayHelper::map($modelsHouse, 'id', 'id')));

            // validate person and houses models
            $valid = $modelPerson->validate();
            $valid = Model::validateMultiple($modelsHouse) && $valid;

            $roomsIDs = [];
            //if (isset($_POST['FoodOrderTypeItem'][0][0])) {
            if (isset($_POST['FoodOrderTypeItem'])) {
                foreach ($_POST['FoodOrderTypeItem'] as $indexHouse => $rooms) {
                    $roomsIDs = ArrayHelper::merge($roomsIDs, array_filter(ArrayHelper::getColumn($rooms, 'id')));
                    foreach ($rooms as $indexRoom => $room) {
                        $data['FoodOrderTypeItem'] = $room;
                        $modelRoom = (isset($room['id']) && isset($oldRooms[$room['id']])) ? $oldRooms[$room['id']] : new FoodOrderTypeItem;
                        $modelRoom->load($data);
                        $modelsRoom[$indexHouse][$indexRoom] = $modelRoom;
                        $valid = $modelRoom->validate();
                    }
                }
            }

            $oldRoomsIDs = ArrayHelper::getColumn($oldRooms, 'id');
            $deletedRoomsIDs = array_diff($oldRoomsIDs, $roomsIDs);

            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelPerson->save(false)) {
                        if (! empty($deletedRoomsIDs)) {
                            FoodOrderTypeItem::deleteAll(['id' => $deletedRoomsIDs]);
                        }

                        if (! empty($deletedHouseIDs)) {
                            FoodOrderType::deleteAll(['id' => $deletedHouseIDs]);
                        }

                        foreach ($modelsHouse as $indexHouse => $modelHouse) {

                            if ($flag === false) {
                                break;
                            }

                            $modelHouse->order_id = $modelPerson->id;

                            if (!($flag = $modelHouse->save(false))) {
                                break;
                            }

                            if (isset($modelsRoom[$indexHouse]) && is_array($modelsRoom[$indexHouse])) {
                                foreach ($modelsRoom[$indexHouse] as $indexRoom => $modelRoom) {
                                    $modelRoom->order_type_id = $modelHouse->id;
                                    if (!($flag = $modelRoom->save(false))) {
                                        break;
                                    }
                                }
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['update', 'id' => $modelPerson->id]);
                    } else {
                        $transaction->rollBack();
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'dishes' => $dishes,
            'sets' => $sets,
            'modelOrder' => $modelPerson,
            'modelsType' => (empty($modelsHouse)) ? [new FoodOrderType] : $modelsHouse,
            'modelsItem' => (empty($modelsRoom)) ? [[new FoodOrderTypeItem]] : $modelsRoom
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

    public function actionCustomerList($q = null, $id = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new Query;
            $query->select('id, fio AS text')
                ->from('customer')
                ->where(['like', 'fio', $q])
                ->orWhere(['like', 'phone', $q])
                ->orWhere(['like', 'email', $q])
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => Customer::find($id)->fio];
        }
        return $out;
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
