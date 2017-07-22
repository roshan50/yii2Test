<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post`.
 */
class m170721_205348_create_post_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('post', [
            'id' => $this->primaryKey(),
            'title' => $this->string(30),
            'context' => $this->text(),
        ]);

        $seeder = new \tebazil\yii2seeder\Seeder();
        $generator = $seeder->getGeneratorConfigurator();
        $faker = $generator->getFakerConfigurator();

        $seeder->table('post')->columns([
            'id', //automatic pk
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
        $this->dropTable('post');
    }
}
