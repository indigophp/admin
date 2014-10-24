<?php

/*
 * This file is part of the IndigoPHP framework.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Admin\Controller;

class Dashboard extends \Fuel\Controller\Base
{
	/**
	 * The basic welcome message
	 *
	 * @return \View
	 */
	public function actionIndex()
	{
		return \View::forge('dashboard/index.twig');
	}

	/**
	 * The 404 action for the application.
	 *
	 * @return \Response
	 */
	public function action404()
	{
		return \Response::forge('html', \View::forge('dashboard/404.twig'), 404);
	}
}
