<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AlterTableCards extends AbstractMigration
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
        $this->table('cards')
            ->addColumn('address', 'string', [
                'after' => 'active',
                'default' => null,
                'null' => true,
                'limit' => 100
            ])
            ->addColumn('address_number', 'string', [
                'after' => 'address',
                'default' => null,
                'null' => true,
                'limit' => 10
            ])
            ->addColumn('complement', 'string', [
                'after' => 'address_number',
                'default' => null,
                'null' => true,
                'limit' => 45
            ])
            ->addColumn('neighborhood', 'string', [
                'after' => 'complement',
                'default' => null,
                'null' => true,
                'limit' => 100
            ])
            ->addColumn('zip_code', 'string', [
                'after' => 'neighborhood',
                'default' => null,
                'null' => true,
                'limit' => 9
            ])
            ->addColumn('city_id', 'integer', [
                'after' => 'zip_code',
                'default' => null,
                'null' => true,
                'limit' => 9
            ])
            ->addColumn('state_id', 'integer', [
                'after' => 'city_id',
                'default' => null,
                'null' => true,
                'limit' => 9
            ])
            ->addColumn('phone', 'string', [
                'after' => 'state_id',
                'default' => null,
                'null' => true,
                'limit' => 13
            ])
            ->addColumn('emergency_phone', 'string', [
                'after' => 'phone',
                'default' => null,
                'null' => true,
                'limit' => 13
            ])
            ->update();
    }
}
