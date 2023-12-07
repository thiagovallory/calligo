<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Costs seed.
 */
class CostsSeed extends AbstractSeed
{
    public function getDependencies()
    {
        return [
            'UserSeed',
            'ModalitiesSeed',
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
        $data = [];

        for ($i = 1; $i <= 50; $i++) {
            $data[] = [
                'user_id'          => $i,
                'modality_id'      => rand(1, 2),
                'value_full'       => $faker->randomElement([100.00, 150.00, 200.00, 250.00, 300.00]),
                'value_additional' => '25',
                'created'          => date('Y-m-d H:i:s'),
                'modified'         => date('Y-m-d H:i:s')
            ];
            $data[] = [
                'user_id'          => $i,
                'modality_id'      => rand(3, 4),
                'value_full'       => $faker->randomElement([100.00, 150.00, 200.00, 250.00, 300.00]),
                'value_additional' => '25',
                'created'          => date('Y-m-d H:i:s'),
                'modified'         => date('Y-m-d H:i:s')
            ];
            $data[] = [
                'user_id'          => $i,
                'modality_id'      => rand(5, 6),
                'value_full'       => $faker->randomElement([100.00, 150.00, 200.00, 250.00, 300.00]),
                'value_additional' => '25',
                'created'          => date('Y-m-d H:i:s'),
                'modified'         => date('Y-m-d H:i:s')
            ];
        }

        $table = $this->table('costs');
        $table->insert($data)->save();
    }
}
