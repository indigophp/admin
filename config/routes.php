<?php

/*
 * This file is part of the IndigoPHP framework.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * NOTICE:
 *
 * This is the route configuration for this FuelPHP application.
 * It contains configuration which is for this application only.
 */

// 404 route
$this->router->all(null, 'admin/admin/404', '404');

// homepage route
$this->router->all('/', 'admin/dashboard/index', 'root');
$this->router->all('login', 'admin/dashboard/login');
$this->router->all('logout', 'admin/dashboard/logout');
