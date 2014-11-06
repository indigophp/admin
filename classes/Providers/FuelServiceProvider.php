<?php

/*
 * This file is part of the Indigo Admin component.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Admin\Providers;

use Fuel\Dependency\ServiceProvider;

/**
 * Provides menu services
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class FuelServiceProvider extends ServiceProvider
{
	/**
	 * {@inheritdoc}
	 */
	public $provides = ['admin.menu'];

	/**
	 * {@inheritdoc}
	 */
	public function provide()
	{
		$this->register('admin.menu', function($dic)
		{
			$menu = $dic->multiton('menu', 'admin', [gettext('Admin menu')]);

			$menu->addChild('dashboard', ['uri' => '', 'label' => gettext('Dashboard')]);

			return $menu;
		});
	}
}
