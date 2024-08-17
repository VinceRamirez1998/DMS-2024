<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class Functions extends Controller
{
    public function changePassword(Request $request){
        if($request->btn == 'cancel'){
            return redirect()->route('settings');
        }
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ]);
        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }
        
        $user = auth()->user();
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->back()->with('success', 'Password changed successfully.');
        
    }

    public function changeContact(Request $request){
        if($request->btn == 'cancel'){
            return redirect()->route('settings');
        }
        $request->validate([
            'contact' => 'required|numeric|digits:11',
        ]);
        $user = auth()->user();
        $user->phone = $request->contact;
        $user->save();
        return redirect()->back()->with('success', 'Contact changed successfully.');
    }

    public function changeProfile(Request $request){
        if($request->btn == 'cancel'){
            return redirect()->route('settings');
        }
        $request->validate([
            'profile' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $imageName = auth()->user()->username . '.'.$request->profile->extension();
        $request->profile->move(public_path('img/profile'), $imageName);
        $user = auth()->user();
        $oldProfile = public_path('img/profile/'.$user->profile);
        $user->profile_picture = $imageName;
        $user->save();
        // Delete old profile
        if (file_exists($oldProfile) && is_file($oldProfile)) {
            unlink($oldProfile);
        }
      
        return redirect()->back()->with('success', 'Profile changed successfully.');
    }

    public function request_page(){
        $months = Proposal::selectRaw('MONTH(created_at) as month, MONTHNAME(created_at) as month_name')
        ->where('type', 'inquiry')
        ->groupBy('month', 'month_name')
        ->orderBy('month')
        ->get();
        return view('requests', compact('months'));
    }
    public function request_month($month){
        $monthNumber = date('m', strtotime($month));
        $file = Proposal::select('*')
                     ->where('type', 'inquiry')
                     ->whereMonth('created_at', $monthNumber) 
                     ->orderBy('created_at') 
                     ->get();

        return view('requestsmonth', ['monthName' => $month], compact('file','month'));
    }

    public function request_folder($month, $folder){
        $file = Proposal::where('id', $folder)->first();
        $file = Proposal::where('title', $file->title)->get();

        return view('requestsfolder', ['monthName' => $month, 'folder' => $folder], compact('file', 'month'));
    }

    public function submitInquiry(Request $request){
        $request->validate([
            'title' => 'required',
            'position' => 'required',
            'location' => 'required',
            'file' => 'required|mimes:pdf,doc,docx',

        ]);

        // File
        $file = $request->title . '-'. auth()->user()->username . '_' . date('m_d_Y_s') . '.' . $request->file->extension();
        $request->file->move(public_path('documents'), $file);
        $proposal = new Proposal();
        $proposal->username = auth()->user()->username;
        $proposal->title = $request->title;
        $proposal->position = $request->position;
        $proposal->location = $request->location;
        $proposal->type = 'inquiry';
        $proposal->file = $file;
        $proposal->save();


        return redirect()->back()->with('success', 'Proposal submitted.');
    }

    public function requestsoption(Request $request, $month){
        if (empty($request->option)) {
            $request->validate([
                'option' => 'required',
            ]);
        }
    
        if ($request->option === 'rename') {
            $proposal = Proposal::where('id', $request->folder_id)->first();
            $proposal->title = $request->new_name; 
            $proposal->save();
        } elseif ($request->option === 'delete') {
            $proposal = Proposal::where('id', $request->folder_id)->first();
            if ($proposal && $proposal->file) {
                $filePath = public_path('documents/' . $proposal->file);
                if (file_exists($filePath)) {
                    unlink($filePath);  
                }
            }
            $proposal->delete();
        }
        return redirect()->back();
    }

}
