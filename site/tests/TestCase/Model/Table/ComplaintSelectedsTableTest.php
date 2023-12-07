<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ComplaintSelectedsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ComplaintSelectedsTable Test Case
 */
class ComplaintSelectedsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ComplaintSelectedsTable
     */
    protected $ComplaintSelecteds;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.ComplaintSelecteds',
        'app.Complaints',
        'app.ComplaintItems',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ComplaintSelecteds') ? [] : ['className' => ComplaintSelectedsTable::class];
        $this->ComplaintSelecteds = $this->getTableLocator()->get('ComplaintSelecteds', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->ComplaintSelecteds);

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
