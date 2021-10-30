<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MediaTagsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MediaTagsTable Test Case
 */
class MediaTagsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MediaTagsTable
     */
    public $MediaTags;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.MediaTags'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('MediaTags') ? [] : ['className' => MediaTagsTable::class];
        $this->MediaTags = TableRegistry::getTableLocator()->get('MediaTags', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MediaTags);

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
