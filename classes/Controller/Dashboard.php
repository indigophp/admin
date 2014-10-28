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
 * Admin controller
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Dashboard extends Base
{
	use \Indigo\Common\Controller\Theme
	{
		before as private _before;
	}

	/**
	 * {@inheritdoc}
	 */
	public function before()
	{
		$this->_before();

		$manager = $this->getAuth();

		if ( ! in_array($this->route->action, ['Login', '404']))
		{
			return parent::before();
		}
		else
		{
			\View::setGlobal('admin_uri', $this->getUri());
		}
	}

	/**
	 * The basic welcome message
	 *
	 * @return View
	 */
	public function actionIndex()
	{
		return \View::forge('index.twig');
	}

	/**
	 * Login
	 *
	 * @return View
	 */
	public function actionLogin()
	{
		$auth = $this->getAuth();

		if ($auth->check())
		{
			return $this->redirectLoggedIn();
		}

		if ($this->request->getInput()->getMethod() === 'POST')
		{
			$user = $this->request->getInput()->getParam('username');
			$password = $this->request->getInput()->getParam('password');

			if ($auth->login($user, $password))
			{
				return $this->redirectLoggedIn();
			}
		}

		return \View::forge('login.twig');
	}

	protected function redirectLoggedIn()
	{
		$uri = $this->request->getInput()->getParam('uri', $this->getUri());

		return \Response::forge('redirect', $uri);
	}

	/**
	 * Logout
	 *
	 * @return Response
	 */
	public function actionLogout()
	{
		$this->getAuth()->logout();
		$uri = $this->getUri();

		return \Response::forge('redirect', $uri.'login');
	}

	/**
	 * The 404 action for the application.
	 *
	 * @return Response
	 */
	public function action404()
	{
		return \Response::forge('html', \View::forge('404.twig'), 404);
	}
}
