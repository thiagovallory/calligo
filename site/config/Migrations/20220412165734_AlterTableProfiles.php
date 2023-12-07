<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AlterTableProfiles extends AbstractMigration
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
        $this->table('profiles')
            ->addColumn('title_id', 'integer', [
                'after' => 'id',
                'default' => null,
                'null' => true,
            ])
            ->addColumn('crp_expiration', 'date', [
                'after' => 'crp',
                'default' => null,
                'null' => true,
            ])
            ->addColumn('epsi_origin', 'integer', [
                'after' => 'epsi',
                'default' => null,
                'null' => true,
            ])
            ->addColumn('epsi_expiration', 'date', [
                'after' => 'epsi_origin',
                'default' => null,
                'null' => true,
            ])
            ->update();
    }
}
