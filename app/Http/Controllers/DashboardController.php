<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class DashboardController extends Controller
{
    
    public function index() {
        $projects = Project::all();
        $finished = Project::select('id')->where('progress', '=', '100')->get();
        $current = Project::latest()->take(5)->get();
        $total_users = User::select('id')->get();
        $latest_users = User::where('id', '<>', auth()->user()->id)->latest()->take(5)->get();
        $projects_0 = Project::select('id')->where('progress', '=', '0')->get();
        $projects_25 = Project::select('id')->where('progress', '=', '25')->get();
        $projects_50 = Project::select('id')->where('progress', '=', '50')->get();
        $projects_75 = Project::select('id')->where('progress', '=', '75')->get();
        $projects_100 = Project::select('id')->where('progress', '=', '100')->get();
        $users_metrics = [];        
        foreach($latest_users as $user) {
            $projectsByUser = Project::select('progress', DB::raw('count(*) AS total'))->where('user_id', $user->id)->groupBy('progress')->get()->toArray();            
            $userClass = new stdClass();
            $userClass->id = $user->id;
            $userClass->name = $user->name;
            $userClass->photo = $user->photo;
            $userClass->projects = $projectsByUser;
            array_push($users_metrics, $userClass);            
        }
        $your_metrics = [];
        $singleUser = User::select('id', 'name', 'photo')->where('id', auth()->user()->id)->first();
        $projectsBySingleUser = Project::select('progress', DB::raw('count(*) AS total'))->where('user_id', $singleUser->id)->groupBy('progress')->get()->toArray();
        $singleUserClass = new stdClass();
        $singleUserClass->id = $singleUser->id;
        $singleUserClass->name = $singleUser->name;
        $singleUserClass->photo = $singleUser->photo;
        $singleUserClass->projects = $projectsBySingleUser;
        array_push($your_metrics, $singleUserClass);        
        return view('dashboards.index',
        [
                'projects' => $projects, 
                'total_users' => count($total_users),
                'latest_users' => $latest_users,
                'finished' => count($finished),
                'current' => $current,
                'projects_0' => count($projects_0),
                'projects_25' => count($projects_25),
                'projects_50' => count($projects_50),
                'projects_75' => count($projects_75),
                'projects_100' => count($projects_100),
                'users_metrics' => $users_metrics,
                'your_metrics' => $your_metrics
            ]
        );
    }

    public function search(Request $request) {
        $search = $request->search;
        $projects = Project::where('title', 'LIKE', '%'.$search.'%')
                    ->where('user_id', '<>', auth()->user()->id)
                    ->join('users', 'users.id', '=', 'projects.user_id')
                    ->get();
        return view('dashboards.search', ['projects' => $projects]);
    }

}
