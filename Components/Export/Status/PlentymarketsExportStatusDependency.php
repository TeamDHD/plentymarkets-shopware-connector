<?php
/**
 * plentymarkets shopware connector
 * Copyright © 2013 plentymarkets GmbH
 *
 * According to our dual licensing model, this program can be used either
 * under the terms of the GNU Affero General Public License, version 3,
 * or under a proprietary license.
 *
 * The texts of the GNU Affero General Public License, supplemented by an additional
 * permission, and of our proprietary license can be found
 * in the LICENSE file you have received along with this program.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * "plentymarkets" is a registered trademark of plentymarkets GmbH.
 * "shopware" is a registered trademark of shopware AG.
 * The licensing of the program under the AGPLv3 does not imply a
 * trademark license. Therefore any rights, titles and interests in the
 * above trademarks remain entirely with the trademark owners.
 *
 * @copyright Copyright (c) 2013, plentymarkets GmbH (http://www.plentymarkets.com)
 * @author Daniel Bächtle <daniel.baechtle@plentymarkets.com>
 */

require_once PY_COMPONENTS . 'Export/Status/PlentymarketsExportStatus.php';

/**
 * An export with an dependency
 *
 * @author Daniel Bächtle <daniel.baechtle@plentymarkets.com>
 */
class PlentymarketsExportStatusDependency extends PlentymarketsExportStatus
{

	/**
	 *
	 * @var PlentymarketsExportStatusInterface
	 */
	protected $Dependency;

	/**
	 * Checks whether the export may be announced
	 *
	 * @see PlentymarketsExportStatusInterface::mayAnnounce()
	 * @return boolean
	 */
	public function mayAnnounce()
	{
		return $this->getStatus() == 'open' && !$this->needsDependency();
	}

	/**
	 * Checks whether the export depends on another export
	 *
	 * @see PlentymarketsExportStatusInterface::needsDependency()
	 * @return boolean
	 */
	public function needsDependency()
	{
		return $this->Dependency->needsDependency() || !$this->Dependency->isFinished();
	}

	/**
	 * Returns the dependency
	 *
	 * @return PlentymarketsExportStatusInterface
	 */
	public function getDependency()
	{
		return $this->Dependency;
	}

	/**
	 * Sets the dependency
	 *
	 * @param PlentymarketsExportStatusInterface $Dependency
	 */
	public function setDependency(PlentymarketsExportStatusInterface $Dependency)
	{
		$this->Dependency = $Dependency;
	}
}
