<?php

namespace app\controllers;
use app\models\User;
use Yii;

class ProfileController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $user_name=Yii::$app->user->identity->username;
        return $this->render('index',['user_name'=>$user_name]);
    }

    public function actionUsername()
{
    $model = User::findOne(Yii::$app->user->id); // assuming your User model is named "User"
    $newUsername = Yii::$app->request->post('new-username');
    $password = Yii::$app->request->post('password');
    
     // Validate password
     if (!$model->validatePassword($password)) {
        Yii::$app->session->setFlash('error', 'Invalid password.');
        return $this->redirect(['index']);
    }

    // If password is valid, update the username
    $model->username = $newUsername;
    if ($model->save()) {
        Yii::$app->session->setFlash('success', 'Username updated successfully.');
    } else {
        Yii::$app->session->setFlash('error', 'Failed to update username.');
    }

    return $this->redirect(['index']);
}

public function actionPassword(){
    $model = User::findOne(Yii::$app->user->id);
    $currentPassword = Yii::$app->request->post('current-password');
    $newPassword = Yii::$app->request->post('new-password');
    $confirmPassword = Yii::$app->request->post('confirm-password');

    if ($newPassword === $confirmPassword) {
        if ($model->validatePassword($currentPassword)) {
            $model->setPassword($newPassword);
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Password changed successfully.');
            } else {
                Yii::$app->session->setFlash('error', 'Error changing password.');
            }
        } else {
            Yii::$app->session->setFlash('error', 'Invalid current password.');
        }
    } else {
        Yii::$app->session->setFlash('error', 'New password and confirmation password do not match.');
    }

    return $this->redirect(['index']);
}

}
