<?php

namespace app\controllers;
use app\models\Log;
use app\models\SubscriptionType;
use app\models\SubscriptionTypeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use Mpdf;
use yii\web\ForbiddenHttpException;

/**
 * SubscriptionTypeController implements the CRUD actions for SubscriptionType model.
 */
class SubscriptionTypeController extends Controller
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
     * Lists all SubscriptionType models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SubscriptionTypeSearch();
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
        $searchModel = new SubscriptionTypeSearch();
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
     * Displays a single SubscriptionType model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if(Yii::$app->user->can('View_subscriptionTypes')){
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }else{
            throw new ForbiddenHttpException;
        }
        
    }

    /**
     * Creates a new SubscriptionType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new SubscriptionType();
        if(Yii::$app->user->can('Create_subscriptionTypes')){
            if ($this->request->isPost) {
                if ($model->load($this->request->post())) {
                    $model->created_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                    $model->updated_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                    $model->created_by=Yii::$app->user->identity->username;
                    $model->updated_by=Yii::$app->user->identity->username;
                    if($model->save()){
                        $log = new Log();
                        $log->done_by=Yii::$app->user->identity->username;
                        $log->comment="Created a new subscription type";
                        $log->done_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                        $log->save();
                    }
                    return $this->redirect(['view', 'id' => $model->id]);
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
     * Updates an existing SubscriptionType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('Update_subscriptionTypes')){
            $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            if($model->save()){
                $log = new Log();
                $log->done_by=Yii::$app->user->identity->username;
                $log->comment="Updated details of a subscription type";
                $log->done_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                $log->save();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
        }else{
            throw new ForbiddenHttpException;
        }
        
    }

    /**
     * Deletes an existing SubscriptionType model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->can('Delete_subscriptionTypes')){
            $this->findModel($id)->delete();
                $log = new Log();
                $log->done_by=Yii::$app->user->identity->username;
                $log->comment="Deleted subscription type";
                $log->done_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                $log->save();
            

        return $this->redirect(['index']);
        }else{
            throw new ForbiddenHttpException;
        }
        
    }

    /**
     * Finds the SubscriptionType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return SubscriptionType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SubscriptionType::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
