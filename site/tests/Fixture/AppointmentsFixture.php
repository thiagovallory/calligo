<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AppointmentsFixture
 */
class AppointmentsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'therapist_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'patient_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'schedule_setting_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => true, 'default' => null, 'comment' => ''],
        'modified' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => true, 'default' => null, 'comment' => ''],
        '_indexes' => [
            'fk_appointments_users1_idx' => ['type' => 'index', 'columns' => ['therapist_id'], 'length' => []],
            'fk_appointments_users2_idx' => ['type' => 'index', 'columns' => ['patient_id'], 'length' => []],
            'fk_appointments_schedule_settings1_idx' => ['type' => 'index', 'columns' => ['schedule_setting_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_appointments_schedule_settings1' => ['type' => 'foreign', 'columns' => ['schedule_setting_id'], 'references' => ['schedule_settings', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_appointments_users1' => ['type' => 'foreign', 'columns' => ['therapist_id'], 'references' => ['users', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_appointments_users2' => ['type' => 'foreign', 'columns' => ['patient_id'], 'references' => ['users', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // phpcs:enable
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'therapist_id' => 1,
                'patient_id' => 1,
                'schedule_setting_id' => 1,
                'created' => '2021-07-02 15:38:21',
                'modified' => '2021-07-02 15:38:21',
            ],
        ];
        parent::init();
    }
}
