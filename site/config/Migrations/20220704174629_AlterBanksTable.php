<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AlterBanksTable extends AbstractMigration
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
        $table = $this->table('banks')
            ->addColumn('cep', 'string', [
                'after'   => 'financial_institution_id',
                'default' => null,
                'null'    => true,
                'limit'   => 255
            ])
            ->addColumn('address', 'string', [
                'after'   => 'cep',
                'default' => null,
                'null'    => true,
                'limit'   => 255
            ])
            ->addColumn('city_id', 'integer', [
                'after'   => 'address',
                'default' => null,
                'null'    => true,
            ])
            ->addColumn('state_id', 'integer', [
                'after'   => 'city_id',
                'default' => null,
                'null'    => true,
            ])
            ->addColumn('neighborhood', 'string', [
                'after'   => 'state_id',
                'default' => null,
                'null'    => true,
                'limit'   => 255
            ])
            ->addColumn('telephone', 'string', [
                'after'   => 'neighborhood',
                'default' => null,
                'null'    => true,
                'limit'   => 15
            ]);
        $table->update();
    }
}
