<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RadioTracksTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RadioTracksTable Test Case
 */
class RadioTracksTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RadioTracksTable
     */
    public $RadioTracks;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.RadioTracks',
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
        $config = TableRegistry::getTableLocator()->exists('RadioTracks') ? [] : ['className' => RadioTracksTable::class];
        $this->RadioTracks = TableRegistry::getTableLocator()->get('RadioTracks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RadioTracks);

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
