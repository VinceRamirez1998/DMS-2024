<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Inquiry;
use App\Models\Projects;
use App\Models\Requests;
use App\Models\Proposals;
use App\Models\ActivityLog;
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
            if(Auth::user()->role == 'president' || Auth::user()->role == 'vicepresident' || Auth::user()->role == 'director' || Auth::user()->role == 'areaspecialist' || Auth::user()->role == 'centermanager'){
                $proposal = Proposals::get();
            }elseif(Auth::user()->role == 'coordinator' || Auth::user()->role == 'dean' || Auth::user()->role == 'facultyextensionist'){
                $proposal = Proposals::where('department', Auth::user()->department)->get();
            }
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
                $requests = Requests::where('access', 'centermanager')->where('type', 'request')->get();
            }elseif(Auth::user()->role == 'areaspecialist'){
                $requests = Requests::where('access', 'areaspecialist')->where('type', 'request')->get();
            }elseif (Auth::user()->role == 'dean') {
                $requests = Requests::where(function($query) {
                        $query->where('access', 'dean')
                              ->where('department', Auth::user()->department);
                    })
                    ->where('type', 'request') 
                    ->get();
            }elseif (Auth::user()->role == 'coordinator') {
                $requests = Requests::
                    where('access', 'coordinator')
                    ->where('department', Auth::user->department)
                    ->where('type', 'request') 
                    ->get();
            }elseif (Auth::user()->role == 'facultyextensionist') {
                $requests = Requests::
                    where('access', 'facultyextensionist')
                    ->where('department', Auth::user->department)
                    ->where('type', 'request') 
                    ->get();
            }
            return view('requests', compact('requests'));
        }
        elseif($type == 'projects'){
            $projects = Projects::all();
            $proposal_comments = ProposalComments::get();
            return view('projects', compact('projects','proposal_comments'));
        }
        elseif($type == 'inquiries'){
            $inquiry = Inquiry::where('type', 'inquire')->get();
            $inquiry_comments = InquiryComments::get();
            return view('inquiries', compact('inquiry','inquiry_comments'));
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
        $inquiry->position = '@'. ucfirst(auth()->user()->role);
        $inquiry->reply = $request->reply;
        $inquiry->username = auth()->user()->username;
        $inquire_notif = Inquiry::where('id', $request->request_id)->first();
        $inquire_notif->reply_status = 'replied';
        $inquire_notif->save();
        $inquiry->save();

        $notification = new Notifications();
        $notification->inquiry_no = $request->request_id;
        $notification->sender = auth()->user()->id;
        $notification->receiver = $request->user_id;
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
        if($request->department == 'dean' && Auth::user()->role == 'director'){
            $requests = Requests::where('id', $request->request_id)->first();
            foreach($request->selectdepartment as $departments){
                $department = new Requests();
                $department->username = $requests->username;
                $department->title = $requests->title;
                $department->position = $requests->position;
                $department->location = $requests->location;
                $department->file = $requests->file;
                $department->status = $requests->status;
                $department->type = $requests->type;
                $department->access = $request->department;
                $department->department = $departments ?? null;
                $department->inquiry = $requests->inquiry ?? null;
                $department->remarks = $requests->remarks ?? null;
                $department->inbox_status = $requests->inbox_status ?? null;
                $department->save();
            }
            $requests = Requests::where('id', $request->request_id)->delete();
        }else{
            $requests = Requests::where('id', $request->request_id)->first();
            $requests->access = $request->department;
            if(Auth::user()->role == 'areaspecialist'){
                $requests->access = 'coordinator';
            }
            if($request->selectdepartment){
                foreach($request->selectdepartment as $department){
                    $requests->department = $department;
                }
            }
            $requests->save();
        }
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
        $notifications = Notifications::where('receiver', auth()->user()->id)->orderBy('created_at', 'desc')->get();
        $sender = [];
    foreach ($notifications as $notification) {
        $sender[] = User::where('id', $notification->sender)->first()->role;
    }
        return view('notification', compact('notifications', 'sender'));
    }

    public function notificationroute($route){
        $notifications = Notifications::where('receiver', auth()->user()->id)->where('status', $route)->orderBy('created_at', 'desc')->get();
        $sender = [];
        foreach ($notifications as $notification) {
            $sender[] = User::where('id', $notification->sender)->first()->role;
        }
        return view('notification', ['route' => $route, 'notifications' => $notifications, 'sender' => $sender]);

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
        $proposal->user_id = Auth()->user()->id;
        $proposal->lastname = $request->lastname;
        $proposal->firstname = $request->firstname;
        $proposal->email = $request->email;
        $proposal->project_title = $request->project_title;
        $proposal->project_description = $request->project_description;
        $proposal->position = $request->position;
        $proposal->department = Auth::user()->department;
        $proposal->file = $file;
        $proposal->save();

        return redirect()->back()->with('success', 'Proposal submitted.');
    }

    public function dashboard(Request $request){
        $notices = NoticeBoard::orderBy('created_at', 'desc')->take(8)->get();
        $projects = Projects::where('phase', '<=', 3)->orderBy('created_at', 'desc')->take(5)->get();
        if(auth()->user()->role == 'president' || auth()->user()->role == 'vicepresident' || auth()->user()->role == 'director'){
            $department = session('department', 'CCS');
            $department_title = session('department_title', 'College of Computing Studies');
            $projects = Projects::where('department', $department)->get();
            // Pie Chart (Percentage)
            $ccs = ActivityLog::where('department', 'CCS')->count();
            $cea = ActivityLog::where('department', 'CEA')->count();
            $shs = ActivityLog::where('department', 'SHS')->count();
            $chs = ActivityLog::where('department', 'CHS')->count();
            $total = $ccs + $cea + $shs + $chs;
            $ccs_percentage = ($total > 0) ? (($ccs / $total) * 100) : 0;
            $cea_percentage = ($total > 0) ? (($cea / $total) * 100) : 0;
            $shs_percentage = ($total > 0) ? (($shs / $total) * 100) : 0;
            $chs_percentage = ($total > 0) ? (($chs / $total) * 100) : 0;
            $total_percentage = ($total > 0) ? (($total / $total) * 100) : 0;
            
            return view('dashboard', compact('projects','department','department_title','notices','ccs_percentage','cea_percentage','shs_percentage','chs_percentage','total_percentage'));
        }
        elseif(auth()->user()->role == 'areaspecialist' || auth()->user()->role == 'centermanagement'){
            $total_inquiries = Inquiry::where('type', 'inquire')->count();
            $total_requests = Inquiry::where('type', 'request')->count();
            $recent_files = Inquiry::latest()->take(5)->get();
        return view('dashboard', compact('notices','total_requests','total_inquiries','recent_files'));
        }

        return view('dashboard', compact('notices','projects'));
    }

    public function chartdepartment(Request $request){
        $department = $request->department;

        switch ($department) {
            case 'CCS':
                $department_title = 'College of Computing Studies';
                break;
            case 'CEA':
                $department_title = 'College of Engineering and Architecture';
                break;
            case 'SHS':
                $department_title = 'Senior High School';
                break;
            case 'CHS':
                $department_title = 'College of Health Science';
                break;
            default:
                $department_title = 'Wahoo';
        }
        session([
            'department' => $department,
            'department_title' => $department_title,
        ]);
        return redirect()->route('dashboard', '#department-container');
        
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
        $proposal = Proposals::where('id', $request->proposal)->first();
        if($request->type == 'approve'){
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
            $notification = Notifications::create([
                'inquiry_no' => $request->proposal,
                'sender' => auth()->user()->id,
                'receiver' => $request->user_id,
                'title' => "Proposal Accepted",
                'message' => "Dear " . $proposal->firstname . ",<br><br>Your proposal for " . $proposal->project_title . " has been accepted.",
                'status' => 'unread',
            ]);
        }elseif($request->type == 'reject'){
            $notification = Notifications::create([
                'inquiry_no' => $request->proposal,
                'sender' => auth()->user()->id,
                'receiver' => $request->user_id,
                'title' => "Proposal Rejected",
                'message' => "Dear " . $proposal->firstname . ",<br><br> After careful consideration, we regret to inform you that your proposal has not been approved at this time. Unfortunately, we are unable to provide specific feedback regarding the decision.<br><br>We appreciate your effort and interest, and we encourage you to continue sharing your ideas with us in the future.<br><br>Thank you for your understanding.",
                'status' => 'unread',
            ]);
        }
        $proposal = Proposals::where('id', $request->proposal)->delete();
        return redirect()->back();
    }

    public function addprojects(Request $request){
        // FIle upload multiple using foreach
        $files = $request->file('file');
        foreach ($files as $file) {
            $filename = $request->project_title . '-' . auth()->user()->username . '_proposal_' . date('m_d_Y_s') . '.' . $file->extension();
            $file->move(public_path('documents/proposals'), $filename);
            $projects = new Projects();
            $projects->user_id = auth()->user()->id;
            $projects->lastname = $request->lastname;
            $projects->firstname = $request->firstname;
            $projects->email = $request->email;
            $projects->project_title = $request->project_title;
            $projects->project_description = $request->project_description;
            $projects->position = $request->position;
            $projects->department = auth()->user()->department;
            $projects->file = $filename;
            $projects->save();
        }

        return redirect()->back();
    }

    public function projectsoption(Request $request){
        $project = Projects::where('id', $request->folder_id)->first();
            $newName = $request->new_name;
            $fileExtension = $request->file_extension;
            $extension = pathinfo($newName, PATHINFO_EXTENSION);
        
            if ($extension !== $fileExtension) {
                $newName .= '.' . $fileExtension;
            }

            $oldFilePath = public_path("documents/proposals/{$project->project_title}");
            $newFilePath = public_path("documents/proposals/{$newName}");

            if (file_exists($oldFilePath)) {
                rename($oldFilePath, $newFilePath);
            }

            $project->file = $newName;
            $project->save();
            return redirect()->back();
    }

    public function reports(Request $request){
        dd('asd');
        $projects = Projects::where('access', auth()->user()->role)->get();
        return view('reports', compact('projects'));
    }


}