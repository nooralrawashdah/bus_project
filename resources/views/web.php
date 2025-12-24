use App\Http\Controllers\DriverDashboardController;

Route::get('/driver/dashboard', [DriverDashboardController::class, 'index'])
    ->name('driver.dashboard');
