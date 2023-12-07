<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Characteristics seed.
 */
class CharacteristicsSeed extends AbstractSeed
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
                'name' => 'Passa Atividades',
            ],
            [
                'id'   => 2,
                'name' => 'Escuto mais do que falo'
            ],
            [
                'id'   => 3,
                'name' => 'Interage a todo momento',
            ],
            [
                'id'   => 4,
                'name' => 'Tem mais confronto'
            ],
            [
                'id'   => 5,
                'name' => 'Mais séria/o',
            ],
            [
                'id'   => 6,
                'name' => 'Mais descontraído'
            ],
            [
                'id'   => 7,
                'name' => 'Honestidade Aberta'
            ],
            [
                'id'   => 8,
                'name' => 'Honestidade com gentileza'
            ],
            [
                'id'   => 9,
                'name' => 'Trabalha com solução de problemas'
            ],
            [
                'id'   => 10,
                'name' => 'Cria planos de sessão'
            ]
        ];

        $table = $this->table('characteristics');
        $table->insert($data)->save();
    }
}
