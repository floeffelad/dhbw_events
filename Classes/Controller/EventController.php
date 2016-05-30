<?php
namespace DHBW\DhbwEvents\Controller;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 Florian Löffelad <loeffelad@dhbw.de>, DHBW
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * EventController
 */
class EventController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * eventRepository
	 *
	 * @var \DHBW\DhbwEvents\Domain\Repository\EventRepository
	 * @inject
	 */
	protected $eventRepository = NULL;

	/**
	 * @var \DHBW\DhbwEvents\Domain\Repository\CategoryRepository
	 * @inject
	 */
	protected $categoryRepository;


	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction(\DHBW\DhbwEvents\Domain\Model\Demand $demand = NULL) {

		$propertiesToSearch = (strlen($this->settings['propertiesToSearch']) > 0)
			? \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(',', $this->settings['propertiesToSearch'])
			: array();
		$selectableCategories = (strlen($this->settings['selectableCategories']) > 0)
			? \TYPO3\CMS\Core\Utility\GeneralUtility::intExplode(',', $this->settings['selectableCategories'])
			: array();

		$this->view->assign('demand', $demand);
		$this->view->assign(
			'categories',
			array_merge(
				array(0 => 'Alle anzeigen'),
				$this->categoryRepository->findSelectableCategories($selectableCategories)->toArray()
			)
		);

		$this->view->assign(
			'events',
			$this->eventRepository->findDemanded(
				$demand,
				$propertiesToSearch
			)
		);
	}

	/**
	 * action show
	 *
	 * @param \DHBW\DhbwEvents\Domain\Model\Event $event
	 * @return void
	 */
	public function showAction(\DHBW\DhbwEvents\Domain\Model\Event $event) {
		$this->view->assign('event', $event);
	}

	/**
	 * action teaser
	 *
	 * @return void
	 */
	public function teaserAction() {
		$this->view->assign(
			'events',
			$this->eventRepository->findForTeaserView());
	}

}