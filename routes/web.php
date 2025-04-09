<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminAccountController;
use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\CompanieController;
use App\Http\Controllers\CompanyPanelController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\UserProfileController;
use App\Http\Middleware\RedirectIfAdminAuthenticated;
use App\Http\Middleware\RedirectIfAdminNotAuthenticated;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\RedirectIfCompanyAuthenticated;
use App\Http\Middleware\RedirectIfCompanyNotAuthenticated;
use App\Http\Middleware\RedirectIfNotAuthenticated;
use Illuminate\Support\Facades\Route;

// Route to the homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// route to the jobs page
Route::get('/jobs', [JobController::class, 'job'])->name('job');

// route to the companie page
Route::get('/companies', [CompanieController::class, 'showCompanies'])->name('companie');
Route::get('/companies/{id}', [CompanieController::class, 'showCompanyDetails'])->name('companies.details');

Route::middleware([RedirectIfNotAuthenticated::class])->group(function () {
    Route::post('/companies/{id}/follow', [CompanieController::class, 'followCompany'])
    ->name('company.follow');

    Route::post('/companies/{id}/unfollow', [CompanieController::class, 'unfollowCompany'])
    ->name('company.unfollow');

    Route::post('/companies/{id}/rate', [CompanieController::class, 'rateCompany'])
    ->name('company.rate');
});


// view job details page in job menu
Route::get('jobs/job-detail/{id}',[JobController::class,'viewJobDetail'])->name('jobDetail');

Route::get('login/google', [App\Http\Controllers\AccountController::class, 'redirectToGoogle'])->name('login.google');
Route::get('auth/google/call-back', [App\Http\Controllers\AccountController::class, 'handleGoogleCallback']);

// GitHub login
Route::get('auth/github', [AccountController::class, 'redirectToGithub'])->name('login.github');
Route::get('auth/github/call-back', [AccountController::class, 'handleGithubCallback']);

// AccountController Routes
Route::prefix('account')->group(function () {

    // Guest-only routes (using RedirectIfAuthenticated middleware)
    Route::middleware([RedirectIfAuthenticated::class])->group(function () {
        // Show user registration form
        Route::get('/register', [AccountController::class, 'showUserRegistration'])->name('account.userRegistration');
        // Handle user registration submission
        Route::post('/register', [AccountController::class, 'registration'])->name('account.registration');

        // Show user login form
        Route::get('/login', [AccountController::class, 'showUserLogin'])->name('account.userLogin');
        // Handle user authentication
        Route::post('/authenticate', [AccountController::class, 'userAuthenticate'])->name('account.userAuthenticate');

        // login with google
        
    });

    // Authenticated-only routes (using RedirectIfNotAuthenticated middleware)
    Route::middleware([RedirectIfNotAuthenticated::class])->group(function () {
        // Handle user logout
        Route::get('/logout', [AccountController::class, 'userLogout'])->name('account.userLogout');

        // show account setting menu
        Route::get('/account-setting', [AccountController::class, 'showAccountSetting'])->name('account.accountSetting');
        Route::post('/update-email', [AccountController::class, 'updateEmail'])->name('account.updateEmail');
        Route::post('/update-mobile', [AccountController::class, 'updateMobile'])->name('account.updateMobile');
        Route::post('/update-password', [AccountController::class, 'updatePassword'])->name('account.updatePassword');

        // feedback and ratings
        Route::get('/feedback-ratings', [AccountController::class, 'feedback'])->name('account.feedback');
        // store feedbacks
        Route::post('/feedback', [AccountController::class, 'saveFeedback'])->name('account.saveFeedback');

        // dispalying about page
        Route::get('/about-Us', [AccountController::class, 'aboutUs'])->name('account.aboutUs');

         // dispalying contact page
         Route::get('/contact-Us', [AccountController::class, 'showContactUs'])->name('account.contactUs');

    });
});

// UserProfileController Routes

Route::prefix('account')->middleware([RedirectIfNotAuthenticated::class])->group(function () {
    // Show user profile page
    Route::get('/profile', [UserProfileController::class, 'userProfile'])->name('account.userProfile');

    // Show edit profile page
    Route::get('/edit-profile', [UserProfileController::class, 'userEditProfile'])->name('account.userEditProfile');

    // Handle profile update
    Route::post('/update-profile', [UserProfileController::class, 'userUpdateProfile'])->name('account.userUpdateProfile');

    // Handle profile image update
    Route::post('/update-profile-image', [UserProfileController::class, 'updateProfileImage'])->name('account.updateProfileImage');

    // Handle education section update
    Route::post('/update-education', [UserProfileController::class, 'updateEducation'])->name('account.updateEducation');

    // Handle location section update
    Route::post('/update-location', [UserProfileController::class, 'updateLocation'])->name('account.updateLocation');

    // Handle skills section update
    Route::post('/update-skills', [UserProfileController::class, 'updateSkills'])->name('account.updateSkills');

    // Handle resume upload
    Route::post('/upload-resume', [UserProfileController::class, 'uploadResume'])->name('account.uploadResume');

    // View resume
    Route::get('/resume/view', [UserProfileController::class, 'viewResume'])->name('resume.view');

    // Download resume
    Route::get('/resume/download', [UserProfileController::class, 'downloadResume'])->name('resume.download');

    // view user details profile page
    Route::get('/{id}/userProfile', [UserProfileController::class, 'viewUserProfile'])->name('account.viewUserProfile');
});



// job Controller routes
Route::prefix('account/')->middleware([RedirectIfNotAuthenticated::class])->group(function () {
    // show post job file
    Route::get('job/post-job',[JobController::class,'showPostJob'])->name('account.showPostJob');

    // post job data store
    Route::post('job/save-job', [JobController::class, 'saveJob'])->name('account.saveJob');

    // show my jobs file
    Route::get('job/my-jobs',[JobController::class,'showMyJobs'])->name('account.showMyJobs');

    // show edit job page
    Route::get('job/edit/{id}', [JobController::class, 'showEditJob'])->name('account.showEditJob');

    // // update a job
    Route::post('/job/update/{id}', [JobController::class, 'updateJob'])->name('account.updateJob');

    // delete a job
    Route::delete('/job/delete/{id}', [JobController::class, 'deleteJob'])->name('account.deleteJob');

    // view post job
    Route::get('/job/view-job/{id}', [JobController::class, 'viewPostJob'])->name('account.viewPostJob');

    // view jobs applied page
    Route::get('/job/applied-jobs', [JobController::class, 'viewAppliedJobs'])->name('account.appliedJobs');

    // view saved jobs page
    Route::get('/job/saved-jobs', [JobController::class, 'viewSavedJobs'])->name('account.savedJobs');

    // apply jobs
    Route::post('/job/apply/{id}', [JobController::class, 'applyJob'])->name('jobApply');

    // saved jobs
    Route::post('/job/save/{id}', [JobController::class, 'jobSaved'])->name('jobSaved');

    // cancel applied jobs
    Route::delete('/applied-jobs/{id}', [JobController::class, 'cancelAppliedJob'])->name('account.cancelAppliedJob');

    // removed saved jobs
    Route::delete('/remove-saved-job/{id}', [JobController::class, 'removeSavedJob'])->name('account.removeSavedJob');


});


// forgot-password Controller routes
Route::prefix('account/')->middleware([RedirectIfAuthenticated::class])->group(function () {
   
    // show forgot password form
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])
    ->name('account.showForgotPasswordForm');
    // send otp
    Route::post('/forgot-password/send-otp', [ForgotPasswordController::class, 'sendOtp'])
    ->name('account.sendOtp');


     // show verify otp form
     Route::get('/forgot-password/verify-otp', [ForgotPasswordController::class, 'showVerifyOtpForm'])
     ->name('account.showVerifyOtpForm');
     Route::post('/forgot-password/verify-otp', [ForgotPasswordController::class, 'verifyOtp'])
     ->name('account.verifyOtp');


     // show reset password form
     Route::get('/reset-password', [ForgotPasswordController::class, 'showResetForm'])
     ->name('account.showResetForm');
     Route::post('/forgot-password/reset', [ForgotPasswordController::class, 'resetPassword'])
     ->name('account.resetPassword');


});


// ----------------- Companies Route Define------------------


// company controller routes
Route::prefix('company/')->group(function(){

    Route::middleware([RedirectIfCompanyNotAuthenticated::class])->group(function(){
        Route::get('login',[CompanyPanelController::class,'showLogin'])->name('company.login');
        Route::get('register',[CompanyPanelController::class,'showRegister'])->name('company.register');
        Route::post('registration', [CompanyPanelController::class, 'companyRegistration'])->name('company.registration');
        Route::get('/register/reset', [CompanyPanelController::class, 'resetRegistration'])->name('company.register.reset');
        Route::post('login', [CompanyPanelController::class, 'companyAuthenticate'])->name('company.login');

    });
});

// company controller routes
Route::prefix('company/')->group(function(){

    Route::middleware([RedirectIfCompanyAuthenticated::class])->group(function(){
            
        // open company dashboard menu
        Route::get('dashboard',[CompanyPanelController::class,'showDashboard'])->name('company.dashboard');

        // -----------------------------------------Jobs route---------------------------------------------------------------------------
        // open company jobs menu
        Route::get('jobs',[CompanyPanelController::class,'showJobs'])->name('company.jobs');

        // open company applications menu
        Route::get('applications',[CompanyPanelController::class,'showApplications'])->name('company.applications');

        // open company post job page
        // Route::get('jobs/post-job',[CompanyPanelController::class,'postJob'])->name('company.postJob');
        Route::get('post-job/{id?}', [CompanyPanelController::class, 'postJob'])->name('company.postJob');

        Route::post('jobs/post-job', [CompanyPanelController::class, 'savePostJob'])->name('company.savePostJob');

        Route::get('logout', [CompanyPanelController::class, 'companyLogout'])
            ->name('company.companyLogout');

        // reopen jobs changed
        Route::patch('jobs/{job}/reopen', [CompanyPanelController::class, 'reopenJob'])->name('company.jobs.reopen');

        // change job status
        Route::patch('jobs/{job}/close', [CompanyPanelController::class, 'closeJob'])->name('company.jobs.close');

        // edit post jobs
        // Route::get('jobs/{id}/edit', [CompanyPanelController::class, 'editJob'])->name('company.jobs.edit');
        Route::put('jobs/{id}', [CompanyPanelController::class, 'updateJob'])->name('company.jobs.update');

        // delete post job
        Route::delete('jobs/{id}', [CompanyPanelController::class, 'deletePostJob'])->name('company.deletePostJob');

        // view jobs details page
        Route::get('jobs/view/{id}', [CompanyPanelController::class, 'viewJobDetail'])->name('company.viewJobDetail');

         // -----------------------------------------Jobs route---------------------------------------------------------------------------


        //  -------------------------------------applications route----------------------------------------------------------------------

        // application jobs listings
        Route::get('applications/{job}', [CompanyPanelController::class, 'viewApplications'])->name('company.viewApplications');

        // updatw status
        Route::put('/applications/{application}/status', [CompanyPanelController::class, 'updateStatus'])->name('company.applications.updateStatus');

         // view user details profile page
         Route::get('applications/user-profile/{id}', [CompanyPanelController::class, 'viewUserProfile'])
         ->name('company.viewUserProfile');

        //  -------------------------------------applications route----------------------------------------------------------------------

    });
});


// company profile controller routes
Route::prefix('company/')->group(function(){

    Route::middleware([RedirectIfCompanyAuthenticated::class])->group(function(){

        //show company profile page
        Route::get('profile',[CompanyProfileController::class,'showCompanyProfile'])->name('company.profile');

        //show edit company profile page
        Route::get('edit-profile',[CompanyProfileController::class,'editProfile'])->name('company.editProfile');

        // for company profile image
        Route::post('update-profileImage', [CompanyProfileController::class, 'updateProfileImage'])->name('company.update.profile.image');

        // for company cover photo
        Route::post('update-coverImage', [CompanyProfileController::class, 'updateCoverPhoto'])->name('company.update.cover.image');

        // update company name
        Route::post('update-companyName', [CompanyProfileController::class, 'updateCompanyName'])
        ->name('company.update.name');

        // update company type
        Route::post('update-companyType', [CompanyProfileController::class, 'updateCompanyType'])
        ->name('company.update.type');

        // update market type
        Route::post('update-marketType', [CompanyProfileController::class, 'updateMarketType'])->name('company.update.market');

        // update company about
        Route::post('update-companyAbout', [CompanyProfileController::class, 'updateAbout'])->name('company.update.about');

        // update contact information
        Route::post('update-contact-info', [CompanyProfileController::class, 'updateContactInfo'])->name('company.update.contact');

        // update social links
        Route::post('update-socialLinks', [CompanyProfileController::class, 'updateSocialLinks'])->name('company.update.social');

        // update key information
        Route::post('update-keyInfo', [CompanyProfileController::class, 'updateKeyInfo'])
        ->name('company.update.keyinfo');

        // ---------------------------------- settings routes-----------------------------------------------

        
        // open company post job page
        Route::get('settings',[CompanyProfileController::class,'settings'])->name('company.settings');

        Route::post('update-companyEmail', [CompanyProfileController::class, 'updateEmail'])->name('company.update.email');
        Route::post('update-companyPhone', [CompanyProfileController::class, 'updatePhone'])->name('company.update.phone');
        Route::post('update-companypassword', [CompanyProfileController::class, 'updatePassword'])->name('company.update.password');

        // ---------------------------------- settings routes-----------------------------------------------
    });
});


// ---------------- Admin routes define-----------------

Route::prefix('admin/')->group(function(){

    // if admin is not logged in
    Route::middleware([RedirectIfAdminNotAuthenticated::class])->group(function(){
        Route::get('login', [AdminAccountController::class, 'showAdminLogin'])
        ->name('admin.login');
        Route::post('login', [AdminAccountController::class, 'adminLogin'])
            ->name('admin.login.submit');
        Route::get('register', [AdminAccountController::class, 'showAdminRegister'])
            ->name('admin.register');
        Route::post('register', [AdminAccountController::class, 'registerAdmin'])
            ->name('admin.register.submit');
    });

    // if admin is logged in 
    Route::middleware([RedirectIfAdminAuthenticated::class])->group(function () {

        // for show admin dashboard
        Route::get('dashboard', [AdminPanelController::class, 'showDashboard'])
            ->name('admin.dashboard');

        Route::get('/job/{id}', [AdminPanelController::class, 'showJobDetails'])->name('admin.job.details');

        
        // for show job management page
        Route::get('job-manage', [AdminPanelController::class, 'showJobManagement'])
            ->name('admin.jobManagement');

        
        // admin logout
        Route::get('logout', [AdminAccountController::class, 'logout'])
            ->name('admin.logout');

        // status changes in job management
        Route::post('jobs/{job}/toggle-status', [AdminPanelController::class, 'toggleStatus'])
        ->name('admin.jobs.toggleStatus');

        // view job details page
        Route::get('jobs/{id}/details', [AdminPanelController::class, 'showJobDetails'])
        ->name('admin.jobs.details');

        // FOR JOB DELETE
        Route::post('jobs/delete/{id}', [AdminPanelController::class, 'deleteJob'])->name('admin.jobs.delete');


        // ---------------------------------------- User Management -----------------------------

        // show user management page
        Route::get('user-manage', [AdminPanelController::class, 'showUserManage'])->name('admin.UserManage');

        // retrive data in user management page
        Route::get('user-management', [AdminPanelController::class, 'showUserManage'])->name('admin.user.manage');

        // for user delete
        Route::post('users/delete/{id}', [AdminPanelController::class, 'deleteUser'])->name('admin.users.delete');

        // for view user profile
        Route::get('users/view/{id}', [AdminPanelController::class, 'showUserProfile'])->name('admin.user.view');


        // -------------------------------------- company maangement --------------------------------

         // show companys management page
         Route::get('companies-manage', [AdminPanelController::class, 'showCompanyManage'])->name('admin.CompanyManage');

        // delete company
        Route::post('companies/delete/{id}', [AdminPanelController::class, 'deleteCompany'])->name('admin.companies.delete');

        // company profile data 
        Route::get('companies/{id}', [AdminPanelController::class, 'showCompanyDetails'])->name('admin.details');


        // ----------------------  application management ------------------------

         // show application management page
         Route::get('application-manage', [AdminPanelController::class, 'showApplicationmanage'])->name('admin.Applicationmanage');

         Route::get('applications/{job_id}', [AdminPanelController::class, 'showJobApplicants'])->name('admin.applications.view');

         
         // show application management page
         Route::get('categories-skills-manage', [AdminPanelController::class, 'showCategorySkillManage'])->name('admin.CategorySkillManage');

         // Add Category Route
        Route::post('add-category', [AdminPanelController::class, 'addCategory'])->name('admin.addCategory');

        // Add Job Type Route
        Route::post('add-job-type', [AdminPanelController::class, 'addJobType'])->name('admin.addJobType');

        // Add Job Experience route
        Route::post('add-experience', [AdminPanelController::class, 'addExperience'])->name('admin.addExperience');


        // For toggling category status
        Route::post('toggle-category-status/{id}', [AdminPanelController::class, 'toggleCategoryStatus'])->name('admin.toggleCategoryStatus');

        // For toggling job type status
        Route::post('toggle-job-type-status/{id}', [AdminPanelController::class, 'toggleJobTypeStatus'])->name('admin.toggleJobTypeStatus');

        // For toggling experience status
        Route::post('toggle-experience-status/{id}', [AdminPanelController::class, 'toggleExperienceStatus'])->name('admin.toggleExperienceStatus');



        // --------------------------  feedbacks and ratings routes ----------------------------------
        
        // show feedbacks and ratings management page
        Route::get('feedback-ratings-manage', [AdminPanelController::class, 'showFeedbackRatingManage'])->name('admin.FeedbackRatingManage');

        Route::delete('feedback/{id}', [AdminPanelController::class, 'deleteFeedback'])->name('admin.feedback.delete');

        Route::patch('feedback/set/{id}', [AdminPanelController::class, 'setFeedback'])->name('admin.feedback.set');

        // show companie feedbacks and ratings management page
        Route::get('companie-feedback-ratings', [AdminPanelController::class, 'showCompanieReview'])->name('admin.showCompanieReview');

    });
});

// admin profile routes
Route::prefix('admin/')->group(function(){
    Route::middleware([RedirectIfAdminAuthenticated::class])->group(function () {

        // show admin profile
        Route::get('profile', [AdminProfileController::class, 'showAdminProfile'])->name('admin.profile');

        // show admin edit profile
        Route::get('profile/edit-profile', [AdminProfileController::class, 'showEditProfile'])->name('admin.editProfile');

        Route::put('profile/update-details', [AdminProfileController::class, 'updateProfile'])->name('admin.profile.update');
        Route::put('profile/update-password', [AdminProfileController::class, 'updatePassword'])->name('admin.password.update');
    });
});
