<?php
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Livewire\Clientregister;
use App\Livewire\vendorregister;
use App\Livewire\GuestConfirmForm;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdsController;
use App\Http\Controllers\TopAdController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\AllGuestController;
use App\Http\Controllers\VendorCategoryController;
use App\Http\Controllers\ClientChecklistController;
use App\Http\Controllers\ClientGuestListController;
use App\Http\Controllers\ClientEventPlannerController;
use App\Http\Controllers\ClientVendorBookingController;
use App\Http\Controllers\ClientWishlistController;
use App\Http\Controllers\ClientBookingController;
use App\Http\Controllers\CancelBookingController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustormerBookingController;
use App\Http\Controllers\GuestConfirmController;
use App\Http\Controllers\GuestListController;
use App\Http\Controllers\SitePackageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SocialShareButtonsController;
use App\Livewire\GuestListFilament;
use App\Livewire\UpdateClientRegister;
use App\Livewire\UpdateVendorRegister;
use App\Livewire\Wishlist;
use App\Models\VendorGallery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;




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

Route::get('/', function () {
    return view('customer.index');
})->name('homepage');


Route::get('/vendordetails', function () {
    return view('common.vendoradvertistmentdetails');
})->name('vendordetails');

Route::get('/photocollagetemplate', function () {
    return view('common.PhotoCollageTemplate');
})->name('photocollagetemplate');


Route::get('/photocollage', function () {
    return view('common.EditPhotoCollageTemplate');
})->name('photocollage');

// Route::get('/adplan', function () {
//     return view('vendor.adplan');
// })->name('adplan');

Route::get('/checklist', function () {
    return view('customer.checklist');
})->name('checklist');


Route::get('/budgetplanner', function () {
    return view('customer.budgetplannerfront');
})->name('budgetplanner');


Route::get('/testemail', function () {
    return view('common.weddingInvitationMail');
});

Route::get('/guestlistnew', GuestListFilament::class)->name('guestlistnew');

Route::get('/guestlist', function () {
    return view('customer.guestlistfront');
})->name('guestlist');

Route::resource('rsvpguestlist', AllGuestController::class);
Route::get('rsvpguestlist/{advertisement}/share', [AllGuestController::class, 'rsvpguestlistshare'])->name('rsvpguestlist.rsvpguestlistshare');
Route::Patch('requestrsvp/{guest}', [AllGuestController::class, 'rsvprequestmail'])->name('rsvpguestlist.rsvprequestmail');
Route::patch('/rsvp/send', [AllGuestController::class, 'sendRSVP'])->name('rsvp.send');

Route::resource('rsvpguestconfirm', GuestConfirmController::class);
// Route::get('rsvpguestconfirm/confirm', [GuestConfirmController::class, 'beforeselectguest'])->name('guestconfirm.beforeselectguest');
Route::get('rsvpguestconfirm/confirm', [GuestConfirmController::class, 'rsvpguestconfirm'])->name('rsvpguestconfirmform');
Route::post('rsvpguestconfirm/confirm', [GuestConfirmController::class, 'rsvpguestconfirm'])->name('guestconfirm.rsvpguestconfirm');
// Route::post('rsvpguestconfirm/confirm', [GuestConfirmController::class, 'rsvpguestform'])->name('guestconfirm.rsvpguestform');
Route::get('rsvpsearch', [GuestConfirmController::class, 'showrsvpsearch'])->name('guestconfirm.showrsvpsearch');
Route::get('rsvpsearched', [GuestConfirmController::class, 'rsvpsearch'])->name('guestconfirm.rsvpsearch');
Route::post('rsvpsearched', [GuestConfirmController::class, 'rsvpsearch'])->name('guestconfirm.rsvpsearch');

Route::post('rsvpconfirm', [GuestConfirmController::class, 'rsvpguestform'])->name('guestconfirm.rsvpguestform');
Route::get('selectedguestconfirm/{select_id}', [GuestConfirmController::class, 'selectedguestconfirm'])->name('guestconfirm.selectedguestconfirm');

Route::get('/adsplan', function () {
    return view('vendor.adsplan');
})->name('adsplan');

Route::get('/contact', [ContactController::class, 'contact'])->name('contact');

Route::post('/send-email', [ContactController::class, 'sendEmail'])->name('contact.send');
// Route::controller(ClientChecklistController::class)->group(function(){
//     Route::get('/checklist', 'index');
//     Route::post("categories","getCategory")->name('get-category');
//     Route::post('ClientChecklist','store');
// });


Route::get('/vendor/register', function () {
    return view('livewire.vendorregister');
});

Route::get('/vendor/register', vendorregister::class);

Route::get('/guestconfirm', GuestConfirmForm::class);
Route::get('guestlinks/{userid}/confirm', GuestConfirmForm::class)->name('guestlists.guestlinks');
// Route::get('guestlinks/{userid}/confirm', [GuestListController::class, 'guestlinks'])->name('guestlists.guestlinks');

Route::get('/vendor/updateregister', UpdateVendorRegister::class);

Route::get('/customer/updateregister', UpdateClientRegister::class);

Route::get('/vendorbooking', function () {
    return view('common.vendorbooking');
});





Route::get('/customer/register', function () {
    return view('livewire.Clientregister');
});

Route::get('/customer/register', Clientregister::class)->name('customerreg');

Route::resource('client-guest-lists', ClientGuestListController::class);

//Event Calendar Routes
Route::resource('clienteventplanners', ClientEventPlannerController::class);
Route::resource('checklist', ClientChecklistController::class);

Route::resource('topAds', TopAdController::class);
Route::resource('vendorCategories', VendorCategoryController::class);
Route::resource('vendors', VendorController::class);
Route::resource('clients', ClientController::class);
Route::resource('advertistments', AdvertisementController::class);
Route::get('advertisements/{advertisement}/adpreview', [AdvertisementController::class, 'adpreview'])->name('advertisements.adpreview');
Route::put('advertisements/{advertisement}/adpublish', [AdvertisementController::class, 'adpublish'])->name('advertisements.adpublish');
Route::put('advertisements/{advertisement}/adreview', [AdvertisementController::class, 'adreview'])->name('advertisements.adreview');
Route::put('advertisements/{advertisement}/adreject', [AdvertisementController::class, 'adreject'])->name('advertisements.adreject');

Route::resource('ads', AdsController::class);
Route::resource('sitePackages', SitePackageController::class);

Route::resource('clientVendorBookings', ClientVendorBookingController::class);
Route::resource('clientBookings', ClientBookingController::class);
Route::get('clientBookings/{clientbooking}', [ClientBookingController::class, 'packageData'])->name('clientBookings.packges');

// Route::put('clientVendorBookings/{clientVendorBooking}/cancel', ClientVendorBookingController::class)->name('clientVendorBookings.cancel');
Route::put('bookings/{booking}/reqcancel', [CancelBookingController::class, 'cancelRequest'])->name('bookings.requestcancel');
Route::put('bookings/{booking}/cancel', [CancelBookingController::class, 'cancelBooking'])->name('bookings.bookingcancel');
Route::put('bookings/{booking}/book', BookingController::class)->name('bookings.book');

Route::get('cusbookings/{cusbooking}', [CustormerBookingController::class, 'packageData'])->name('cusbookings.packages');
Route::get('cusbookingdata/{cusbooking}', [CustormerBookingController::class, 'bookingData'])->name('cusbookings.bookingdata');
Route::patch('cusbookings/{cusbooking}', [CustormerBookingController::class, 'updatebooking'])->name('cusbookings.updatebooking');


Route::resource('clientWishlists', ClientWishlistController::class);
Route::post('/wishlist/add', [ClientWishlistController::class, 'addToWishlist'])->name('wishlist.add');
Route::get('/wishlist/check', [ClientWishlistController::class, 'checkWishlist'])->name('wishlist.check');
Route::post('/wishlist/toggle', [ClientWishlistController::class, 'toggleWishlist'])->name('wishlist.toggle');
Route::get('wishlist/categories', [ClientWishlistController::class, 'wishcategories'])->name('wishlist.categories');
Route::get('wishlist/categories/{category}', [ClientWishlistController::class, 'categoryfavourites'])->name('wishlist.categoryfavourites');
Route::get('/tooglewishlist', Wishlist::class)->name('tooglewishlist');
Route::get('/toogletopadwishlist', Wishlist::class)->name('toogletopadwishlist');

Route::get('/cusbookings', function () {
    return view('vendor.vendorPackages');
});


Route::get('/customer/calendar/index', [CalendarController::class, 'index'])->name('customer.calendar.index');
Route::post('/customer/calendar', [CalendarController::class, 'store'])->name('customer.calendar.store');
Route::patch('/customer/calendar/update/{id}', [CalendarController::class, 'update'])->name('customer.calendar.update');
Route::delete('/customer/calendar/destroy/{id}', [CalendarController::class, 'destroy'])->name('customer.calendar.destroy');


//Payment Gateway Routes
Route::post('pay', [PaymentController::class, 'pay'])->name('payment');
Route::get('success', [PaymentController::class, 'success']);
Route::get('error', [PaymentController::class, 'error']);
Route::post('/freepayment', [PaymentController::class, 'freepayment'])->name('freepayment');


// Social Media Share
Route::get('/social-media-share', [SocialShareButtonsController::class,'ShareWidget']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        $webuser = AUTH::id();
        // $client = DB::scalar("select v_name from vendors where user_id = '$webuser'");
        $client = DB::scalar("select c_name from clients where user_id = '$webuser'");
        $vendor = DB::scalar("select v_name from vendors where user_id = '$webuser'");
        $redirectUrl = Session::get('redirectUrl');
        $homePageRedirectUrl = Session::get('homePageRedirectUrl');
        if ($redirectUrl) {
            return redirect($redirectUrl);
            Session::forget('redirectUrl');
        }else {
        if(Auth::user()->role_id === 1){
            return redirect('/admin');
        }else if(Auth::user()->role_id === 2){
            return redirect('/merchants');
        }else if(Auth::user()->role_id === 3 && $client !== null){
            return redirect('/');
        }else if(Auth::user()->role_id === 3 && $client == null){
            return redirect('/customer/register');
        }else if(Auth::user()->role_id === 2 && $vendor !== null){
            return redirect('/merchants');
        }else if(Auth::user()->role_id === 2 && $vendor == null){
            return redirect('/vendor/register');
        }
    }
    })->name('dashboard');


    // Route::get('/dashboard', function ($request) {
    //     if ($request->filled('redirect')) {
    //         return redirect($request->input('redirect'));
    //     }else{
    //         if(Auth::user()->role_id == '1'){
    //             return redirect('/admin');
    //         }else if(Auth::user()->role_id == '2'){
    //             return redirect('/admin');
    //         }else if(Auth::user()->role_id == '3'){
    //             return view('customer.index');
    //         }
    //     }

    // })->name('dashboard');

});


// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/login', function (Request $request) {
//         $redirect = $request->input('redirect');

//         if ($redirect && !Str::contains($redirect, 'email/verify')) {
//             return redirect($redirect);
//         } else {
//            return redirect()->intended(config('fortify.home'));
//         }
//     })->name('login');
// });
