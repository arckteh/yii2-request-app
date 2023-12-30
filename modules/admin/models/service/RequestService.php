<?php
namespace app\modules\admin\models\service;

use Yii;
use yii\base\Model;
use yii\base\Exception;
use app\models\entity\Request;



/**
 * Create user form
 */
class RequestService extends Model
{
    /**
     * @var \app\models\entity\Request
     */
    protected $request = null;

    protected $currentStatus = false;


    public function iniByRequestId($id)
    {
        $this->request= Request::findOne(['id' => $id]);
        if ($this->request) {
            $this->currentStatus = $this->request->status;
            return true;
        }
    }

    public function isRequestResolved()
    {
        return $this->currentStatus == Request::STATUS_ACTIVE && $this->request->status == Request::STATUS_RESOLVED;
    }

    public  function update($data)
    {
        if ($this->request->load($data) && $this->request->save()) {
            if ($this->isRequestResolved()) {
                Yii::$app->mailer->compose('requestResolved', ['request' => $this->request])
                    ->setSubject(Yii::t('app', 'Your request has been resolved"'))
                    ->setTo($this->request->email)
                    ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
                    ->setTextBody(Yii::t('app', 'Your request has been resolved : {comment}"',
                        ['comment' => $this->request->comment]))
                    ->send();

            }

            return true;
        }

        return false;
    }

    public function getReequest()
    {
        return $this->request;
    }

    public function getRequestId()
    {
        return $this->request ? $this->request->id : false;
    }
}