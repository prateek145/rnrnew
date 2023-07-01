<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\backend\Field;
use App\Models\User;
use App\Models\backend\Group;
use App\Models\backend\Application;
use App\Models\backend\ApplicationField;
use App\Models\backend\Fielduserid;
use App\Models\backend\Fieldgroupid;
use Illuminate\Support\Facades\Log;

class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //code...
        $field = Field::find($id);
        $groups = Group::where(['status' => 1])
            ->latest()
            ->get();
        $users = User::where('status', 1)
            ->latest()
            ->get();

        return view('backend.field.create', compact('field', 'groups', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'type' => 'required',
            'status' => 'required',
        ];

        $custommessages = [
            'name.required' => 'Required',
        ];

        $this->validate($request, $rules, $custommessages);
        //code...
        // dd($request->all());
        try {
            $data = $request->all();
            unset($data['applicationid']);
            unset($data['users']);
            unset($data['groups']);
    
            $application = Application::find($request->application_id);
            // dd($application);
            $applicationfields = Field::where('application_id', $application->id)->get();
            for ($i = 0; $i < count($applicationfields); $i++) {
                # code...
                if ($applicationfields[$i]->keyfield == 1) {
                    # code...
                    // dd('prateek');
                    if (isset($request->keyfield) && $request->keyfield == 1) {
                        # code...
                        throw new \Exception('Already Assign Key field');
                    }
                }
            }
    
            unset($data['_token']);
            if ($request->valuelistvalue) {
                unset($data['valuelistvalue']);
                $data['valuelistvalue'] = json_encode($request->valuelistvalue);
            }
    
            // dd($data);
            $data['forder'] = count($applicationfields) + 1;
            // dd($data);
            $field = Field::create($data);
            Log::channel('custom')->info('Userid -> ' . auth()->user()->custom_userid . ' , Field Created by -> ' . auth()->user()->name . ' ' . auth()->user()->lastname . ' Field Name -> ' . $field->name . ' Field Type -> ' . $field->type);
    
            // dd($request->groups);
            if ($request->groups) {
                for ($i = 0; $i < count($request->groups); $i++) {
                    $fieldgroup = new Fieldgroupid();
                    $fieldgroup->applicationid = $application->id;
                    $fieldgroup->fieldid = $field->id;
                    $fieldgroup->groupids = $request->groups[$i];
                    $fieldgroup->userid = auth()->id();
                    $fieldgroup->save();
                }
            }
    
            if ($request->users) {
                for ($i = 0; $i < count($request->users); $i++) {
                    $fielduser = new Fielduserid();
                    $fielduser->applicationid = $application->id;
                    $fielduser->fieldid = $field->id;
                    $fielduser->userids = $request->users[$i];
                    $fielduser->userid = auth()->id();
                    $fielduser->save();
                }
            }
    
            $applicationfield = new ApplicationField();
            $applicationfield->applicationid = $application->id;
            $applicationfield->fieldid = $field->id;
            $applicationfield->userid = auth()->id();
            $applicationfield->save();
    
            return redirect()
                ->route('application.edit', $application->id)
                ->with(['success' => 'Field Created.', 'field' => 'active']);
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
        //code...
        $field = Field::find($id);
        $groups = Group::where(['status' => 1])
            ->latest()
            ->get();
        $users = User::where('status', 1)
            ->where('role', '!=', 'admin')
            ->latest()
            ->get();
        $application = Application::find($id);

        return view('backend.field.create', compact('field', 'groups', 'users', 'application'));
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
            $field = Field::find($id);
            $groups = Group::where(['status' => 1])
                ->latest()
                ->get();

            $users = User::where('status', 1)
                ->where('role', '!=', 'admin')
                ->latest()
                ->get();

            if ($field->access == 'private') {
                # code...
                $selectedgroups = Fieldgroupid::where('fieldid', $id)
                    ->pluck('groupids')
                    ->toArray();
                $selectedusers = Fielduserid::where('fieldid', $id)
                    ->pluck('userids')
                    ->toArray();

                if ($selectedusers != []) {
                    # code...
                    $selectedusersarray = User::find($selectedusers);
                }

                if ($selectedgroups != []) {
                    # code...
                    $selectedgrouparray = Group::find($selectedgroups);
                }
            } else {
                # code...
                $selectedgroups = [];
                $selectedusers = [];
                $selectedusersarray = [];
                $selectedgrouparray = [];
            }

            // dd($selectedusersarray, $selectedgrouparray);
            // dd($userlist, $field);
            return view('backend.field.edit', compact('selectedusersarray', 'selectedgrouparray', 'selectedusers', 'field', 'groups', 'selectedgroups', 'users'));
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
        //code...
        $rules = [
            'name' => 'required',
            // 'forder' => 'required',
            'type' => 'required',
            'status' => 'required',
        ];

        $custommessages = [
            'forder' => 'Order is required',
        ];

        $this->validate($request, $rules, $custommessages);

        $data = $request->all();

        unset($data['_token']);
        unset($data['_method']);
        unset($data['users']);
        unset($data['groups']);

        if ($request->valuelistvalue) {
            # code...
            unset($data['valuelistvalue']);
            $data['valuelistvalue'] = json_encode($request->valuelistvalue);
        }

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

        // dd($data);
        // if ($request->groups) {
        //     # code...
        //     if (count($request->groups) > 0) {
        //         // dd($request->groups);
        //         # code...
        //         $data['groups'] = json_encode($request->groups);
        //     }
        // }


        // dd($data);

        //for logs
        $field = Field::find($id);
        // dd($field);
        // dd($request->groups);

        //for delete if user make private field to public
        if ($request->access == 'public') {
            $dids1 = Fieldgroupid::where('fieldid', $field->id)->pluck('id');
            if ($dids1) {
                # code...
                Fieldgroupid::destroy($dids1);
            }

            $dids2 = Fielduserid::where('fieldid', $field->id)->pluck('id');
            if ($dids2) {
                # code...
                Fielduserid::destroy($dids2);
            }
        }

        if ($request->groups) {
           
            $dids = Fieldgroupid::where('fieldid', $field->id)->pluck('id');
            Fieldgroupid::destroy($dids);
            for ($i = 0; $i < count($request->groups); $i++) {
                $fieldgroup = new Fieldgroupid();
                $fieldgroup->applicationid = $field->application_id;
                $fieldgroup->fieldid = $field->id;
                $fieldgroup->groupids = $request->groups[$i];
                $fieldgroup->userid = auth()->id();
                $fieldgroup->save();
            }
        }

        if ($request->users) {
           
            $dids = Fielduserid::where('fieldid', $field->id)->pluck('id');
            Fielduserid::destroy($dids);
            for ($i = 0; $i < count($request->users); $i++) {
                $fielduser = new Fielduserid();
                $fielduser->applicationid = $field->application_id;
                $fielduser->fieldid = $field->id;
                $fielduser->userids = $request->users[$i];
                $fielduser->userid = auth()->id();
                $fielduser->save();
            }
        }

        $changearray = [];
        if ($field->status == 1) {
            # code...
            $currentstatus = 'Active';
        } else {
            # code...
            $currentstatus = 'InActive';
        }

        if ($field->requiredfield == 1) {
            # code...
            $currentrequiredfield = 'Active';
        } else {
            # code...
            $currentrequiredfield = 'InActive';
        }

        if ($field->requireuniquevalue == 1) {
            # code...
            $currentrequireuniquevalue = 'Active';
        } else {
            # code...
            $currentrequireuniquevalue = 'InActive';
        }

        if ($field->keyfield == 1) {
            # code...
            $currentkeyfield = 'Active';
        } else {
            # code...
            $currentkeyfield = 'InActive';
        }
        $currentarray = [
            'name' => $field->name,
            'type' => $field->type,
            'status' => $field->currentstatus,
            'requiredfield' => $field->currentrequiredfield,
            'requireuniquevalue' => $field->currentrequireuniquevalue,
            'keyfield' => $field->keyfield,
            'access' => $field->access,
            'description' => $field->description,
        ];

        if ($field->name != $data['name']) {
            # code...
            $changearray['name'] = $data['name'];
        }

        if ($field->type != $data['type']) {
            # code...
            $changearray['type'] = $data['type'];
        }

        if ($field->access != $data['access']) {
            # code...
            $changearray['access'] = $data['access'];
        }

        if ($field->status != $data['status']) {
            # code...
            if ($data['status'] == 1) {
                # code...
                $changearray['status'] = 'Active';
            } else {
                # code...
                $changearray['status'] = 'InActive';
            }
        }

        if (isset($data['requiredfield']) && $field->requiredfield != $data['requiredfield']) {
            # code...
            if ($data['requiredfield'] == 1) {
                # code...
                $changearray['requiredfield'] = 'Active';
            } else {
                # code...
                $changearray['requiredfield'] = 'InActive';
            }
        }

        if (isset($data['requireuniquevalue']) && $field->requireuniquevalue != $data['requireuniquevalue']) {
            # code...
            if ($data['requireuniquevalue'] == 1) {
                # code...
                $changearray['requireuniquevalue'] = 'Active';
            } else {
                # code...
                $changearray['requireuniquevalue'] = 'InActive';
            }
        }

        if (isset($data['keyfield']) && $field->keyfield != $data['keyfield']) {
            # code...
            if ($data['keyfield'] == 1) {
                # code...
                $changearray['keyfield'] = 'Active';
            } else {
                # code...
                $changearray['keyfield'] = 'InActive';
            }
        }

        if (isset($data['description']) && $field->description != $data['description']) {
            # code...
            $changearray['description'] = $data['description'];
        }

        // dd($data);
        $field->update($data);
        Log::channel('custom')->info('Userid -> ' . auth()->user()->custom_userid . ' , Field Edited by -> ' . auth()->user()->name . ' ' . auth()->user()->lastname . ' Field Name -> ' . $field->name . ' Current Data -> ' . json_encode($currentarray) . ' Changed Data -> ' . json_encode($changearray));

        return redirect()
            ->back()
            ->with(['success' => 'Successfully Field Edit.']);
        try {
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
            $field = Field::find($id);
            $application = Application::find($field->application_id);
            $destroyids = ApplicationField::where(['applicationid'=> $application->id, 'fieldid'=> $field->id])->pluck('id');
            ApplicationField::destroy($destroyids);
            Log::channel('custom')->info('Userid ' . auth()->user()->custom_userid . ' , Field Deleted by ' . auth()->user()->name . ' ' . auth()->user()->lastname . ' Field Name -> ' . $field->name);
            Field::destroy($id);
            return redirect()
                ->back()
                ->with('success', 'Successfully Field Delete.');
            // dd($audit);
        } catch (\Exception $th) {
            //throw $th;
            return redirect()
                ->back()
                ->with('error', $th->getMessage());
        }
    }
}
