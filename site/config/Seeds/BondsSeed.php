<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Bonds seed.
 */
class BondsSeed extends AbstractSeed
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
        $faker = Faker\Factory::create();
        $data  = [];
        for ($i = 1; $i < 51; $i++) {
            for ($j = 1; $j < 25; $j++) {
                $data[] = [
                    'therapist_id'          => $i,
                    'patient_id'            => rand(51, 100),
                    'status'                => rand(1, 3),
                    'started_at'            => $faker->dateTimeInInterval('-2 years', '-12 months')->format('Y-m-d'),
                    'ended_at'              => $faker->dateTimeInInterval('-11 months', '-1 months')->format('Y-m-d'),
                    'created'               => date('Y-m-d H:m:i'),
                    'modified'              => date('Y-m-d H:m:i'),
                    'closing_description'   => null,
                    'closing_patient_at_risk'=>null,
                    'closing_file_name'     => null,
                    'closing_file_url'      => null,
                    'closing_file_size'     => null,
                ];
            }
        }

        $table = $this->table('bonds');
        $table->insert($data)->save();
    }
}
