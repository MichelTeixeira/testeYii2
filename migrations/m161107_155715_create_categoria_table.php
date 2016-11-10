<?php

use yii\db\Migration;

/**
 * Handles the creation of table `categoria`.
 */
class m161107_155715_create_categoria_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('categoria'
                        , [
                            'id' => $this->primaryKey(),
                            'nome' => $this->string()->notNull(),
                        ]
                        , 'ENGINE=InnoDB'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('categoria');
    }
}
