<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\backend\Application;
use App\Models\backend\Application_roles;
use App\Models\backend\Field;

class AjaxController extends Controller
{
    //
    public function change_forder(Request $request)
    {
        try {
            //code...
            $application = Application::find($request->application_id);
            $fields = Field::where('application_id', $application->id)
                ->orderBy('forder', 'asc')
                ->get();

            for ($i = 0; $i < count($fields); $i++) {
                # code...
                // dd($fields[$i]->forder, $request->forderarray[$i]);
                $fields[$i]->forder = $request->forderarray[$i];
                $fields[$i]->save();
            }
            // dd($fields);
            return response()->json(['success' => 'true']);
        } catch (\Exception $th) {
            return response()->json(['success' => 'false', 'error' => $th->getMessage()]);
        }
    }

    public function togglebtnroles(Request $request){
        try {
            //code...
            $applicationrole = Application_roles::where('roleid', $request->roleid)->where('applicationid', $request->applicationid)->first();
            if ($applicationrole) {
                # code...
                $name = $request->name;
                // dd($applicationrole->$name);
                if ($applicationrole->$name == 0) {
                    # code...
                    $applicationrole->$name = 1;
                    $applicationrole->save();
                } else {
                    # code...
                    $applicationrole->$name = 0;
                    $applicationrole->save();
                }
                
            }else{
                $data = $request->all();
                unset($data['_token']);
                unset($data['name']);
                // dd();
                $name = $request->name;
                $approle =new Application_roles;
                $approle->roleid = $request->roleid;
                $approle->applicationid = $request->applicationid;
                $approle->$name = 1;
                $approle->save();
                
            }
            return response()->json(['success' => 'true']);

        } catch (\Exception $th) {
            return response()->json(['success' => 'false', 'error' => $th->getMessage()]);
        }
    }
}
