<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Inquiry;
use App\Models\Projects;
use App\Models\Requests;
use App\Models\Proposals;
use App\Models\NoticeBoard;
use Illuminate\Http\Request;
use App\Models\Notifications;
use App\Models\InquiryComments;
use App\Models\RequestComments;
use App\Models\ProposalComments;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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

    public function request_page($type){
        if($type == 'proposals'){
            $proposal = Proposals::get();
            $proposal_comments = ProposalComments::get();
            return view('proposals', compact('proposal','proposal_comments'));
        }elseif($type == 'requests'){
            if(Auth::user()->role == 'president'){
                $requests = Requests::where('access', 'president')->where('type', 'request')->get();
            }elseif(Auth::user()->role == 'vicepresident'){
                $requests = Requests::where('access', 'vicepresident')->where('type', 'request')->get();
            }elseif(Auth::user()->role == 'director'){
                $requests = Requests::where('access', 'director')->get();
            }elseif(Auth::user()->role == 'centermanager'){
                $requests = Requests::where('access', 'director')->orWhere('access', 'vicepresident')->orWhere('access', 'director')->orWhere('access', 'centermanager')->where('type', 'request')->get();
            }elseif(Auth::user()->role == 'areaspecialist'){
                $requests = Requests::where('access', 'director')->orWhere('access', 'vicepresident')->orWhere('access', 'director')->orWhere('access', 'centermanager')->orWhere('access', 'areaspecialist')->where('type', 'request')->get();
            }elseif(Auth::user()->role == 'dean'){
                $requests = Requests::where('access', 'director')->orWhere('access', 'vicepresident')->orWhere('access', 'director')->orWhere('access', 'centermanager')->orWhere('access', 'areaspecialist')->orWhere('access', 'dean')->where('type', 'request')->get();
            }
            $requests_comments = RequestComments::get();

            if(auth()->user()->role == 'deanccs'){
                $faculty = User::where('role','facultyccs')->get();
            }elseif(auth()->user()->role == 'deanccs'){
                $faculty = User::where('role','facultycea')->get();
            }elseif(auth()->user()->role == 'deancea'){
                $faculty = User::where('role','facultychs')->get();
            }elseif(auth()->user()->role == 'deanchs'){
                $faculty = User::where('role','facultyshs')->get();
            }elseif(auth()->user()->role == 'deanshs'){
                $faculty = User::where('role','facultychtm')->get();
            }elseif(auth()->user()->role == 'deanchtm'){
                $faculty = User::where('role','facultycoe')->get();
            }elseif(auth()->user()->role == 'deancoe'){
                $faculty = User::where('role','facultycbs')->get();
            }elseif(auth()->user()->role == 'deancbs'){
                $faculty = User::where('role','facultycssp')->get();
            }elseif(auth()->user()->role == 'deanlhs'){
                $faculty = User::where('role','facultylhs')->get();
            }elseif(auth()->user()->role == 'deancas'){
                $faculty = User::where('role','facultycas')->get();
            }elseif(auth()->user()->role == 'deancit'){
                $faculty = User::where('role','facultycit')->get();
            }else{
                $faculty = null;
            }

            return view('requests', compact('requests','requests_comments','faculty'));
        }elseif($type == 'inquiries'){
            $inquiry = Inquiry::where('type', 'inquire')->get();
            $inquiry_comments = InquiryComments::get();
            return view('inquiries', compact('inquiry','inquiry_comments'));
        }
        elseif($type == 'projects'){
            $projects = Projects::all();
            $proposal_comments = ProposalComments::get();
            return view('projects', compact('projects','proposal_comments'));
        }
    }
    public function request_month($month){
        $monthNumber = date('m', strtotime($month));
        $file = Inquiry::select('*')
                     ->where('type', 'request')
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

    public function projects_folder($folder){
        $file = Projects::where('project_title', $folder)->get();
        return view('projectsfolder', ['folder' => $folder], compact('file'));
    }

    public function proposalcommentsubmit(Request $request){
        if($request->remarks == null){
            return redirect()->back();
        }
        $proposal = new ProposalComments();
        $proposal->proposal_id = $request->proposal_id;
        $proposal->username = auth()->user()->username;
        $proposal->title = $request->title;
        $proposal->position = '@'. ucfirst(auth()->user()->role);
        $proposal->remarks = $request->remarks;
        $proposal->save();
        return redirect()->back()->with('success', 'Comment submitted successfully.');
    }

    public function requestcommentsubmit(Request $request){
        if($request->remarks == null){
            return redirect()->back();
        }
        $requests = new RequestComments();
        $requests->request_id = $request->request_id;
        $requests->username = auth()->user()->username;
        $requests->title = $request->title;
        $requests->position = '@'. ucfirst(auth()->user()->role);
        $requests->remarks = $request->remarks;
        $verifyPurpose = User::where('username', $request->username)->first();
        if($verifyPurpose->purpose == 'inquire'){
            $inquire = Inquiry::where('id', $request->request_id)->first();
            $inquire->reply_status = 'replied';
            $inquire->save();
            return redirect()->back();
        }
        $requests->save();
        return redirect()->back()->with('success', 'Comment submitted successfully.');
    }

    public function repository($category){
        if($category == 'ongoing'){
            $projects = Projects::where('phase', '>=' , 3)->get();
        }elseif($category == 'completed'){
            $projects = Projects::where('phase', '=', 4)->get();
        }
        return view('repository', ['category' => $category, 'projects' => $projects]);
    }

    public function inquirycommentsubmit(Request $request){
        if($request->reply == null){
            return redirect()->back();
        }
        $inquiry = new InquiryComments();
        $inquiry->inquiry_id = $request->request_id;
        $inquiry->username = auth()->user()->username;
        $inquiry->position = '@'. ucfirst(auth()->user()->role);
        $inquiry->reply = $request->reply;

     
        $inquire_notif = Inquiry::where('id', $request->request_id)->first();
        $inquire_notif->reply_status = 'replied';
        $inquire_notif->save();
        $inquiry->save();


        $notification = new Notifications();
        $notification->inquiry_no = $request->request_id;
        $notification->sender = '@' . ucfirst(auth()->user()->role);
        $notification->receiver = $request->username;
        $notification->title = $request->title;
        $notification->message = $request->reply;
        $notification->status = 'unread';
        $notification->save();

        return redirect()->back()->with('success', 'Comment submitted successfully.');
    }

    public function selectdepartment(Request $request){
        $request->validate([
            'department' => 'required',
        ]);
        $requests = Inquiry::where('id', $request->request_id)->first();
        $requests->department = $request->department;
        $requests->save();
        return redirect()->back()->with('success', 'Department changed successfully.');
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
            $request->file->move(public_path('documents/requests'), $file);
            $proposal = new Requests();
            $proposal->username = auth()->user()->username;
            $proposal->title = $request->title;
            $proposal->position = $request->position;
            $proposal->location = $request->location;
            $proposal->status = 'pending';
            $proposal->access = 'president';
            $proposal->type = auth()->user()->purpose;
            $proposal->file = $file;
            $proposal->save();
        }else{
            $proposal = new Inquiry();
            $proposal->username = auth()->user()->username;
            $proposal->title = $request->title;
            $proposal->position = $request->position;
            $proposal->location = $request->location;
            $proposal->inquiry = $request->inquiry;
            $proposal->status = 'pending';
            $proposal->access = 'president';
            $proposal->type = auth()->user()->purpose;
            $proposal->save();
        }

        return redirect()->back()->with('success', 'Inquiry submitted.');
    }

    public function requesttransfer(Request $request){
        if(Auth()->user()->role === 'president'){
            $requests = Requests::where('id', $request->id)->first();
            $requests->access = 'vicepresident';
            $requests->save();
        }
        elseif(Auth()->user()->role === 'vicepresident'){
            $requests = Requests::where('id', $request->id)->first();
            $requests->access = 'director';
            $requests->save();
        }
     
        return redirect()->back()->with('success', 'Transferred successfully.');
    }

    public function inquirytransfer(Request $request){
        dd($request->all());
        if($request->reply != null){
            $requests->inquiry_id = $request->id;
            $requests->reply = $request->reply;
            $requests->save();

        }

        return redirect()->back()->with('success', 'Transferred successfully.');
    }

    public function notifications(){
        $notifications = Notifications::where('receiver', auth()->user()->username)->orderBy('created_at', 'desc')->get();
        return view('notification', compact('notifications'));
    }

    public function notificationroute($route){
        $notifications = Notifications::where('status', $route)->orderBy('created_at', 'desc')->get();
    
        return view('notification', ['route' => $route, 'notifications' => $notifications]);

    }

    public function notificationupdate(Request $request)
    {
        if ($request->category == 'delete') {
            foreach ($request->id as $id) {
                $notifications = Notifications::where('id', $id)->first();
                $notifications->delete();
            }
        }elseif ($request->category == 'markasread') {
            foreach ($request->id as $id) {
                $notifications = Notifications::where('id', $id)->first();
                $notifications->status = 'read';
                $notifications->save();
            }
        }elseif ($request->read) {
                $notifications = Notifications::where('id', $request->read)->first();
                $notifications->status = 'read';
                $notifications->save();
        }elseif($request->category){
                $notifications = Notifications::where('status', $request->category)->first();
        }
        return redirect()->back()->with('notifications');
    }
    
    

    public function requestsoption(Request $request, $month){
        if (empty($request->option)) {
            $request->validate([
                'option' => 'required',
            ]);
        }
    
        if ($request->option === 'rename') {
            $requests = Inquiry::where('id', $request->folder_id)->first();
            $requests->title = $request->new_name; 
            $requests->save();
        } elseif ($request->option === 'delete') {
            $requests = Inquiry::where('id', $request->folder_id)->first();
            if ($requests && $requests->file) {
                $filePath = public_path('documents/requests/' . $requests->file);
                if (file_exists($filePath)) {
                    unlink($filePath);  
                }
            }
            $requests->delete();
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
        $proposal = Auth()->user()->id;
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
        $notices = NoticeBoard::orderBy('created_at', 'desc')->take(8)->get();
        $projects = Projects::where('phase', '<=', 3)->orderBy('created_at', 'desc')->take(5)->get();
        if(auth()->user()->role == 'president' || auth()->user()->role == 'vicepresident' || auth()->user()->role == 'director'){
            // $total_requests = Inquiry::count();
            // $total_proposals = Proposals::count();
            // $total = ($total_proposals + $total_requests) ?? 0;
            // $requests_percentage = ($total > 0) ? (($total_requests / $total) * 100) : 0;
            // $proposals_percentage = ($total > 0) ? (($total_proposals / $total) * 100) : 0;

            // Dummy Data
            $ccs = 70;
            $cea = 72;
            $shs = 24;
            $chs = 10;
            $total = $ccs + $cea + $shs + $chs;
            $ccs_percentage = ($total > 0) ? (($ccs / $total) * 100) : 0;
            $cea_percentage = ($total > 0) ? (($cea / $total) * 100) : 0;
            $shs_percentage = ($total > 0) ? (($shs / $total) * 100) : 0;
            $chs_percentage = ($total > 0) ? (($chs / $total) * 100) : 0;
            $total_percentage = ($total > 0) ? (($total / $total) * 100) : 0;
           
            return view('dashboard', compact('notices','ccs_percentage','cea_percentage','shs_percentage','chs_percentage','total_percentage'));
        }
        elseif(auth()->user()->role == 'areaspecialist' || auth()->user()->role == 'centermanagement'){
            $total_inquiries = Inquiry::where('type', 'inquire')->count();
            $total_requests = Inquiry::where('type', 'request')->count();
            $recent_files = Inquiry::latest()->take(5)->get();
        return view('dashboard', compact('notices','total_requests','total_inquiries','recent_files'));
        }

        return view('dashboard', compact('notices','projects'));
    }

    public function proposalsoption(Request $request, $folder){
        if (empty($request->option)) {
            $request->validate([
                'option' => 'required',
            ]);
        }
    
        if ($request->option === 'rename') {
            $requests = Proposals::where('id', $request->folder_id)->first();
            $newName = $request->new_name;
            $fileExtension = $request->file_extension;
            $extension = pathinfo($newName, PATHINFO_EXTENSION);
        
            if ($extension !== $fileExtension) {
                $newName .= '.' . $fileExtension;
            }

            $oldFilePath = public_path("documents/proposals/{$requests->project_title}");
            $newFilePath = public_path("documents/proposals/{$newName}");

            if (file_exists($oldFilePath)) {
                rename($oldFilePath, $newFilePath);
            }

            $requests->file = $newName;
            $requests->save();
        }
         elseif ($request->option === 'delete') {
            $requests = Proposals::where('id', $request->folder_id)->first();
            if ($requests && $requests->file) {
                $filePath = public_path('documents/proposals/' . $requests->file);
                if (file_exists($filePath)) {
                    unlink($filePath);  
                }
            }
            $requests->delete();
        }
        return redirect()->back();
    }

    public function progressbar(Request $request){
        $project = Projects::where('project_title', $request->title)->get();
        foreach($project as $project){
            if($project->phase != 4){
                $project->phase += 1;
                $project->save();
            }
        }
        return redirect()->back();
    }

    public function proposalsubmit(Request $request){
        if($request->type == 'approve'){
            $proposal = Proposals::where('id', $request->proposal)->first();
            $project = new Projects();
            $project->user_id =  $proposal->id;
            $project->firstname = $proposal->firstname;
            $project->lastname = $proposal->lastname;
            $project->email = $proposal->email;
            $project->project_title = $proposal->project_title;
            $project->project_description = $proposal->project_description;
            $project->position = $proposal->position;
            $project->file = $proposal->file;
            $project->phase = 2;
            $project->save();
            $proposal = Proposals::where('id', $request->proposal)->delete();
            $notification = Notifications::create([
                'inquiry_no' => $proposal->id,
                'sender' => auth()->user()->id,
                'receiver' => $request->user_id,
                'title' => "Proposal Accepted",
                'message' => "Dear " . $proposal->firstname . ",<br><br>Your proposal for " . $proposal->project_title . " has been accepted.",
                'status' => 'unread',
            ]);
        }elseif($request->type == 'reject'){
            $proposal = Proposals::where('id', $request->proposal)->first();
            $notification = Notifications::create([
                'inquiry_no' => $proposal->id,
                'sender' => auth()->user()->id,
                'receiver' => $request->user_id,
                'title' => "Proposal Rejected",
                'message' => "Dear " . $proposal->firstname . ",<br><br>I hope this message finds you well. After careful consideration, we regret to inform you that your proposal has not been approved at this time. Unfortunately, we are unable to provide specific feedback regarding the decision.<br><br>We appreciate your effort and interest, and we encourage you to continue sharing your ideas with us in the future.<br><br>Thank you for your understanding.",
                'status' => 'unread',
            ]);
            $proposal = Proposals::where('id', $request->proposal)->delete();
        }

        return redirect()->back();
    }



}
