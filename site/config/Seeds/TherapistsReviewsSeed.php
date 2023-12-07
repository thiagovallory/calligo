<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * TherapistsReviews seed.
 */
class TherapistsReviewsSeed extends AbstractSeed
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

        for ($i = 1; $i <= 51; $i++) {
            for ($j = 0; $j < 100; $j++) {
                $data[] = [
                    'reviwer_id'   => rand(51, 100),
                    'therapist_id' => $i,
                    'title'        => $faker->text(20),
                    'description'  => $faker->realText(255),
                ];
            }
        }

        $table = $this->table('therapists_reviews');
        $table->insert($data)->save();
    }
}
