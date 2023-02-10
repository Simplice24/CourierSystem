<?php

namespace app\controllers;

use app\models\Status;
use app\models\StatusSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

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

    /**
     * Displays a single Status model.
     * @param int $status_id Status ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($status_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($status_id),
        ]);
    }

    /**
     * Creates a new Status model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Status();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->created_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                $model->updated_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                $model->created_by=Yii::$app->user->identity->username;
                $model->updated_by=Yii::$app->user->identity->username;
                $model->save();
                return $this->redirect(['view', 'status_id' => $model->status_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
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
        $model = $this->findModel($status_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'status_id' => $model->status_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
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
        $this->findModel($status_id)->delete();

        return $this->redirect(['index']);
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
