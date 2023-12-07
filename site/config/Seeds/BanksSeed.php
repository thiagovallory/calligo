<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Banks seed.
 */
class BanksSeed extends AbstractSeed
{
    public function getDependencies()
    {
        return [
            'UserSeed',
            'FinancialInstitutionsSeed'
        ];
    }

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
        $faker     = Faker\Factory::create('pt_BR');
        $banks_ids = ["1", "3", "4", "21", "33", "37", "41", "47", "70", "77", "82", "84", "85", "93", "97", "99"];
        $data      = [];

        for ($i = 1; $i < 51; $i++) {
            $data[] = [
                'name'                     => $faker->firstName . ' ' . $faker->lastName,
                'document_number'          => ($i % 2 == 0) ? $faker->cpf : $faker->cnpj,
                'agency'                   => $faker->numerify('#####-#'),
                'account'                  => $faker->numerify('######'),
                'type'                     => rand(1, 2),
                'user_id'                  => $i,
                'financial_institution_id' => $banks_ids[rand(0, 15)]
            ];
        }

        $table = $this->table('banks');
        $table->insert($data)->save();
    }
}
