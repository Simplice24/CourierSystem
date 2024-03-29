<?php

namespace app\controllers;

use app\models\Subscription;
use app\models\Log;
use app\models\User;
use app\models\SubscriptionType;
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
        $user_id = Yii::$app->user->id;
        $userDetails = User::findOne($user_id);
        $userProfileImage = $userDetails->profile;
        $searchModel = new SubscriptionSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'userProfileImage' => $userProfileImage,
        ]);
    }

    public function actionDuration(){
        $user_id = Yii::$app->user->id;
        $userDetails = User::findOne($user_id);
        $userProfileImage = $userDetails->profile;
        return $this->render('duration',['userProfileImage'=>$userProfileImage,]);
    }

    public function actionGenerate() {
        $user_id = Yii::$app->user->id;
        $userDetails = User::findOne($user_id);
        $userProfileImage = $userDetails->profile;
        if (Yii::$app->request->post()) {
            $start_date = Yii::$app->request->post('start_date');
            $end_date = Yii::$app->request->post('end_date');
            $query = Subscription::find()
                ->where(['between', 'FROM_UNIXTIME(created_at, "%Y-%m-%d")', $start_date, $end_date])
                ->orderBy('created_at');
            $dataProvider= $query->all();
            $no=0;
            
            if (empty($dataProvider)) {
                $message = 'No Subscriptions found for the selected date range.';
                return $this->render('viewreport', ['message' => $message,'userProfileImage' => $userProfileImage,]);
            } else {
                return $this->render('viewreport', ['dataProvider' => $dataProvider, 'no' => $no,'userProfileImage' => $userProfileImage,]);
            }
        }
        return $this->render('duration',['userProfileImage' => $userProfileImage,]);
    }
    

    public function actionPdf(){
        $dataProvider=unserialize(urldecode($_GET['dataProvider']));
        $no=0;
        $html = $this->renderPartial('pdf_view',['dataProvider'=>$dataProvider,'no'=>$no]);
        $mpdf = new Mpdf\Mpdf;
        $mpdf ->showImageErrors = true;
        $mpdf ->SetDisplayMode('fullpage','two');
        $mpdf ->writeHTML($html);
        $mpdf->output();
        exit;
    }

    /**
     * Displays a single Subscription model.
     * @param int $subscription_id Subscription ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($subscription_id)
    {
        $user_id = Yii::$app->user->id;
        $userDetails = User::findOne($user_id);
        $userProfileImage = $userDetails->profile;
        return $this->render('view', [
            'model' => $this->findModel($subscription_id),
            'userProfileImage' => $userProfileImage,
        ]);
    }

    /**
     * Creates a new Subscription model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
{
    $user_id = Yii::$app->user->id;
    $userDetails = User::findOne($user_id);
    $userProfileImage = $userDetails->profile;
    $model = new Subscription();

    if ($this->request->isPost) {
        if ($model->load($this->request->post())) {
            $model->created_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
            $model->updated_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
            $model->created_by=Yii::$app->user->identity->username;
            $model->updated_by=Yii::$app->user->identity->username;

            // Retrieve the amount of the selected subscription type
            $subscriptionType = SubscriptionType::findOne(['name' => $model->subscription_type]);
            $model->amount = $subscriptionType->amount;

            if($model->save()){
                $log = new Log();
                $log->done_by=Yii::$app->user->identity->username;
                $log->comment="New subscription created";
                $log->done_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                $log->save();
            }
            return $this->redirect(['view', 'subscription_id' => $model->subscription_id,'userProfileImage'=>$userProfileImage,]);
        }
    } else {
        $model->loadDefaultValues();
    }

    return $this->render('create', [
        'model' => $model,
        'userProfileImage' => $userProfileImage,
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
        $user_id = Yii::$app->user->id;
        $userDetails = User::findOne($user_id);
        $userProfileImage = $userDetails->profile;
        $model = $this->findModel($subscription_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'subscription_id' => $model->subscription_id,'userProfileImage' => $userProfileImage,]);
        }

        return $this->render('update', [
            'model' => $model,
            'userProfileImage' => $userProfileImage,
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
        $user_id = Yii::$app->user->id;
        $userDetails = User::findOne($user_id);
        $userProfileImage = $userDetails->profile;
        $this->findModel($subscription_id)->delete();

        return $this->redirect(['index','userProfileImage' => $userProfileImage]);
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

    public function actionGetAmount($subscription_type){
        $subscriptionType = SubscriptionType::find()->where(['name'=>$subscription_type])->one();
        $amount = $subscriptionType->amount;
        return json_encode($amount);
        
    }
}
