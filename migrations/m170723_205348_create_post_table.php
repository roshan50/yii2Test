<?php

use yii\db\Migration;
use app\models\User;

/**
 * Handles the creation of table `post`.
 */
class m170723_205348_create_post_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('post', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'title' => $this->string(30),
            'context' => $this->text(),
        ]);

        $this->createIndex(
            'idx-post-user_id',
            'post',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-post-user_id',
            'post',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );


        $seeder = new \tebazil\yii2seeder\Seeder();
        $generator = $seeder->getGeneratorConfigurator();
        $faker = $generator->getFakerConfigurator();

//        $uids = User::find()->select(['id'])->all();
//        $uid = array_rand($uids);

        $uid = 1;

        $seeder->table('post')->columns([
            'id', //automatic pk
            'user_id'=> $uid,
            'title'=>$faker->firstName,
            'context'=>$faker->text
                ])->rowQuantity(30);

        $seeder->refill();
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `post`
        $this->dropForeignKey(
            'fk-post-user_id',
            'post'
        );

        // drops index for column `post_id`
        $this->dropIndex(
            'idx-post-user_id',
            'post'
        );
        $this->dropTable('post');
    }
}
