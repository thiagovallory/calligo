<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * States seed.
 */
class StatesSeed extends AbstractSeed
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
                'id'   => 11,
                'name' => "Rondônia"
            ],
            [
                'id'   => 12,
                'name' => "Acre"
            ],
            [
                'id'   => 13,
                'name' => "Amazonas"
            ],
            [
                'id'   => 14,
                'name' => "Roraima"
            ],
            [
                'id'   => 15,
                'name' => "Pará"
            ],
            [
                'id'   => 16,
                'name' => "Amapá"
            ],
            [
                'id'   => 21,
                'name' => "Maranhão"
            ],
            [
                'id'   => 22,
                'name' => "Piauí"
            ],
            [
                'id'   => 23,
                'name' => "Ceará"
            ],
            [
                'id'   => 24,
                'name' => "Rio Grande do Norte"
            ],
            [
                'id'   => 17,
                'name' => "Tocantins"
            ],
            [
                'id'   => 25,
                'name' => "Paraíba"
            ],
            [
                'id'   => 26,
                'name' => "Pernambuco"
            ],
            [
                'id'   => 27,
                'name' => "Alagoas"
            ],
            [
                'id'   => 28,
                'name' => "Sergipe"
            ],
            [
                'id'   => 29,
                'name' => "Bahia"
            ],
            [
                'id'   => 31,
                'name' => "Minas Gerais"
            ],
            [
                'id'   => 32,
                'name' => "Espírito Santo"
            ],
            [
                'id'   => 33,
                'name' => "Rio de Janeiro"
            ],
            [
                'id'   => 35,
                'name' => "São Paulo"
            ],
            [
                'id'   => 41,
                'name' => "Paraná"
            ],
            [
                'id'   => 42,
                'name' => "Santa Catarina"
            ],
            [
                'id'   => 43,
                'name' => "Rio Grande do Sul"
            ],
            [
                'id'   => 50,
                'name' => "Mato Grosso do Sul"
            ],
            [
                'id'   => 51,
                'name' => "Mato Grosso"
            ],
            [
               'id'   => 52,
                'name' => "Goiás"
            ],
            [
                'id' => 53,
                'name' => 'Distrito Federal'
            ]
        ];

        $table = $this->table('states');
        $table->insert($data)->save();
    }
}
