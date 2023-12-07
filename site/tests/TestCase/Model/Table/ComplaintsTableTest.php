<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ComplaintsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ComplaintsTable Test Case
 */
class ComplaintsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ComplaintsTable
     */
    protected $Complaints;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Complaints',
        'app.ComplaintSelecteds',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Complaints') ? [] : ['className' => ComplaintsTable::class];
        $this->Complaints = $this->getTableLocator()->get('Complaints', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Complaints);

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
