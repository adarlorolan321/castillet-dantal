<?php

use App\Http\Controllers\Admin\DentalServiceController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\UnavalableDatesController;
use App\Http\Controllers\Apointment\ApointmentController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Customer\CustomerCalendarController;
use App\Http\Controllers\Customer\ServiceController;
use App\Http\Controllers\Customer\UserHistoryController;
use App\Http\Controllers\CustomerAppoinmentController;
use App\Http\Controllers\Medecine\MedecineController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserCheckupHistoryController;
use App\Models\Admin\DentalService;
use App\Models\Apointment\Apointment;
use App\Models\Payment\Payment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

if (env('APP_ENV') === 'dev') {
    URL::forceScheme('https');
}

Route::get('/', function () {
    $auth = auth()->user();
    $service = DentalService::get();
    foreach ($service as $servicing) {
        $servicing['photo'] = json_decode($servicing['photo']);
    }
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'service' => $service,
        'auth' => $auth,
    ]);
})->name('home');

Route::get('/dashboard', function () {
    $service = DentalService::get();
    $todayDate = now()->format('Y-m-d');

    
     // Format today's date to match your format
    // Get today's date
    $todayDate = Carbon::now();

    // Get all appointments where the date is greater than today
    $appointments = Apointment::where('date', '>=', $todayDate)->get();
   
    $user = User::where('id','!=', auth()->user()->id)->get();
    $totalAmount = Payment::sum('amount');

    // dd($totalAmount);

    if (auth()->user()->role == 'Admin') {
        return Inertia::render(
            'Dashboard',
            [
                'service' => $service,
                'appointments' => $appointments,
                'user' => $user,
                'totalAmount' => $totalAmount
            ]
        );
    } else {
        $service = DentalService::get();
        foreach ($service as $servicing) {
            $servicing['photo'] = json_decode($servicing['photo']);
        }
        $data = Apointment::with(['user', 'service'])->where('user_id', auth()->user()->id)->get();
        return Inertia::render('Welcome', [
            'data' => $data,
            'service' => $service
        ]);
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/histories', UserHistoryController::class);
    Route::resource('apointment', ApointmentController::class);
    Route::resource('chats', ChatController::class);

    Route::resource('unavailable-dates', UnavalableDatesController::class);
    Route::resource('dental-services', DentalServiceController::class);
    Route::resource('medicines', MedecineController::class);
    Route::resource('customer-apointment', CustomerAppoinmentController::class);
    Route::resource('patients', PatientController::class);
    Route::resource('user-history', UserCheckupHistoryController::class);
    // Route::get('user-history/{id}',[UserCheckupHistoryController::class, 'showData'])->name('user-history.getData');
    Route::resource('payments', PaymentController::class);
    Route::resource('customer-appointments', CustomerAppoinmentController::class);
    Route::get('pay', [CustomerAppoinmentController::class, 'pay'])->name('pay');
    Route::get('store_apointment', [CustomerAppoinmentController::class, 'store_apointment'])->name('store_apointment');
    Route::get('get-my-apointment', [CustomerAppoinmentController::class, 'getMyAppointment'])->name('getMyAppointment');
    Route::get('reciept/{id}', [CustomerAppoinmentController::class, 'reciept'])->name('reciept');
    Route::prefix("customer")->group(function () {
        Route::resource('slots', CustomerCalendarController::class);
        Route::resource('services', ServiceController::class);
    });
});

require __DIR__ . '/auth.php';
