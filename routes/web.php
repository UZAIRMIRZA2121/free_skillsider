<?php

use App\Http\Controllers\CertificateController;
use App\Http\Controllers\LlcController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\VideoHistoryController;
use App\Http\Controllers\RankController;
use App\Http\Controllers\VideosController;
use App\Http\Controllers\StudentController;            




use App\Http\Controllers\FaqController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TransectionController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\EarningController;
use App\Http\Controllers\EarningRewardController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FaqAffiliateVideoController;
use App\Http\Controllers\MarketToolController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TestController;

use Illuminate\Support\Facades\Mail;



use Illuminate\Support\Facades\Log;

Route::get('/test-email/{email}', function ($email) {
    try {
        $data = ['message' => 'This is a test email sent using SendGrid in Laravel.'];

        Mail::raw($data['message'], function ($message) use ($email) {
            $message->to($email)
                ->subject('Test Email')
                ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        });
dd('Email has been sent successfully!');
        return 'Email has been sent successfully!';
    } catch (\Exception $e) {
        dd('Failed to send email.');
        Log::error('Error sending email: ' . $e->getMessage());
        return 'Failed to send email.';
    }
});




/*
|--------------------------------------------------------------------------
| Web  Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/nomi', function () {
   // Fetch data from the first two tables
$earningsData = DB::table('users')
    ->join('u', 'users.email', '=', 'u.email')
    ->select('users.id as user_id', 'users.email', 'u.id as earning_id', 'u.earnings as amount')
    ->get();
   // dd($earningsData);
    
    // Insert data into the third table
foreach ($earningsData as $earning) {
    DB::table('earnings')->insert([
        'user_id' => $earning->user_id,
        'user_by_id' => $earning->user_id, // Assuming user_by_id is the same as user_id in this example
        'amount' => $earning->amount,
        'percentage' => 0,
        'percentage_type' => 'first person',
        'status' => '2',
    ]);
} 
})->name('home.page'); 
*/


Route::get('/', function () {
    return redirect('home');
})->name('home.page');
Route::get('/.env', function () {
    return redirect('home');
});

Route::get('/login-direct/{id}', function ($id) {
    // Find the user by ID
    $user = App\Models\User::find($id);

    if ($user) {
        // Log in the user
        Auth::login($user);

        // Redirect to the intended page after login (e.g., dashboard)
        return 'sucess';
    }

    // If the user is not found, redirect to login page with error message
    return redirect('login')->with('error', 'User not found');
});
Route::get('/login/page', function () {
    return redirect('login');
})->name('login.page');

Route::get('logout', function () {
    if (Auth::check()) {
        Auth::logout();
    }
    return redirect()->route('std.index')->with('session_expired', 'Your session has expired. Please log in again.');
})->name('logout');


Route::get('/home', [UserController::class, 'std_index'])->name('std.index');
Route::get('/about-us', [UserController::class, 'std_about_us'])->name('about.us');
Route::get('/blog', [UserController::class, 'std_blog'])->name('blog');
Route::get('/single-blog', [UserController::class, 'show'])->name('single.blog');
Route::get('/free-courses', [CourseController::class, 'free_courses'])->name('free.courses');
Route::get('/free-course-video/{id}', [CourseController::class, 'showFreeCourseVideo'])->name('free.course.video');

Route::get('/blog/{title}', [BlogController::class, 'show'])->name('blog.show');
// web.php (routes file)
Route::post('blogs/upload-image', [BlogController::class, 'uploadImage'])->name('blogs.upload_image');

Route::get('/refund-policy', [UserController::class, 'refund_policy'])->name('refund.policy');


Route::get('/golden-package', [UserController::class, 'golden_package'])->name('golden.package');
Route::get('/platium-package', [UserController::class, 'platium_package'])->name('platium.package');
Route::get('/contact-us', [UserController::class, 'contact_us'])->name('contact.us');
Route::get('/student-reviews', [UserController::class, 'student_review'])->name('student.review');
Route::get('/student-reviews-show/{id}', [UserController::class, 'student_review_show'])->name('student.review.show');
Route::get('/package/{id}', [PackageController::class, 'single_package'])->name('single.package');

Route::post('/check-coupon', [CouponController::class, 'checkCoupon'])->name('coupons.check');
Route::get('/register-by-referral/{referral_code}', [UserController::class, 'register_by_referral'])->name('register.by.referal');


Route::get('/register', [UserController::class, 'register'])->name('user.register');
Route::POST('/registeration', [UserController::class, 'registeration'])->name('registeration.submit');
Route::get('/affiliate/veification', [UserController::class, 'affiliate_veification'])->name('affiliate.veification');
Route::get('/affiliate/veification/check', [UserController::class, 'affiliate_veification_check'])->name('affiliate.veification.check');
Route::post('/affiliate/verification/check/ajax', [UserController::class, 'affiliate_verification_check_ajax'])->name('affiliate.verification.check.ajax');

Route::get('/OfficialAccounts', [UserController::class, 'paymennt_link'])->name('paymennt.link');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        if (Auth::user()->role == 1) {
            return redirect()->route('students.management.index');
        } elseif (Auth::user()->role == 2) {
            return redirect()->route('students.management.index');
        } elseif (Auth::user()->role == 3) {
            return redirect()->route('admin.dashboard');
        } elseif (Auth::user()->role == 4) {
            return redirect()->route('payment.management');
        } elseif (Auth::user()->role == 0 && Auth::user()->status == 1) {
            return redirect()->route('student.single_package_course', ['id' => Auth::user()->package_id]);
        } else {
            return view('welcome');
        }
    })->name('dashboard');
});




Route::middleware(['admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/leaderboard', [UserController::class, 'leaderboard'])->name('user.leaderboard');
    Route::get('/team', [UserController::class, 'team'])->name('user.team');
    Route::get('/certificate', [UserController::class, 'certificate'])->name('user.certificate');
    Route::get('/affilate_training', [UserController::class, 'affilate_training'])->name('user.affilate_training');
    Route::get('/faq', [UserController::class, 'faq'])->name('user.faq');
    Route::get('/stdearning', [UserController::class, 'stdearning'])->name('std.earning');
    Route::get('/stdtotalearning', [UserController::class, 'stdtotalearning'])->name('std.total.earning');
    Route::get('/community', [UserController::class, 'community'])->name('user.community');
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::POST('/update_password', [UserController::class, 'update_password'])->name('update.password');
    Route::get('/update_image', [UserController::class, 'update_image'])->name('image.update');

    //---about video-controller---//
    Route::get('/about/video', [UserController::class, 'aboutvideoindex'])->name('about.video');
    Route::get('/about/video/edit', [UserController::class, 'editaboutvideo'])->name('edit.about.video');

    Route::put('/update-about-video', [UserController::class, 'updateaboutvideo'])->name('update.about.video');

    //---dashboard_images-controller---//
    Route::get('dashboard/images', [UserController::class, 'dashboardimageindex'])->name('dashboard.images.index');
    Route::get('dashboard/images/create', [UserController::class, 'dashboardimagecreate'])->name('dashboard.images.create');
    Route::post('dashboard/images', [UserController::class, 'dashboardimagestore'])->name('dashboard.images.store');
    Route::get('dashboard/images/{dashboardImage}/edit', [UserController::class, 'dashboardimagesedit'])->name('dashboard.images.edit');
    Route::put('dashboard/images/{dashboardImage}', [UserController::class, 'dashboardimagesupdate'])->name('dashboard.images.update');
    Route::delete('dashboard/images/{dashboardImage}', [UserController::class, 'dashboardimagesdestroy'])->name('dashboard.images.destroy');
    //---faq_affiliate_videos-controller---//
    Route::resource('faq_affiliate_videos', FaqAffiliateVideoController::class);


    //---user-controller---//
    Route::resource('users', UserController::class)->names([
        'index' => 'admin.index',
        'show' => 'admin.profile',
        'edit' => 'admin.edit.profile',
        'update' => 'admin.update.profile',
    ]);
    // -----payments---------
    Route::resource('payments', PaymentController::class)->names([
        'index' => 'payment.admin.index',
        'show' => 'payment.admin.show',
        'edit' => 'payment.admin.edit',
        'create' => 'payment.admin.create',
        'store' => 'payment.admin.store',
        'update' => 'payment.admin.update',
        'destroy' => 'payment.admin.delete',

    ]);
    //-----students--controller---//
    Route::resource('students/management', StudentController::class)->names([
        'index' => 'students.management.index',
        'show' => 'students.management.show',
        'edit' => 'students.management.verify',
        'destroy' => 'students.management.delete',
    ]);
    Route::post('/update-email', [StudentController::class, 'updateEmail'])->name('update.email');

    Route::get('students/search', [StudentController::class, 'searchstudents'])->name('search.students');

    //-----packages controller---//
    Route::resource('notifications', NotificationsController::class);
    //-----packages controller---//
    Route::resource('packages', PackageController::class);
    //-----course---controller---///
    // Route::resource('courses', CourseController::class);
    Route::resource('courses', CourseController::class);
    //----videos---controller---//
    Route::resource('videos', VideosController::class);
    //----coupons---controller---///
    Route::resource('coupons', CouponController::class);
    //----FAQ---controller---///
    Route::resource('faq', FaqController::class);
    //////team---controller---///
    Route::resource('team', TeamController::class);
    //////Transaction---controller---///
    Route::resource('transection', TransectionController::class);
    //////EarningRewardController---controller---///
    Route::resource('earning-rewards', EarningRewardController::class);
    Route::get('/claim-rewards', [EarningRewardController::class, 'claimrewardsindex'])->name('admin.claim-rewards.index');
    Route::post('/change-status/{id}', [EarningRewardController::class, 'changeStatus'])->name('change-status');
    Route::get('/payment-management', [EarningController::class, 'payment_management'])->name('payment.management');

    //---update--package--controller---//
    Route::get('/package-upgrade/request', [PackageController::class, 'upgrade_request_index'])->name('upgrade.request.index');
    Route::get('/package-upgrade/approved', [PackageController::class, 'upgrade_approved_index'])->name('upgrade.approved.index');
    Route::get('/package-upgrade/request/accept/{id}', [PackageController::class, 'upgrade_request_accept'])->name('upgrade.request.accept');
    Route::delete('/package-upgrade/delete/{id}', [PackageController::class, 'upgrade_request_destroy'])->name('upgrade.request.delete');

    //---rank--controller---//
    Route::get('/rank', [RankController::class, 'index'])->name('rank.index');
    Route::get('/rank/add', [RankController::class, 'create'])->name('rank.create');
    Route::POST('/rank/store', [RankController::class, 'store'])->name('rank.store');
    Route::get('/rank/edit/{id}', [RankController::class, 'edit'])->name('rank.edit');
    Route::PUT('/rank/update/{id}', [RankController::class, 'update'])->name('rank.update');
    Route::delete('/rank/destroy/{id}', [RankController::class, 'destroy'])->name('rank.destroy');

    //---review--controller---//
    Route::get('/review', [ReviewController::class, 'index'])->name('review.index');
    Route::get('/review/add', [ReviewController::class, 'create'])->name('review.create');
    Route::POST('/review/store', [ReviewController::class, 'store'])->name('review.store');
    Route::get('/review/edit/{id}', [ReviewController::class, 'edit'])->name('review.edit');
    Route::PUT('/review/update/{id}', [ReviewController::class, 'update'])->name('review.update');
    Route::delete('/review/destroy/{id}', [ReviewController::class, 'destroy'])->name('review.destroy');


    Route::resource('market_tools', MarketToolController::class);
    Route::resource('blogs', BlogController::class);

    Route::POST('/fetch-graph-data', [UserController::class, 'graphData'])->name('fetch.graph.data');

    Route::resource('questions', QuestionController::class);

});



Route::middleware(['student'])->prefix('student')->group(function () {
    Route::get('students/search', [StudentController::class, 'searchstudents'])->name('search.std');
    ///-----Students--Controller---//
    Route::get('/dashboard', function () {
        return view('student.dashboard');
    })->name('student.dashboard');
    Route::resource('students', StudentController::class);
    Route::resource('earnings', EarningController::class);
    //Route::get('/my-affiliate', [StudentController::class 'my_affiliate'])->name('my.affiliate');

    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('student.dashboard');
    Route::POST('/user-regions-data', [UserController::class, 'userregionsdata'])->name('user.regions.data');
    Route::get('/leaderboard', [UserController::class, 'leaderboard'])->name('leaderboard');

    Route::get('/Faq', [UserController::class, 'faq'])->name('faq');
    Route::get('/affiliate/trainings', [UserController::class, 'affiliatetraining'])->name('affiliate.training');
    Route::get('/community', [UserController::class, 'community'])->name('community');
    // -----payments---------
    Route::resource('payments', PaymentController::class);
    Route::get('/payments', [PaymentController::class, 'index'])->name('student.payments');
    Route::resource('student-profile', UserController::class);
    Route::post('/update-user-status', [UserController::class, 'updateStatus'])->name('user.updateStatus');

    Route::get('/payment/request', [PaymentController::class, 'payment_request'])->name('payment_request');
    Route::get('/payment/confirm_payment', [PaymentController::class, 'confirm_payment'])->name('user.confirm_payment');
    Route::get('/payment/recieved_payment', [PaymentController::class, 'recieved_payment'])->name('user.recieved_payment');
    Route::get('/passive_pending_payment', [PaymentController::class, 'passive_pending_payment'])->name('user.passive.confirm_payment');
    Route::get('/passive_recieved_payment', [PaymentController::class, 'passive_recieved_payment'])->name('user.passive.recieved_payment');

    Route::get('/my-package', [PackageController::class, 'my_package'])->name('student.package');
    Route::get('my-package/my-course/{id}', [PackageController::class, 'single_package_course'])->name('student.single_package_course');
    Route::get('my-package/my-course/course-video/{id}', [PackageController::class, 'course_video'])->name('student.single_course_video');
    //---user-controller--//
    Route::resource('users', UserController::class);

    //---update--package controller---//
    Route::get('/package-update', [PackageController::class, 'package_update_form'])->name('users.package.upgrade.form');
    Route::POST('/package-update/{id}', [PackageController::class, 'package_update'])->name('package.upgrade');

    //---certificate--controller---//
    Route::get('/certificate/{courseTitle}', [CourseController::class, 'certificate'])->name('certificate');
    Route::get('/download-certificate/{course_id}', [CertificateController::class, 'downloadCertificate'])->name('download.certificate');
 

    //////EarningRewardController---controller---///
    Route::get('/earning-rewards-std', [EarningRewardController::class, 'stdindex'])->name('earning-rewards.std.index');
    // In routes/web.php
    Route::get('/reward/{id}', [EarningRewardController::class, 'stdshow'])->name('single_reward');

    Route::get('/claim-reward/{earning_reward}', [EarningRewardController::class, 'claim'])->name('earning-rewards.claim');

    Route::get('/claim-rewards', [EarningRewardController::class, 'claimrewardsindexstd'])->name('claim-rewards.index');

    Route::get('/market-tools', [MarketToolController::class, 'index_std'])->name('market_tools.index_std');
    Route::get('/market-tool/{id}', [MarketToolController::class, 'show'])->name('market_tool_link_std');

    Route::get('/Discount', [CouponController::class, 'coupon_code'])->name('users.coupon.code');

    Route::POST('/fetch-graph-data', [UserController::class, 'graphData'])->name('fetch.graph.data');


    Route::post('/notifications/mark-read', [NotificationsController::class, 'markAllAsRead'])->name('std.all.notifications');
    Route::get('/notification/{id}', [NotificationsController::class, 'show'])->name('notification.show');


    // Route::resource('tests', TestController::class);
    Route::get('tests/', [TestController::class, 'index'])->name('tests.index');

    Route::get('tests/{testId}/attempts', [TestController::class, 'indexAttempts'])->name('tests.attempts.index');
    Route::get('tests/{testId}/attempts/create', [TestController::class, 'createAttempt'])->name('tests.attempts.create');
    Route::post('tests/{testId}/attempts', [TestController::class, 'storeAttempt'])->name('tests.attempts.store');
    Route::get('tests/{testId}/attempts/{id}', [TestController::class, 'showAttempt'])->name('tests.attempts.show');
    Route::get('tests/{testId}/attempts/{id}/edit', [TestController::class, 'editAttempt'])->name('tests.attempts.edit');
    Route::put('tests/{testId}/attempts/{id}', [TestController::class, 'updateAttempt'])->name('tests.attempts.update');
    Route::delete('tests/{testId}/attempts/{id}', [TestController::class, 'destroyAttempt'])->name('tests.attempts.destroy');


    Route::post('/submit-test', [TestController::class, 'submit_test'])->name('submit.test');
    Route::get('/test/{id}/result', [TestController::class, 'reviewReport'])->name('test.review');
    
    Route::post('/test/start', [TestController::class, 'test_start'])->name('tests.start');
    Route::get('/std/tests/start/{test_id}', [TestController::class, 'std_test_start'])->name('std.tests.start');



    Route::resource('video-histories', VideoHistoryController::class);
    Route::post('/video-history', [VideoHistoryController::class, 'store'])->name('video-history.store');


});




Route::get('/cc', function () {
    // Clearing views, cache, routes, and configuration
    $exitCodeViewClear = Artisan::call('view:clear');
    $exitCodeCacheClear = Artisan::call('cache:clear');
    $exitCodeRouteClear = Artisan::call('route:clear');
    $exitCodeConfigClear = Artisan::call('config:clear');
});
