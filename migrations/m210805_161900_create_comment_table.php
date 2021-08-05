<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comment}}`.
 */
class m210805_161900_create_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comment}}', [
            'id' => $this->primaryKey(),
            'text' => $this->string()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'article_id' => $this->integer()->notNull(),
            'status' => $this->integer()->defaultValue(0),
        ]);

        $this->createIndex(
            'idx-comment-user_id',
            'comment',
            'user_id'
        );

        $this->addForeignKey(
            'fk-comment-user_id',
            'comment',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-comment-article_id',
            'comment',
            'article_id'
        );

        $this->addForeignKey(
            'fk-comment-article_id',
            'comment',
            'article_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-comment-user_id',
            'comment'
        );

        $this->dropIndex(
            'idx-comment-user_id',
            'comment'
        );

        $this->dropForeignKey(
            'fk-comment-article_id',
            'comment'
        );

        $this->dropIndex(
            'idx-comment-article_id',
            'comment'
        );

        $this->dropTable('{{%comment}}');
    }
}
