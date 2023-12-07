<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\UsersController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\UsersController Test Case
 *
 * @uses \App\Controller\UsersController
 */
class UsersControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Users',
        'app.AcademicBackgrounds',
        'app.Notifications',
        'app.PaymentMethods',
        'app.Products',
        'app.Profiles',
        'app.Reviews',
        'app.TypeOfServices',
        'app.Ages',
        'app.Characteristics',
        'app.Langs',
        'app.Modalities',
        'app.Problems',
        'app.Specialties',
        'app.Therapies',
        'app.Banks',
        'app.EmergencyContacts',
        'app.AgesUsers',
        'app.CharacteristicsUsers',
        'app.LangsUsers',
        'app.ModalitiesHasUsers',
        'app.ProblemsUsers',
        'app.SpecialtiesUsers',
        'app.TherapiesUsers',
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
