<?php

namespace app\controllers;
use app\models\User;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use Yii;

class ProfileController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $user_id = Yii::$app->user->id;
        $userDetails = User::findOne($user_id);
        $userProfileImage = $userDetails->profile;
        $user_name=Yii::$app->user->identity->username;
        return $this->render('index',['user_name'=>$user_name,'userProfileImage' => $userProfileImage,]);
    }

    public function actionUsername()
{
    $user_id = Yii::$app->user->id;
    $userDetails = User::findOne($user_id);
    $userProfileImage = $userDetails->profile;
    $model = User::findOne(Yii::$app->user->id); // assuming your User model is named "User"
    $newUsername = Yii::$app->request->post('new-username');
    $password = Yii::$app->request->post('password');
    
     // Validate password
     if (!$model->validatePassword($password)) {
        Yii::$app->session->setFlash('error', 'Invalid password.');
        return $this->redirect(['index','userProfileImage' => $userProfileImage]);
    }

    // If password is valid, update the username
    $model->username = $newUsername;
    if ($model->save()) {
        Yii::$app->session->setFlash('success', 'Username updated successfully.');
    } else {
        Yii::$app->session->setFlash('error', 'Failed to update username.');
    }

    return $this->redirect(['index','userProfileImage' =>$userProfileImage,]);
}

public function actionImage()
{
    $user_id = Yii::$app->user->id;
    $userDetails = User::findOne($user_id);
    $userProfileImage = $userDetails->profile;
    $userId = Yii::$app->user->identity->id; // Get the authenticated user's ID
    $user = User::findOne($userId); // Find the user record

    // Get the uploaded file
    $profilePic = UploadedFile::getInstanceByName('profile-pic');

    // Validate if a file was uploaded successfully
    if ($profilePic !== null) {
        $oldProfilePicPath = Yii::getAlias('@webroot/') . $user->getAttribute('profile');

        // Generate a unique file name for the new profile image
        $fileName = 'image-' . uniqid() . '.' . $profilePic->extension;

        // Update the user's profile attribute in the database
        $user->setAttribute('profile', 'profiles/' . $fileName);
        $user->save(false); // Save the user record without performing validation

        // Save the new profile image to the specified directory
        $profilePic->saveAs(Yii::getAlias('@webroot/profiles/') . $fileName);

        // Delete the old profile image if it exists
        if (file_exists($oldProfilePicPath) && is_file($oldProfilePicPath)) {
            unlink($oldProfilePicPath);
        }

        // Redirect or display success message
        Yii::$app->session->setFlash('success', 'Profile image updated successfully.');
        return $this->redirect(['profile/index','userProfileImage'=>$userProfileImage]); // Replace 'profile/view' with the appropriate URL to redirect after the image is updated
    }

    // Handle the case when no file was uploaded
    Yii::$app->session->setFlash('error', 'No profile image uploaded.');
    return $this->redirect(['profile/index','userProfileImage'=>$userProfileImage]); // Replace 'profile/view' with the appropriate URL to redirect if no image is uploaded
}


public function actionPassword()
{
    $user_id = Yii::$app->user->id;
    $userDetails = User::findOne($user_id);
    $userProfileImage = $userDetails->profile;
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

    return $this->redirect(['index','userProfileImage' => $userProfileImage,]);
}

}
