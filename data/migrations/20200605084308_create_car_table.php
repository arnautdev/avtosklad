<?php

use Phinx\Migration\AbstractMigration;

class CreateCarTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $this->table('cars')
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('deleted_at', 'datetime')
            ->addColumn('brand', 'string', ['limit' => 500, 'null' => false])
            ->addColumn('model', 'string', ['limit' => 500, 'null' => false])
            ->addColumn('issueYear', 'date', ['null' => false])
            ->addColumn('equipment', 'text', ['null' => false])
            ->addColumn('technicalSpecifications', 'text', ['null' => false])
            ->addColumn('status', 'enum', ['null' => false, 'values' => ['instock', 'sold', 'waitingDelivery'], 'default' => 'instock'])
            ->addColumn('addedByAdminId', 'integer')
            ->addForeignKey('addedByAdminId', 'users', 'id')
            ->addIndex(['brand', 'model', 'issueYear'])
            ->create();
    }


    public function down()
    {
        $this->table('car')->drop();
    }
}
