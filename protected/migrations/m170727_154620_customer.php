<?php

class m170727_154620_customer extends CDbMigration
{
	public function up()
	{
	   $this->createTable('customer', array(
            'id' => 'pk',
            'first_name' => 'string NOT NULL',
          
        ));
    }
 
    public function down()
    {
        $this->dropTable('customer');
    }

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}