<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ScheduleSettingsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ScheduleSettingsTable Test Case
 */
class ScheduleSettingsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ScheduleSettingsTable
     */
    protected $ScheduleSettings;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.ScheduleSettings',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ScheduleSettings') ? [] : ['className' => ScheduleSettingsTable::class];
        $this->ScheduleSettings = $this->getTableLocator()->get('ScheduleSettings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->ScheduleSettings);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
