<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BlockedSchedulesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BlockedSchedulesTable Test Case
 */
class BlockedSchedulesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BlockedSchedulesTable
     */
    protected $BlockedSchedules;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.BlockedSchedules',
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
        $config = $this->getTableLocator()->exists('BlockedSchedules') ? [] : ['className' => BlockedSchedulesTable::class];
        $this->BlockedSchedules = $this->getTableLocator()->get('BlockedSchedules', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->BlockedSchedules);

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
