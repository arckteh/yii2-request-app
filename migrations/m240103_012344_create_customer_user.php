<?php

use Yii;
use yii\db\Migration;
use yii\console\{Controller, ExitCode};
use yii\helpers\{Console, ArrayHelper};
use app\models\entity\User;

/**
 * Class m240103_012344_create_customer_user
 */
class m240103_012344_create_customer_user extends Migration
{
    const CUSTOMER_NAME = 'Customer';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        if (User::findByUsername(self::CUSTOMER_NAME)) {
            return;
        }
        $user = new User();
        $user->username = self::CUSTOMER_NAME;
        $user->email = 'customer@example.com';
        $user->setPassword('customer_pwd');
        $user->status = User::STATUS_ACTIVE;
        $user->access_token = 'token_customer';
        $user->save(false);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        try {
            $user = User::findByUsername(self::CUSTOMER_NAME);
            $user->delete();
        } catch (Exception $e) {
            return false;
        }
    }
    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240103_012344_create_customer_user cannot be reverted.\n";

        return false;
    }
    */
}
