<?php

use yii\db\Migration;

/**
 * Handles the creation of table `produto`.
 * Has foreign keys to the tables:
 *
 * - `categoria`
 */
class m161107_161242_create_produto_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('produto'
                        , [
                            'id' => $this->primaryKey(),
                            'categoria_id' => $this->integer()->notNull(),
                            'nome' => $this->string()->notNull(),
                        ]
                        , 'ENGINE=InnoDB'
        );

        // creates index for column `categoria_id`
        $this->createIndex(
            'idx-produto-categoria_id',
            'produto',
            'categoria_id'
        );

        // add foreign key for table `categoria`
        $this->addForeignKey(
            'fk-produto-categoria_id',
            'produto',
            'categoria_id',
            'categoria',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `categoria`
        $this->dropForeignKey(
            'fk-produto-categoria_id',
            'produto'
        );

        // drops index for column `categoria_id`
        $this->dropIndex(
            'idx-produto-categoria_id',
            'produto'
        );

        $this->dropTable('produto');
    }
}
