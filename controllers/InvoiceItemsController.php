<?php

namespace app\controllers;

use app\models\InvoiceItems;
use app\models\Item;
use app\models\Invoice;
use app\models\Log;
use app\models\InvoiceItemsSearch;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use Mpdf;

/**
 * InvoiceItemsController implements the CRUD actions for InvoiceItems model.
 */
class InvoiceItemsController extends Controller
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
     * Lists all InvoiceItems models.
     *
     * @return string
     */
    public function actionIndex()
{
    $invoice_id = Yii::$app->request->get('invoice_id');
    $searchModel = new InvoiceItemsSearch();
    $searchModel->invoice_id = $invoice_id; // add a filter condition
    $dataProvider = $searchModel->search($this->request->queryParams);

    return $this->render('index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'invoice_id'=>$invoice_id,
    ]);
}

public function actionInvoice($invoice_id)
{
$query = InvoiceItems::find()->where(['invoice_id' => $invoice_id]);
$dataProvider = new ActiveDataProvider([
    'query' => $query,
]);

// render the view with the data provider
$html = $this->renderPartial('invoice-pdf', ['dataProvider' => $dataProvider]);

// output the PDF
$mpdf = new Mpdf\Mpdf;
$mpdf->showImageErrors = true;
$mpdf->SetDisplayMode('fullpage','two');
$mpdf->writeHTML($html);
$mpdf->output();
exit;

}





    /**
     * Displays a single InvoiceItems model.
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
     * Creates a new InvoiceItems model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $invoice_id = Yii::$app->request->get('invoice_id');
        
        $model = new InvoiceItems();
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $item_id = $model->item_id;
                $item = Item::findOne($item_id);
                $model->invoice_id=$invoice_id;
                $model->item_name=$item->item_name;
                $model->sender_name=$item->sender_name;
                $model->receiver_name=$item->receiver_name;
                $model->item_value=$item->value;
                $model->departure=$item->departure;
                $model->destination=$item->destination;
                $model->created_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                $model->updated_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                if($model->save()){
                    $log = new Log();
                    $log->done_by=Yii::$app->user->identity->username;
                    $log->comment="New item is added to the invoice";
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
     * Updates an existing InvoiceItems model.
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
     * Deletes an existing InvoiceItems model.
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
     * Finds the InvoiceItems model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return InvoiceItems the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InvoiceItems::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
