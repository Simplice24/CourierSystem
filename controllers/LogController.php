<?php

namespace app\controllers;

use app\models\Log;
use app\models\LogSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use yii\web\ForbiddenHttpException;

/**
 * LogController implements the CRUD actions for Log model.
 */
class LogController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Log models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new LogSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Log model.
     * @param int $log_id Log ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($log_id)
    {
        if(Yii::$app->user->can('View_log')){
            return $this->render('view', [
                'model' => $this->findModel($log_id),
            ]);
        }else{
            throw new ForbiddenHttpException;
        }
        
    }

    /**
     * Creates a new Log model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Log();
        if(Yii::$app->user->can('Create_log')){

            if ($this->request->isPost) {
                if ($model->load($this->request->post())) {
                    $model->created_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                    $model->updated_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                    $model->created_by=Yii::$app->user->identity->username;
                    $model->updated_by=Yii::$app->user->identity->username;
                    $model->save();
                    return $this->redirect(['view', 'log_id' => $model->log_id]);
                }
            } else {
                $model->loadDefaultValues();
            }
    
            return $this->render('create', [
                'model' => $model,
            ]);
        }else{
            throw new ForbiddenHttpException;
        }
        
    }

    /**
     * Updates an existing Log model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $log_id Log ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($log_id)
    {
        if(Yii::$app->user->can('Update_log')){
            $model = $this->findModel($log_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'log_id' => $model->log_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
        }else{
            throw new ForbiddenHttpException;
        }
        
    }

    /**
     * Deletes an existing Log model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $log_id Log ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($log_id)
    {
        $this->findModel($log_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Log model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $log_id Log ID
     * @return Log the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($log_id)
    {
        if (($model = Log::findOne(['log_id' => $log_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
