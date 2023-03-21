<?php

namespace app\controllers;

use app\models\Subscription;
use app\models\SubscriptionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Mpdf;
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

    public function actionDuration(){
        return $this->render('duration');
    }

    public function actionGenerate() {
        if (Yii::$app->request->post()) {
            $start_date = Yii::$app->request->post('start_date');
            $end_date = Yii::$app->request->post('end_date');
            $query = Subscription::find()
        ->where(['between', 'FROM_UNIXTIME(created_at, "%Y-%m-%d")', $start_date, $end_date])
        ->orderBy('created_at');
        $dataProvider= $query->all();
            $html = $this->renderPartial('pdf_view',['dataProvider'=>$dataProvider]);
            $mpdf = new Mpdf\Mpdf;
            $mpdf ->showImageErrors = true;
            $mpdf ->SetDisplayMode('fullpage','two');
            $mpdf ->writeHTML($html);
            $mpdf->output();
            exit;
        // return $this->render('viewreport',['dataProvider' => $dataProvider]);
        }
        
        return $this->render('duration');
    }

    /**
     * Displays a single Subscription model.
     * @param int $subscription_id Subscription ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($subscription_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($subscription_id),
        ]);
    }

    /**
     * Creates a new Subscription model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Subscription();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'subscription_id' => $model->subscription_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
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
        $model = $this->findModel($subscription_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'subscription_id' => $model->subscription_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
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
        $this->findModel($subscription_id)->delete();

        return $this->redirect(['index']);
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
