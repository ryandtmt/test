<?php
/**
 * JExtn Customer E-Bill package
 * @author J-Extension <contact@jextn.com>
 * @link http://www.jextn.com
 * @copyright (C) 2013 - 2014 J-Extension
 * @license GNU/GPL, see LICENSE.php for full license.
**/

// No direct access
defined('_JEXEC') or die;

/**
 * @param	array	A named array
 * @return	array
 */
function JExtnCustomerEBillBuildRoute(&$query)
{
	$segments 		= array();

	if (isset($query['task'])) {
		$segments[] = implode('/',explode('.',$query['task']));
		unset($query['task']);
	}
	if (isset($query['id'])) {
		$segments[] = $query['id'];
		unset($query['id']);
	}
	if (isset($query['cid'])) {
		$segments[] = $query['cid'];
		unset($query['cid']);
	}
	if (isset($query['y'])) {
		$segments[] = $query['y'];
		unset($query['y']);
	}

	return $segments;
}

/**
 * @param	array	A named array
 * @param	array
 *
 * Formats:
 *
 * index.php?/jextncustomerebill/task/id/Itemid
 *
 * index.php?/jextncustomerebill/id/Itemid
 */
function JExtnCustomerEBillParseRoute($segments)
{
	$vars 					= array();

	// view is always the first element of the array
	$count 					= count($segments);

    if ($count)
	{
		$count--;
		$segment 			= array_pop($segments) ;
		if (is_numeric($segment)) {
			$vars['y'] 		= $segment;
			$segment 		= array_pop($segments) ;
			$vars['cid'] 	= $segment;
			$segment 		= array_pop($segments) ;
		}
         else{
            $count--;
            $vars['task'] 	= array_pop($segments) . '.' . $segment;
        }
	}

	if ($count)
	{
        $vars['task'] 		= implode('.',$segments);
	}
	return $vars;
}
