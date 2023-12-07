<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Notes seed.
 */
class NotesSeed extends AbstractSeed
{
    public function getDependencies()
    {
        return [
            'CharacteristicsSeed',
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
        $data = [
            // TODO
        ];

        $table = $this->table('notes');
        $table->insert($data)->save();
    }
}
