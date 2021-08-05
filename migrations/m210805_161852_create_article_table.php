<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%article}}`.
 */
class m210805_161852_create_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%article}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'description' => $this->string(255),
            'content' => $this->text(),
            'date' => $this->date(),
            'image' => $this->string(255),
            'viewed' => $this->integer(),
            'user_id' => $this->integer(),
            'status' => $this->integer(),
            'category_id' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-article-user_id',
            'article',
            'user_id'
        );

        $this->addForeignKey(
            'fk-article-user_id',
            'article',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-article-category_id',
            'article',
            'category_id'
        );

        $this->addForeignKey(
            'fk-article-category_id',
            'article',
            'category_id',
            'category',
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
            'fk-article-user_id',
            'article'
        );

        $this->dropIndex(
            'idx-article-user_id',
            'article'
        );

        $this->dropForeignKey(
            'fk-article-category_id',
            'article'
        );

        $this->dropIndex(
            'idx-article-category_id',
            'article'
        );

        $this->dropTable('{{%article}}');
    }
}
