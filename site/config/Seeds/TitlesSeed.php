<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Problems seed.
 */
class TitlesSeed extends AbstractSeed
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
                'name' => 'Dr'
            ],
            [
                'id'   => 2,
                'name' => 'Mestre'
            ],
            [
                'id'   => 3,
                'name' => 'Reverendo'
            ],
            [
                'id'   => 4,
                'name' => 'Senhor'
            ],
            [
                'id'   => 5,
                'name' => 'Senhora'
            ]
        ];

        $table = $this->table('titles');
        $table->insert($data)->save();
    }
}
