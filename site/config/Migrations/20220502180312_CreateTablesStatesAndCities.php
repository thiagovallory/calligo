<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateTablesStatesAndCities extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $this->table('states')
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => false,
            ])
            ->create();

        $this->table('cities')
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => false,
            ])
            ->addColumn('state_id', 'integer', [
                'default' => null,
                'null' => false,
            ])
            ->addIndex([
                'state_id'
            ])
            ->create();
    }
}
