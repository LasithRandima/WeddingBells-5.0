GET|HEAD        / ............................................................................................ homepage
  GET|HEAD        _debugbar/assets/javascript ............... debugbar.assets.js › Barryvdh\Debugbar › AssetController@js
  GET|HEAD        _debugbar/assets/stylesheets ............ debugbar.assets.css › Barryvdh\Debugbar › AssetController@css
  DELETE          _debugbar/cache/{key}/{tags?} ...... debugbar.cache.delete › Barryvdh\Debugbar › CacheController@delete
  GET|HEAD        _debugbar/clockwork/{id} ..... debugbar.clockwork › Barryvdh\Debugbar › OpenHandlerController@clockwork
  GET|HEAD        _debugbar/open ................ debugbar.openhandler › Barryvdh\Debugbar › OpenHandlerController@handle
  POST            _ignition/execute-solution ignition.executeSolution › Spatie\LaravelIgnition › ExecuteSolutionControll…
  GET|HEAD        _ignition/health-check .......... ignition.healthCheck › Spatie\LaravelIgnition › HealthCheckController
  POST            _ignition/update-config ....... ignition.updateConfig › Spatie\LaravelIgnition › UpdateConfigController
  GET|HEAD        admin ..................................... filament.admin.pages.dashboard › Filament\Pages › Dashboard
  GET|HEAD        admin/activity-logs filament.admin.resources.activity-logs.index › Z3d0X\FilamentLogger › ListActiviti…
  GET|HEAD        admin/activity-logs/{record} filament.admin.resources.activity-logs.view › Z3d0X\FilamentLogger › View…
  GET|HEAD        admin/advertisements filament.admin.resources.advertisements.index › App\Filament\Resources\Advertisem…
  GET|HEAD        admin/advertisements/create filament.admin.resources.advertisements.create › App\Filament\Resources\Ad…
  GET|HEAD        admin/advertisements/{record} filament.admin.resources.advertisements.view › App\Filament\Resources\Ad…
  GET|HEAD        admin/advertisements/{record}/edit filament.admin.resources.advertisements.edit › App\Filament\Resourc…
  GET|HEAD        admin/client-event-planners filament.admin.resources.client-event-planners.index › App\Filament\Resour…
  GET|HEAD        admin/client-event-planners/create filament.admin.resources.client-event-planners.create › App\Filamen…
  GET|HEAD        admin/client-event-planners/{record}/edit filament.admin.resources.client-event-planners.edit › App\Fi…
  GET|HEAD        admin/login ........................................ filament.admin.auth.login › Filament\Pages › Login
  POST            admin/logout ............................ filament.admin.auth.logout › Filament\Http › LogoutController
  GET|HEAD        admin/site-packages filament.admin.resources.site-packages.index › App\Filament\Resources\SitePackageR…
  GET|HEAD        admin/site-packages/create filament.admin.resources.site-packages.create › App\Filament\Resources\Site…
  GET|HEAD        admin/site-packages/{record}/edit filament.admin.resources.site-packages.edit › App\Filament\Resources…
  GET|HEAD        admin/themes .................................. filament.admin.pages.themes › Hasnayeen\Themes › Themes
  GET|HEAD        admin/top-ads filament.admin.resources.top-ads.index › App\Filament\Resources\TopAdResource\Pages\List…
  GET|HEAD        admin/top-ads/create filament.admin.resources.top-ads.create › App\Filament\Resources\TopAdResource\Pa…
  GET|HEAD        admin/top-ads/{record} filament.admin.resources.top-ads.view › App\Filament\Resources\TopAdResource\Pa…
  GET|HEAD        admin/top-ads/{record}/edit filament.admin.resources.top-ads.edit › App\Filament\Resources\TopAdResour…
  GET|HEAD        admin/vendor-categories filament.admin.resources.vendor-categories.index › App\Filament\Resources\Vend…
  GET|HEAD        admin/vendor-categories/create filament.admin.resources.vendor-categories.create › App\Filament\Resour…
  GET|HEAD        admin/vendor-categories/{record}/edit filament.admin.resources.vendor-categories.edit › App\Filament\R…
  GET|HEAD        admin/vendors filament.admin.resources.vendors.index › App\Filament\Resources\VendorResource\Pages\Lis…
  GET|HEAD        admin/vendors/create filament.admin.resources.vendors.create › App\Filament\Resources\VendorResource\P…
  GET|HEAD        admin/vendors/{record}/edit filament.admin.resources.vendors.edit › App\Filament\Resources\VendorResou…
  GET|HEAD        ads ................................................................... ads.index › AdsController@index
  POST            ads ................................................................... ads.store › AdsController@store
  GET|HEAD        ads/create .......................................................... ads.create › AdsController@create
  GET|HEAD        ads/{ad} ................................................................ ads.show › AdsController@show
  PUT|PATCH       ads/{ad} ............................................................ ads.update › AdsController@update
  DELETE          ads/{ad} .......................................................... ads.destroy › AdsController@destroy
  GET|HEAD        ads/{ad}/edit ........................................................... ads.edit › AdsController@edit
  GET|HEAD        adsplan ....................................................................................... adsplan
  GET|HEAD        advertisements/{advertisement}/adpreview . advertisements.adpreview › AdvertisementController@adpreview
  GET|HEAD        advertistments ................................... advertistments.index › AdvertisementController@index
  POST            advertistments ................................... advertistments.store › AdvertisementController@store
  GET|HEAD        advertistments/create .......................... advertistments.create › AdvertisementController@create
  GET|HEAD        advertistments/{advertistment} ..................... advertistments.show › AdvertisementController@show
  PUT|PATCH       advertistments/{advertistment} ................. advertistments.update › AdvertisementController@update
  DELETE          advertistments/{advertistment} ............... advertistments.destroy › AdvertisementController@destroy
  GET|HEAD        advertistments/{advertistment}/edit ................ advertistments.edit › AdvertisementController@edit
  GET|HEAD        api/user ..............................................................................................
  PUT             bookings/{booking}/book ............................................. bookings.book › BookingController
  PUT             bookings/{booking}/cancel .............. bookings.bookingcancel › CancelBookingController@cancelBooking
  PUT             bookings/{booking}/reqcancel ........... bookings.requestcancel › CancelBookingController@cancelRequest
  GET|POST|HEAD   broadcasting/auth .......................... Illuminate\Broadcasting › BroadcastController@authenticate
  GET|HEAD        budgetplanner ........................................................................... budgetplanner
  GET|HEAD        chatify ............................................. chatify › Chatify\Http › MessagesController@index
  POST            chatify/api/chat/auth .................. api.pusher.auth › Chatify\Http › MessagesController@pusherAuth
  POST            chatify/api/deleteConversation api.conversation.delete › Chatify\Http › MessagesController@deleteConve…
  GET|HEAD        chatify/api/download/{fileName} . api.attachments.download › Chatify\Http › MessagesController@download
  POST            chatify/api/favorites .................. api.favorites › Chatify\Http › MessagesController@getFavorites
  POST            chatify/api/fetchMessages ................ api.fetch.messages › Chatify\Http › MessagesController@fetch
  GET|HEAD        chatify/api/getContacts .............. api.contacts.get › Chatify\Http › MessagesController@getContacts
  POST            chatify/api/idInfo ......................... api.idInfo › Chatify\Http › MessagesController@idFetchData
  POST            chatify/api/makeSeen ....................... api.messages.seen › Chatify\Http › MessagesController@seen
  GET|HEAD        chatify/api/search .............................. api.search › Chatify\Http › MessagesController@search
  POST            chatify/api/sendMessage ..................... api.send.message › Chatify\Http › MessagesController@send
  POST            chatify/api/setActiveStatus .. api.activeStatus.set › Chatify\Http › MessagesController@setActiveStatus
  POST            chatify/api/shared ........................ api.shared › Chatify\Http › MessagesController@sharedPhotos
  POST            chatify/api/star ................................ api.star › Chatify\Http › MessagesController@favorite
  POST            chatify/api/updateSettings ....... api.avatar.update › Chatify\Http › MessagesController@updateSettings
  POST            chatify/chat/auth .......................... pusher.auth › Chatify\Http › MessagesController@pusherAuth
  POST            chatify/deleteConversation . conversation.delete › Chatify\Http › MessagesController@deleteConversation
  POST            chatify/deleteMessage ................ message.delete › Chatify\Http › MessagesController@deleteMessage
  GET|HEAD        chatify/download/{fileName} ......... attachments.download › Chatify\Http › MessagesController@download
  POST            chatify/favorites .......................... favorites › Chatify\Http › MessagesController@getFavorites
  POST            chatify/fetchMessages ........................ fetch.messages › Chatify\Http › MessagesController@fetch
  GET|HEAD        chatify/getContacts ...................... contacts.get › Chatify\Http › MessagesController@getContacts
  GET|HEAD        chatify/group/{id} .................................... group › Chatify\Http › MessagesController@index
  POST            chatify/idInfo .......................................... Chatify\Http › MessagesController@idFetchData
  POST            chatify/makeSeen ............................... messages.seen › Chatify\Http › MessagesController@seen
  GET|HEAD        chatify/search ...................................... search › Chatify\Http › MessagesController@search
  POST            chatify/sendMessage ............................. send.message › Chatify\Http › MessagesController@send
  POST            chatify/setActiveStatus .......... activeStatus.set › Chatify\Http › MessagesController@setActiveStatus
  POST            chatify/shared ................................ shared › Chatify\Http › MessagesController@sharedPhotos
  POST            chatify/star ........................................ star › Chatify\Http › MessagesController@favorite
  POST            chatify/updateContacts .......... contacts.update › Chatify\Http › MessagesController@updateContactItem
  POST            chatify/updateSettings ............... avatar.update › Chatify\Http › MessagesController@updateSettings
  GET|HEAD        chatify/{id} ........................................... user › Chatify\Http › MessagesController@index
  GET|HEAD        checklist ........................................... checklist.index › ClientChecklistController@index
  POST            checklist ........................................... checklist.store › ClientChecklistController@store
  GET|HEAD        checklist/create .................................. checklist.create › ClientChecklistController@create
  GET|HEAD        checklist/{checklist} ................................. checklist.show › ClientChecklistController@show
  PUT|PATCH       checklist/{checklist} ............................. checklist.update › ClientChecklistController@update
  DELETE          checklist/{checklist} ........................... checklist.destroy › ClientChecklistController@destroy
  GET|HEAD        checklist/{checklist}/edit ............................ checklist.edit › ClientChecklistController@edit
  GET|HEAD        client-guest-lists ......................... client-guest-lists.index › ClientGuestListController@index
  POST            client-guest-lists ......................... client-guest-lists.store › ClientGuestListController@store
  GET|HEAD        client-guest-lists/create ................ client-guest-lists.create › ClientGuestListController@create
  GET|HEAD        client-guest-lists/{client_guest_list} ....... client-guest-lists.show › ClientGuestListController@show
  PUT|PATCH       client-guest-lists/{client_guest_list} ... client-guest-lists.update › ClientGuestListController@update
  DELETE          client-guest-lists/{client_guest_list} . client-guest-lists.destroy › ClientGuestListController@destroy
  GET|HEAD        client-guest-lists/{client_guest_list}/edit .. client-guest-lists.edit › ClientGuestListController@edit
  GET|HEAD        clientBookings .................................. clientBookings.index › ClientWishlistController@index
  POST            clientBookings .................................. clientBookings.store › ClientWishlistController@store
  GET|HEAD        clientBookings/create ......................... clientBookings.create › ClientWishlistController@create
  GET|HEAD        clientBookings/{clientBooking} .................... clientBookings.show › ClientWishlistController@show
  PUT|PATCH       clientBookings/{clientBooking} ................ clientBookings.update › ClientWishlistController@update
  DELETE          clientBookings/{clientBooking} .............. clientBookings.destroy › ClientWishlistController@destroy
  GET|HEAD        clientBookings/{clientBooking}/edit ............... clientBookings.edit › ClientWishlistController@edit
  GET|HEAD        clientBookings/{clientbooking} ........... clientBookings.packges › ClientBookingController@packageData
  GET|HEAD        clientVendorBookings ................. clientVendorBookings.index › ClientVendorBookingController@index
  POST            clientVendorBookings ................. clientVendorBookings.store › ClientVendorBookingController@store
  GET|HEAD        clientVendorBookings/create ........ clientVendorBookings.create › ClientVendorBookingController@create
  GET|HEAD        clientVendorBookings/{clientVendorBooking} clientVendorBookings.show › ClientVendorBookingController@s…
  PUT|PATCH       clientVendorBookings/{clientVendorBooking} clientVendorBookings.update › ClientVendorBookingController…
  DELETE          clientVendorBookings/{clientVendorBooking} clientVendorBookings.destroy › ClientVendorBookingControlle…
  GET|HEAD        clientVendorBookings/{clientVendorBooking}/edit clientVendorBookings.edit › ClientVendorBookingControl…
  GET|HEAD        clienteventplanners .................... clienteventplanners.index › ClientEventPlannerController@index
  POST            clienteventplanners .................... clienteventplanners.store › ClientEventPlannerController@store
  GET|HEAD        clienteventplanners/create ........... clienteventplanners.create › ClientEventPlannerController@create
  GET|HEAD        clienteventplanners/{clienteventplanner} . clienteventplanners.show › ClientEventPlannerController@show
  PUT|PATCH       clienteventplanners/{clienteventplanner} clienteventplanners.update › ClientEventPlannerController@upd…
  DELETE          clienteventplanners/{clienteventplanner} clienteventplanners.destroy › ClientEventPlannerController@de…
  GET|HEAD        clienteventplanners/{clienteventplanner}/edit clienteventplanners.edit › ClientEventPlannerController@…
  GET|HEAD        clients ........................................................ clients.index › ClientController@index
  POST            clients ........................................................ clients.store › ClientController@store
  GET|HEAD        clients/create ............................................... clients.create › ClientController@create
  GET|HEAD        clients/{client} ................................................. clients.show › ClientController@show
  PUT|PATCH       clients/{client} ............................................. clients.update › ClientController@update
  DELETE          clients/{client} ........................................... clients.destroy › ClientController@destroy
  GET|HEAD        clients/{client}/edit ............................................ clients.edit › ClientController@edit
  GET|HEAD        contact ........................................................... contact › ContactController@contact
  GET|HEAD        curator/{path} ................................................. Awcodes\Curator › MediaController@show
  GET|HEAD        cusbookingdata/{cusbooking} .......... cusbookings.bookingdata › CustormerBookingController@bookingData
  GET|HEAD        cusbookings ...........................................................................................
  GET|HEAD        cusbookings/{cusbooking} ................ cusbookings.packages › CustormerBookingController@packageData
  PATCH           cusbookings/{cusbooking} ......... cusbookings.updatebooking › CustormerBookingController@updatebooking
  GET|HEAD        customer ............................... filament.customer.pages.dashboard › Filament\Pages › Dashboard
  POST            customer/calendar .................................. customer.calendar.store › CalendarController@store
  DELETE          customer/calendar/destroy/{id} ................. customer.calendar.destroy › CalendarController@destroy
  GET|HEAD        customer/calendar/index ............................ customer.calendar.index › CalendarController@index
  PATCH           customer/calendar/update/{id} .................... customer.calendar.update › CalendarController@update
  POST            customer/logout ...................... filament.customer.auth.logout › Filament\Http › LogoutController
  GET|HEAD        customer/register ........................................... customerreg › App\Livewire\Clientregister
  GET|HEAD        customer/updateregister ............................................. App\Livewire\UpdateClientRegister
  GET|HEAD        dashboard ................................................................................... dashboard
  GET|HEAD        error ......................................................................... PaymentController@error
  GET|HEAD        forgot-password ............... password.request › Laravel\Fortify › PasswordResetLinkController@create
  POST            forgot-password .................. password.email › Laravel\Fortify › PasswordResetLinkController@store
  POST            freepayment ............................................... freepayment › PaymentController@freepayment
  GET|HEAD        guestlist ................................................................................... guestlist
  GET|HEAD        guestlistnew ............................................ guestlistnew › App\Livewire\GuestListFilament
  GET|HEAD        livewire/livewire.js ...................... Livewire\Mechanisms › FrontendAssets@returnJavaScriptAsFile
  GET|HEAD        livewire/preview-file/{filename} livewire.preview-file › Livewire\Features › FilePreviewController@han…
  POST            livewire/update ................... livewire.update › Livewire\Mechanisms › HandleRequests@handleUpdate
  POST            livewire/upload-file ........... livewire.upload-file › Livewire\Features › FileUploadController@handle
  GET|HEAD        login ................................. login › Laravel\Fortify › AuthenticatedSessionController@create
  POST            login .......................................... Laravel\Fortify › AuthenticatedSessionController@store
  POST            logout .............................. logout › Laravel\Fortify › AuthenticatedSessionController@destroy
  GET|HEAD        merchants ............................. filament.merchants.pages.dashboard › Filament\Pages › Dashboard
  GET|HEAD        merchants/ads-packages filament.merchants.resources.ads-packages.index › App\Filament\Merchants\Resour…
  GET|HEAD        merchants/ads-packages/create filament.merchants.resources.ads-packages.create › App\Filament\Merchant…
  GET|HEAD        merchants/ads-packages/{record}/edit filament.merchants.resources.ads-packages.edit › App\Filament\Mer…
  GET|HEAD        merchants/client-vendor-bookings filament.merchants.resources.client-vendor-bookings.index › App\Filam…
  GET|HEAD        merchants/client-vendor-bookings/create filament.merchants.resources.client-vendor-bookings.create › A…
  GET|HEAD        merchants/client-vendor-bookings/{record}/edit filament.merchants.resources.client-vendor-bookings.edi…
  POST            merchants/logout .................... filament.merchants.auth.logout › Filament\Http › LogoutController
  GET|HEAD        merchants/social-networks filament.merchants.resources.social-networks.index › App\Filament\Merchants\…
  GET|HEAD        merchants/social-networks/create filament.merchants.resources.social-networks.create › App\Filament\Me…
  GET|HEAD        merchants/social-networks/{record}/edit filament.merchants.resources.social-networks.edit › App\Filame…
  GET|HEAD        merchants/themes .......................... filament.merchants.pages.themes › Hasnayeen\Themes › Themes
  GET|HEAD        merchants/vendor-advertisements filament.merchants.resources.vendor-advertisements.index › App\Filamen…
  GET|HEAD        merchants/vendor-advertisements/create filament.merchants.resources.vendor-advertisements.create › App…
  GET|HEAD        merchants/vendor-advertisements/{record} filament.merchants.resources.vendor-advertisements.view › App…
  GET|HEAD        merchants/vendor-advertisements/{record}/edit filament.merchants.resources.vendor-advertisements.edit …
  GET|HEAD        merchants/vendor-faqs filament.merchants.resources.vendor-faqs.index › App\Filament\Merchants\Resource…
  GET|HEAD        merchants/vendor-faqs/create filament.merchants.resources.vendor-faqs.create › App\Filament\Merchants\…
  GET|HEAD        merchants/vendor-faqs/{record}/edit filament.merchants.resources.vendor-faqs.edit › App\Filament\Merch…
  GET|HEAD        merchants/vendor-galleries filament.merchants.resources.vendor-galleries.index › App\Filament\Merchant…
  GET|HEAD        merchants/vendor-galleries/create filament.merchants.resources.vendor-galleries.create › App\Filament\…
  GET|HEAD        merchants/vendor-galleries/{record}/edit filament.merchants.resources.vendor-galleries.edit › App\Fila…
  GET|HEAD        merchants/vendor-top-ads filament.merchants.resources.vendor-top-ads.index › App\Filament\Merchants\Re…
  GET|HEAD        merchants/vendor-top-ads/create filament.merchants.resources.vendor-top-ads.create › App\Filament\Merc…
  GET|HEAD        merchants/vendor-top-ads/{record} filament.merchants.resources.vendor-top-ads.view › App\Filament\Merc…
  GET|HEAD        merchants/vendor-top-ads/{record}/edit filament.merchants.resources.vendor-top-ads.edit › App\Filament…
  POST            pay ................................................................... payment › PaymentController@pay
  GET|HEAD        photocollage ............................................................................. photocollage
  GET|HEAD        photocollagetemplate ............................................................. photocollagetemplate
  GET|HEAD        register ................................. register › Laravel\Fortify › RegisteredUserController@create
  POST            register ............................................. Laravel\Fortify › RegisteredUserController@store
  POST            reset-password ........................ password.update › Laravel\Fortify › NewPasswordController@store
  GET|HEAD        reset-password/{token} ................ password.reset › Laravel\Fortify › NewPasswordController@create
  GET|HEAD        sanctum/csrf-cookie ................. sanctum.csrf-cookie › Laravel\Sanctum › CsrfCookieController@show
  POST            send-email ................................................. contact.send › ContactController@sendEmail
  GET|HEAD        sitePackages ......................................... sitePackages.index › SitePackageController@index
  POST            sitePackages ......................................... sitePackages.store › SitePackageController@store
  GET|HEAD        sitePackages/create ................................ sitePackages.create › SitePackageController@create
  GET|HEAD        sitePackages/{sitePackage} ............................. sitePackages.show › SitePackageController@show
  PUT|PATCH       sitePackages/{sitePackage} ......................... sitePackages.update › SitePackageController@update
  DELETE          sitePackages/{sitePackage} ....................... sitePackages.destroy › SitePackageController@destroy
  GET|HEAD        sitePackages/{sitePackage}/edit ........................ sitePackages.edit › SitePackageController@edit
  GET|HEAD        success ..................................................................... PaymentController@success
  GET|HEAD        topAds ........................................................... topAds.index › TopAdController@index
  POST            topAds ........................................................... topAds.store › TopAdController@store
  GET|HEAD        topAds/create .................................................. topAds.create › TopAdController@create
  GET|HEAD        topAds/{topAd} ..................................................... topAds.show › TopAdController@show
  PUT|PATCH       topAds/{topAd} ................................................. topAds.update › TopAdController@update
  DELETE          topAds/{topAd} ............................................... topAds.destroy › TopAdController@destroy
  GET|HEAD        topAds/{topAd}/edit ................................................ topAds.edit › TopAdController@edit
  GET|HEAD        two-factor-challenge two-factor.login › Laravel\Fortify › TwoFactorAuthenticatedSessionController@crea…
  POST            two-factor-challenge .................. Laravel\Fortify › TwoFactorAuthenticatedSessionController@store
  GET|HEAD        user/confirm-password ............................ Laravel\Fortify › ConfirmablePasswordController@show
  POST            user/confirm-password ........ password.confirm › Laravel\Fortify › ConfirmablePasswordController@store
  GET|HEAD        user/confirmed-password-status password.confirmation › Laravel\Fortify › ConfirmedPasswordStatusContro…
  POST            user/confirmed-two-factor-authentication two-factor.confirm › Laravel\Fortify › ConfirmedTwoFactorAuth…
  PUT             user/password ...................... user-password.update › Laravel\Fortify › PasswordController@update
  GET|HEAD        user/profile ............................ profile.show › Laravel\Jetstream › UserProfileController@show
  PUT             user/profile-information user-profile-information.update › Laravel\Fortify › ProfileInformationControl…
  POST            user/two-factor-authentication two-factor.enable › Laravel\Fortify › TwoFactorAuthenticationController…
  DELETE          user/two-factor-authentication two-factor.disable › Laravel\Fortify › TwoFactorAuthenticationControlle…
  GET|HEAD        user/two-factor-qr-code ......... two-factor.qr-code › Laravel\Fortify › TwoFactorQrCodeController@show
  GET|HEAD        user/two-factor-recovery-codes two-factor.recovery-codes › Laravel\Fortify › RecoveryCodeController@in…
  POST            user/two-factor-recovery-codes ......................... Laravel\Fortify › RecoveryCodeController@store
  GET|HEAD        user/two-factor-secret-key two-factor.secret-key › Laravel\Fortify › TwoFactorSecretKeyController@show
  GET|HEAD        vendor/register ........................................................... App\Livewire\vendorregister
  GET|HEAD        vendor/updateregister ............................................... App\Livewire\UpdateVendorRegister
  GET|HEAD        vendorCategories .............................. vendorCategories.index › VendorCategoryController@index
  POST            vendorCategories .............................. vendorCategories.store › VendorCategoryController@store
  GET|HEAD        vendorCategories/create ..................... vendorCategories.create › VendorCategoryController@create
  GET|HEAD        vendorCategories/{vendorCategory} ............... vendorCategories.show › VendorCategoryController@show
  PUT|PATCH       vendorCategories/{vendorCategory} ........... vendorCategories.update › VendorCategoryController@update
  DELETE          vendorCategories/{vendorCategory} ......... vendorCategories.destroy › VendorCategoryController@destroy
  GET|HEAD        vendorCategories/{vendorCategory}/edit .......... vendorCategories.edit › VendorCategoryController@edit
  GET|HEAD        vendorbooking .........................................................................................
  GET|HEAD        vendordetails ........................................................................... vendordetails
  GET|HEAD        vendors ........................................................ vendors.index › VendorController@index
  POST            vendors ........................................................ vendors.store › VendorController@store
  GET|HEAD        vendors/create ............................................... vendors.create › VendorController@create
  GET|HEAD        vendors/{vendor} ................................................. vendors.show › VendorController@show
  PUT|PATCH       vendors/{vendor} ............................................. vendors.update › VendorController@update
  DELETE          vendors/{vendor} ........................................... vendors.destroy › VendorController@destroy
  GET|HEAD        vendors/{vendor}/edit ............................................ vendors.edit › VendorController@edit
  POST            wishlist/add .................................... wishlist.add › ClientWishlistController@addToWishlist
  GET|HEAD        wishlist/check ................................ wishlist.check › ClientWishlistController@checkWishlist
  POST            wishlist/toggle ............................. wishlist.toggle › ClientWishlistController@toggleWishlist
