<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ComplaintItemsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ComplaintItemsTable Test Case
 */
class ComplaintItemsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ComplaintItemsTable
     */
    protected $ComplaintItems;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.ComplaintItems',
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
        $config = $this->getTableLocator()->exists('ComplaintItems') ? [] : ['className' => ComplaintItemsTable::class];
        $this->ComplaintItems = $this->getTableLocator()->get('ComplaintItems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->ComplaintItems);

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
}
