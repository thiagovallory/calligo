<?php
declare(strict_types=1);

use Cake\Core\Configure;
use Migrations\AbstractSeed;

/**
 * ScheduleSettings seed.
 */
class ScheduleSettingsSeed extends AbstractSeed
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
        $days  = Configure::read('DAYS_NAME');
        $hours = ['08:50', '09:10', '10:22', '11:46', '14:16', '15:23', '16:08', '17:00'];

        $data = [];
        for ($i = 1; $i <= 50; $i++) {
            for ($j = 0; $j < 8; $j++) {
                for ($k = 0; $k < 7; $k++) {
                    $data[] = [
                        'day_name'   => $days[$k],
                        'day_index'  => $k,
                        'hour_start' => $hours[$j],
                        'user_id'    => $i
                    ];
                }
            }
        }

        $table = $this->table('schedule_settings');
        $table->insert($data)->save();
    }
}
