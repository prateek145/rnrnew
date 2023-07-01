<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\backend\Dashboard;
use App\Models\backend\Group;
use App\Models\backend\Dashboarduser;
use App\Models\backend\Dashboardgroup;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
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
            $dashboards = Dashboard::latest()->get();
            return view('backend.dashboard.index', compact('dashboards'));
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
            $groups = Group::where('status', 1)
                ->Orderby('id', 'DESC')
                ->get();

            $users = User::where('status', 1)
                ->where('role', '!=', 'admin')
                ->Orderby('id', 'DESC')
                ->get();
            return view('backend.dashboard.create', compact('users', 'groups'));
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
            $rules = [
                'name' => 'required|unique:dashboards',
                // 'attachments' => 'required|mimes:pdf,jpg,png|min:5|max:2048',
                'status' => 'required',
                // 'description' => 'required',
            ];

            $custommessages = [
                'name.unique' => 'Dashboard Name Should be Unique.',
            ];

            $this->validate($request, $rules, $custommessages);
            $data = $request->all();
            unset($data['_token']);
            unset($data['userids']);
            unset($data['groupids']);

            // dd($data);
            $dashboard = Dashboard::create($data);

            if (isset($request->userids)) {
                # code...
                unset($data['userids']);
                for ($i = 0; $i < count($request->userids); $i++) {
                    # code...
                    Dashboarduser::create([
                        'dashboardid' => $dashboard->id,
                        'userids' => $request->userids[$i],
                        'created_by' => auth()->id(),
                    ]);
                }
            }

            if (isset($request->groupids)) {
                # code...
                unset($data['groupids']);
                for ($i = 0; $i < count($request->groupids); $i++) {
                    # code...
                    Dashboardgroup::create([
                        'dashboardid' => $dashboard->id,
                        'groupids' => $request->groupids[$i],
                        'created_by' => auth()->id(),
                    ]);
                }
            }

            // dd('Userid ' . auth()->user()->custom_userid . ' Application Created by ' . auth()->user()->name . ' ' . auth()->user()->lastname . ' Application Name -> ' . $application->name . ', Application Status -> ' . $application->status);
            Log::channel('custom')->info('Userid -> ' . auth()->user()->custom_userid . ' , Dashboard Created by -> ' . auth()->user()->name . ' ' . auth()->user()->lastname . ' , Dashboard Name -> ' . $dashboard->name);
            return redirect()
                ->route('dashboard.index')
                ->with('success', 'Dashboard Created.');
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
            $dashboard = Dashboard::find($id);
            $users = User::where('status', 1)
                ->where('role', '!=', 'admin')
                ->Orderby('id', 'DESC')
                ->get();

            $groups = Group::where(['status' => 1])
                ->latest()
                ->get();

            if ($dashboard->access == 'private') {
                # code...
                $selectedgroups = Dashboardgroup::where('dashboardid', $dashboard->id)
                    ->pluck('groupids')
                    ->toArray();
                $selectedusers = Dashboarduser::where('dashboardid', $dashboard->id)
                    ->pluck('userids')
                    ->toArray();
            } else {
                # code...
                $selectedgroups = [];
                $selectedusers = [];
            }

            $selecteduserdata = User::find($selectedusers);
            $selectedgroupsdata = Group::find($selectedgroups);

            // dd($selecteduserdata, $selectedgroupsdata);
            return view('backend.dashboard.edit', compact('selecteduserdata', 'selectedgroupsdata', 'selectedgroups', 'selectedusers', 'users', 'groups', 'dashboard'));
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
            $rules = [
                'name' => 'required',
                // 'attachments' => 'required|mimes:pdf,jpg,png|min:5|max:2048',
                'status' => 'required',
                // 'description' => 'required',
            ];

            $custommessages = [
                'name.unique' => 'Dashboard Name Should be Unique.',
            ];

            $this->validate($request, $rules, $custommessages);
            $data = $request->all();
            // dd($data);
            unset($data['_token']);
            unset($data['userids']);
            unset($data['groupids']);

            // dd($data);
            $dashboard = Dashboard::find($id);

            if (isset($request->userids)) {
                # code...
                $dusers = Dashboarduser::where('dashboardid', $dashboard->id)->pluck('id');
                Dashboarduser::destroy($dusers);
                unset($data['users']);
                for ($i = 0; $i < count($request->userids); $i++) {
                    # code...
                    Dashboarduser::create([
                        'dashboardid' => $dashboard->id,
                        'userids' => $request->userids[$i],
                        'created_by' => auth()->id(),
                    ]);
                }
            }

            if (isset($request->groupids)) {
                # code...
                $dgroups = Dashboardgroup::where('dashboardid', $dashboard->id)->pluck('id');
                Dashboardgroup::destroy($dgroups);
                unset($data['groups']);
                for ($i = 0; $i < count($request->groupids); $i++) {
                    # code...
                    Dashboardgroup::create([
                        'dashboardid' => $dashboard->id,
                        'groupids' => $request->groupids[$i],
                        'created_by' => auth()->id(),
                    ]);
                }
            }
            // dd($data);
            $dashboard->update($data);

            // dd('Userid ' . auth()->user()->custom_userid . ' Application Created by ' . auth()->user()->name . ' ' . auth()->user()->lastname . ' Application Name -> ' . $application->name . ', Application Status -> ' . $application->status);
            Log::channel('custom')->info('Userid -> ' . auth()->user()->custom_userid . ' , Dashboard Updated by -> ' . auth()->user()->name . ' ' . auth()->user()->lastname . ' , Dashboard Name -> ' . $dashboard->name);
            return redirect()
                ->route('dashboard.index')
                ->with('success', 'Dashboard Created.');
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
            $dashboard = Dashboard::find($id);
            Log::channel('custom')->info('Userid -> ' . auth()->user()->custom_userid . ' , Dashboard Deleted by -> ' . auth()->user()->name . ' ' . auth()->user()->lastname . ' , Dashboard Name -> ' . $dashboard->name);
            Dashboard::destroy($id);

            return redirect()
                ->back()
                ->with('success', 'Successfully Dashboard Deleted.');
            // dd($audit);
        } catch (\Exception $th) {
            //throw $th;
            return redirect()
                ->back()
                ->with('error', $th->getMessage());
        }
    }
}
