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
        $sql = <<<SQL
CREATE TABLE `car` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `brand` VARCHAR(100) NOT NULL,
  `model` VARCHAR(100) NOT NULL,
  `issueYear` DATE NOT NULL,
  `equipment` VARCHAR(45) NOT NULL,
  `technicalSpecifications` JSON NOT NULL,
  PRIMARY KEY (`id`));

ALTER TABLE `car` 
ADD COLUMN `status` ENUM('instock', 'sold', 'waitingDelivery') NOT NULL DEFAULT 'instock' AFTER `technicalSpecifications`;
SQL;
        $this->execute($sql);
    }
}
