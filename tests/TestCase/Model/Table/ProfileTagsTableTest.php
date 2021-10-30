<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProfileTagsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProfileTagsTable Test Case
 */
class ProfileTagsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProfileTagsTable
     */
    public $ProfileTags;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ProfileTags'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ProfileTags') ? [] : ['className' => ProfileTagsTable::class];
        $this->ProfileTags = TableRegistry::getTableLocator()->get('ProfileTags', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProfileTags);

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
}
