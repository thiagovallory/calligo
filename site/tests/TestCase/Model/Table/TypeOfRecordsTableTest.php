<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TypeOfRecordsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TypeOfRecordsTable Test Case
 */
class TypeOfRecordsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TypeOfRecordsTable
     */
    protected $TypeOfRecords;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.TypeOfRecords',
        'app.Records',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('TypeOfRecords') ? [] : ['className' => TypeOfRecordsTable::class];
        $this->TypeOfRecords = $this->getTableLocator()->get('TypeOfRecords', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->TypeOfRecords);

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
