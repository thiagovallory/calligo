<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * ComplaintItems seed.
 */
class ComplaintItemsSeed extends AbstractSeed
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
                "id"   => "1",
                "role" => "2",
                "name" => "Comportamento agressivo do meu paciente",
                "description" => "Comportamento agressivo do meu paciente",
            ],
            [
                "id"   => "2",
                "role" => "2",
                "name" => "Comportamento obsceno do meu paciente",
                "description" => "Comportamento obsceno do meu paciente",
            ],
            [
                "id"   => "3",
                "role" => "2",
                "name" => "Paciente está stalking (perseguindo) a/o psicóloga/o",
                "description" => "Paciente está stalking (perseguindo) a/o psicóloga/o",
            ],
            [
                "id"   => "4",
                "role" => "2",
                "name" => "Paciente ameaçando de violência física/sexual a/o psicóloga/o",
                "description" => "Paciente ameaçando de violência física/sexual a/o psicóloga/o",
            ],
            [
                "id"   => "5",
                "role" => "2",
                "name" => "Outros motivos",
                "description" => "Outros motivos",
            ],
            [
                "id"   => "6",
                "role" => "1",
                "name" => "Atraso do psicólogo",
                "description" => "Atraso do psicólogo",
            ],
            [
                "id"   => "7",
                "role" => "1",
                "name" => "Cancelado do meu psicólogo",
                "description" => "Cancelado do meu psicólogo",
            ],
            [
                "id"   => "8",
                "role" => "1",
                "name" => "Fraude de pagamento",
                "description" => "Fraude de pagamento",
            ],
            [
                "id"   => "9",
                "role" => "1",
                "name" => "Comportamento do meu psicólogo",
                "description" => "Comportamento do meu psicólogo",
            ],
            [
                "id"   => "10",
                "role" => "1",
                "name" => "Falta de privacidade do lado do psicólogo",
                "description" => "Falta de privacidade do lado do psicólogo",
            ],
        ];

        $table = $this->table('complaint_items');
        $table->insert($data)->save();
    }
}
