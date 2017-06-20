<?php

use yii\db\Schema;
use yii\db\Migration;

class m170610_133805_admin extends Migration
{
    public function up()
    {
        $this->createTable('admin', [
            'id' => $this->primaryKey(),
            'username' => $this->string(100)->notNull(),
            'email' => $this->string(255)->notNull(),
            'description' => $this->string(255),
            'auth_key' => $this->string(100)->notNull(),
            'password_hash' => $this->string(100)->notNull(),
            'access_token' => $this->string(100)->notNull(),
            'password_reset_token' => $this->string(100),
            'status' => "ENUM('active', 'inactive', 'expire', 'ban', 'block') NOT NULL DEFAULT 'active'",
            'role' => "ENUM('admin', 'editor', 'author', 'contributor') NOT NULL DEFAULT 'admin'",
            'created_at' => Schema::TYPE_TIMESTAMP . ' NOT NULL DEFAULT CURRENT_TIMESTAMP',
        ]);

        $this->insert('admin', array(
                'username' => 'admin',
                'email' => 'zartashzulfiqar@gmail.com',
                'auth_key' => Yii::$app->security->generateRandomString(),
                'password_hash' => Yii::$app->security->generatePasswordHash('admin'),
                'access_token' => Yii::$app->security->generateRandomString() . time(),
                'password_reset_token' => '',
                'status' => 'active',
                'role' => 'admin',
            )
        );
    }

    public function down()
    {
        $this->dropTable('admin');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
