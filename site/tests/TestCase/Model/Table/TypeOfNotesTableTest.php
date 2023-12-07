<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TypeOfNotesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TypeOfNotesTable Test Case
 */
class TypeOfNotesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TypeOfNotesTable
     */
    protected $TypeOfNotes;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.TypeOfNotes',
        'app.Notes',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('TypeOfNotes') ? [] : ['className' => TypeOfNotesTable::class];
        $this->TypeOfNotes = $this->getTableLocator()->get('TypeOfNotes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->TypeOfNotes);

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
