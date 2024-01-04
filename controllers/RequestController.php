<?php

namespace app\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;
use yii\web\ForbiddenHttpException;
use yii\filters\auth\CompositeAuth;
use app\models\search\RequestSearch;

/**
 * RequestController implements the CRUD actions for Request model.
 */
class RequestController extends ActiveController
{
    public $modelClass = 'app\models\entity\Request';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::class,
            'authMethods' => [
                HttpBearerAuth::class
            ],
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
            'modelClass' => 'app\models\entity\Request',
            'checkAccess' => false,
            'scenario' => $this->createScenario,
        ];

        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;

        $actions['index']['dataFilter'] = [
            'class' => \yii\data\ActiveDataFilter::class,
            'searchModel' => 'app\models\search\RequestSearch'
        ];

        return $actions;
    }

    public function prepareDataProvider() {
        $searchModel = new RequestSearch();
        $params[$searchModel->formName()] = Yii::$app->getRequest()->getQueryParams();
        $dataProvider = $searchModel->search($params);

        return $dataProvider;
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