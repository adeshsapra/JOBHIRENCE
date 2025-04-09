<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class userProfileController extends Controller
{
    
    // show user profile
    public function userProfile()
    {
        $user_id = Auth::id();
        $user = Auth::user(); // Retrieve user details
        $userDetail = UserDetail::where('user_id', $user_id)->first(); // Retrieve UserDetail

        return view('front.account.userProfile', [
            'user' => $user,
            'userDetail' => $userDetail,
        ]);
    }
    // show user Edit Profile
    // public function userEditProfile(){
    //     $user_id = Auth::user()->id;
    //     // dd($user_id);
    //     $user = User::where('id',$user_id)->first();

    //     return view('front.account.userEditProfile',[
    //         'user' => $user
    //     ]);
    // }
    public function userEditProfile()
    {
        $user_id = Auth::id();
        $user = Auth::user(); // Retrieve user details
        $userDetail = UserDetail::where('user_id', $user_id)->first(); // Retrieve UserDetail

        return view('front.account.userEditProfile', [
            'user' => $user,
            'userDetail' => $userDetail,
        ]);
    }

    // update profile information
    public function userUpdateProfile(Request $request)
    {
        $user_id = Auth::id();
        
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user_id,
            'designation' => 'nullable|string|max:255',
            'mobile' => 'required|digits:10|unique:users,mobile_number,' . $user_id,
            'bio' => 'nullable|string|max:1000',
        ], [
            'full_name.required' => 'The full name field is required.',
            'email.unique' => 'This email is already taken by another user.',
            'mobile.unique' => 'This mobile number is already taken by another user.',
            'mobile.digits' => 'The mobile number must be 10 digits.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Capitalize values
        $fullName = Str::title($request->full_name); 
        $designation = $request->designation ? Str::title($request->designation) : null;
        $bio = $request->bio ? Str::title($request->bio) : null;

        $result = DB::table('users')
            ->where('id', $user_id)
            ->update([
                'fullName' => $fullName,
                'email' => $request->email,
                'designation' => $designation,
                'mobile_number' => $request->mobile,
                'bio' => $bio,
            ]);
            
        if ($result) {
            return redirect()->back()->with([
                'success' => 'profile updated successfully..!!',
                'link' => route('account.userProfile'), 
                'link_text' => 'View Profile', 
            ]);
        } else {
            return redirect()->back()
                ->with('error', 'No changes made to profile.')
                ->withInput();
        }
    }

    // update profile image
    public function updateProfileImage(Request $request)
    {
        $user_id = Auth::id();

        // Validate the uploaded file
        $request->validate([
            'profile_image' => 'required|image'
        ]);

        if ($request->hasFile('profile_image')) {
            // Retrieve the uploaded file
            $image = $request->file('profile_image');
            $imageName = $user_id . '-' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('profile_image'), $imageName);

            $result = DB::table('users')
                ->where('id', $user_id)
                ->update(['image' => 'profile_image/' . $imageName]);

            if ($result) {
                return redirect()->back()->with([
                    'success' => 'Profile Picture updated successfully..!!',
                    'link' => route('account.userProfile'), 
                    'link_text' => 'View Profile', 
                ]);
            } else {
                return redirect()->back()->with('error', 'Failed to update the profile picture in the database.');
            }
        }

        return redirect()->back()->with('error', 'No file was uploaded.');
    }

    // update education
    public function updateEducation(Request $request)
    {
        $user_id = Auth::id();

        $request->validate([
            'degree' => 'required|string|max:255',
            'university' => 'required|string|max:255',
            'graduation_year' => 'required|digits:4',
        ]);

        $userDetail = UserDetail::where('user_id', $user_id)->first();

        if ($userDetail) {
            $userDetail->degree = Str::title($request->degree);
            $userDetail->university = Str::title($request->university);
            $userDetail->graduation_year = $request->graduation_year;

            if ($userDetail->save()) {
                return redirect()->back()->with([
                    'success' => 'Education updated successfully..!!',
                    'link' => route('account.userProfile'), 
                    'link_text' => 'View Profile', 
                ]);
            }
        } else {
            $newUserDetail = new UserDetail();
            $newUserDetail->user_id = $user_id;
            $newUserDetail->degree = Str::title($request->degree);
            $newUserDetail->university = Str::title($request->university);
            $newUserDetail->graduation_year = $request->graduation_year;

            if ($newUserDetail->save()) {
                return redirect()->back()->with([
                    'success' => 'Education added successfully..!!',
                    'link' => route('account.userProfile'), 
                    'link_text' => 'View Profile', 
                ]);
            }
        }

        return redirect()->back()->with('error', 'Failed to update education.');
    }

    // update location
    public function updateLocation(Request $request)
    {
        $user_id = Auth::id();

        $request->validate([
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
        ]);
        $city = Str::title($request->city); 
        $state = Str::title($request->state); 

        $userDetail = UserDetail::where('user_id', $user_id)->first();

        if ($userDetail) {
            // If record exists, update it
            $userDetail->city = $city;
            $userDetail->state = $state;

            if ($userDetail->save()) {
                return redirect()->back()->with([
                    'success' => 'Location updated successfully..!!',
                    'link' => route('account.userProfile'), 
                    'link_text' => 'View Profile', 
                ]);
            } else {
                return redirect()->back()->with('error', 'Failed to update location.');
            }
        } else {
            // If no record exists, create a new one
            $newUserDetail = new UserDetail();
            $newUserDetail->user_id = $user_id;
            $newUserDetail->city = $city;
            $newUserDetail->state = $state;

            if ($newUserDetail->save()) {
                return redirect()->back()->with([
                    'success' => 'Location added successfully..!!',
                    'link' => route('account.userProfile'), 
                    'link_text' => 'View Profile', 
                ]);
                
            } else {
                return redirect()->back()->with('error', 'Failed to add location.');
            }
        }
    }

    // update skills
    public function updateSkills(Request $request)
    {
        $user_id = Auth::id();

        $request->validate([
            'skills' => 'required|string',
        ]);

        $skills = array_map('trim', explode(',', $request->skills));
        $formattedSkills = implode(', ', array_map('ucwords', $skills)); // Capitalize each skill

        $userDetail = UserDetail::where('user_id', $user_id)->first();

        if ($userDetail) {
            $userDetail->skills = $formattedSkills;

            if ($userDetail->save()) {
                return redirect()->back()->with([
                    'success' => 'Skills Updated successfully..!!',
                    'link' => route('account.userProfile'), 
                    'link_text' => 'View Profile', 
                ]);
            }
        } else {
            $newUserDetail = new UserDetail();
            $newUserDetail->user_id = $user_id;
            $newUserDetail->skills = $formattedSkills;

            if ($newUserDetail->save()) {
                return redirect()->back()->with([
                    'success' => 'Skills added successfully..!!',
                    'link' => route('account.userProfile'), 
                    'link_text' => 'View Profile', 
                ]);
            }
        }

        return redirect()->back()->with('error', 'Failed to update skills.');
    }

    // view resume
    public function viewResume()
    {
        $userId = Auth::id();
        $userDetail = UserDetail::where('user_id', $userId)->first();

        if (!$userDetail || !$userDetail->resume) {
            return redirect()->back()->with('error', 'No resume found.');
        }

        $filePath = public_path('uploaded_resumes/' . basename($userDetail->resume));

        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'Resume file not found.');
        }

        $fileContents = file_get_contents($filePath);
        $mimeType = mime_content_type($filePath);

        return Response::make($fileContents, 200, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="' . basename($userDetail->resume) . '"',
        ]);
    }


//  Download the resume file
    public function downloadResume()
    {
        $userId = Auth::id();
        $userDetail = UserDetail::where('user_id', $userId)->first();

        if (!$userDetail || !$userDetail->resume) {
            return redirect()->back()->with('error', 'No resume found.');
        }

        $filePath = public_path('uploaded_resumes/' . basename($userDetail->resume));

        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'Resume file not found.');
        }

        return Response::download($filePath, basename($userDetail->resume));
    }


//  Modified uploadResume method with correct file path handling

    public function uploadResume(Request $request)
    {
        $userId = Auth::id();

        $request->validate([
            'resume' => [
                'required',
                'file',
                'mimes:pdf,doc,docx',
                'max:3072', // 3MB
            ],
        ]);

        if ($request->hasFile('resume')) {
            $resume = $request->file('resume');
            $resumeName = $userId . '-' . time() . '.' . $resume->getClientOriginalExtension();
            $uploadPath = public_path('uploaded_resumes');

            // Create directory if it doesn't exist
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0777, true);
            }

            // Delete old resume if exists
            $userDetail = UserDetail::where('user_id', $userId)->first();
            if ($userDetail && $userDetail->resume) {
                $oldFilePath = public_path('uploaded_resumes/' . basename($userDetail->resume));
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                }
            }

            // Move new resume
            $resume->move($uploadPath, $resumeName);

            // Update database
            if ($userDetail) {
                $userDetail->resume = 'jobHierance/resumes/'.$resumeName;
                $userDetail->save();
            } else {
                UserDetail::create([
                    'user_id' => $userId,
                    'resume' => $resumeName,
                ]);
            }

            return redirect()->back()->with([
                'success' => 'Resume Uploaded successfully..!!',
                'link' => route('account.userProfile'), 
                'link_text' => 'View Profile', 
            ]);
        }

        return redirect()->back()->with('error', 'No file was uploaded.');
    }

    public function viewUserProfile($id){
        
        $user_id = $id;
        $user = User::where('id', $user_id)->first();
        $userDetail = UserDetail::where('user_id', $user_id)->first(); // Retrieve UserDetail

        // dd($user);
        return view('front.account.viewUserProfile',compact('user', 'userDetail'));
    }
}

