<?php

namespace app\controllers;

use Yii;
use app\models\Status;
use app\models\StatusSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\Country;

/**
 * StatusController implements the CRUD actions for Status model.
 */
class StatusController extends Controller
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
            // access control
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
            // allow authenticated users
                [
                    'actions' => ['index'],
                    'allow' => true,
                ],

                [
                		'actions' => ['create', 'update', 'view','delete'],
                    'allow' => true,
                    'roles' => ['@'],
                ],
        // everything else is defined
                ],
            ],
        ];
    }

    /**
     * Lists all Status models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StatusSearch();

        if (Yii::$app->request) {
        	
//         	if(Yii::$app->request->queryParams["de_code_name"] != ""){
//         		$searchModel->de_code_name = Yii::$app->request->queryParams["de_code_name"];
//         	}
        	
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Status model.
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
     * Creates a new Status model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Status();
        
        //use app\models\Country;
        $modelData = Country::find()->all();
        
        //use yii\helpers\ArrayHelper;
        $listData = ArrayHelper::map($modelData, 'id', 'code');
        
        if ($model->load(Yii::$app->request->post())) {
            // $model->created_by = Yii::$app->user->getId();
            // $model->updated_by = Yii::$app->user->getId();

        	$model->created_at = date("y-m-d");
        	$model->updated_at = date("y-m-d");

            
        	if ($model->save()) {
        		return $this->redirect(['view', 'id' => $model->id]);
        	}
        }

        return $this->render('create', [
            'model' => $model,
        	'listData' => $listData,
        ]);
    }

    /**
     * Updates an existing Status model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        //use app\models\Country;
        $modelData = Country::find()->all();
        
        //use yii\helpers\ArrayHelper;
        $listData = ArrayHelper::map($modelData, 'id', 'code');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        	'listData' => $listData,
        ]);
    }

    /**
     * Deletes an existing Status model.
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
     * Finds the Status model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Status the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Status::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
