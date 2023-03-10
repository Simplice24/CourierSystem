<?php

namespace app\controllers;

use app\models\Branch;
use app\models\Log;
use app\models\BranchSearch;
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
        $searchModel = new BranchSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        if(Yii::$app->user->isGuest){
            return Yii::$app->getResponse()->redirect(['site/login']);
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionPdf(){
        $searchModel = new BranchSearch();
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
     * Displays a single Branch model.
     * @param int $branch_id Branch ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($branch_id)
    {
        if(Yii::$app->user->isGuest){
            return Yii::$app->getResponse()->redirect(['site/login']);
        }
        else if(Yii::$app->user->can('View_branch')){
            return $this->render('view', [
                'model' => $this->findModel($branch_id),
            ]);
        }else{
            throw new ForbiddenHttpException;
        } 
    }

    /**
     * Creates a new Branch model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
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
                    return $this->redirect(['view', 'branch_id' => $model->branch_id]);
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
     * Updates an existing Branch model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $branch_id Branch ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($branch_id)
    {
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
                
                return $this->redirect(['view', 'branch_id' => $model->branch_id]);
            }
    
            return $this->render('update', [
                'model' => $model,
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
    
