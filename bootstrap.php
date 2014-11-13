<?php

/*
 * This file is part of the Indigo Admin component.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

// Ugly hack to make twig extansions work
$this
	->getApplication()
	->getViewManager()
	->getParser('twig')
	->getTwig()
	->addExtension(\Fuel::getDic()->resolve('twig.menu'));
