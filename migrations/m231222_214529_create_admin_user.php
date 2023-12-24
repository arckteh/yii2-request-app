<?php

use Yii;
use yii\db\Migration;
use yii\console\{Controller, ExitCode};
use yii\helpers\{Console, ArrayHelper};
use app\models\entity\User;

/**
 * Class m231222_214529_create_admin_user
 */
class m231222_214529_create_admin_user extends Migration
{
    const ADMIN_NAME = 'Admin';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        if (User::findByUsername(self::ADMIN_NAME)) {
            return;
        }
        $user = new User();
        $user->username = self::ADMIN_NAME;
        $user->email = 'admin@example.com';
        $user->setPassword('admin_pwd');
        $user->role_name = User::ROLE_ADMIN;
        $user->status = User::STATUS_ACTIVE;
        $user->save(false);

        $auth = Yii::$app->authManager;
        $role = $auth->createRole($user->role_name);
        $role->description = Yii::t('app', 'Admin area access');
        $auth->add($role);
        $auth->assign($role, $user->id);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        try {
            $user = User::findByUsername(self::ADMIN_NAME);
            $user->delete();

            $role = Yii::$app->authManager->getRole(User::ROLE_ADMIN);
            Yii::$app->authManager->remove($role);
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
        echo "m231222_214529_create_admin_user cannot be reverted.\n";

        return false;
    }
    */
}
