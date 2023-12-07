<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProblemsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProblemsTable Test Case
 */
class ProblemsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProblemsTable
     */
    protected $Problems;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Problems',
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
        $config = $this->getTableLocator()->exists('Problems') ? [] : ['className' => ProblemsTable::class];
        $this->Problems = $this->getTableLocator()->get('Problems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Problems);

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
