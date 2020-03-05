<?php

namespace Htmlpet\CheckoutTimetrack\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        $table = $installer->getTable('htmlpet_checkout_timetrack');
        $refTblName = $installer->getTable('sales_order');

        if (!$installer->tableExists($table)) {
            $table = $installer->getConnection()->newTable(
                $table
            )
            ->addColumn('id', \Magento\Framework\Db\Ddl\Table::TYPE_INTEGER, null, [
                'primary' => true,
                'identity' => true,
                'unsigned' => true
            ])
            ->addColumn('order_id', \Magento\Framework\Db\Ddl\Table::TYPE_INTEGER, null, [
                'nullable' => false,
                'unsigned' => true
            ])
            ->addColumn('timetrack', \Magento\Framework\Db\Ddl\Table::TYPE_INTEGER, null, [
                'unsigned' => true,
                'nullable' => false
            ])->addIndex(
                $installer->getConnection()->getIndexName($table, ['order_id']), 
                ['order_id']
            )->addForeignKey(
                $installer->getConnection()->getForeignKeyName($table, 'order_id', $refTblName, 'entity_id'),
                'order_id',
                $refTblName,
                'entity_id',
                \Magento\Framework\Db\Ddl\Table::ACTION_CASCADE
            );

            $installer->getConnection()->createTable($table);
        }

        $installer->endSetup();
    }
}