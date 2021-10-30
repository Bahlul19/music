<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ArtistInfoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ArtistInfoTable Test Case
 */
class ArtistInfoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ArtistInfoTable
     */
    public $ArtistInfo;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ArtistInfo',
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
        $config = TableRegistry::getTableLocator()->exists('ArtistInfo') ? [] : ['className' => ArtistInfoTable::class];
        $this->ArtistInfo = TableRegistry::getTableLocator()->get('ArtistInfo', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ArtistInfo);

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
