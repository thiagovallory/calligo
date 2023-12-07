<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Profile seed.
 */
class ProfileSeed extends AbstractSeed
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
        for ($i = 0; $i < 100; $i++) {
            $data[] = [
                'user_id'                  => $i + 1,
                'title_id'                 => rand(1, 5),
                'birth_date'               => $faker->date('Y-m-d'),
                'gender'                   => rand(1, 2),
                'pronoun'                  => rand(1, 2),
                'document_number'          => $faker->cpf,
                'telephone_number'         => $faker->cellphoneNumber,
                'active'                   => 1,
                'created'                  => date('Y-m-d H:i:s'),
                'modified'                 => date('Y-m-d H:i:s'),
                'crp'                      => $faker->numerify('#######'),
                'crp_expiration'           => $faker->date('Y-m-d'),
                'crp_origin'               => rand(1, 3),
                'epsi'                     => $faker->numerify('#######'),
                'epsi_expiration'          => $faker->date('Y-m-d'),
                'epsi_origin'              => rand(1, 3),
                'description'              => $faker->realText(1500),
                'default_language'         => rand(1, 13),
                'default_time_zone'        => 1,
                'time_work_experience'     => rand(1, 10),
                'attendance_by_phone_call' => 1,
                'attendance_by_video_call' => rand(0, 1),
                'session_duration'         => '50',
                'session_break'            => '10',
                'completed_profile'        => 1,
                'photo_url'                => '1665602992634715b0a64d1.png',
                'video_url'                => 'https://www.youtube.com/watch?v=GykgZblsL7o',
                'video_name'               => 'apresentação'
            ];
        }

        $table = $this->table('profiles');
        $table->insert($data)->save();
    }
}
