<?php

namespace app\controllers;

use app\models\User;
use app\models\Log;
use app\models\AuthAssignment;
use app\models\UserSearch;
use yii\web\Controller;
use app\models\UserSignatures;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Expression;
use Yii;
use Mpdf;
use yii\web\ForbiddenHttpException;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $user_id = Yii::$app->user->id;
        $userDetails = User::findOne($user_id);
        $userProfileImage = $userDetails->profile;
        $searchModel = new UserSearch();
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
        return $this->render('duration',['userProfileImage' => $userProfileImage]);
    }


        public function actionGenerate() {
            $user_id = Yii::$app->user->id;
            $userDetails = User::findOne($user_id);
            $userProfileImage = $userDetails->profile;
            if (Yii::$app->request->post()) {
                $start_date = Yii::$app->request->post('start_date');
                $end_date = Yii::$app->request->post('end_date');
                $query = User::find()
            ->where(['between', 'FROM_UNIXTIME(created_at, "%Y-%m-%d")', $start_date, $end_date])
            ->orderBy('created_at');
            $users = $query->all();
            $no=0;
            return $this->render('viewreport',['users' => $users,'no'=>$no,'userProfileImage'=>$userProfileImage]);
                }
            
            return $this->render('duration',['userProfileImage'=>$userProfileImage]);
        }

    public function actionPdf(){
        $users=unserialize(urldecode($_GET['users']));
        $no=0;
        $html = $this->renderPartial('pdf_view',['users'=>$users,'no'=>$no]);
        $mpdf = new Mpdf\Mpdf;
        $mpdf ->showImageErrors = true;
        $mpdf ->SetDisplayMode('fullpage','two');
        $mpdf ->writeHTML($html);
        $mpdf->output();
        exit;
    }

    /**
     * Displays a single User model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $user_id = Yii::$app->user->id;
        $userDetails = User::findOne($user_id);
        $userProfileImage = $userDetails->profile;
        if(Yii::$app->user->can('View_user')){
            return $this->render('view', [
                'model' => $this->findModel($id),
                'userProfileImage' => $userProfileImage,
            ]);
        }else{
            throw new ForbiddenHttpException;
        }
        
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
{
    $user_id = Yii::$app->user->id;
    $userDetails = User::findOne($user_id);
    $userProfileImage = $userDetails->profile;
    $model = new User();

    if (Yii::$app->user->can('Create_user')) {
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                // Validate unique username and email
                if ($this->isUsernameUnique($model->username) && $this->isEmailUnique($model->email)) {
                    $model->auth_key = Yii::$app->security->generateRandomString();
                    $model->verification_token = Yii::$app->security->generateRandomString();
                    $model->created_at = Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                    $model->updated_at = Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                    $model->setPassword($model->password_hash);
                    $model->profile = 'profiles/userImage.jpg';
                    
                    if ($model->save()) {
                        $auth = new AuthAssignment;
                        $auth->user_id = $model->id;
                        $auth->item_name = $model->role;
                        $auth->save();

                        $log = new Log();
                        $log->done_by = Yii::$app->user->identity->username;
                        $log->comment = "Created a new system user";
                        $log->done_at = Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                        $log->save();

                        return $this->redirect(['view', 'id' => $model->id, 'userProfileImage' => $userProfileImage]);
                    }
                } else {
                    $model->addError('username', 'Username is already taken.');
                    $model->addError('email', 'Email is already taken.');
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'userProfileImage' => $userProfileImage,
        ]);
    } else {
        throw new ForbiddenHttpException;
    }
}

private function isUsernameUnique($username)
{
    $existingUser = User::findOne(['username' => $username]);
    return $existingUser === null;
}

private function isEmailUnique($email)
{
    $existingUser = User::findOne(['email' => $email]);
    return $existingUser === null;
}

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $user_id = Yii::$app->user->id;
        $userDetails = User::findOne($user_id);
        $userProfileImage = $userDetails->profile;
        if(Yii::$app->user->can('Update_user')){
            $model = $this->findModel($id);
        if ($this->request->isPost && $model->load($this->request->post())) {
            if($model->save()){
                $log = new Log();
                $log->done_by=Yii::$app->user->identity->username;
                $log->comment="Updated user details";
                $log->done_at=Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
                $log->save();
            }
            return $this->redirect(['view', 'id' => $model->id,'userProfileImag'=>$userProfileImage]);
        }

        return $this->render('update', [
            'model' => $model,
            'userProfileImage' =>$userProfileImage,
        ]);
        }else{
            throw new ForbiddenHttpException;
        }
        
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $user_id = Yii::$app->user->id;
        $userDetails = User::findOne($user_id);
        $userProfileImage = $userDetails->profile;
        if (Yii::$app->user->can('Delete_user')) {
            $model = $this->findModel($id);
            $userSignaturesModel = UserSignatures::findOne(['user_id' => $id]);

            if ($userSignaturesModel !== null) {
                $userSignaturesModel->delete();
            }

            $model->delete();

            $log = new Log();
            $log->done_by = Yii::$app->user->identity->username;
            $log->comment = "Deleted a system user";
            $log->done_at = Yii::$app->formatter->asTimestamp(date('Y-m-d h:m:s'));
            $log->save();

            return $this->redirect(['index','userProfileImage'=> $userProfileImage]);
        } else {
            throw new ForbiddenHttpException;
        }
    }


    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
