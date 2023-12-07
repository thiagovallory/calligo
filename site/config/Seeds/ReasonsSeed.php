<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Reasons seed.
 */
class ReasonsSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id'   => 1,
                'name' => 'Motivo 1',
            ],
            [
                'id'   => 2,
                'name' => 'Motivo 2',
            ]
        ];

        $table = $this->table('reasons');
        $table->insert($data)->save();
    }
}
