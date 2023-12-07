<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AcademicBackgroundsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AcademicBackgroundsTable Test Case
 */
class AcademicBackgroundsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AcademicBackgroundsTable
     */
    protected $AcademicBackgrounds;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.AcademicBackgrounds',
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
        $config = $this->getTableLocator()->exists('AcademicBackgrounds') ? [] : ['className' => AcademicBackgroundsTable::class];
        $this->AcademicBackgrounds = $this->getTableLocator()->get('AcademicBackgrounds', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->AcademicBackgrounds);

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
