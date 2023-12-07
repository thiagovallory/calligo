<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CharacteristicsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CharacteristicsTable Test Case
 */
class CharacteristicsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CharacteristicsTable
     */
    protected $Characteristics;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Characteristics',
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
        $config = $this->getTableLocator()->exists('Characteristics') ? [] : ['className' => CharacteristicsTable::class];
        $this->Characteristics = $this->getTableLocator()->get('Characteristics', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Characteristics);

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
