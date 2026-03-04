<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\StudentMiddleware;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\FronStudentController;
use App\Http\Controllers\PostController;

use App\Http\Controllers\Coursecontroller;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TestCreateController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\CoinsController;
use App\Http\Controllers\PurchasedController;
use App\Http\Controllers\PDfNoteController;
use App\Http\Controllers\CreatePDFNotesController;
use App\Http\Controllers\HomepdfController;
use App\Http\Controllers\VideorecordingController;
use App\Http\Controllers\CreatevideoController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\HomeLiveClassCotronller;
use App\Http\Controllers\QuestionToVolumeController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\QuestionBankController;
use CKSource\CKFinderBridge\Controller\CKFinderController;
use App\Http\Controllers\HomePractiseController;
use App\Http\Controllers\HomeLiveController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeBlogController;
use App\Http\Controllers\MockTestVolumeController;
use App\Http\Controllers\MockTestController;
 use App\Http\Controllers\HomeMockTestController;

Route::get('/',[HomeController::class,'index'])->name('home');

Route::get('/term_and_conditions', [HomeController::class, 'term_and_conditions']);
Route::get('/privacy_policy', [HomeController::class, 'privacy_policy']);
Route::get('/refund_policy', [HomeController::class, 'refund_policy']);
Route::get('/shipping_cancellation', [HomeController::class, 'shipping_cancellation']);


Route::get('/login',[AuthController::class,'login'])->name('login');



Route::post('/student/login',[AuthController::class,'userlogin'])->name('student.login');
Route::get('/referral/{id}',[AuthController::class,'register_refreal']);
Route::get('/student/register',[AuthController::class,'register'])->name('student.register');
Route::post('/student/store',[AuthController::class,'store'])->name('student.store');
Route::post('/student/sendOtp',[AuthController::class,'send_otp'])->name('student.send.otp');
Route::get('/student/forgot',[AuthController::class,'forgot'])->name('student.forgoton');
Route::get('email-otp-confirm',[AuthController::class, 'emailConfirm'])->name('email.otp.form');
Route::post('email-otp-verify',[AuthController::class, 'emailverify'])->name('email.otp.verify');
 Route::post('otp-verify',[AuthController::class, 'verify_otp'])->name('otp.verify');


Route::post('/create-order', [PaymentController::class, 'createOrder'])->name('create.order');
Route::post('/verify-payment', [PaymentController::class, 'verifyPayment'])->name('verify.payment');
Route::get('/payment', [PaymentController::class, 'payment'])->name('payment');



Route::post('forgot-password',[ForgotPasswordController::class, 'sendOtp'])->name('password.email');
Route::get('verify-otp', [ForgotPasswordController::class, 'showOtpForm'])->name('password.otp.form');
Route::post('verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('password.otp.verify');
Route::get('reset-password', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset.form');
Route::post('reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');


Route::get('/admin',[AdminController::class,'index'])->name('admin.login');
Route::post('/admin/login/store',[AuthController::class,'userlogin'])->name('admin.login.store');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::group(['prefix' => 'ckfinder', 'middleware' => ['web']], function () {
    Route::any('/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
        ->name('ckfinder_connector');
    Route::any('/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
        ->name('ckfinder_browser');
});
//blogs
Route::get('/blogs',[HomeBlogController::class,'blogs'])->name('blogs');
Route::get('/blog/{id}',[HomeBlogController::class,'blog_show'])->name('blog.show');
Route::get('/offline-classes',function(){
    return view('offline');
})->name('offline.classes');

 Route::get('/student/dailycurrentaffair',[FronStudentController::class,'index'])->name('dailyafairs');
    Route::get('/student/day_type/{id}/{category}',[FronStudentController::class,'read_document'])->name('dailyafairs');
    Route::get('/student/read_content/{id}',[FronStudentController::class,'read_content'])->name('read_content');
    Route::get('/daily-current-affair/category', [FronStudentController::class, 'category'])->name('dailyafairs.category');
    //batches
     Route::get('/batches_series',[HomeController::class,'batches_series'])->name('batches.series');
     Route::get('/batches_valume/{id}',[HomeController::class,'batches_valume'])->name('batches.valume');
    Route::get('/cources',[HomeController::class,'cources'])->name('courses');
    Route::get('/cources_type/{id}',[HomeController::class,'cources_type'])->name('cources.type');
    Route::get('/test_series',[HomeController::class,'test_series'])->name('test.series');
    Route::get('/tests_valume/{id}',[HomeController::class,'tests_valume'])->name('tests.valume');

    Route::get('/notes',[HomepdfController::class,'note_series'])->name('notes.series');
    Route::get('/notes_valume/{id}',[HomepdfController::class,'note_valume'])->name('notes.valume');
    Route::get('/noteshow/{id}',[HomepdfController::class,'noteshow'])->name('notes.show');
    Route::get('/liveclass/{test_id}/{volume_id}',[HomeLiveClassCotronller::class,'liveclass'])->name('liveclass.show');
        Route::get('/Mocktest-volume',[HomeMockTestController::class,'mocktest_volume'])->name('mocktest.volume');

Route::middleware(['auth', StudentMiddleware::class])->group(function () {
   
    Route::get('/student/dashboard',[StudentDashboardController::class, 'index'])->name('student.dashboard');
    Route::get('/student/booking',[StudentDashboardController::class, 'booking'])->name('student.booking');
    Route::get('/student/coins',[StudentDashboardController::class, 'coins'])->name('student.coins');
        Route::get('/student/profile',[StudentDashboardController::class, 'profile'])->name('student.profile');
        Route::post('/student/profile/update',[StudentDashboardController::class, 'updateProfile'])->name('student.profile.update');

   
     Route::get('/Join/class/{id}',[HomeController::class,'join_class'])->name('join.class');
     Route::get('/previous/class/{id}',[HomeController::class,'previous_class'])->name('previous.class');
     Route::get('/purchase/class/{id}',[HomeLiveClassCotronller::class,'checkout'])->name('purchase.class');
    Route::get('/student/post/{id}', [PostController::class, 'show'])->name('post.show');
    
    Route::post('/save-answer', [HomeLiveClassCotronller::class, 'saveAnswer'])->name('liveclass.saveAnswer');
    Route::post('/submit-test', [HomeLiveClassCotronller::class, 'submitTest'])->name('liveclass.submitTest');


    Route::get('/recording_room',[VideoController::class,'index']);
    Route::get('/video_valume/{id}',[VideoController::class,'video_valume']);
    Route::get('/purchase/video/{id}',[VideoController::class,'checkout']);

    Route::get('/video/{id}',[VideoController::class,'video_show']);
    Route::get('/purchase/notes/{id}',[HomepdfController::class,'checkout']);
    Route::get('/pdf/{id}',[HomeController::class,'pdf_show']);
    Route::get('/pdfcontent/{id}',[HomeController::class,'pdfcontent']);
    Route::get('/pdfanswer/{id}',[HomeController::class,'pdfanswer']);
    Route::get('/purchase/test/{id}',[HomeController::class,'checkout']);
    Route::post('/coins/detucts',[CoinsController::class,'coins_detucts'])->name('save.coins');
    Route::post('/coins/restore',[CoinsController::class,'restore'])->name('resotore.coins');
    Route::post('/student/respurchased',[PurchasedController::class,'purchased'])->name('purchased.saved');
    Route::post('/student/notes/respurchased',[PurchasedController::class,'purchasednotes'])->name('notes.purchased.saved');

    Route::get('/student/success',[PurchasedController::class,'success']);
    Route::get('/student/notes/success',[PurchasedController::class,'successnotes']);
 
    Route::get('/student/practise/{id}',[HomePractiseController::class,'index'])->name('practise.index');
    Route::get('/student/practise/instructions',[HomePractiseController::class,'instructions'])->name('practise.instructions');
    Route::get('/student/practise/start',[HomePractiseController::class,'start'])->name('practise.start');
    Route::get('/student/practise/result',[HomePractiseController::class,'result'])->name('practise.result');
    Route::get('/student/live/{id}',[HomeLiveController::class,'index'])->name('live.index');
    Route::post('/student/live/instructions',[HomeLiveController::class,'instructions'])->name('live.instructions');
    Route::post('/student/live/start',[HomeLiveController::class,'start'])->name('live.start');
    Route::post('/student/live/result',[HomeLiveController::class,'result'])->name('live.result');
    Route::post('/student/practise/result',
    [HomePractiseController::class,'result']
)->name('practise.result');
Route::get('student/get-question/{id}', [HomeLiveController::class, 'getQuestion'])->name('get.question');
Route::get('admin/get-question/{id}', [SectionController::class, 'getQuestion'])->name('get.question');
Route::get('/result/download/{id}', [HomeLiveController::class, 'downloadPdf'])
    ->name('result.download');
    
});


Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
    Route::get('/admin/student',[StudentController::class,'index'])->name('all.students');
    Route::get('/admin/notes',[NotesController::class,'index'])->name('all.notes');
    Route::get('/admin/notes/add',[NotesController::class,'add'])->name('add.notes');
    Route::post('/admin/notes/store',[NotesController::class,'store'])->name('notes.store');
    Route::get('/admin/notes/edit/{id}',[NotesController::class,'edit'])->name('notes.edit');
    Route::post('/admin/notes/update/{id}',[NotesController::class,'update'])->name('dailycurrent.update');
    Route::get('/admin/notes/delete/{id}',[NotesController::class,'delete'])->name('notes.delete');

    Route::get('/admin/courses/all',[Coursecontroller::class,'index'])->name('all.courses');
    Route::get('/admin/courses/add',[Coursecontroller::class,'add'])->name('add.courses');
    Route::post('/admin/courses/store',[Coursecontroller::class,'store'])->name('courses.store');

    Route::get('admin/courses/edit/{id}', [Coursecontroller::class, 'edit'])->name('courses.edit');
    Route::put('admin/courses/update/{id}', [Coursecontroller::class, 'update'])->name('courses.update');
    
    // Extra Routes
    Route::get('admin/courses/delete/{id}', [Coursecontroller::class, 'destroy'])->name('courses.delete');
    Route::get('admin/courses/delete/permanent/{id}', [Coursecontroller::class, 'destroy_permanent'])->name('courses.delete.permanent'); 
    Route::get('admin/courses/restore/{id}', [Coursecontroller::class, 'restore'])->name('courses.restore');  
    Route::get('admin/courses/toggle/{id}', [Coursecontroller::class, 'toggleActive'])->name('courses.toggle'); 
    
    //batch roouts
    Route::get('cource/batch/{id}', [BatchController::class, 'index'])->name('batch.all'); 
    Route::get('admin/batch/add', [BatchController::class, 'add'])->name('add.batch');     Route::get('admin/batch/add', [BatchController::class, 'add'])->name('add.batch'); 
    Route::get('admin/batch/edit/{id}', [BatchController::class, 'edit'])->name('edit.batch'); 

    Route::post('admin/batch/store', [BatchController::class, 'store'])->name('batch.store'); 
        Route::put('admin/batch/update/{id}', [BatchController::class, 'update'])->name('batch.update'); 

    Route::get('admin/batch/delete/{id}', [BatchController::class, 'destroy'])->name('batch.delete');  
        Route::get('admin/batch/delete/permanent/{id}', [BatchController::class, 'destroy_permanent'])->name('batch.delete.permanent');  

    Route::get('admin/batch/restore/{id}', [BatchController::class, 'restore'])->name('batch.restore');  
    Route::get('admin/batch/toggle/{id}', [BatchController::class, 'toggleActive'])->name('batch.toggle');



    //classess routs
    Route::get('admin/class/all', [ClassController::class, 'index'])->name('class.all'); 
    Route::get('admin/class/add', [ClassController::class, 'add'])->name('add.class'); 
    Route::get('admin/class/edit/{id}', [ClassController::class, 'edit'])->name('add.edit'); 
    Route::post('admin/class/store', [ClassController::class, 'store'])->name('class.store'); 
    Route::put('admin/class/update/{id}', [ClassController::class, 'update'])->name('class.update'); 
    Route::get('admin/class/delete/{id}', [ClassController::class, 'destroy'])->name('class.delete');
    Route::get('admin/class/delete/permanent/{id}', [ClassController::class, 'destroy_permanent'])->name('class.delete.permanent');  
    Route::get('admin/class/restore/{id}', [ClassController::class, 'restore'])->name('class.restore');  
    Route::get('admin/class/toggle/{id}', [ClassController::class, 'toggleActive'])->name('class.toggle');


    //teachers routs
    Route::get('admin/teacher/all/{id}', [TeacherController::class, 'index'])->name('teacher.all'); 
    Route::get('admin/teacher/add', [TeacherController::class, 'add'])->name('add.teacher'); 
    Route::post('admin/teacher/store', [TeacherController::class, 'store'])->name('teacher.store'); 
    Route::get('admin/teacher/delete/{id}', [TeacherController::class, 'destroy'])->name('teacher.delete');  
    Route::get('admin/teacher/restore/{id}', [TeacherController::class, 'restore'])->name('teacher.restore');  
    Route::get('admin/teacher/toggle/{id}', [TeacherController::class, 'toggleActive'])->name('teacher.toggle');



    //test volume routs
    Route::get('admin/test/all', [TestController::class, 'index'])->name('test.all'); 
    Route::get('admin/test/add', [TestController::class, 'add'])->name('add.test'); 
    Route::get('admin/test/edit/{id}', [TestController::class, 'show']); 
    Route::post('admin/test/update/{id}', [TestController::class, 'update'])->name('test.update'); 

    Route::post('admin/test/store', [TestController::class, 'store'])->name('test.store'); 
    Route::get('admin/test/delete/{id}', [TestController::class, 'destroy'])->name('test.delete');  
    Route::get('admin/test/delete/permanent/{id}', [TestController::class, 'destroy_permanent'])->name('test.delete.permanent'); 
    Route::get('admin/test/restore/{id}', [TestController::class, 'restore'])->name('test.restore');  
    Route::get('admin/test/toggle/{id}', [TestController::class, 'toggleActive'])->name('test.toggle');


//test create routs
Route::get('admin/test_create/{id}', [TestCreateController::class, 'index']); 
Route::get('admin/test_creates/add', [TestCreateController::class, 'add'])->name('add.createst'); 
Route::post('admin/test_creates/store', [TestCreateController::class, 'store'])->name('createst.store'); 
Route::get('admin/test_creates/edit/{id}', [TestCreateController::class, 'edit'])->name('createst.edit'); 
Route::put('admin/test_creates/edit/{id}', [TestCreateController::class, 'update'])->name('createst.update'); 

Route::get('admin/test_creates/delete/{id}', [TestCreateController::class, 'destroy'])->name('createst.delete');  
Route::get('admin/test_creates/restore/{id}', [TestCreateController::class, 'restore'])->name('createst.restore');  
Route::get('admin/test_creates/toggle/{id}', [TestCreateController::class, 'toggleActive'])->name('createst.toggle');
//mock test
//test volume routs
    Route::get('admin/mock_test/all', [MockTestVolumeController::class, 'index'])->name('mock_test.all'); 
    Route::get('admin/mock_test/add', [MockTestVolumeController::class, 'add'])->name('add.mock_test'); 
    Route::get('admin/mock_test/edit/{id}', [MockTestVolumeController::class, 'show']); 
    Route::post('admin/mock_test/update/{id}', [MockTestVolumeController::class, 'update'])->name('update.mock_test'); 

    Route::post('admin/mock_test/store', [MockTestVolumeController::class, 'store'])->name('mock_test.store'); 
    Route::get('admin/mock_test/delete/{id}', [MockTestVolumeController::class, 'destroy'])->name('mock_test.delete');  
    Route::get('admin/mock_test/delete/permanent/{id}', [MockTestVolumeController::class, 'destroy_permanent'])->name('mock_test.delete.permanent'); 
    Route::get('admin/mock_test/restore/{id}', [MockTestVolumeController::class, 'restore'])->name('mock_test.restore');  
    Route::get('admin/mock_test/toggle/{id}', [MockTestVolumeController::class, 'toggleActive'])->name('mock_test.toggle');


//mock test create routs
Route::get('admin/mock_test_create/{id}', [MockTestController::class, 'index']); 
Route::get('admin/mock_test_creates/add', [MockTestController::class, 'add'])->name('add.createst'); 
Route::post('admin/mock_test_creates/store', [MockTestController::class, 'store'])->name('createmock.store'); 
Route::get('admin/mock_test_creates/edit/{id}', [MockTestController::class, 'edit'])->name('createmock.edit'); 
Route::put('admin/mock_test_creates/edit/{id}', [MockTestController::class, 'update'])->name('createmock.update'); 

Route::get('admin/mock_test_creates/delete/{id}', [MockTestController::class, 'destroy'])->name('createmock.delete');  
Route::get('admin/mock_test_creates/restore/{id}', [MockTestController::class, 'restore'])->name('createmock.restore');  
Route::get('admin/mock_test_creates/toggle/{id}', [MockTestController::class, 'toggleActive'])->name('createmock.toggle');
    
//craete questions
Route::get('admin/questions/all', [QuestionsController::class, 'index'])->name('questions.all'); 
Route::get('admin/questions/add', [QuestionsController::class, 'add'])->name('add.questions'); 
Route::post('admin/questions/store', [QuestionsController::class, 'store'])->name('questions.store'); 
Route::get('admin/questions/delete/{id}', [QuestionsController::class, 'destroy'])->name('questions.delete');  
Route::get('admin/questions/restore/{id}', [QuestionsController::class, 'restore'])->name('questions.restore');  
Route::get('admin/questions/toggle/{id}', [QuestionsController::class, 'toggleActive'])->name('questions.toggle');





//create tags
Route::get('language',[LanguageController::class, 'index'])->name('admin.language');
Route::get('admin/language/add', [LanguageController::class, 'add'])->name('add.language'); 
Route::get('admin/language/edit/{id}', [LanguageController::class, 'edit'])->name('edit.language'); 
Route::post('admin/language/update/{id}', [LanguageController::class, 'update'])->name('update.language'); 
Route::post('admin/language/store', [LanguageController::class, 'store'])->name('language.store'); 
Route::get('admin/language/delete/{id}', [LanguageController::class, 'destroy'])->name('language.delete');  
Route::get('admin/language/restore/{id}', [LanguageController::class, 'restore'])->name('language.restore');  
Route::get('admin/language/toggle/{id}', [LanguageController::class, 'toggleActive'])->name('language.toggle');

//create tags
Route::get('questions/tag/{id}',[TagController::class, 'index']);
Route::get('admin/tag/add', [TagController::class, 'add'])->name('add.tags'); 
Route::post('admin/tag/store', [TagController::class, 'store'])->name('tags.store'); 
Route::get('admin/tag/delete/{id}', [TagController::class, 'destroy'])->name('tags.delete');  
Route::get('admin/tag/restore/{id}', [TagController::class, 'restore'])->name('tags.restore');  
Route::get('admin/tag/toggle/{id}', [TagController::class, 'toggleActive'])->name('tags.toggle');



//create questionBanks
Route::get('questions_bank/all/{id}',[QuestionBankController::class, 'index']);
Route::get('admin/questions_bank/add', [QuestionBankController::class, 'add'])->name('add.questionbank'); 
Route::post('admin/questions_bank/store', [QuestionBankController::class, 'store'])->name('questionbank.store'); 
Route::get('admin/questions_bank/delete/{id}', [QuestionBankController::class, 'destroy'])->name('questionbank.delete');  
Route::get('admin/questions_bank/restore/{id}', [QuestionBankController::class, 'restore'])->name('questionbank.restore');  
Route::get('admin/questions_bank/toggle/{id}', [QuestionBankController::class, 'toggleActive'])->name('questionbank.toggle');


//create Packegs
Route::get('packages/all',[PackageController::class, 'index'])->name('packages.all');
Route::get('admin/packages/add', [PackageController::class, 'add'])->name('add.packages'); 
Route::post('admin/packages/store', [PackageController::class, 'store'])->name('packages.store'); 
Route::get('admin/packages/delete/{id}', [PackageController::class, 'destroy'])->name('packages.delete');  
Route::get('admin/packages/restore/{id}', [PackageController::class, 'restore'])->name('packages.restore');  
Route::get('admin/packages/toggle/{id}', [PackageController::class, 'toggleActive'])->name('packages.toggle');


//create section
Route::get('admin/section/{id}',[SectionController::class, 'index'])->name('section.all');
Route::get('admin/sections/add', [SectionController::class, 'add'])->name('add.sections');
Route::get('admin/section/edit/{id}', [SectionController::class, 'edit'])->name('edit.sections');
Route::put('admin/section/update/{id}', [SectionController::class, 'update'])->name('section.update');


Route::post('admin/section/store', [SectionController::class, 'store'])->name('section.store'); 
Route::get('admin/section/delete/{id}', [SectionController::class, 'destroy'])->name('section.delete');  
Route::get('admin/section/restore/{id}', [SectionController::class, 'restore'])->name('section.restore');  
Route::get('admin/section/toggle/{id}', [SectionController::class, 'toggleActive'])->name('packages.toggle');
Route::get('admin/section/add_question/{id}',[SectionController::class, 'add_question']);
Route::get('admin/get-question/{id}', [SectionController::class, 'getQuestion'])->name('get.question');
Route::post('admin/add-question', [QuestionToVolumeController::class, 'store'])->name('question.add');


// All Notes Routes
Route::get('admin/pdfnotes/all',[PDfNoteController::class, 'index'])->name('pdfnotes.all');
Route::get('admin/pdfnotes/add', [PDfNoteController::class, 'add'])->name('add.pdfnotes');
Route::get('admin/pdfnotes/edit/{id}', [PDfNoteController::class, 'edit']);
Route::post('admin/pdfnotes/update/{id}', [PDfNoteController::class, 'update'])->name('pdfnotes.update');
Route::post('admin/pdfnotes/store', [PDfNoteController::class, 'store'])->name('pdfnotes.store'); 
Route::get('admin/pdfnotes/delete/{id}', [PDfNoteController::class, 'destroy'])->name('pdfnotes.delete');  
Route::get('admin/pdfnotes/delete/permanent/{id}', [PDfNoteController::class, 'destroy_permanent'])->name('pdfnotes.delete.permanent');  
Route::get('admin/pdfnotes/restore/{id}', [PDfNoteController::class, 'restore'])->name('pdfnotes.restore');  
Route::get('admin/pdfnotes/toggle/{id}', [PDfNoteController::class, 'toggleActive'])->name('pdfnotes.toggle');
// All CouponController Routes
Route::get('admin/coupon/all',[CouponController::class, 'index'])->name('coupon.all');
Route::get('admin/coupon/add', [CouponController::class, 'add'])->name('add.coupon');
Route::get('admin/coupon/edit/{id}', [CouponController::class, 'edit']);
Route::put('admin/coupon/update/{id}', [CouponController::class, 'update'])->name('coupon.update');
Route::post('admin/coupon/store', [CouponController::class, 'store'])->name('coupon.store'); 
Route::get('admin/coupon/delete/{id}', [CouponController::class, 'destroy'])->name('coupon.delete');  
Route::get('admin/coupon/delete/permanent/{id}', [CouponController::class, 'destroy_permanent'])->name('coupon.delete.permanent');  
Route::get('admin/coupon/restore/{id}', [CouponController::class, 'restore'])->name('coupon.restore');  
Route::get('admin/coupon/toggle/{id}', [CouponController::class, 'toggleActive'])->name('coupon.toggle');



//PDF Notes Create Routes
Route::get('admin/create_pdfnote/{id}', [CreatePDFNotesController::class, 'index']); 
Route::get('admin/create_pdfnotes/add', [CreatePDFNotesController::class, 'add'])->name('add.create_pdfnotes'); 
Route::post('admin/create_pdfnotes/store', [CreatePDFNotesController::class, 'store'])->name('create_pdfnotes.store'); 
Route::get('admin/create_pdfnotes/delete/{id}', [CreatePDFNotesController::class, 'destroy'])->name('create_pdfnotes.delete');  
Route::get('admin/create_pdfnotes/edit/{id}', [CreatePDFNotesController::class, 'edit'])->name('create_pdfnotes.edit');  
Route::put('admin/create_pdfnotes/update/{id}', [CreatePDFNotesController::class, 'update'])->name('create_pdfnotes.update');  

Route::get('admin/create_pdfnotes/delete/permanent/{id}', [CreatePDFNotesController::class, 'destroy_permanent'])->name('create_pdfnotes.delete.permanent');  

Route::get('admin/create_pdfnotes/restore/{id}', [CreatePDFNotesController::class, 'restore'])->name('create_pdfnotes.restore');  
Route::get('admin/create_pdfnotes/toggle/{id}', [CreatePDFNotesController::class, 'toggleActive'])->name('create_pdfnotes.toggle');
//Route::get('/admin/classroom/all',[CourseController::class,'index'])->name('all.classroom');


//Recording All
Route::get('admin/recordings/all',[VideorecordingController::class, 'index'])->name('recording.all');
Route::get('admin/recording/add', [VideorecordingController::class, 'add'])->name('recording.add');; 
Route::get('admin/recording/edit/{id}', [VideorecordingController::class, 'edit'])->name('recording.edit');; 
Route::put('admin/recording/update/{id}', [VideorecordingController::class, 'update'])->name('recording.update');; 

Route::post('admin/recording/store', [VideorecordingController::class, 'store'])->name('recording.store'); 
Route::get('admin/recording/delete/{id}', [VideorecordingController::class, 'destroy'])->name('recording.delete');  
Route::get('admin/recording/delete/permanent/{id}', [VideorecordingController::class, 'destroy_permanent'])->name('recording.delete.permanent');  

Route::get('admin/recording/restore/{id}', [VideorecordingController::class, 'restore'])->name('recording.restore');  
Route::get('admin/recording/toggle/{id}', [VideorecordingController::class, 'toggleActive'])->name('recording.toggle');
    
// Recording Create Successfully
Route::get('admin/recording_create/{id}', [CreatevideoController::class, 'index']); 
Route::get('admin/recording_creates/add', [CreatevideoController::class, 'add'])->name('add.recording_creates'); 
Route::post('admin/recording_creates/store', [CreatevideoController::class, 'store'])->name('recording_creates.store'); 
Route::get('admin/recording_creates/delete/{id}', [CreatevideoController::class, 'destroy'])->name('recording_creates.delete');  
Route::get('admin/recording_creates/restore/{id}', [CreatevideoController::class, 'restore'])->name('recording_creates.restore');  
Route::get('admin/recording_creates/toggle/{id}', [CreatevideoController::class, 'toggleActive'])->name('recording_creates.toggle');

//create category
Route::get('admin/category/all',[CategoryController::class, 'index'])->name('category.all');
Route::get('admin/category/add', [CategoryController::class, 'create'])->name('add.category');
Route::post('admin/category/store', [CategoryController::class, 'store'])->name('category.store');
Route::get('admin/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('admin/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::get('admin/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
Route::get('admin/category/delete/permanent/{id}', [CategoryController::class, 'destroy_permanent'])->name('category.delete.permanent');
Route::get('admin/category/restore/{id}', [CategoryController::class, 'restore'])->name('category.restore');
Route::get('admin/category/toggle/{id}', [CategoryController::class, 'toggleActive'])->name('category.toggle');
//create subcategory
Route::get('admin/subcategory/all/{id}',[SubCategoryController::class, 'index'])->name('subcategory.all');
Route::get('admin/subcategory/add/{id}', [SubCategoryController::class, 'create'])->name('add.subcategory');
Route::post('admin/subcategory/store', [SubCategoryController::class, 'store'])->name('subcategory.store');
Route::get('admin/subcategory/edit/{id}', [SubCategoryController::class, 'edit'])->name('subcategory.edit');
Route::put('admin/subcategory/update/{id}', [SubCategoryController::class, 'update'])->name('subcategory.update');
Route::get('admin/subcategory/delete/{id}', [SubCategoryController::class, 'destroy'])->name('subcategory.delete');
Route::get('admin/subcategory/delete/permanent/{id}', [SubCategoryController::class, 'destroy_permanent'])->name('subcategory.delete.permanent');
Route::get('admin/subcategory/restore/{id}', [SubCategoryController::class, 'restore'])->name('subcategory.restore');
Route::get('admin/subcategory/toggle/{id}', [SubCategoryController::class, 'toggleActive'])->name('subcategory.toggle');
Route::get('/admin/get-subcategories/{id}', [SubCategoryController::class, 'getCategory'])->name('subcategory.getCategory');
//blogs
Route::get('admin/Blog/all',[BlogController::class, 'index'])->name('blog.all');
Route::get('admin/blog/add', [BlogController::class, 'create'])->name('add.blog');
Route::post('admin/blog/store', [BlogController::class, 'store'])->name('blog.store');
Route::get('admin/blog/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
Route::put('admin/blog/update/{id}', [BlogController::class, 'update'])->name('blog.update');
Route::get('admin/blog/delete/{id}', [BlogController::class, 'destroy'])->name('blog.delete');
Route::get('admin/blog/delete/permanent/{id}', [BlogController::class, 'destroy_permanent'])->name('blog.delete.permanent');
Route::get('admin/blog/restore/{id}', [BlogController::class, 'restore'])->name('blog.restore');
Route::get('admin/blog/toggle/{id}', [BlogController::class, 'toggleActive'])->name('blog.toggle');

});