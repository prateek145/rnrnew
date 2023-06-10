<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\backend\Group;
use App\Models\backend\Application;
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
            $users = User::where('status', 1)->latest()->get();
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
           

            if (isset($data['userids'])) {
                # code...
                unset($data['userids']);
                $data['userids'] = json_encode($request->userids);
            }

            if (isset($data['groupids'])) {
                # code...
                unset($data['groupids']);
                $data['groupids'] = json_encode($request->groupids);
            }

            if (isset($data['mogroupids'])) {
                # code...
                unset($data['mogroupids']);
                $data['mogroupids'] = json_encode($request->mogroupids);
            }
    
            // dd($data);
            $group = Group::create($data);
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
            $users = User::orderBy('name')->get();
            $selectedusers = [];
            if ($group->userids != null) {
                # code...
                $userids = json_decode($group->userids);
                for ($i = 0; $i < count($userids); $i++) {
                    # code...
                    $user = User::find($userids[$i]);
                    array_push($selectedusers, $user);
                }
            }
            // dd($userids, $selectedusers);
            return view('backend.group.edit', compact('group', 'users','groups', 'selectedusers'));
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
                // 'attachments' => 'required|mimes:pdf,jpg,png|min:5|max:2048',
                // 'userids' => 'required',
                // 'user_id' => 'required',
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
           

            if (isset($data['userids'])) {
                # code...
                unset($data['userids']);
                $data['userids'] = json_encode($request->userids);
            }

            if (isset($data['groupids'])) {
                # code...
                unset($data['groupids']);
                $data['groupids'] = json_encode($request->groupids);
            }

            if (isset($data['mogroupids'])) {
                # code...
                unset($data['mogroupids']);
                $data['mogroupids'] = json_encode($request->mogroupids);
            }
    
            // dd($data);
            $group = Group::find($id);
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
