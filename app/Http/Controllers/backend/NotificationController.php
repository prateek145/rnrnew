<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\backend\Notification;
use App\Models\backend\Application;
use App\Models\backend\Group;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
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
            $notifications = Notification::latest()->get();
            // dd($notifications);
            return view('backend.notifications.index', compact('notifications'));
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
            $applications = Application::latest()->get();
            $users = User::where('status', 1)
                ->latest()
                ->get();
            $groups = Group::where(['status' => 1])
                ->latest()
                ->get();

            $selectedgroups = [];

            $selectedusers = [];
            return view('backend.notifications.create', compact('selectedgroups', 'selectedusers', 'users', 'groups', 'applications'));
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
            //code...
            // dd($request->all());
            $data = $request->all();
            unset($data['_token']);
            unset($data['user_list']);
            unset($data['group_list']);
            unset($data['application_id']);

            //jsonencode
            $data['user_list'] = json_encode($request->user_list);
            $data['group_list'] = json_encode($request->group_list);
            $data['application_id'] = json_encode($request->application_id);

            //
            $notification = Notification::create($data);
            Log::channel('custom')->info('Attachment Created by -> ' . auth()->user()->name . ' ' . auth()->user()->lastname . ' , Notification Name -> ' . $notification->name . ' , Data -> ' . json_encode($data));
            return redirect()
                ->route('notifications.index')
                ->with('success', 'Notification Created.');
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
        //using show for indexing in notifications
        try {
            //code...
            $notifications = Notification::where('application_id', $id)
                ->latest()
                ->get();
            $application = Application::find($id);
            // dd($notifications,  $application);
            return view('backend.notifications.index', compact('notifications', 'application'));
        } catch (\Exception $th) {
            //throw $th;
            return redirect()
                ->back()
                ->with('error', $th->getMessage());
        }
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
            $notification = Notification::find($id);
            $applications = Application::latest()->get();
            $users = User::where('status', 1)
                ->latest()
                ->get();
            $groups = Group::where(['status' => 1])
                ->latest()
                ->get();

            $selectedgroups = [];
            if ($notification->group_list != 'null') {
                $groupids = json_decode($notification->group_list);
                # code...
                for ($i = 0; $i < count($groupids); $i++) {
                    # code...
                    $group = Group::find($groupids[$i]);
                    array_push($selectedgroups, $group);
                }
            }

            $selectedusers = [];
            if ($notification->user_list != 'null') {
                $userids = json_decode($notification->user_list);
                # code...
                for ($i = 0; $i < count($userids); $i++) {
                    # code...
                    $user = User::find($userids[$i]);
                    array_push($selectedusers, $user);
                }
            }

            $selectedapplications = [];
            if ($notification->applicatoin_id != 'null') {
                $applicationids = json_decode($notification->application_id);
                # code...
                for ($i = 0; $i < count($applicationids); $i++) {
                    # code...
                    $application = Application::find($applicationids[$i]);
                    array_push($selectedapplications, $application);
                }
            }

            // dd($selectedusers, $selectedgroups, $selectedapplications);
            return view('backend.notifications.edit', compact('selectedgroups','applications','selectedapplications', 'selectedusers', 'users', 'groups', 'notification'));
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
            $data = $request->all();
            unset($data['_token']);
            if ($request->user_list) {
                # code...
                unset($data['user_list']);
                $data['user_list'] = json_encode($request->user_list);

            }

            if ($request->group_list) {
                # code...
                unset($data['group_list']);
                $data['group_list'] = json_encode($request->group_list);

            }

            $notification = Notification::create($data);
            Log::channel('custom')->info('Attachment Created by -> ' . auth()->user()->name . ' ' . auth()->user()->lastname . ' , Notification Name -> ' . $notification->name . ' , Data -> ' . json_encode($data));
            return redirect()
                ->route('notifications.show', $request->application_id)
                ->with('success', 'Notification Created.');
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
            $notification = Notification::find($id);
            Log::channel('custom')->info('Userid -> ' . auth()->user()->custom_userid . ' , Attachment Deleted by -> ' . auth()->user()->name . ' ' . auth()->user()->lastname . ' , Notification Name -> ' . $notification->name);
            Notification::destroy($id);
            return redirect()
                ->back()
                ->with('success', 'Successfully Notification Delete.');
            // dd($audit);
        } catch (\Exception $th) {
            //throw $th;
            return redirect()
                ->back()
                ->with('error', $th->getMessage());
        }
    }

    public function custom_edit($id)
    {
        try {
            //code...
            // dd($id);
            $notification = Notification::find($id);
            // dd($notification);
            $users = User::where('status', 1)
                ->latest()
                ->get();
            $groups = Group::where(['status' => 1])
                ->latest()
                ->get();

            $selectedgroups = [];
            // dd($notification->group_list);
            if ($notification->group_list != 'null') {
                $groupids = json_decode($notification->group_list);
                # code...
                for ($i = 0; $i < count($groupids); $i++) {
                    # code...
                    $group = Group::find($groupids[$i]);
                    array_push($selectedgroups, $group);
                }
            }

            $selectedusers = [];
            if ($notification->user_list != 'null') {
                $userids = json_decode($notification->user_list);
                # code...
                for ($i = 0; $i < count($userids); $i++) {
                    # code...
                    $user = User::find($userids[$i]);
                    array_push($selectedusers, $user);
                }
            }
            // dd($selectedusers, $selectedgroups);
            return view('backend.notifications.customedit', compact('selectedgroups', 'selectedusers', 'users', 'groups', 'notification'));
            // dd($audit);
        } catch (\Exception $th) {
            //throw $th;
            return redirect()
                ->back()
                ->with('error', $th->getMessage());
        }
    }
}