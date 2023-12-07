<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AgesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AgesTable Test Case
 */
class AgesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AgesTable
     */
    protected $Ages;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Ages',
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
        $config = $this->getTableLocator()->exists('Ages') ? [] : ['className' => AgesTable::class];
        $this->Ages = $this->getTableLocator()->get('Ages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Ages);

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
