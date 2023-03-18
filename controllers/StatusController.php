<?php

namespace app\controllers;

use app\models\Status;
use app\models\Log;
use app\models\StatusSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use Mpdf;
use yii\web\ForbiddenHttpException;

/**
 * StatusController implements the CRUD actions for Status model.
 */
class StatusController extends Controller
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
     * Lists all Status models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new StatusSearch();
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
        $query = Item::find()
    ->where(['between', 'FROM_UNIXTIME(created_at, "%Y-%m-%d")', $start_date, $end_date])
    ->orderBy('created_at');
    $this->items = $query->all();
    return $this->render('viewreport',['items' => $this->items]);
    }
    
    return $this->render('duration');
}


    public function actionPdf(){
        $searchModel = new StatusSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $html = $this->renderPartial('pdf_view',['dataProvider'=>$dataProvider]);
        $mpdf = new Mpdf\Mpdf;
        $mpdf ->showImageErrors = true;
        $mpdf ->SetDisplayMode('fullpage','two');
        $mpdf ->writeHTML($html);
        $mpdf->output();
        exit;
    }

    /**
     * Displays a single Status model.
     * @param int $status_id Status ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($status_id)
    {
        if(Yii::$app->user->can('View_status')){
            return $this->render('view', [
                'model' => $this->findModel($status_id),
            ]);
        }else{
            throw new ForbiddenHttpException;
        }
        
    }

    /**
     * Creates a new Status model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Status();

        if(Yii::$app->user->can('Create_status')){
            if ($this->request->isPost) {
                if ($model->load($this->request->post())) {
                    $model->created_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                    $model->updated_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                    $model->created_by=Yii::$app->user->identity->username;
                    $model->updated_by=Yii::$app->user->identity->username;
                    if($model->save()){
                        $log = new Log();
    
                        $log->done_by=Yii::$app->user->identity->username;
                        $log->comment="Created new status";
                        $log->done_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                        $log->save();
                    }
                    return $this->redirect(['view', 'status_id' => $model->status_id]);
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
     * Updates an existing Status model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $status_id Status ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($status_id)
    {
        if(Yii::$app->user->can('Update_status')){
            $model = $this->findModel($status_id);

            if ($this->request->isPost && $model->load($this->request->post())) {
                if($model->save()){
                    $log = new Log();
                    $log->done_by=Yii::$app->user->identity->username;
                    $log->comment="Updated status details";
                    $log->done_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                    $log->save();
                }
                return $this->redirect(['view', 'status_id' => $model->status_id]);
            }
    
            return $this->render('update', [
                'model' => $model,
            ]);
        }else{
            throw new ForbiddenHttpException;
        }
       
    }

    /**
     * Deletes an existing Status model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $status_id Status ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($status_id)
    {
        if(Yii::$app->user->can('Delete_status')){
            $this->findModel($status_id)->delete();
                $log = new Log();

                $log->done_by=Yii::$app->user->identity->username;
                $log->comment="Deleted a status";
                $log->done_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                $log->save();


        return $this->redirect(['index']);
        }else{
            throw new ForbiddenHttpException;
        }
        
    }

    /**
     * Finds the Status model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $status_id Status ID
     * @return Status the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($status_id)
    {
        if (($model = Status::findOne(['status_id' => $status_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
