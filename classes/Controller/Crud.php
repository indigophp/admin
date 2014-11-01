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

/**
 * Basic CRUD controller
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
abstract class Crud extends Base
{
	use \Indigo\Common\Controller\Theme
	{
		before as private _before;
	}

	/**
	 * @return View
	 */
	public function actionIndex()
	{
		return \View::forge('crud/index.twig');
	}

	/**
	 * @return View
	 */
	public function actionCreate()
	{
		return \View::forge('crud/create.twig');
	}

	/**
	 * @return View
	 */
	public function actionEdit($id)
	{
		return \View::forge('crud/edit.twig');
	}

	/**
	 * @return View
	 */
	public function actionDelete($id)
	{
		return \View::forge('crud/delete.twig');
	}
}
