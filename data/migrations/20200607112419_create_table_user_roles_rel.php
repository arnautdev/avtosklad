<?php

use Phinx\Migration\AbstractMigration;

class CreateTableUserRolesRel extends AbstractMigration
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
        $this->table('user_roles_rel')
            ->addColumn('created', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('modified', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('isDeleted', 'enum', ['null' => false, 'default' => 'no', 'values' => ['yes', 'no']])
            ->addColumn('userId', 'integer', ['null' => false])
            ->addColumn('roleId', 'integer', ['null' => false])
            ->addColumn('isActive', 'enum', ['null' => false, 'default' => 'yes', 'values' => ['yes', 'no']])
            ->addForeignKey('userId','users','id')
            ->addForeignKey('roleId','user_roles','id')
            ->create();
    }
}
