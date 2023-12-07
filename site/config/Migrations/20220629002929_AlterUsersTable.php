<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AlterUsersTable extends AbstractMigration
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
        $table = $this->table('users')
            ->addColumn('iugu_customer_id', 'string', [
                'after'   => 'iugu_user_token',
                'default' => null,
                'null'    => true,
                'limit'   => 255
            ]);
        $table->update();
    }
}
