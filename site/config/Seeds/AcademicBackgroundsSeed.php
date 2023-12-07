<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * AcademicBackgrounds seed.
 */
class AcademicBackgroundsSeed extends AbstractSeed
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
        $data = [];

        for ($i = 1; $i <= 50; $i++) {
            $data[] = [
                'type'         => 1,
                'class_name'   => 'Psicologia',
                'institution'  => 'USP',
                'period_start' => '2010-01-01',
                'period_end'   => '2015-01-01',
                'status'       => 2,
                'created'      => date('Y-m-d H:i:s'),
                'modified'     => date('Y-m-d H:i:s'),
                'user_id'      => $i
            ];
            $data[] = [
                'type'         => 2,
                'class_name'   => 'Psicologia',
                'institution'  => 'USP',
                'period_start' => '2015-01-01',
                'period_end'   => '2020-01-01',
                'status'       => 2,
                'created'      => date('Y-m-d H:i:s'),
                'modified'     => date('Y-m-d H:i:s'),
                'user_id'      => $i
            ];
        }

        $table = $this->table('academic_backgrounds');
        $table->insert($data)->save();
    }
}
