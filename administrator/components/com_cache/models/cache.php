<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_cache
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\Utilities\ArrayHelper;

/**
 * Cache Model
 *
 * @since  1.6
 */
class CacheModelCache extends JModelList
{
	/**
	 * An Array of CacheItems indexed by cache group ID
	 *
	 * @var Array
	 */
	protected $_data = array();

	/**
	 * Group total
	 *
	 * @var integer
	 */
	protected $_total = null;

	/**
	 * Pagination object
	 *
	 * @var object
	 */
	protected $_pagination = null;

	/**
	 * Constructor.
	 *
	 * @param   array  $config  An optional associative array of configuration settings.
	 *
	 * @since   3.5
	 */
	public function __construct($config = array())
	{
<<<<<<< HEAD
		parent::__construct($config);

		$this->filter_fields = array('group', 'count', 'size');
=======
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'group',
				'count',
				'size',
				'cliend_id',
			);
		}

		parent::__construct($config);
>>>>>>> joomla/staging
	}

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @param   string  $ordering   Field for ordering.
	 * @param   string  $direction  Direction of ordering.
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	protected function populateState($ordering = 'group', $direction = 'asc')
	{
<<<<<<< HEAD
		$clientId = $this->getUserStateFromRequest($this->context . '.filter.client_id', 'filter_client_id', 0, 'int');
		$this->setState('clientId', $clientId == 1 ? 1 : 0);

		$client = JApplicationHelper::getClientInfo($clientId);
		$this->setState('client', $client);
=======
		// Load the filter state.
		$this->setState('filter.search', $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search', '', 'string'));

		// Special case for client id.
		$clientId = (int) $this->getUserStateFromRequest($this->context . '.client_id', 'client_id', 0, 'int');
		$clientId = (!in_array($clientId, array (0, 1))) ? 0 : $clientId;
		$this->setState('client_id', $clientId);

		parent::populateState($ordering, $direction);
	}

	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param   string  $id  A prefix for the store id.
	 *
	 * @return  string  A store id.
	 *
	 * @since   3.5
	 */
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id	.= ':' . $this->getState('client_id');
		$id	.= ':' . $this->getState('filter.search');
>>>>>>> joomla/staging

		return parent::getStoreId($id);
	}

	/**
	 * Method to get cache data
	 *
	 * @return array
	 */
	public function getData()
	{
		if (empty($this->_data))
		{
			$cache = $this->getCache();
			$data = $cache->getAll();

			if ($data && count($data) > 0)
			{
				// Process filter by search term.
				if ($search = $this->getState('filter.search'))
				{
<<<<<<< HEAD
					// Apply custom ordering.
					$ordering = $this->getState('list.ordering');
					$direction = ($this->getState('list.direction') == 'asc') ? 1 : (-1);

					jimport('joomla.utilities.arrayhelper');
					$this->_data = JArrayHelper::sortObjects($data, $ordering, $direction);

					// Apply custom pagination.
					if ($this->_total > $this->getState('list.limit') && $this->getState('list.limit'))
=======
					foreach ($data as $key => $cacheItem)
>>>>>>> joomla/staging
					{
						if (stripos($cacheItem->group, $search) === false)
						{
							unset($data[$key]);
							continue;
						}
					}
				}
<<<<<<< HEAD
=======

				// Process ordering.
				$listOrder = $this->getState('list.ordering', 'group');
				$listDirn  = $this->getState('list.direction', 'ASC');

				$this->_data = ArrayHelper::sortObjects($data, $listOrder, strtolower($listDirn) === 'desc' ? -1 : 1, true, true);

				// Process pagination.
				$limit = (int) $this->getState('list.limit', 25);

				if ($limit !== 0)
				{
					$start = (int) $this->getState('list.start', 0);
					return array_slice($this->_data, $start, $limit);
				}
>>>>>>> joomla/staging
			}
			else
			{
				$this->_data = array();
			}
		}

		return $this->_data;
	}

	/**
	 * Method to get cache instance.
	 *
	 * @return object
	 */
	public function getCache()
	{
		$conf = JFactory::getConfig();

		$options = array(
			'defaultgroup' => '',
			'storage'      => $conf->get('cache_handler', ''),
			'caching'      => true,
<<<<<<< HEAD
			'cachebase'    => ($this->getState('clientId') == 1) ? JPATH_ADMINISTRATOR . '/cache' : $conf->get('cache_path', JPATH_SITE . '/cache')
=======
			'cachebase'    => ($this->getState('client_id') === 1) ? JPATH_ADMINISTRATOR . '/cache' : $conf->get('cache_path', JPATH_SITE . '/cache')
>>>>>>> joomla/staging
		);

		$cache = JCache::getInstance('', $options);

		return $cache;
	}

	/**
	 * Method to get client data.
	 *
	 * @return array
	 */
	public function getClient()
	{
		return JApplicationHelper::getClientInfo($this->getState('client_id', 0));
	}

	/**
	 * Get the number of current Cache Groups.
	 *
	 * @return  int
	 */
	public function getTotal()
	{
		if (empty($this->_total))
		{
			$this->_total = count($this->getData());
		}

		return $this->_total;
	}

	/**
	 * Method to get a pagination object for the cache.
	 *
	 * @return  integer
	 */
	public function getPagination()
	{
		if (empty($this->_pagination))
		{
			$this->_pagination = new JPagination($this->getTotal(), $this->getState('list.start'), $this->getState('list.limit'));
		}

		return $this->_pagination;
	}

	/**
	 * Clean out a cache group as named by param.
	 * If no param is passed clean all cache groups.
	 *
	 * @param   string  $group  Cache group name.
	 *
	 * @return  void
	 */
	public function clean($group = '')
	{
		$cache = $this->getCache();
		$cache->clean($group);
	}

	/**
	 * Purge an array of cache groups.
	 *
	 * @param   array  $array  Array of cache group names.
	 *
	 * @return  void
	 */
	public function cleanlist($array)
	{
		foreach ($array as $group)
		{
			$this->clean($group);
		}
	}

	/**
	 * Purge all cache items.
	 *
	 * @return  boolean  True if successful; false otherwise.
	 */
	public function purge()
	{
		$cache = JFactory::getCache('');

		return $cache->gc();
	}
}
