<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\backend\Group;
use App\Models\backend\Application;
use App\Models\backend\Groupgroupids;
use App\Models\backend\Groupuserids;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        try {
            //code...
            $groups = Group::latest()->get();
            $users = User::orderBy('name')->get();
            $applications = Application::orderBy('name')->get();
            return view('backend.group.index', compact('groups', 'users'));
        } catch (\Exception $th) {
            //throw $th;
            return redirect()
                ->back()
                ->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            //code...
            $users = User::where('status', 1)->where('role', '!=' ,'admin')->latest()->get();
            $groups = Group::where('status', 1)->latest()->get();
            return view('backend.group.create', compact('users', 'groups'));
        } catch (\Exception $th) {
            //throw $th;
            return redirect()
                ->back()
                ->with('error', $th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // dd($request->all());
            $rules = [
                'name' => 'required|unique:groups',
                // 'attachments' => 'required|mimes:pdf,jpg,png|min:5|max:2048',
                // 'userids' => 'required',
                // 'user_id' => 'required',
                'status' => 'required',
                // 'description' => 'required',
            ];

            $custommessages = [
                'name.required' => 'Name Required',
                'name.unique' => 'Name Should Be Unique Required',
                'user_id.required' => 'User id Required',
                'status.required' => 'Status Required',
            ];

            $this->validate($request, $rules, $custommessages);
            //code...
            $data = $request->all();
            // dd($data);
            unset($data['_token']);
            unset($data['userids']);
            unset($data['groupids']);

            $group = Group::create($data);

            if (isset($request->userids)) {
                # code...
                for ($i = 0; $i < count($request->userids); $i++) {
                    $groupuser = new Groupuserids();
                    $groupuser->groupid = $group->id;
                    $groupuser->userids = $request->userids[$i];
                    $groupuser->created_by = auth()->id();
                    $groupuser->save();
                }

            }

            if (isset($request->groupids)) {
                # code...
                for ($i = 0; $i < count($request->groupids); $i++) {
                    $groupgroup = new Groupgroupids();
                    $groupgroup->groupid = $group->id;
                    $groupgroup->groupids = $request->groupids[$i];
                    $groupgroup->created_by = auth()->id();
                    $groupgroup->save();
                }
            }
    
            // dd($data);
           
            Log::channel('custom')->info('Userid -> ' . auth()->user()->custom_userid . ' , Group Created by -> ' . auth()->user()->name . ' ' . auth()->user()->lastname . ' Group Name -> ' . $group->name);

            return redirect()
                ->route('group.index')
                ->with('success', 'Group Created.');
        } catch (\Exception $th) {
            //throw $th;
            return redirect()
                ->back()
                ->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            //code...
            $group = Group::find($id);
            // dd($application->attachments);
            $groups = Group::where('status', 1)->latest()->get();
            $users = User::where('status', 1)->where('role', '!=' ,'admin')->orderBy('name')->get();
            $selectedusersids = $group->groupusers()->pluck('userids')->toArray();
            $selectedgroupsids = $group->groupgroups()->pluck('groupids')->toArray();
            $selectedusers = User::find($selectedusersids);
            $selectedgroups = Group::find($selectedgroupsids);
            // dd( $selectedusers, empty($selectedgroups));
            return view('backend.group.edit', compact('group', 'users','groups', 'selectedusers', 'selectedusersids', 'selectedgroupsids', 'selectedgroups'));
            // dd($audit);
        } catch (\Exception $th) {
            //throw $th;
            return redirect()
                ->back()
                ->with('error', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            // dd($request->all());
            $rules = [
                'name' => 'required',
                'status' => 'required',
                // 'description' => 'required',
            ];

            $custommessages = [
                'name.required' => 'Name Required',
                'user_id.required' => 'User id Required',
                'status.required' => 'Status Required',
            ];

            $this->validate($request, $rules, $custommessages);
            //code...
            $data = $request->all();
            // dd($data);
            unset($data['_token']);
            unset($data['userids']);
            unset($data['groupids']);

            $group = Group::find($id);

            if ($request->userids) {
                # code...
                $groupuserids = $group->groupusers()->pluck('id');
                Groupuserids::destroy($groupuserids);
                // dd($groupuserids);
                // dd('prateek');
                for ($i = 0; $i < count($request->userids); $i++) {
                    $groupuser = new Groupuserids();
                    $groupuser->groupid = $group->id;
                    $groupuser->userids = $request->userids[$i];
                    $groupuser->created_by = auth()->id();
                    $groupuser->save();
                }
            }

            if ($request->groupids) {
                # code...
                $groupgroupids = $group->groupgroups()->pluck('id');
                Groupgroupids::destroy($groupgroupids);
                for ($i = 0; $i < count($request->groupids); $i++) {
                    $groupgroup = new Groupgroupids();
                    $groupgroup->groupid = $group->id;
                    $groupgroup->groupids = $request->groupids[$i];
                    $groupgroup->created_by = auth()->id();
                    $groupgroup->save();
                }
            }

            // if (isset($data['mogroupids'])) {
            //     # code...
            //     unset($data['mogroupids']);
            //     $data['mogroupids'] = json_encode($request->mogroupids);
            // }
    
            // dd($data);
      
            $group->update($data);
            Log::channel('custom')->info('Userid -> ' . auth()->user()->custom_userid . ' , Group Created by -> ' . auth()->user()->name . ' ' . auth()->user()->lastname . ' Group Name -> ' . $group->name);

            return redirect()
                ->back()
                ->with('success', 'Group Updated.');
        } catch (\Exception $th) {
            //throw $th;
            return redirect()
                ->back()
                ->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            //code...
            $group = Group::find($id);
            $groupuserids = $group->groupusers()->pluck('id');
            Groupuserids::destroy($groupuserids);
            $groupgroupids = $group->groupgroups()->pluck('id');
            Groupgroupids::destroy($groupgroupids);
            Log::channel('custom')->info('Userid -> ' . auth()->user()->custom_userid . ' , Group Deleted by -> ' . auth()->user()->name . ' ' . auth()->user()->lastname . ' Group Name -> ' . $group->name);
            Group::destroy($id);

            return redirect()
                ->back()
                ->with('success', 'Successfully Group Delete.');
            // dd($audit);
        } catch (\Exception $th) {
            //throw $th;
            return redirect()
                ->back()
                ->with('error', $th->getMessage());
        }
    }
}
