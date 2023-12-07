<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * SubjectHelps seed.
 */
class SubjectHelpsSeed extends AbstractSeed
{
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
            [
                'id'         => 1,
                'name'       => 'FAQ',
                'icon_class' => 'config-account',
                'created'    => date('Y-m-d H:m:i'),
                'modified'   => date('Y-m-d H:m:i')
            ],
        ];

        $table = $this->table('subject_helps');
        $table->insert($data)->save();
    }
}
