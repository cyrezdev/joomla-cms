<?php
/**
 * @package     Joomla.UnitTest
 * @subpackage  com_finder
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

require_once JPATH_ADMINISTRATOR . '/components/com_finder/helpers/indexer/helper.php';
require_once JPATH_ADMINISTRATOR . '/components/com_finder/helpers/indexer/stemmer.php';
require_once JPATH_ADMINISTRATOR . '/components/com_finder/helpers/indexer/token.php';

/**
 * Test class for FinderIndexerToken.
 * Generated by PHPUnit on 2012-06-10 at 14:53:01.
 */
class FinderIndexerTokenTest extends TestCase
{
	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 *
	 * @return  void
	 *
	 * @since   3.1
	 */
	protected function setUp()
	{
		// Store the factory state so we can mock the necessary objects
		$this->saveFactoryState();

		// Set up our mock database
		$db = JFactory::getDbo();
		$db->name = 'mysqli';

		JFactory::$database = $db;

		FinderIndexerHelper::$stemmer = FinderIndexerStemmer::getInstance('porter_en');
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 *
	 * @return  void
	 *
	 * @since   3.1
	 */
	protected function tearDown()
	{
		// Restore the factory state
		$this->restoreFactoryState();
	}

	/**
	 * Tests the FinderIndexerToken constructor
	 *
	 * @return  void
	 *
	 * @since   3.1
	 */
	public function test__construct()
	{
		$token = new FinderIndexerToken(array('These', 'parties', 'don\'t', 'end'), 'en-GB');

		// Just to make sure we have an instance of ourself
		$this->assertInstanceOf(
			'FinderIndexerToken',
			$token,
			'Make sure our token is actually an instance of the token class'
		);

		// Verify the proper stem is returned
		$this->assertEquals(
			'These parties don end',
			$token->stem,
			'Verify the phrase is properly stemmed.'
		);
	}
}
