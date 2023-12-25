<?php

namespace app\controllers;

use Yii;
use app\models\form\RequestForm;
use yii\web\Controller;


/**
 * RequestController implements the CRUD actions for Request model.
 */
class PostRequestController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    /**
     * Creates a new Request model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionIndex()
    {
        $model = new RequestForm();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('requestFormSubmitted');

                return $this->refresh();
            }
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

}
