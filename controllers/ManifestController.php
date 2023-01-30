<?php

namespace app\controllers;

use app\models\Manifest;
use app\models\ManifestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ManifestController implements the CRUD actions for Manifest model.
 */
class ManifestController extends Controller
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

    /**
     * Displays a single Manifest model.
     * @param int $manifest_id Manifest ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($manifest_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($manifest_id),
        ]);
    }

    /**
     * Creates a new Manifest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Manifest();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'manifest_id' => $model->manifest_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
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
        $model = $this->findModel($manifest_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'manifest_id' => $model->manifest_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
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
        $this->findModel($manifest_id)->delete();

        return $this->redirect(['index']);
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
