<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyDetail;
use App\Models\JobApplication;
use App\Models\Jobs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class CompanyProfileController extends Controller
{
    // show company profile
    public function showCompanyProfile()
    {
        $company = Auth::guard('company')->user();
        
        if (!$company) {
            return redirect()->route('company.login')
                ->with('error', 'Please login to view profile');
        }

        // Create or retrieve company details
        $companyDetails = CompanyDetail::firstOrCreate(
            ['company_id' => $company->id],
            [] 
        );
        
        $activeJobsCount = Jobs::where('company_id', $company->id)
            ->where('status', 1)
            ->count();
            
        $totalApplications = JobApplication::whereHas('job', function($query) use ($company) {
            $query->where('company_id', $company->id);
        })->count();
        
        $recentJobs = Jobs::where('company_id', $company->id)
            ->with(['jobType', 'category'])
            ->orderBy('created_at', 'DESC')
            ->paginate(6);
            
        return view('company.panel.companyProfile', compact(
            'company',
            'companyDetails',
            'activeJobsCount',
            'totalApplications',
            'recentJobs'
        ));
    }

    // open a edit profile for company
    public function editProfile()
    {
        $companyId = Auth::guard('company')->id();

        // Fetch company details from `companies` table
        $company = DB::table('companies')->where('id', $companyId)->first();

        // Fetch additional details from `company_details` table
        $companyDetails = DB::table('company_details')->where('company_id', $companyId)->first();

        return view('company.panel.editProfile', compact('company', 'companyDetails'));
    }


    // Update Profile Image
    public function updateProfileImage(Request $request)
    {
        $companyId = Auth::guard('company')->id();
    
        // Validate the uploaded file
        $request->validate([
            'profile_img' => 'required|image',  // Max 2MB
        ]);
    
        // Retrieve company details if they exist
        $companyDetails = DB::table('company_details')->where('company_id', $companyId)->first();
    
        $profileImgName = $companyDetails->profile_img ?? null; // Keep existing image if no new file
    
        // Handle file upload
        if ($request->hasFile('profile_img')) {
            $file = $request->file('profile_img');
            $profileImgName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension(); // Unique name
            $destinationPath = public_path('uploads/company_profile'); // Destination path
    
            // Move the file to the destination
            $file->move($destinationPath, $profileImgName);
        }
    
        // Insert or update company details
        if ($companyDetails) {
            DB::table('company_details')->where('company_id', $companyId)->update([
                'profile_img' => $profileImgName,
                'updated_at' => now(),
            ]);
        } else {
            DB::table('company_details')->insert([
                'company_id' => $companyId,
                'profile_img' => $profileImgName,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    
        return back()->with('success', 'Profile image updated successfully..!!');
    }   
    
    // Update Cover Photo
    public function updateCoverPhoto(Request $request)
    {
        $companyId = Auth::guard('company')->id();
        $request->validate([
            'cover_img' => 'required|image',
        ]);

        $companyDetails = DB::table('company_details')->where('company_id', $companyId)->first();

        if ($request->hasFile('cover_img')) {
            $image = $request->file('cover_img');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/company_cover'), $imageName);

            $coverImgPath = $imageName;
        } else {
            $coverImgPath = $companyDetails->cover_img ?? null;
        }

        if ($companyDetails) {
            DB::table('company_details')->where('company_id', $companyId)->update([
                'cover_img' => $coverImgPath,
                'updated_at' => now(),
            ]);
        } else {
            DB::table('company_details')->insert([
                'company_id' => $companyId,
                'cover_img' => $coverImgPath,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return back()->with('success', 'Cover photo updated successfully..!!');
    }
    
    // update company name
    public function updateCompanyName(Request $request)
    {
        $companyId = Auth::guard('company')->id();
        
        $request->validate([
            'c_name' => 'required|string|max:255',
        ]);

        // Update or Insert into 'companies' table
        DB::table('companies')->updateOrInsert(
            ['id' => $companyId],  // Check if company exists
            ['c_name' => $request->input('c_name'), 'updated_at' => now()]
        );

        return back()->with('success', 'Company name updated successfully..!!');
    }

    // update company type
    public function updateCompanyType(Request $request)
    {
        $companyId = Auth::guard('company')->id();
        
        $request->validate([
            'c_type' => 'required|string|max:255',
        ]);

        // Update or Insert into 'companies' table
        DB::table('companies')->updateOrInsert(
            ['id' => $companyId],  // Check if company exists
            ['c_type' => $request->input('c_type'), 'updated_at' => now()]
        );

        return back()->with('success', 'Company type updated successfully..!!');
    }

    // Update Market Type
    public function updateMarketType(Request $request)
    {
        $companyId = Auth::guard('company')->id();
        $request->validate([
            'market_type' => 'required|string',
        ]);

        DB::table('company_details')->where('company_id', $companyId)->update([
            'market_type' => $request->input('market_type'),
        ]);

        return back()->with('success', 'Market type updated successfully..!!');
    }

    // Update About Section
    public function updateAbout(Request $request)
    {
        $companyId = Auth::guard('company')->id();
        $request->validate([
            'about' => 'required|string',
        ]);

        DB::table('company_details')->where('company_id', $companyId)->update([
            'about' => $request->input('about'),
        ]);

        return back()->with('success', 'About info updated successfully..!!');
    }

    // update key infromation
    public function updateKeyInfo(Request $request)
    {
        $companyId = Auth::guard('company')->id();

        // Validate form inputs
        $request->validate([
            'c_industry' => 'required|string|max:255',
            'c_established_year' => 'required|integer|min:1800|max:' . date('Y'),
            'headquarters' => 'required|string|max:255',
            'c_size' => 'required|string|max:255',
            'c_type' => 'required|in:Private,Public',
            'c_website' => 'nullable|url|max:255',
        ]);

        // Update company information in companies table
        DB::table('companies')->where('id', $companyId)->update([
            'c_industry' => $request->c_industry,
            'c_established_year' => $request->c_established_year,
            'c_size' => $request->c_size,
            'c_type' => $request->c_type,
            'c_website' => $request->c_website,
            'updated_at' => now(),
        ]);

        // Check if company details record exists
        $companyDetailsExists = DB::table('company_details')
            ->where('company_id', $companyId)
            ->exists();

        if ($companyDetailsExists) {
            // Update existing record
            DB::table('company_details')
                ->where('company_id', $companyId)
                ->update([
                    'headquarters' => $request->headquarters,
                    'updated_at' => now(),
                ]);
        } else {
            // Create new record
            DB::table('company_details')->insert([
                'company_id' => $companyId,
                'headquarters' => $request->headquarters,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return back()->with('success', 'Key information updated successfully!');
    }

    // update contact information
    public function updateContactInfo(Request $request)
    {
        $companyId = Auth::guard('company')->id();
        
        // Validate the request
        $request->validate([
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'c_address' => 'nullable|string|max:500'
        ]);

        // Update or insert contact email and phone in company_details table
        DB::table('company_details')->updateOrInsert(
            ['company_id' => $companyId], // Where condition
            [
                'contact_email' => $request->contact_email,
                'phone' => $request->contact_phone,
                'updated_at' => now()
            ]
        );

        // Update address in companies table
        DB::table('companies')->where('id', $companyId)->update([
            'c_address' => $request->c_address,
            'updated_at' => now()
        ]);

        return back()->with('success', 'Contact information updated successfully!');
    }
    
     // Update Social Links
     public function updateSocialLinks(Request $request)
     {
        $companyId = Auth::guard('company')->id();
         $request->validate([
             'facebook' => 'nullable|string',
             'twitter' => 'nullable|string',
             'linkedin' => 'nullable|string',
             'instagram' => 'nullable|string',
         ]);
 
         DB::table('company_details')->where('company_id', $companyId)->update([
             'facebook' => $request->input('facebook'),
             'twitter' => $request->input('twitter'),
             'linkedin' => $request->input('linkedin'),
             'instagram' => $request->input('instagram'),
         ]);
 
         return back()->with('success', 'Social links updated successfully..!!');
     }

    //  ----------------------------- settings-------------------------------

    // open a post jobs for company
    public function settings()
    {
        $companyId = Auth::guard('company')->id();
        $company = DB::table('companies')->where('id', $companyId)->first();
        $companyDetails = DB::table('company_details')->where('company_id', $companyId)->first();
        return view('company.panel.settings', compact('company', 'companyDetails'));
    }

    // Update Email
    public function updateEmail(Request $request)
    {
        $companyId = Auth::guard('company')->id();
        
        $request->validate([
            'email' => 'required|email|unique:companies,c_email,' . $companyId,
        ], [
            'email.required' => 'Email address is required',
            'email.email' => 'Please enter a valid email address',
            'email.unique' => 'This email is already registered'
        ]);

        DB::table('companies')->where('id', $companyId)->update([
            'c_email' => $request->email,
            'updated_at' => now()
        ]);

        return back()->with('success', 'Email updated successfully..!!');
    }

    // Update Phone
    public function updatePhone(Request $request)
    {
        $companyId = Auth::guard('company')->id();
        
        $request->validate([
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ], [
            'phone.required' => 'Phone number is required',
            'phone.regex' => 'Please enter a valid phone number',
            'phone.min' => 'Phone number must be at least 10 digits'
        ]);

        DB::table('company_details')->where('company_id', $companyId)->update([
            'phone' => $request->phone,
            'updated_at' => now()
        ]);

        return back()->with('success', 'Phone number updated successfully..!!');
    }

    // Update Password
    public function updatePassword(Request $request)
    {
        $companyId = Auth::guard('company')->id();
        
        $request->validate([
            'current_password' => 'required',
            'new_password' => ['required', 'confirmed', Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()],
            'new_password_confirmation' => 'required'
        ], [
            'current_password.required' => 'Current password is required',
            'new_password.required' => 'New password is required',
            'new_password.confirmed' => 'Password confirmation does not match',
            'new_password_confirmation.required' => 'Please confirm your new password'
        ]);

        $company = DB::table('companies')->where('id', $companyId)->first();

        if (!Hash::check($request->current_password, $company->c_password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        DB::table('companies')->where('id', $companyId)->update([
            'c_password' => Hash::make($request->new_password),
            'updated_at' => now()
        ]);

        return back()->with('success', 'Password updated successfully..!!');
    }
}
