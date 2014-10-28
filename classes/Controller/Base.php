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

/**
 * Admin Base controller
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
abstract class Base extends \Fuel\Controller\Base
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

	/**
	 * Returns an URI without left trailing slash
	 *
	 * @return string
	 */
	protected function getUri()
	{
		$uri = $this->request->getComponent()->getUri();

		// Make sure we have a proper ending slash
		if ($uri !== '')
		{
			$uri = rtrim($uri, '/').'/';
		}

		return $uri;
	}

	/**
	 * {@inheritdoc}
	 */
	public function before()
	{
		$manager = $this->getAuth();
		$uri = $this->getUri();

		if ( ! $manager->check())
		{
			return \Response::forge('redirect', $uri.'login', 'location', 403);
		}

		\View::setGlobal('admin_uri', $uri);
	}
}
