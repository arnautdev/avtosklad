<?php

use Phinx\Migration\AbstractMigration;

class CreateCarStoreTable extends AbstractMigration
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
        $this->table('car_stores')
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('deleted_at', 'datetime', ['null' => true])
            ->addColumn('carId', 'integer', ['null' => false])
            ->addColumn('availableCount', 'integer', ['null' => false])
            ->addColumn('status', 'enum', ['null' => false, 'values' => ['instock', 'sold', 'waitingDelivery'], 'default' => 'instock'])
            ->addForeignKey('carId', 'cars', 'id')
            ->create();
    }

    public function down()
    {
        $this->table('carStore')->drop();
    }
}
