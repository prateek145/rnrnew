<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\backend\Group;
use App\Models\backend\Userrole;
use App\Models\backend\Usergroup;
use App\Models\backend\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\backend\Groupuserids;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //code...
        $users = User::where('role', '!=' ,'admin')->latest()->get();
        // dd($users);
        return view('backend.users.index', compact('users'));
        try {
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
        $groups = Group::Orderby('id', 'DESC')->get();
        $roles = Role::Orderby('id', 'DESC')->get();
        // dd($groups);
        return view('backend.users.create', compact('groups', 'roles'));
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
            //code...
            $rules = [
                'email' => 'required|unique:users,email',
                'name' => 'required',
                'custom_userid' => 'required',
                'mobile_no' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'password' => 'required|min:6',
                'repassword' => 'required',
                'groupids' => 'required',
                'roleids' => 'required',
            ];

            $custommessages = [
                'email.unique' => 'Email Already Exists',
                'email.required' => 'Email Required',
                'mobile_no.regex' => 'Please Check Mobile Number',
                'groupids.required' => 'Group Id id Required',
                'roleids.required' => 'Role Id id Required',
            ];

            $this->validate($request, $rules, $custommessages);

            // dd($request->all());
            if ($request->password == $request->repassword) {
                # code...
                $data = $request->all();
                unset($data['_token']);
                unset($data['password']);
                unset($data['repassword']);
                unset($data['groupids']);
                unset($data['roleids']);
                // dd($data);

                $currentarray = json_encode($data);
                $data['password'] = Hash::make($request->password);
                // dd($data);
                $user = User::create($data);
                if ($request->groupids) {
                    # code...
                    for ($i = 0; $i < count($request->groupids); $i++) {
                        $userroup = new Usergroup();
                        $userroup->userid = $user->id;
                        $userroup->groupids = $request->groupids[$i];
                        $userroup->created_by = auth()->id();
                        $userroup->save();
                    }

                    $groups = Group::find($request->groupids);

                    for ($i = 0; $i < count($groups); $i++) {
                        # code...
                        $existedgroupusers = $groups[$i]
                            ->groupusers()
                            ->pluck('userids')
                            ->toArray();
                        if (in_array($user->id, $existedgroupusers)) {
                            # code...
                        } else {
                            # code...
                            $groupuser = new Groupuserids();
                            $groupuser->groupid = $groups[$i]->id;
                            $groupuser->userids = $user->id;
                            $groupuser->created_by = auth()->id();
                            $groupuser->save();
                        }
                    }
                }

                if ($request->roleids) {
                    # code...
                    for ($i = 0; $i < count($request->roleids); $i++) {
                        $userroup = new Userrole();
                        // dd($usergroup);
                        $userroup->userid = $user->id;
                        $userroup->roleids = $request->roleids[$i];
                        $userroup->created_by = auth()->id();
                        $userroup->save();
                    }
                }

                Log::channel('custom')->info('Userid -> ' . auth()->user()->custom_userid . ' , User Created by -> ' . auth()->user()->name . ' ' . auth()->user()->lastname . ' User Name -> ' . $user->name . ' Data -> ' . $currentarray);

                return redirect()
                    ->route('users.index')
                    ->with('success', 'User Created');
            } else {
                # code...
                throw new \Exception('Password Does Not Matched');
            }
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
        //
        // dd($id);
        $user = User::find($id);
        $groups = Group::Orderby('id', 'DESC')->get();
        $roles = Role::Orderby('id', 'DESC')->get();
        // $usergroupsids = $user
        //     ->usergroups()
        //     ->pluck('groupids')
        //     ->toArray();
        $usergroupsids = $user->selectedthroughgroup()->pluck('groupid')->toArray();
        // dd($usergroupsids, $selectedthroughgroup);
        $userrolesids = $user
            ->userroles()
            ->pluck('roleids')
            ->toArray();
        $selectedgroups = Group::find($usergroupsids);
        $selectedroles = Role::find($userrolesids);
        // dd($user->groupids);
        return view('backend.users.edit', compact('user', 'groups', 'roles', 'usergroupsids', 'userrolesids', 'selectedgroups', 'selectedroles'));
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
            //code...
            $rules = [
                'email' => 'required',
                'name' => 'required',
                'custom_userid' => 'required',
                'mobile_no' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'password' => 'required_with:password_confirmation|confirmed',
            ];

            $custommessages = [
                'email.unique' => 'Email Already Exists',
                'email.required' => 'Email Required',
                'mobile_no.regex' => 'Please Check Mobile Number',
            ];

            $this->validate($request, $rules, $custommessages);

            // dd($request->all());
            $user = User::find($id);
            if ($request->password == $request->repassword) {
                # code...
                $data = $request->all();
                unset($data['_token']);
                unset($data['password']);
                unset($data['password_confirmation']);
                unset($data['groupids']);
                unset($data['roleids']);

                if (isset($request->password)) {
                    # code...
                    $data['password'] = Hash::make($request->password);
                }

                if (isset($request->password_confirmation)) {
                    # code...
                }

                if ($request->groupids) {
                    # code...
                    $usergroupids = $user->usergroups()->pluck('id');
                    Usergroup::destroy($usergroupids);
                    for ($i = 0; $i < count($request->groupids); $i++) {
                        $userroup = new Usergroup();
                        $userroup->userid = $user->id;
                        $userroup->groupids = $request->groupids[$i];
                        $userroup->created_by = auth()->id();
                        $userroup->save();
                    }

                    $groups = Group::find($request->groupids);
                 
                    for ($i = 0; $i < count($groups); $i++) {
                        # code...
                        $existedgroupusers = $groups[$i]
                            ->groupusers()
                            ->pluck('userids')
                            ->toArray();
                        if (in_array($user->id, $existedgroupusers)) {
                            # code...
                        } else {
                            # code...
                            $groupuser = new Groupuserids();
                            // dd($existedgroupusers, $groups[$i], $user->id);
                            $groupuser->groupid = $groups[$i]->id;
                            $groupuser->userids = $user->id;
                            $groupuser->created_by = auth()->id();
                            $groupuser->save();
                        }
                    }
                }
              
      
                if ($request->roleids) {
                    # code...
                    $userroleids = $user->userroles()->pluck('id');
                    Userrole::destroy($userroleids);
                    // dd($request->roleids);
                    for ($i = 0; $i < count($request->roleids); $i++) {
                        $userroup = new Userrole();
                        // dd($usergroup);
                        $userroup->userid = $user->id;
                        $userroup->roleids = $request->roleids[$i];
                        $userroup->created_by = auth()->id();
                        $userroup->save();
                    }
                }
     
                $currentarray = json_encode($data);

                // dd($data);

                $user->update($data);
                Log::channel('custom')->info('Userid -> ' . auth()->user()->custom_userid . ' , User Created by -> ' . auth()->user()->name . ' ' . auth()->user()->lastname . ' User Name -> ' . $user->name . ' Data -> ' . $currentarray);

                return redirect()
                    ->back()
                    ->with('success', 'User Updated.');
            } else {
                # code...
                throw new \Exception('Password Does Not Matched');
            }
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
            $user = User::find($id);
            Log::channel('custom')->info('Userid -> ' . auth()->user()->custom_userid . ' , User Deleted by -> ' . auth()->user()->name . ' ' . auth()->user()->lastname . ' User Name -> ' . $user->name);
            User::destroy($id);

            return redirect()
                ->back()
                ->with('success', 'Successfully User Delete.');
            // dd($audit);
        } catch (\Exception $th) {
            //throw $th;
            return redirect()
                ->back()
                ->with('error', $th->getMessage());
        }
    }
}
