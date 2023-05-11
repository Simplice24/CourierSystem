<?php

namespace app\controllers;

use app\models\UserSignatures;
use app\models\UserSiganturesSearch;
use app\models\Log;
use app\models\AuthAssignment;
use yii\web\Controller;
use app\models\Invoice;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Yii;

/**
 * UserSignaturesController implements the CRUD actions for UserSignatures model.
 */
class UserSignaturesController extends Controller
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
     * Lists all UserSignatures models.
     *
     * @return string
     */
    public function actionIndex()
{
    $searchModel = new UserSiganturesSearch();
    $queryParams = $this->request->queryParams;
    
    // only show records where user_id is equal to the authenticated user's ID
    $queryParams['UserSiganturesSearch']['user_id'] = Yii::$app->user->id;
    
    $dataProvider = $searchModel->search($queryParams);

    return $this->render('index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
    ]);
}


    /**
     * Displays a single UserSignatures model.
     * @param int $signature_id Signature ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($signature_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($signature_id),
        ]);
    }

    /**
     * Creates a new UserSignatures model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new UserSignatures();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->timestamp=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                $image = UploadedFile::getInstance($model, 'signature_image');

                // Generate a unique filename
                $filename = uniqid() . '.' . $image->extension;

                // Define the path where the file will be saved
                $path = Yii::getAlias('@webroot') . '/uploads/' . $filename;

                // Save the uploaded file
                if ($image->saveAs($path)) {
                    // Set the path of the signature image in the model
                    $model->signature_image = '/uploads/' . $filename;
                    
                    $model->timestamp = Yii::$app->formatter->asTimestamp(date('Y-m-d H:i:s'));

                    // Save the model in the database
                    $model->save();
                    return $this->redirect(['view', 'signature_id' => $model->signature_id]);
                }
                
                
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing UserSignatures model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $signature_id Signature ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($signature_id)
{
    $model = $this->findModel($signature_id);

    if ($this->request->isPost) {
        $oldImage = $model->signature_image; // Save the old image path for deletion
        if ($model->load($this->request->post())) {
            $image = UploadedFile::getInstance($model, 'signature_image');

            if ($image !== null) {
                // Generate a unique filename
                $filename = uniqid() . '.' . $image->extension;

                // Define the path where the file will be saved
                $path = Yii::getAlias('@webroot') . '/uploads/' . $filename;

                // Save the uploaded file
                if ($image->saveAs($path)) {
                    // Delete the old image file
                    if ($oldImage !== null) {
                        $oldImagePath = Yii::getAlias('@webroot') . $oldImage;
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    }

                    // Set the path of the signature image in the model
                    $model->signature_image = '/uploads/' . $filename;
                } else {
                    // Image upload failed, set signature_image to null
                    $model->signature_image = null;
                }
            }
            
            if ($model->save()) {
                return $this->redirect(['view', 'signature_id' => $model->signature_id]);
            }
        }
    }

    return $this->render('update', [
        'model' => $model,
    ]);
}




    /**
     * Deletes an existing UserSignatures model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $signature_id Signature ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($signature_id)
        {
            // delete the signature image file
            $model = $this->findModel($signature_id);
            $imagePath = Yii::getAlias('@webroot') . $model->signature_image;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            // update the invoice records
            Invoice::updateAll(['signature_id' => null, 'signed' => 0], ['signature_id' => $signature_id]);

            // delete the signature record
            $model->delete();
            return $this->redirect(['index']);
        }


    /**
     * Finds the UserSignatures model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $signature_id Signature ID
     * @return UserSignatures the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($signature_id)
    {
        if (($model = UserSignatures::findOne(['signature_id' => $signature_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
