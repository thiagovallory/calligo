<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HelpQuestionsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HelpQuestionsTable Test Case
 */
class HelpQuestionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\HelpQuestionsTable
     */
    protected $HelpQuestions;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.HelpQuestions',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config              = $this->getTableLocator()->exists('HelpQuestions') ? [] : ['className' => HelpQuestionsTable::class];
        $this->HelpQuestions = $this->getTableLocator()->get('HelpQuestions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->HelpQuestions);

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
