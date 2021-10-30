<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NotificationCommentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NotificationCommentsTable Test Case
 */
class NotificationCommentsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\NotificationCommentsTable
     */
    public $NotificationComments;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.NotificationComments',
        'app.Notifications',
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
        $config = TableRegistry::getTableLocator()->exists('NotificationComments') ? [] : ['className' => NotificationCommentsTable::class];
        $this->NotificationComments = TableRegistry::getTableLocator()->get('NotificationComments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->NotificationComments);

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
