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

use Fuel\Auth\Manager;
use Fuel\Auth\Storage;
use Fuel\Auth\Persistence;
use Fuel\Auth\User;
use Fuel\Auth\Group;
use Fuel\Auth\Role;
use Fuel\Auth\Acl;

class Dashboard extends \Fuel\Controller\Base
{
	/**
	 * Auth Manager
	 *
	 * @var Manager
	 */
	protected $auth;

	protected function getAuth()
	{
		if ( ! $this->auth)
		{
			$this->auth = new Manager(
				new Storage\File(['file' => '/tmp']),
				new Persistence\File(['file' => '/tmp'])
			);

			// assign our Auth drivers
			$this->auth->addDriver(new User\File(['min_password_length' => 6, 'new_password_length' => 8, 'file' => '/tmp']), 'user');
			$this->auth->addDriver(new Group\File(['file' => '/tmp']), 'group');
			$this->auth->addDriver(new Role\File(['file' => '/tmp']), 'role');
			$this->auth->addDriver(new Acl\File(['file' => '/tmp']), 'acl');
		}

		return $this->auth;
	}

	public function before()
	{
		$manager = $this->getAuth();

		if ($manager->check()) {
		}
	}

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
