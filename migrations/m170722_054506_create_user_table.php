<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m170722_054506_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string(30),
            'password' => $this->string(30),
            'authKey' => $this->string(100),
            'accessToken' => $this->string(100),
        ]);

        $seeder = new \tebazil\yii2seeder\Seeder();
        $generator = $seeder->getGeneratorConfigurator();
        $faker = $generator->getFakerConfigurator();

        $seeder->table('user')->columns([
            'id', //automatic pk
            'username'=>$faker->firstName,
            'password'=>$faker->firstName,
//            'password'=>Yii::$app->getSecurity()->generatePasswordHash('password'),
            'authKey'=>Yii::$app->getSecurity()->generateRandomString(),
            'accessToken'=>Yii::$app->getSecurity()->generateRandomString()
                ])->rowQuantity(3);

        $seeder->refill();
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
