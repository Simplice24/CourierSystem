<?php

namespace app\controllers;

use app\models\Branch;
use app\models\Log;
use app\models\BranchSearch;
use app\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use Mpdf;
use \yii\helpers\Url;
use yii\web\ForbiddenHttpException;

/**
 * BranchController implements the CRUD actions for Branch model.
 */
class BranchController extends Controller
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
     * Lists all Branch models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $user_id = Yii::$app->user->id;
        $userDetails = User::findOne($user_id);
        $userProfileImage = $userDetails->profile;
        $searchModel = new BranchSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        if(Yii::$app->user->isGuest){
            return Yii::$app->getResponse()->redirect(['site/login']);
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'userProfileImage' => $userProfileImage ,
        ]);
    }
    public function actionPdf(){
        $branches = unserialize(urldecode($_GET['branches']));
        $no=0;
        $html = $this->renderPartial('pdf_view',['branches'=>$branches,'no'=>$no]);
        $mpdf = new Mpdf\Mpdf;
        $mpdf ->showImageErrors = true;
        $mpdf ->SetDisplayMode('fullpage','two');
        $mpdf ->writeHTML($html);
        $mpdf->output();
        exit;
    }

    /**
     * Displays a single Branch model.
     * @param int $branch_id Branch ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($branch_id)
    {
        $user_id = Yii::$app->user->id;
        $userDetails = User::findOne($user_id);
        $userProfileImage = $userDetails->profile;
        if(Yii::$app->user->isGuest){
            return Yii::$app->getResponse()->redirect(['site/login']);
        }
        else if(Yii::$app->user->can('View_branch')){
            return $this->render('view',[
                'model' => $this->findModel($branch_id),'userProfileImage' => $userProfileImage,
            ]);
        }else{
            throw new ForbiddenHttpException;
        } 
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
            $query = Branch::find()
        ->where(['between', 'FROM_UNIXTIME(created_at, "%Y-%m-%d")', $start_date, $end_date])
        ->orderBy('created_at');
        $branches = $query->all();
        $no=0;
        
        if(empty($branches)){
            $message = "No branches found for the selected date range.";
            return $this->render('viewreport', ['message' => $message, 'userProfileImage' => $userProfileImage,]);
        }
        
        return $this->render('viewreport',['branches' => $branches,'no'=>$no ,'userProfileImage' => $userProfileImage,]);
        }
        
        return $this->render('duration');
    }

    /**
     * Creates a new Branch model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $user_id = Yii::$app->user->id;
        $userDetails = User::findOne($user_id);
        $userProfileImage = $userDetails->profile;
        $model = new Branch();
        if(Yii::$app->user->isGuest){
            return Yii::$app->getResponse()->redirect(['site/login']);
        }
        else if( Yii::$app->user->can('Create_branch')){
          
            if ($this->request->isPost) {
                if ($model->load($this->request->post())) {
                    $model->created_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                    $model->updated_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                    $model->created_by=Yii::$app->user->identity->username;
                    $model->updated_by=Yii::$app->user->identity->username;
                    if($model->save()){
                        $log = new Log();
                        $log->done_by=Yii::$app->user->identity->username;
                        $log->comment="Created new branch";
                        $log->done_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                        $log->save();
                    }
                    return $this->redirect(['view', 'branch_id' => $model->branch_id,'userProfileImage' => $userProfileImage,]);
                }
            } else {
                $model->loadDefaultValues();
            }
            return $this->render('create', [
                'model' => $model,
                'userProfileImage' => $userProfileImage,
            ]);
        }
        else{
            throw new ForbiddenHttpException;
        }
        
    }

    /**
     * Updates an existing Branch model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $branch_id Branch ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($branch_id)
    {
        $user_id = Yii::$app->user->id;
        $userDetails = User::findOne($user_id);
        $userProfileImage = $userDetails->profile;
        if(Yii::$app->user->isGuest){
            return Yii::$app->getResponse()->redirect(['site/login']);
        }
        else if(Yii::$app->user->can('Update_branch')){
            $model = $this->findModel($branch_id);

            if ($this->request->isPost && $model->load($this->request->post())) {
                if($model->save()){
                    $log = new Log();
                    $log->done_by=Yii::$app->user->identity->username;
                    $log->comment="Updated branch details";
                    $log->done_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                    $log->save();
                }
                
                return $this->redirect(['view', 'branch_id' => $model->branch_id,'userProfileImage' => $userProfileImage,]);
            }
    
            return $this->render('update', [
                'model' => $model,'userProfileImage' => $userProfileImage,
            ]);
        }else{
            throw new ForbiddenHttpException;
        }
       
    }

    /**
     * Deletes an existing Branch model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $branch_id Branch ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($branch_id)
    {
        $user_id = Yii::$app->user->id;
        $userDetails = User::findOne($user_id);
        $userProfileImage = $userDetails->profile;
        if(Yii::$app->user->isGuest){
            return Yii::$app->getResponse()->redirect(['site/login']);
        }
        else if(Yii::$app->user->can('Delete_branch')){
            $this->findModel($branch_id)->delete();
                $log = new Log();
                $log->done_by=Yii::$app->user->identity->username;
                $log->comment="Deleted a branch";
                $log->done_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                $log->save();

                return $this->redirect(['index']);
            }else{
                throw new ForbiddenHttpException;
            }

        
        }

        protected function findModel($branch_id)
    {
        if(Yii::$app->user->isGuest){
            return Yii::$app->getResponse()->redirect(['site/login']);
        }
        else if (($model = Branch::findOne(['branch_id' => $branch_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

        
    }

    /**
     * Finds the Branch model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $branch_id Branch ID
     * @return Branch the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    
