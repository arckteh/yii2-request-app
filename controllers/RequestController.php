<?php

namespace app\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;
use yii\web\ForbiddenHttpException;

/**
 * RequestController implements the CRUD actions for Request model.
 */
class RequestController extends ActiveController
{
    public $modelClass = 'app\models\entity\Request';


    public function behaviors()
    {
        $behaviors = parent::behaviors();
        return $behaviors;

        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
        ];
        return $behaviors;
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        $actions = parent::actions();

        $actions['create'] = [
            'class' => 'yii\rest\CreateAction',
            'modelClass' => 'app\models\form\RequestForm',
            'checkAccess' => false,
            'scenario' => $this->createScenario,
        ];
        return $actions;
    }


    /**
     * {@inheritdoc}
     */
    public function checkAccess($action, $model = null, $params = [])
    {
        if (!Yii::$app->user->can('Admin')) {
            throw new ForbiddenHttpException(Yii::t('app', 'Access Denied'));
        }

    }

}