<?php

namespace app\controllers;

use app\models\Customer;
use app\models\Log;
use app\models\User;
use app\models\CustomerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use Mpdf;
use yii\web\ForbiddenHttpException;

/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomerController extends Controller
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
     * Lists all Customer models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $user_id = Yii::$app->user->id;
        $userDetails = User::findOne($user_id);
        $userProfileImage = $userDetails->profile;
        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'userProfileImage' =>$userProfileImage ,
        ]);
    }

    public function actionDuration(){
        $user_id = Yii::$app->user->id;
        $userDetails = User::findOne($user_id);
        $userProfileImage = $userDetails->profile;
        return $this->render('duration',['userProfileImage' => $userProfileImage]);
    }


    public function actionGenerate()
    {
        $user_id = Yii::$app->user->id;
        $userDetails = User::findOne($user_id);
        $userProfileImage = $userDetails->profile;
        if (Yii::$app->request->post()) {
            $start_date = Yii::$app->request->post('start_date');
            $end_date = Yii::$app->request->post('end_date');
            $query = Customer::find()
                ->where(['between', 'FROM_UNIXTIME(created_at, "%Y-%m-%d")', $start_date, $end_date])
                ->orderBy('created_at');
            $customers = $query->all();
            $no = 0;
    
            if (empty($customers)) {
                $message = "No customers found within the selected date range.";
                return $this->render('viewreport', ['message' => $message,'userProfileImage'=>$userProfileImage,]);
            } else {
                return $this->render('viewreport', ['customers' => $customers, 'no' => $no,'userProfileImage' => $userProfileImage,]);
            }
        }
    
        return $this->render('duration',['userProfileImage' => $userProfileImage,]);
    }
    


    /**
     * Displays a single Customer model.
     * @param int $customer_id Customer ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($customer_id)
    {
        $user_id = Yii::$app->user->id;
        $userDetails = User::findOne($user_id);
        $userProfileImage = $userDetails->profile;
        if(Yii::$app->user->can('View_customer')){
            return $this->render('view', [
                'model' => $this->findModel($customer_id),
                'userProfileImage' => $userProfileImage,
            ]);
        }else{
            throw new ForbiddenHttpException;
        }
       
    }
    public function actionPdf(){
        $customers=unserialize(urldecode($_GET['customers']));
        $no=0;
        $html = $this->renderPartial('pdf_view',['customers'=>$customers,'no'=>$no]);
        $mpdf = new Mpdf\Mpdf;
        $mpdf ->showImageErrors = true;
        $mpdf ->SetDisplayMode('fullpage','two');
        $mpdf ->writeHTML($html);
        $mpdf->output();
        exit;
    }

    /**
     * Creates a new Customer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $user_id = Yii::$app->user->id;
        $userDetails = User::findOne($user_id);
        $userProfileImage = $userDetails->profile;
        $model = new Customer();
       
        if(Yii::$app->user->can('Create_customer')){
            if ($this->request->isPost) {
                if ($model->load($this->request->post())) {
                    $model->created_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                    $model->updated_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                    $model->created_by=Yii::$app->user->identity->username;
                    $model->updated_by=Yii::$app->user->identity->username;
                    if($model->save()){
                        $log = new Log();
                        $log->done_by=Yii::$app->user->identity->username;
                        $log->comment="Registered new customer";
                        $log->done_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                        $log->save();
                    }
                    return $this->redirect(['view', 'customer_id' => $model->customer_id,'userProfileImage' => $userProfileImage,]);
                }
            } else {
                $model->loadDefaultValues();
            }
    
            return $this->render('create', [
                'model' => $model,
                'userProfileImage' => $userProfileImage,
            ]);
        }else{
            throw new ForbiddenHttpException;
        }
       
    }

    /**
     * Updates an existing Customer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $customer_id Customer ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($customer_id)
    {
        $user_id = Yii::$app->user->id;
        $userDetails = User::findOne($user_id);
        $userProfileImage = $userDetails->profile;
        if(Yii::$app->user->can('Update_customer')){
            $model = $this->findModel($customer_id);

            if ($this->request->isPost && $model->load($this->request->post())) {
                if($model->save()){
                    $log = new Log();

                    $log->done_by=Yii::$app->user->identity->username;
                    $log->comment="Updated customer details ";
                    $log->done_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                    $log->save();
                }
                return $this->redirect(['view', 'customer_id' => $model->customer_id,'userProfileImage' =>$userProfileImage,]);
            }
    
            return $this->render('update', [
                'model' => $model,
                'userProfileImage' =>$userProfileImage,
            ]);
        }else{
            throw new ForbiddenHttpException;
        }
       
    }

    /**
     * Deletes an existing Customer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $customer_id Customer ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($customer_id)
    {
        $user_id = Yii::$app->user->id;
        $userDetails = User::findOne($user_id);
        $userProfileImage = $userDetails->profile;
        if(Yii::$app->user->can('Delete_customer')){
            $this->findModel($customer_id)->delete();
                $log = new Log();
                $log->done_by=Yii::$app->user->identity->username;
                $log->comment="Deleted a customer";
                $log->done_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                $log->save();

            return $this->redirect(['index']);
        }else{
            throw new ForbiddenHttpException;
        }
       
    }

    /**
     * Finds the Customer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $customer_id Customer ID
     * @return Customer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($customer_id)
    {
        if (($model = Customer::findOne(['customer_id' => $customer_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
