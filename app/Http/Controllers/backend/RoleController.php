<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\backend\Application;
use App\Models\backend\Group;
use App\Models\backend\Role;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            //code...
            $roles = Role::where('status', 1)
                ->latest()
                ->get();
            return view('backend.role.index', compact('roles'));
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
        $groups = Group::where('status', 1)
            ->Orderby('id', 'DESC')
            ->get();
        $applications = Application::where('status', 1)
            ->Orderby('id', 'DESC')
            ->get();

        return view('backend.role/create', compact('groups', 'applications'));
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
                'name' => 'required|unique:roles',
                'status' => 'required',
            ];

            $custommessages = [
                'name.required' => 'Name Required',
                'name.unique' => 'Name Should Be Unique Required',
                'status.required' => 'Status Required',
            ];

            $this->validate($request, $rules, $custommessages);

            $data = $request->all();
            // dd($data);
            unset($data['_token']);

            if (isset($request->userids)) {
                # code...
                unset($data['userids']);
                $data['userids'] = json_encode($request->userids);
            }

            if (isset($request->groupids)) {
                # code...
                unset($data['groupids']);
                $data['groupids'] = json_encode($request->groupids);
            }

            // $application = Application::find($request->application_id);
            // dd($application);
            if ($request->groupids == null) {
                # code...
                throw new \Exception('Select Atleast Group.');
            }
            $role1 = Role::create($data);
            Log::channel('custom')->info('Userid -> ' . auth()->user()->custom_userid . ' , Role Created by -> ' . auth()->user()->name . ' ' . auth()->user()->lastname);

            return redirect()
                ->route('role.index')
                ->with('success', 'Successfully Roles Created.');
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
            $role = Role::find($id);
            // dd($role);
            $groups = Group::where('status', 1)
                ->latest()
                ->get();
            $applications = Application::orderBy('name')->get();

            return view('backend.role.edit', compact('role', 'groups', 'applications'));
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
            //code...
            // dd($request->all());
            $rules = [
                'name' => 'required',
                'status' => 'required',
                'groupids' => 'required'
            ];

            $custommessages = [
                'name.required' => 'Name Required',
                'name.unique' => 'Name Should Be Unique Required',
                'status.required' => 'Status Required',
                'groupids.required' => 'Group Selection Required'
            ];

            $this->validate($request, $rules, $custommessages);

            $role = Role::find($id);

         

            $data = $request->all();
            if (isset($request->groupids)) {
                # code...
                unset($data['groupids']);
                $data['groupids'] = json_encode($request->groupids);
            }
            $currentarray = $role;
            $changearray = $data;
            $role->update($data);

            Log::channel('custom')->info('Userid -> ' . auth()->user()->custom_userid . ' , Role Edited by -> ' . auth()->user()->name . ' ' . auth()->user()->lastname . ' Current Data -> ' . json_encode($currentarray) . ' Changed Data -> ' . json_encode($changearray));

            return redirect()
                ->back()
                ->with('success', 'Successfully Roles Updated.');
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
            // dd($id);
            $role = Role::find($id);
            Log::channel('user')->info('Userid ' . auth()->user()->custom_userid . ' , Role Deleted by ' . auth()->user()->name . ' ' . auth()->user()->lastname . ' Role Name -> ' . $role->name);
            Role::destroy($id);
            return redirect()
                ->back()
                ->with('success', 'Successfully Deleted.');
            // dd($audit);
        } catch (\Exception $th) {
            //throw $th;
            return redirect()
                ->back()
                ->with('error', $th->getMessage());
        }
    }
}
