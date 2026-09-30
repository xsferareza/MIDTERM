$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::processLogin');
$routes->get('logout', 'Auth::logout');

// Protected Routes (Requires Auth Filter)
$routes->group('', ['filter' => 'auth'], function($routes) {
    // Products
    $routes->get('products', 'Products::index');
$routes->get('products/create', 'Products::create');
$routes->post('products/store', 'Products::store');
$routes->get('products/delete/(:num)', 'Products::delete/$1');

    // Customers
    $routes->get('customers', 'Customers::index');
    $routes->get('customers/create', 'Customers::create');
    $routes->post('customers/store', 'Customers::store');

    // Staff
    $routes->get('staff', 'Staff::index');
    $routes->get('staff/create', 'Staff::create');
    $routes->post('staff/store', 'Staff::store');

    // Sales
    $routes->get('sales/create', 'Sales::create');
$routes->post('sales/process', 'Sales::process');
$routes->get('sales/history', 'Sales::history');
});