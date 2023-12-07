<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Modalities seed.
 */
class ModalitiesSeed extends AbstractSeed
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
                'name' => 'Individual'
            ],
//            [
//                'id'   => 2,
//                'name' => 'Casal'
//            ],
//            [
//                'id'   => 3,
//                'name' => 'Família'
//            ],
//            [
//                'id'   => 4,
//                'name' => 'Grupo'
//            ],
//            [
//                'id'   => 5,
//                'name' => 'Terapia de Alcance'
//            ],
//            [
//                'id'   => 6,
//                'name' => 'Supervisão Técnica'
//            ],
        ];

        $table = $this->table('modalities');
        $table->insert($data)->save();
    }
}
