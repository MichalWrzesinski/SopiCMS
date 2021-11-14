<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Page\PageController;
use App\Http\Controllers\Page\PageAdminController;
use App\Http\Controllers\Blog\BlogController;
use App\Http\Controllers\Blog\BlogAdminController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserAdminController;
use App\Http\Controllers\Item\ItemController;
use App\Http\Controllers\Item\ItemUserController;
use App\Http\Controllers\Item\ItemAdminController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BanController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\Payment\PaymentAdminController;

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

/*
 * Home
 */
Route::get('/', [HomeController::class, 'index'])
    ->name('home');

/*
 * Contact
 */
Route::get('/kontakt', [ContactController::class, 'form'])
    ->name('contact');

Route::post('/kontakt', [ContactController::class, 'send'])
    ->name('contact.send');

/*
 * Blog
 */
Route::get('/blog', [BlogController::class, 'list'])
    ->name('blog');

Route::get('/blog/{id}/{url}', [BlogController::class, 'show'])
    ->name('blog.show');

/*
 * User
 */
Route::group(['prefix' => '/konto/'], function() {

    Route::group(['middleware' => ['auth']], function () {

        Route::get('', [UserController::class, 'dashboard'])
            ->name('user.dashboard');

        Route::get('wyloguj', [UserController::class, 'logout'])
            ->name('user.logout');

        /*
         * Setting
         */
        Route::group(['prefix' => 'ustawienia/'], function() {

            Route::get('', [UserController::class, 'manage'])
                ->name('user.manage');

            Route::post('dane', [UserController::class, 'manageDataSend'])
                ->name('user.manage.data.send');

            Route::post('haslo', [UserController::class, 'managePasswordSend'])
                ->name('user.manage.password.send');

            Route::post('avatar', [UserController::class, 'manageAvatarSend'])
                ->name('user.manage.avatar.send');

            Route::post('usun-avatar', [UserController::class, 'manageAvatarDelete'])
                ->name('user.manage.avatar.delete');
        });

        /*
         * Items
         */
        Route::group(['prefix' => 'ogloszenia/'], function() {

            Route::get('', [ItemUserController::class, 'list'])
                ->name('user.item.list');

            Route::get('dodaj', [ItemUserController::class, 'add'])
                ->name('user.item.add');

            Route::post('dodaj', [ItemUserController::class, 'addSend'])
                ->name('user.item.add.send');

            Route::get('edytuj/{id}', [ItemUserController::class, 'edit'])
                ->name('user.item.edit');

            Route::post('edytuj/{id}', [ItemUserController::class, 'editSend'])
                ->name('user.item.edit.send');

            Route::post('usun/{id}', [ItemUserController::class, 'deleteSend'])
                ->name('user.item.delete.send');

            Route::get('obserwowane', [ItemUserController::class, 'favorite'])
                ->name('user.item.favorite.list');
        });
    });

    Route::group(['middleware' => ['guest']], function () {

        Route::get('logowanie', [UserController::class, 'login'])
            ->name('user.login');

        Route::post('logowanie', [UserController::class, 'loginSend'])
            ->name('user.login.send');

        Route::get('rejestracja', [UserController::class, 'register'])
            ->name('user.register');

        Route::post('rejestracja', [UserController::class, 'registerSend'])
            ->name('user.register.send');

        Route::get('aktywacja', [UserController::class, 'activate'])
            ->name('user.activate');

        Route::get('aktywacja/{id}/{hash}', [UserController::class, 'activateSend'])
            ->name('user.activate.send');

        Route::get('haslo', [UserController::class, 'password'])
            ->name('user.password');

        Route::post('haslo', [UserController::class, 'passwordSend'])
            ->name('user.password.send');

        Route::get('haslo/{id}/{hash}', [UserController::class, 'passwordNew'])
            ->name('user.password.new');

        Route::post('haslo/{id}/{hash}/zmien', [UserController::class, 'passwordNewSend'])
            ->name('user.password.new.send');
    });
});

/*
 * Items
 */
Route::get('/ogloszenia/{search?}', [ItemController::class, 'list'])
    ->where('search', '(.*)')
    ->name('item.list');

Route::post('/szukaj', [ItemController::class, 'search'])
    ->name('item.search.send');

Route::get('/ogloszenie/{id}/{url}', [ItemController::class, 'show'])
    ->name('item.show');

/*
     *  Gallery
     */
Route::group(['prefix' => 'galeria/', 'middleware' => ['auth']], function() {

    Route::post('dodaj/{module}/{moduleId}', [GalleryController::class, 'addSend'])
        ->name('gallery.add.send');

    Route::get('glowne/{module}/{moduleId}/{id}', [GalleryController::class, 'coverSend'])
        ->name('gallery.cover.send');

    Route::get('usun/{id}', [GalleryController::class, 'deleteSend'])
        ->name('gallery.delete.send');
});

/*
 * Admin
 */
Route::group(['prefix' => '/admin/', 'middleware' => ['auth', 'can:admin']], function() {

    Route::get('', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    /*
     * Items
     */
    Route::group(['prefix' => 'ogloszenia/'], function() {

        Route::get('lista', [ItemAdminController::class, 'list'])
            ->name('admin.items.list');

        Route::post('lista', [ItemAdminController::class, 'list'])
            ->name('admin.items.list.send');

        Route::get('edytuj/{id}', [ItemAdminController::class, 'edit'])
            ->name('admin.items.edit');

        Route::post('edytuj/{id}', [ItemAdminController::class, 'editSend'])
            ->name('admin.items.edit.send');

        Route::post('publikacja/{id}', [ItemAdminController::class, 'publicSend'])
            ->name('admin.items.public.send');

        Route::post('usun/{id}', [ItemAdminController::class, 'deleteSend'])
            ->name('admin.items.delete.send');

        Route::get('do-aktywacji', [ItemAdminController::class, 'listDeactive'])
            ->name('admin.items.list.inactive');

        Route::get('ustawienia', [ItemAdminController::class, 'settings'])
            ->name('admin.items.settings');

        Route::post('ustawienia', [ItemAdminController::class, 'settingsSend'])
            ->name('admin.items.settings.send');
    });

    /*
     * Categories
     */
    Route::group(['prefix' => 'kategorie/'], function() {

        Route::get('', [CategoryController::class, 'list'])
            ->name('admin.categories.list');

        Route::post('dodaj', [CategoryController::class, 'addSend'])
            ->name('admin.categories.add.send');

        Route::get('{id}/do-gory', [CategoryController::class, 'up'])
            ->name('admin.categories.up.send');

        Route::get('{id}/w-dol', [CategoryController::class, 'down'])
            ->name('admin.categories.down.send');

        Route::get('edytuj/{id}', [CategoryController::class, 'edit'])
            ->name('admin.categories.edit');

        Route::post('edytuj/{id}', [CategoryController::class, 'editSend'])
            ->name('admin.categories.edit.send');

        Route::post('usun/{id}', [CategoryController::class, 'deleteSend'])
            ->name('admin.categories.delete.send');
    });

    /*
     * Users
     */
    Route::group(['prefix' => 'uzytkownicy/'], function() {

        Route::get('lista', [UserAdminController::class, 'list'])
            ->name('admin.users.list');

        Route::post('lista', [UserAdminController::class, 'list'])
            ->name('admin.users.list.send');

        Route::post('dodaj', [UserAdminController::class, 'addSend'])
            ->name('admin.users.add.send');

        Route::get('edytuj/{id}', [UserAdminController::class, 'edit'])
            ->name('admin.users.edit');

        Route::post('edytuj/{id}', [UserAdminController::class, 'editSend'])
            ->name('admin.users.edit.send');

        Route::post('haslo/{id}', [UserAdminController::class, 'passwordSend'])
            ->name('admin.users.password.send');

        Route::post('usun/{id}', [UserAdminController::class, 'deleteSend'])
            ->name('admin.users.delete.send');

        Route::post('avatar/{id}', [UserAdminController::class, 'avatarAddSend'])
            ->name('admin.users.avatar.add.send');

        Route::post('avatar/{id}/usun', [UserAdminController::class, 'avatarDeleteSend'])
            ->name('admin.users.avatar.delete.send');

        Route::get('platnosci', [PaymentAdminController::class, 'list'])
            ->name('admin.users.payments');

        Route::get('banicja', [BanController::class, 'list'])
            ->name('admin.users.bans');

        Route::post('banicja', [BanController::class, 'list'])
            ->name('admin.users.bans.send');

        Route::post('banicja/dodaj', [BanController::class, 'addSend'])
            ->name('admin.users.bans.add.send');

        Route::get('banicja/usun/{id}', [BanController::class, 'deleteSend'])
            ->name('admin.users.bans.delete.send');

        Route::get('newsletter', [UserAdminController::class, 'newsletter'])
            ->name('admin.users.newsletter');

        Route::post('newsletter', [UserAdminController::class, 'newsletterSend'])
            ->name('admin.users.newsletter.send');
    });

    /*
     * Pages
     */
    Route::group(['prefix' => 'tresci/'], function() {

        Route::group(['prefix' => 'strony/'], function() {

            Route::get('', [PageAdminController::class, 'list'])
                ->name('admin.pages.list');

            Route::post('', [PageAdminController::class, 'list'])
                ->name('admin.pages.list.send');

            Route::post('dodaj', [PageAdminController::class, 'addSend'])
                ->name('admin.pages.add.send');

            Route::get('edytuj/{id}', [PageAdminController::class, 'edit'])
                ->name('admin.pages.edit');

            Route::post('edytuj/{id}', [PageAdminController::class, 'editSend'])
                ->name('admin.pages.edit.send');

            Route::post('usun/{id}', [PageAdminController::class, 'deleteSend'])
                ->name('admin.pages.delete.send');
        });

        /*
         * Blog
         */
        Route::group(['prefix' => 'blog/'], function() {

            Route::get('', [BlogAdminController::class, 'list'])
                ->name('admin.blog.list');

            Route::post('', [BlogAdminController::class, 'list'])
                ->name('admin.blog.list.send');

            Route::post('dodaj', [BlogAdminController::class, 'addSend'])
                ->name('admin.blog.add.send');

            Route::get('edytuj/{id}', [BlogAdminController::class, 'edit'])
                ->name('admin.blog.edit');

            Route::post('edytuj/{id}', [BlogAdminController::class, 'editSend'])
                ->name('admin.blog.edit.send');

            Route::post('usun/{id}', [BlogAdminController::class, 'deleteSend'])
                ->name('admin.blog.delete.send');
        });
    });

    /*
     * Setting
     */
    Route::group(['prefix' => 'ustawienia/'], function() {

        Route::get('seo', [AdminController::class, 'seo'])
            ->name('admin.settings.seo');

        Route::post('seo', [AdminController::class, 'seoSend'])
            ->name('admin.settings.seo.send');

        Route::get('social-media', [AdminController::class, 'socialmedia'])
            ->name('admin.settings.socialmedia');

        Route::post('social-media', [AdminController::class, 'socialmediaSend'])
            ->name('admin.settings.socialmedia.send');

        Route::get('e-mail', [AdminController::class, 'email'])
            ->name('admin.settings.email');

        Route::post('e-mail', [AdminController::class, 'emailSend'])
            ->name('admin.settings.email.send');

        Route::get('reklamy', [AdminController::class, 'ads'])
            ->name('admin.settings.ads');

        Route::post('reklamy', [AdminController::class, 'adsSend'])
            ->name('admin.settings.ads.send');

        Route::get('inne', [AdminController::class, 'other'])
            ->name('admin.settings.other');

        Route::post('inne', [AdminController::class, 'otherSend'])
            ->name('admin.settings.other.send');
    });
});

/*
 * Image
 */
Route::get('/image/{width}x{height}/{path?}', [ImageController::class, 'thumbnail'])
    ->where('path', '(.*)')
    ->name('image.thumbnail');

Route::get('/image/{path?}', [ImageController::class, 'show'])
    ->where('path', '(.*)')
    ->name('image.show');

/*
 * Last route!
 */
Route::get('{url}', [PageController::class, 'show'])
    ->name('page.show');
