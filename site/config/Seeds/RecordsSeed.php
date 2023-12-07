<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Recordsa seed.
 */
class RecordsSeed extends AbstractSeed
{
    public function getDependencies()
    {
        return [
            'TypeOfRecordsSeed',
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
        for ($i = 0; $i < 50; $i++) {
            for ($j = 0; $j < 15; $j++) {
                $data[] = [
                    'name'              => $faker->text(255),
                    'description'       => $faker->realText(1500),
                    'private'           => rand(0, 1),
                    'type_of_record_id' => rand(1, 3),
                    'owner_id'          => $i + 1,
                    'patient_id'        => $i + 51,
                    'created'           => $faker->dateTimeBetween('-11 months', 'now')->format('Y-m-d'),
                    'modified'          => $faker->dateTimeBetween('-11 months', 'now')->format('Y-m-d'),
                ];
            }
        }
        for ($i = 51; $i < 100; $i++) {
            for ($j = 0; $j < 15; $j++) {
                $data[] = [
                    'name'              => $faker->text(255),
                    'description'       => $faker->realText(1500),
                    'private'           => 0,
                    'type_of_record_id' => rand(1, 3),
                    'owner_id'          => $i + 1,
                    'patient_id'        => $i + 1,
                    'created'           => $faker->dateTimeBetween('-11 months', 'now')->format('Y-m-d'),
                    'modified'          => $faker->dateTimeBetween('-11 months', 'now')->format('Y-m-d'),
                ];
            }
        }

        $table = $this->table('records');
        $table->insert($data)->save();
    }
}
