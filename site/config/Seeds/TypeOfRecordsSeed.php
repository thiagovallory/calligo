<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * TypeOfDocuments seed.
 */
class TypeOfRecordsSeed extends AbstractSeed
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
                'name' => 'Contrato'
            ],
            [
                'id'   => 2,
                'name' => 'Escala'
            ],
            [
                'id'   => 3,
                'name' => 'Atestado'
            ]
        ];

        $table = $this->table('type_of_records');
        $table->insert($data)->save();
    }
}
