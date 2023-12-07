<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Ages seed.
 */
class AgesSeed extends AbstractSeed
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
                'name' => 'Melhor idade 65+'
            ],
            [
                'id'   => 2,
                'name' => 'Adultos 20+'
            ],
            [
                'id'   => 3,
                'name' => 'Adolescentes 14-19'
            ],
            [
                'id'   => 4,
                'name' => 'Pré-adolescentes 11-13 anos'
            ],
            [
                'id'   => 5,
                'name' => 'Crianças 6-10 anos'
            ],
            [
                'id'   => 6,
                'name' => 'Crianças 0-5'
            ],
            [
                'id'   => 7,
                'name' => 'Individual'
            ],
            [
                'id'   => 8,
                'name' => 'Casal'
            ],
            [
                'id'   => 9,
                'name' => 'Familía'
            ],
            [
                'id'   => 10,
                'name' => 'Grupo'
            ],
            [
                'id'   => 11,
                'name' => 'Terapia de Alcance'
            ],
            [
                'id'   => 12,
                'name' => 'Supervisão Técnica'
            ],
        ];

        $table = $this->table('ages');
        $table->insert($data)->save();
    }
}
