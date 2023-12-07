<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReasonsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReasonsTable Test Case
 */
class ReasonsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ReasonsTable
     */
    protected $Reasons;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Reasons',
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
        $config = $this->getTableLocator()->exists('Reasons') ? [] : ['className' => ReasonsTable::class];
        $this->Reasons = $this->getTableLocator()->get('Reasons', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Reasons);

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
