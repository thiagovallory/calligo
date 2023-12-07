<?php
declare(strict_types=1);

use Cake\I18n\FrozenDate;
use Migrations\AbstractSeed;

/**
 * Appointments seed.
 */
class AppointmentsSeed extends AbstractSeed
{
    public function getDependencies()
    {
        return [
            'ScheduleSettingsSeed',
            'UserSeed',
            'ModalitiesSeed'
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
        $faker  = Faker\Factory::create();
        $today  = FrozenDate::today();
        $dates  = [
            $today->format('Y-m-d'),
            $today->addDay(1)->format('Y-m-d'),
            $today->addDay(2)->format('Y-m-d'),
            $today->addDay(3)->format('Y-m-d'),
            $today->addDay(4)->format('Y-m-d'),
            $today->addDay(5)->format('Y-m-d'),
            $today->addDay(6)->format('Y-m-d'),
        ];
        $hours  = ['08:50', '09:10', '10:22', '11:46', '14:16', '15:23', '16:08', '17:00'];
        $prices = [100.00, 150.00, 200.00, 250.00, 300.00];

        $data = [];

        for ($i = 0; $i < 1000; $i++) {
            $data[] = [
                'therapist_id'   => rand(1, 50),
                'patient_id'     => rand(51, 100),
                'modality_id'    => rand(1, 5),
                'price'          => $faker->randomElement($prices),
                'day'            => $faker->randomElement($dates),
                'hour'           => $faker->randomElement($hours),
                'mode'           => rand(1, 2),
                'status'         => rand(1, 5),
                'created'        => date('Y-m-d H:m:i'),
                'modified'       => date('Y-m-d H:m:i'),
                'reserved_until' => date('Y-m-d H:m:i')
            ];
        }

        $table = $this->table('appointments');
        $table->insert($data)->save();
    }
}
