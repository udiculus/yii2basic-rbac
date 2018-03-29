<?php
/**
 * Created by PhpStorm.
 * User: Yudhi_G293
 * Date: 28/03/2018
 * Time: 10:15
 */

namespace app\commands;

use app\models\User;
use yii\console\Controller;
use yii\console\ExitCode;

class UserController extends Controller
{
    public function actionIndex($message = 'hello world')
    {
        echo $message . "\n";

        return ExitCode::OK;
    }

    public function actionCreate()
    {
        // Admin
        $user = new User();
        $user->username = "admin";
        $user->setPassword("admin");
        $user->email = "admin@admin.com";
        $user->status = User::STATUS_ACTIVE;
        $user->generateAuthKey();
        $user->created_at = round(microtime(true) * 1000);
        $user->updated_at = round(microtime(true) * 1000);

        if ($user->save()) {
            $auth = \Yii::$app->authManager;
            $adminRole = $auth->getRole('admin');
            $auth->assign($adminRole, $user->getId());

            echo "Admin has been created\n";
        } else {
            echo "Failed to create Admin\n";
        }

        // Author
        $user = new User();
        $user->username = "author";
        $user->setPassword("author");
        $user->email = "author@author.com";
        $user->status = User::STATUS_ACTIVE;
        $user->generateAuthKey();
        $user->created_at = round(microtime(true) * 1000);
        $user->updated_at = round(microtime(true) * 1000);

        if ($user->save()) {
            $auth = \Yii::$app->authManager;
            $authorRole = $auth->getRole('author');
            $auth->assign($authorRole, $user->getId());

            echo "Author has been created";
        } else {
            echo "Failed to create Author";
        }
    }
}