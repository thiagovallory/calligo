<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SubjectHelpsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SubjectHelpsTable Test Case
 */
class SubjectHelpsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SubjectHelpsTable
     */
    protected $SubjectHelps;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.SubjectHelps',
        'app.Helps',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('SubjectHelps') ? [] : ['className' => SubjectHelpsTable::class];
        $this->SubjectHelps = $this->getTableLocator()->get('SubjectHelps', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->SubjectHelps);

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
