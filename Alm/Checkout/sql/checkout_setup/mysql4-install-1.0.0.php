<?php
$installer = $this;

$installer->startSetup();

$installer->run("
		alter table sales_flat_quote 
		ADD COLUMN `ship_flag` SMALLINT(6) NOT NULL,
		ADD COLUMN `ship_price` float NOT NULL");
$installer->endSetup();