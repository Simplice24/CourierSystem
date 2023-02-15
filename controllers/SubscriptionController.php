<?php

namespace app\controllers;

use app\models\Subscription;
use app\models\SubscriptionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use yii\web\ForbiddenHttpException;

/**
 * SubscriptionController implements the CRUD actions for Subscription model.
 */
class SubscriptionController extends Controller
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
     * Lists all Subscription models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SubscriptionSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Subscription model.
     * @param int $subscription_id Subscription ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($subscription_id)
    {
        if(Yii::$app->user->can('View_subscription')){
            return $this->render('view', [
                'model' => $this->findModel($subscription_id),
            ]);
        }else{
            throw new ForbiddenHttpException;
        }
        
    }

    /**
     * Creates a new Subscription model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Subscription();
        if(Yii::$app->user->can('Create_subscription')){
            if ($this->request->isPost) {
                if ($model->load($this->request->post())) {
                    $model->created_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                    $model->updated_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                    $model->created_by=Yii::$app->user->identity->username;
                    $model->updated_by=Yii::$app->user->identity->username;
                    $model->save();
                    return $this->redirect(['view', 'subscription_id' => $model->subscription_id]);
                }
            } else {
                $model->loadDefaultValues();
            }
    
            return $this->render('create', [
                'model' => $model,
            ]);
        }
        else{
            throw new ForbiddenHttpException;
        }
        
    }

    /**
     * Updates an existing Subscription model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $subscription_id Subscription ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($subscription_id)
    {
        if(Yii::$app->user->can('Update_subscription')){
            $model = $this->findModel($subscription_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'subscription_id' => $model->subscription_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
        }else{
            throw new ForbiddenHttpException;
        }
        
    }

    /**
     * Deletes an existing Subscription model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $subscription_id Subscription ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($subscription_id)
    {
        if(Yii::$app->user->can('Delete_subscription')){
            $this->findModel($subscription_id)->delete();

        return $this->redirect(['index']);
    }else{
        throw new ForbiddenHttpException;
    }

        }
        

    /**
     * Finds the Subscription model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $subscription_id Subscription ID
     * @return Subscription the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($subscription_id)
    {
        if (($model = Subscription::findOne(['subscription_id' => $subscription_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
