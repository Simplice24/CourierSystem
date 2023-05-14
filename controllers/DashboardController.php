<?php

namespace app\controllers;
use app\models\Branch;
use app\models\Customer;
use app\models\Item;
use app\models\Log;
use app\models\Manifest;
use app\models\Status;
use app\models\Subscription;
use app\models\SubscriptionType;
use app\models\User;
use Yii;

class DashboardController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $user_id = Yii::$app->user->id;
        $userDetails = User::findOne($user_id);
        $userProfileImage = $userDetails->profile;
        $users=User::find()->count();
        $branches=Branch::find()->count();
        $items=Item::find()->count();
        $logs=Log::find()->count();
        $manifests=Manifest::find()->count();
        $customers=Customer::find()->count();
        $status=Status::find()->count();
        $subscriptions=Subscription::find()->count();
        $subscriptiontypes=SubscriptionType::find()->count();

        return $this->render('index',['userProfileImage' =>$userProfileImage,'users' => $users,'branches'=>$branches,'items'=>$items,'logs'=>$logs,'manifests'=>$manifests,'customers'=>$customers,'status'=>$status,'subscriptions'=>$subscriptions,'subscriptiontypes'=>$subscriptiontypes]);
    }

}
