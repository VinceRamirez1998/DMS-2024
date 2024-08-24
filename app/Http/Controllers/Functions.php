<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\Proposals;
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
        $months = Inquiry::selectRaw('MONTH(created_at) as month, MONTHNAME(created_at) as month_name')
        ->where('type', 'inquire')
        ->groupBy('month', 'month_name')
        ->orderBy('month')
        ->get();
        return view('requests', compact('months'));
    }
    public function request_month($month){
        $monthNumber = date('m', strtotime($month));
        $file = Inquiry::select('*')
                     ->where('type', 'inquire')
                     ->whereMonth('created_at', $monthNumber) 
                     ->orderBy('created_at') 
                     ->get();

        return view('requestsmonth', ['monthName' => $month], compact('file','month'));
    }

    public function request_folder($month, $folder){
        $file = Inquiry::where('id', $folder)->first();
        $file = Inquiry::where('title', $file->title)->get();

        return view('requestsfolder', ['monthName' => $month, 'folder' => $folder], compact('file', 'month'));
    }

    public function submitInquiry(Request $request){
        $request->validate([
            'title' => 'required',
            'position' => 'required',
            'location' => 'required',
            

        ]);

        if(auth()->user()->purpose == 'request'){
            $request->validate([
                'file' => 'required|mimes:pdf,doc,docx',
            ]);
            // File
            $file = $request->title . '-'. auth()->user()->username . '_' . date('m_d_Y_s') . '.' . $request->file->extension();
            $request->file->move(public_path('documents/inquiry'), $file);
            $proposal = new Inquiry();
            $proposal->username = auth()->user()->username;
            $proposal->title = $request->title;
            $proposal->position = $request->position;
            $proposal->location = $request->location;
            $proposal->type = auth()->user()->purpose;
            $proposal->file = $file;
            $proposal->save();
        }else{
            $proposal = new Inquiry();
            $proposal->username = auth()->user()->username;
            $proposal->title = $request->title;
            $proposal->position = $request->position;
            $proposal->location = $request->location;
            $proposal->type = auth()->user()->purpose;
            $proposal->save();
        }

        return redirect()->back()->with('success', 'Proposal submitted.');
    }
    

    public function requestsoption(Request $request, $month){
        if (empty($request->option)) {
            $request->validate([
                'option' => 'required',
            ]);
        }
    
        if ($request->option === 'rename') {
            $proposal = Proposals::where('id', $request->folder_id)->first();
            $proposal->title = $request->new_name; 
            $proposal->save();
        } elseif ($request->option === 'delete') {
            $proposal = Proposals::where('id', $request->folder_id)->first();
            if ($proposal && $proposal->file) {
                $filePath = public_path('documents/requests/' . $proposal->file);
                if (file_exists($filePath)) {
                    unlink($filePath);  
                }
            }
            $proposal->delete();
        }
        return redirect()->back();
    }

    public function submitProposal(Request $request){
        $request->validate([
            'lastname' => 'required',
            'firstname' => 'required',
            'email' => 'required|email',
            'position' => 'required',
            'project_title' => 'required',
            'project_description' => 'required',
            'file' => 'required|mimes:pdf,doc,docx',

        ]);

        // File
        $file = $request->project_title . '-'. auth()->user()->username . '_proposal_' . date('m_d_Y_s') . '.' . $request->file->extension();
        $request->file->move(public_path('documents/proposals'), $file);
        $proposal = new Proposals();
        $proposal->lastname = $request->lastname;
        $proposal->firstname = $request->firstname;
        $proposal->email = $request->email;
        $proposal->project_title = $request->project_title;
        $proposal->project_description = $request->project_description;
        $proposal->position = $request->position;
        $proposal->file = $file;
        $proposal->save();

        return redirect()->back()->with('success', 'Proposal submitted.');
    }

    public function dashboard(){
        if(auth()->user()->role == 'president' || auth()->user()->role == 'vicepresident'){
            $total_requests = Inquiry::count();
            $total_proposals = Proposals::count();
            $total = $total_proposals + $total_requests;
            $requests_percentage = ($total_requests / $total) * 100;
            $proposals_percentage = ($total_proposals / $total) * 100;
           
            return view('dashboard', compact('total_requests','total_proposals', 'proposals_percentage', 'requests_percentage'));
        }
        elseif(auth()->user()->role == 'areaspecialist' || auth()->user()->role == 'centermanagement'){
            $total_inquiries = Inquiry::where('type', 'inquire')->count();
            $total_requests = Inquiry::where('type', 'request')->count();
            $recent_files = Inquiry::latest()->take(5)->get();
        return view('dashboard', compact('total_requests','total_inquiries','recent_files'));
        }

        return view('dashboard');
    }

}
