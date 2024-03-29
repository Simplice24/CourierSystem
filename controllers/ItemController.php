<?php

namespace app\controllers;

use app\models\Item;
use app\models\Log;
use app\models\User;
use app\models\ItemSearch;
use app\models\UserSignatures;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use Mpdf;
use Yii;
use yii\web\ForbiddenHttpException;

class ItemController extends Controller
{
   public function actionView($item_id)
   {
        $user_id = Yii::$app->user->id;
        $userDetails = User::findOne($user_id);
        $userProfileImage = $userDetails->profile;
       if(Yii::$app->user->isGuest){
           return Yii::$app->getResponse()->redirect(['site/login']);
       }
       else if(Yii::$app->user->can('View_item')){
           return $this->render('view', [
               'model' => $this->findModel($item_id),
               'userProfileImage' => $userProfileImage,
           ]);
       }else{
           throw new ForbiddenHttpException;
       } 
   }

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
     * Lists all Item models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $user_id = Yii::$app->user->id;
        $userDetails = User::findOne($user_id);
        $userProfileImage = $userDetails->profile;
        $searchModel = new ItemSearch();
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
            $query = Item::find()
                ->where(['between', 'FROM_UNIXTIME(created_at, "%Y-%m-%d")', $start_date, $end_date])
                ->orderBy('created_at');
            $dataProvider = $query->all();
            $no = 0;
            if (empty($dataProvider)) {
                $message = 'No item found for the selected date range.';
                return $this->render('viewreport',['message'=>$message,'userProfileImage' =>$userProfileImage,]);
            }
            return $this->render('viewreport', ['dataProvider' => $dataProvider, 'no' => $no,'userProfileImage' => $userProfileImage,]);
        }
        return $this->render('duration', ['userProfileImage' => $userProfileImage]);
    }
    
    /**
     * Creates a new Item model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $user_id = Yii::$app->user->id;
        $userDetails = User::findOne($user_id);
        $userProfileImage = $userDetails->profile;
        $model = new Item();
        if(Yii::$app->user->can('Create_item')){
            
            if ($this->request->isPost) {
                if ($model->load($this->request->post())) {
                    $model->created_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                    $model->updated_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                    $model->created_by=Yii::$app->user->identity->username;
                    $model->updated_by=Yii::$app->user->identity->username;
                    if($model->save()){
                        $log = new Log();
                        $log->done_by=Yii::$app->user->identity->username;
                        $log->comment="Item received by branch agent";
                        $log->done_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                        $log->save();
                    }
                    return $this->redirect(['view', 'item_id' => $model->item_id,'userProfileImage' => $userProfileImage]);
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
     * Updates an existing Item model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $item_id Item ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($item_id)
    {
        $user_id = Yii::$app->user->id;
        $userDetails = User::findOne($user_id);
        $userProfileImage = $userDetails->profile;
        if(Yii::$app->user->can('Update_item')){
            $model = $this->findModel($item_id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            if($model->save()){
                $log = new Log();
                $log->done_by=Yii::$app->user->identity->username;
                $log->comment="Updated item details ";
                $log->done_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                $log->save();
            }
            return $this->redirect(['view', 'item_id' => $model->item_id,'userProfileImage'=>$userProfileImage,]);
        }

        return $this->render('update', [
            'model' => $model,
            'userProfileImage' => $userProfileImage,
        ]);
        }else{
            throw new ForbiddenHttpException;
        }
        
    }

    public function actionReceipt($item_id)
{
    $userID = Yii::$app->user->id;
    // Select all details from the Item model based on the $item_id parameter
    $query = Item::find()->where(['item_id' => $item_id]);
    $dataProvider = new ActiveDataProvider([
        'query' => $query,
    ]);

    $signatureImage = UserSignatures::find()
    ->select(['signature_image'])
    ->where(['user_id' => $userID])
    ->scalar();
    $userSignature = UserSignatures::find()->where(['user_id' => $userID])->one();
    $signatureImagePath = 'uploads/' . basename($userSignature->signature_image);
    
    // Get the data as an array
    $items = $dataProvider->getModels();
    $dataProvider= $query->all();
        $html = $this->renderPartial('receipt',['items'=>$items,'signatureImagePath'=>$signatureImagePath]);
        $mpdf = new Mpdf\Mpdf;
        $mpdf ->showImageErrors = true;
        $mpdf ->SetDisplayMode('fullpage','two');
        $mpdf ->writeHTML($html);
        $mpdf->output();
        exit;
}

    /**
     * Deletes an existing Item model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $item_id Item ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($item_id)
    {
        $user_id = Yii::$app->user->id;
        $userDetails = User::findOne($user_id);
        $userProfileImage = $userDetails->profile;
        if(Yii::$app->user->can('Delete_item')){
            $this->findModel($item_id)->delete();
                $log = new Log();
                $log->done_by=Yii::$app->user->identity->username;
                $log->comment="Deleted item";
                $log->done_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                $log->save();
            
            return $this->redirect(['index','userProfileImage' => $userProfileImage,]);
        }else{
            throw new ForbiddenHttpException;
        }
      
    }

    public function actionPdf(){
        $no=0;
        $dataProvider = unserialize(urldecode($_GET['dataProvider']));
        $html = $this->renderPartial('pdf_view',['dataProvider'=>$dataProvider,'no'=>$no]);
        $mpdf = new Mpdf\Mpdf;
        $mpdf ->showImageErrors = true;
        $mpdf ->SetDisplayMode('fullpage','two');
        $mpdf ->writeHTML($html);
        $mpdf->output();
        exit;
    }


    /**
     * Finds the Item model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $item_id Item ID
     * @return Item the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($item_id)
    {
        if (($model = Item::findOne(['item_id' => $item_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    
}
