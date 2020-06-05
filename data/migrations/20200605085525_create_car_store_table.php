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
        $sql = <<<SQL
CREATE TABLE `carStore` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `carId` INT(10) NOT NULL,
  `availableCount` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_carStore_1`
    FOREIGN KEY (`carId`)
    REFERENCES `car` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);
SQL;
        $this->execute($sql);
    }
}
