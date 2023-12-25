<?php

namespace app\models\entity;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use app\models\query\RequestQuery;


/**
 * This is the model class for table "{{%request}}".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $status
 * @property string|null $message
 * @property string|null $comment
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Request extends \yii\db\ActiveRecord
{
    CONST STATUS_ACTIVE = 'Active';
    CONST STATUS_RESOLVED = 'Resolved';


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%request}}';
    }

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
    }

    public static function getAllowedStatuses() {
        return [
            self::STATUS_ACTIVE => Yii::t('app', 'Active'),
            self::STATUS_RESOLVED => Yii::t('app', 'Resolved'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            ['status', 'in', 'range' => array_keys(self::getAllowedStatuses())],
            [['message', 'comment'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'email'], 'string', 'max' => 255],
            ['comment',
                'required',
                'when' => function($model) {
                    return $model->status == self::STATUS_RESOLVED;
                },
                'whenClient' => "function (attribute, value) {return $('#request-status').val() == '" . self::STATUS_RESOLVED. "'}"

            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'email' => Yii::t('app', 'Email'),
            'status' => Yii::t('app', 'Status'),
            'message' => Yii::t('app', 'Message'),
            'comment' => Yii::t('app', 'Comment'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return RequestQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RequestQuery(get_called_class());
    }
}
