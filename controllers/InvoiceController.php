<?php

namespace app\controllers;

use app\models\Invoice;
use app\models\Log;
use app\models\InvoiceItems;
use app\models\InvoiceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\UserSignatures;
use yii\filters\VerbFilter;
use yii\web\HttpException;
use Yii;
/**
 * InvoiceController implements the CRUD actions for Invoice model.
 */
class InvoiceController extends Controller
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
     * Lists all Invoice models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new InvoiceSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionSign($id)
    {
        $model = $this->findModel($id);
        $user_id=$model->user_id;
        $userSignature = UserSignatures::findOne(['user_id' => $user_id]);
        $signature_id=$userSignature->signature_id;
        if ($signature_id !== null) {
            $model->signature_id = $signature_id;
            $model->signed=1;
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Invoice signed successfully.');
            } else {
                Yii::$app->session->setFlash('error', 'Failed to sign invoice.');
            }
        } else {
            Yii::$app->session->setFlash('error', 'Upload your signature in order to sign this Invoice');
        }
    
        return $this->redirect(['view', 'invoice_id' => $model->invoice_id]);
    }
    

    /**
     * Displays a single Invoice model.
     * @param int $invoice_id Invoice ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($invoice_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($invoice_id),
        ]);
    }

    /**
     * Creates a new Invoice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Invoice();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->user_id=Yii::$app->user->id;
                $model->created_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                $model->updated_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                if($model->save()){
                    $log = new Log();
                    $log->done_by=Yii::$app->user->identity->username;
                    $log->comment="Invoice is Created";
                    $log->done_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                    $log->save();
                }
                return $this->redirect(['invoice-items/create', 'invoice_id' => $model->invoice_id]);

            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Invoice model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $invoice_id Invoice ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($invoice_id)
    {
        $model = $this->findModel($invoice_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'invoice_id' => $model->invoice_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Invoice model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $invoice_id Invoice ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($invoice_id)
{
    // delete all invoice items with the specified invoice_id
    InvoiceItems::deleteAll(['invoice_id' => $invoice_id]);

    // delete the invoice model
    $this->findModel($invoice_id)->delete();

    return $this->redirect(['index']);
}


    /**
     * Finds the Invoice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $invoice_id Invoice ID
     * @return Invoice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($invoice_id)
    {
        if (($model = Invoice::findOne(['invoice_id' => $invoice_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
