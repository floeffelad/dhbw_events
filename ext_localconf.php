<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'DHBW.' . $_EXTKEY,
	'Events',
	array(
		'Event' => 'list, show, teaser',

	),
	// non-cacheable actions
	array(
		'Event' => '',

	)
);
