<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NotificationRatingsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NotificationRatingsTable Test Case
 */
class NotificationRatingsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\NotificationRatingsTable
     */
    public $NotificationRatings;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.NotificationRatings',
        'app.Media',
        'app.Users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('NotificationRatings') ? [] : ['className' => NotificationRatingsTable::class];
        $this->NotificationRatings = TableRegistry::getTableLocator()->get('NotificationRatings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->NotificationRatings);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
