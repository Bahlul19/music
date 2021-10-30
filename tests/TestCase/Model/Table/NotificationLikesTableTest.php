<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NotificationLikesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NotificationLikesTable Test Case
 */
class NotificationLikesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\NotificationLikesTable
     */
    public $NotificationLikes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.NotificationLikes',
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
        $config = TableRegistry::getTableLocator()->exists('NotificationLikes') ? [] : ['className' => NotificationLikesTable::class];
        $this->NotificationLikes = TableRegistry::getTableLocator()->get('NotificationLikes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->NotificationLikes);

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
