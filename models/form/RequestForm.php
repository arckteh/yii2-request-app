<?php
namespace app\models\form;

use Yii;
use yii\base\Model;
use yii\base\Exception;
use app\models\entity\Request;


/**
 * Create user form
 */
class RequestForm extends Model
{
    public $name;
    public $email;
    public $message;
    public $verifyCode;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'message'], 'required'],
            [['message'], 'string'],
            [['name'], 'string', 'max' => 256],
            [['email'], 'string', 'max' => 256],
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            //['verifyCode', 'captcha'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Name'),
            'email' => Yii::t('app', 'Email'),
            'message' => Yii::t('app', 'Message'),
        ];
    }

    /**
     * Creates space
     * @return null|bool the saved model or null if saving fails
     * @throws Exception
     */
    public function save()
    {
        if ($this->validate()) {

            try {
                $model = new Request();
                $model->load( $this->getAttributes());

                if (!$model->save()) {
                    throw new Exception(Yii::t('app', 'Model not saved'));
                }

                return true;
            } catch (\Exception $e) {
                Yii::$app->errorHandler->logException($e);
            }
        }

        return false;
    }

}
