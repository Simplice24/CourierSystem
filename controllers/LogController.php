<?php

namespace app\controllers;

use app\models\Log;
use app\models\LogSearch;
use yii\web\Controller;
use app\models\User;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use Yii;
use Mpdf;


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
        $user_id = Yii::$app->user->id;
        $userDetails = User::findOne($user_id);
        $userProfileImage = $userDetails->profile;
        $searchModel = new LogSearch();
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
        return $this->render('duration',['userProfileImage' => $userProfileImage,]);
    }


    public function actionGenerate() {
        $user_id = Yii::$app->user->id;
        $userDetails = User::findOne($user_id);
        $userProfileImage = $userDetails->profile;
        if (Yii::$app->request->post()) {
            $start_date = Yii::$app->request->post('start_date');
            $end_date = Yii::$app->request->post('end_date');
            $query = Log::find()
                ->where(['between', 'FROM_UNIXTIME(done_at, "%Y-%m-%d")', $start_date, $end_date])
                ->orderBy('done_at');
            $dataProvider = $query->all();
            $no = 0;
            
            if (empty($dataProvider)) {
                $message = 'No data found for the selected date range.';
                return $this->render('viewreport', ['message' => $message,'userProfileImage'=>$userProfileImage,]);
            } else {
                return $this->render('viewreport', ['dataProvider' => $dataProvider, 'no' => $no,'userProfileImage' => $userProfileImage,]);
            }
        }
        
        return $this->render('duration',['userProfileImage' => $userProfileImage]);
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
     * Displays a single Log model.
     * @param int $log_id Log ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($log_id)
    {
        $user_id = Yii::$app->user->id;
        $userDetails = User::findOne($user_id);
        $userProfileImage = $userDetails->profile;
        return $this->render('view', [
            'model' => $this->findModel($log_id),
            'userProfileImage' => $userProfileImage,
        ]);
    }

    /**
     * Creates a new Log model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $user_id = Yii::$app->user->id;
        $userDetails = User::findOne($user_id);
        $userProfileImage = $userDetails->profile;
        $model = new Log();
        if(Yii::$app->user->can('Create_log')){
            if ($this->request->isPost) {
                if ($model->load($this->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'log_id' => $model->log_id]);
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
     * Updates an existing Log model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $log_id Log ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($log_id)
    {
        $user_id = Yii::$app->user->id;
        $userDetails = User::findOne($user_id);
        $userProfileImage = $userDetails->profile;
        $model = $this->findModel($log_id);
        if(Yii::$app->user->can('Update_log')){
            if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'log_id' => $model->log_id]);
            }
    
            return $this->render('update', [
                'model' => $model,
                'userProfileImage' => $userProfileImage,
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
        $user_id = Yii::$app->user->id;
        $userDetails = User::findOne($user_id);
        $userProfileImage = $userDetails->profile;
        if(Yii::$app->user->can('Delete_log')){
            $this->findModel($log_id)->delete();

            return $this->redirect(['index','userProfileImage' => $userProfileImage,]);
        }else{
            throw new ForbiddenHttpException;
        }
        
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
