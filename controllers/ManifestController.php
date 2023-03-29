<?php

namespace app\controllers;

use app\models\Manifest;
use app\models\Log;
use app\models\ManifestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use Mpdf;
use yii\web\ForbiddenHttpException;

/**
 * ManifestController implements the CRUD actions for Manifest model.
 */
class ManifestController extends Controller
{
   
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
     * Lists all Manifest models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ManifestSearch();
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
        $query = Manifest::find()
    ->where(['between', 'FROM_UNIXTIME(created_at, "%Y-%m-%d")', $start_date, $end_date])
    ->orderBy('created_at');
    $manifests = $query->all();
    $no=0;
    return $this->render('viewreport',['manifests' => $manifests,'no'=>$no]);
    }
    
    return $this->render('duration');
}

    public function actionPdf(){
        $manifests=unserialize(urldecode($_GET['manifests']));
        $no=0;
        $html = $this->renderPartial('pdf_view',['manifests'=>$manifests,'no'=>$no]);
        $mpdf = new Mpdf\Mpdf;
        $mpdf ->showImageErrors = true;
        $mpdf ->SetDisplayMode('fullpage','two');
        $mpdf ->writeHTML($html);
        $mpdf->output();
        exit;
    }

    /**
     * Displays a single Manifest model.
     * @param int $manifest_id Manifest ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($manifest_id)
    {
        if(Yii::$app->user->can('View_manifest')){
            return $this->render('view', [
                'model' => $this->findModel($manifest_id),
            ]);
        }else{
            throw new ForbiddenHttpException;
        }
        
    }

    /**
     * Creates a new Manifest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Manifest();
        if(Yii::$app->user->can('Create_manifest')){
            if ($this->request->isPost) {
                if ($model->load($this->request->post())) {
                    $model->created_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                    $model->updated_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                    $model->created_by=Yii::$app->user->identity->username;
                    $model->updated_by=Yii::$app->user->identity->username;
                    if($model->save()){
                        $log = new Log();
                        $log->done_by=Yii::$app->user->identity->username;
                        $log->comment="Created new manifest";
                        $log->done_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                        $log->save();
                    }
                    return $this->redirect(['view', 'manifest_id' => $model->manifest_id]);
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
     * Updates an existing Manifest model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $manifest_id Manifest ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($manifest_id)
    {
        if(Yii::$app->user->can('Update_manifest')){
            $model = $this->findModel($manifest_id);

            if ($this->request->isPost && $model->load($this->request->post())) {
                if($model->save()){
                    $log = new Log();
                    $log->done_by=Yii::$app->user->identity->username;
                    $log->comment="Updated manifest details";
                    $log->done_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                    $log->save();
                }
                return $this->redirect(['view', 'manifest_id' => $model->manifest_id]);
            }
    
            return $this->render('update', [
                'model' => $model,
            ]);
        }else{
            throw new ForbiddenHttpException;
        }
       
    }

    /**
     * Deletes an existing Manifest model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $manifest_id Manifest ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($manifest_id)
    {
        if(Yii::$app->user->can('Delete_manifest')){
            $this->findModel($manifest_id)->delete();
                $log = new Log();

                $log->done_by=Yii::$app->user->identity->username;
                $log->comment="Deleted a manifest";
                $log->done_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                $log->save();

            return $this->redirect(['index']);
        }else{
            throw new ForbiddenHttpException;
        }
       
    }

    /**
     * Finds the Manifest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $manifest_id Manifest ID
     * @return Manifest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($manifest_id)
    {
        if (($model = Manifest::findOne(['manifest_id' => $manifest_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
