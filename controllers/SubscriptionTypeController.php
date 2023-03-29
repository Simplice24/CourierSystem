<?php

namespace app\controllers;

use app\models\SubscriptionType;
use app\models\Log;
use app\models\SubscriptionTypeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Mpdf;
use Yii;
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
            $query = SubscriptionType::find()
        ->where(['between', 'FROM_UNIXTIME(created_at, "%Y-%m-%d")', $start_date, $end_date])
        ->orderBy('created_at');
        $dataProvider= $query->all();
        $no=0;
        return $this->render('viewreport',['dataProvider' => $dataProvider,'no'=>$no]);
        }
        
        return $this->render('duration');
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
     * Displays a single SubscriptionType model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SubscriptionType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new SubscriptionType();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->created_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                $model->updated_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                $model->created_by=Yii::$app->user->identity->username;
                $model->updated_by=Yii::$app->user->identity->username;
                if($model->save()){
                    $log = new Log();
                    $log->done_by=Yii::$app->user->identity->username;
                    $log->comment="New type of subscription is created";
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
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
