<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * EmergencyContacts seed.
 */
class EmergencyContactsSeed extends AbstractSeed
{
    public function getDependencies()
    {
        return [
            'UserSeed',
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
        $faker = Faker\Factory::create('pt_BR');
        $data  = [];

        for ($i = 1; $i <= 100; $i++) {
            $data[] = [
                'name'             => $faker->firstName . ' ' . $faker->lastName,
                'telephone_number' => $faker->cellphoneNumber,
                'email'            => $faker->email,
                'created'          => date('Y-m-d H:i:s'),
                'modified'         => date('Y-m-d H:i:s'),
                'user_id'          => $i,
                'gender'           => rand(1, 2),
                'pronoun'          => rand(1, 2)
            ];
        }

        $table = $this->table('emergency_contacts');
        $table->insert($data)->save();
    }
}
