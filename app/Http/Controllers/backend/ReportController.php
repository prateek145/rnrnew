<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\backend\Report;
use App\Models\backend\Application;
use App\Models\backend\Field;
use App\Models\backend\Group;
use App\Models\backend\Dashboarduser;
use App\Models\backend\Formdata;
use App\Models\backend\Dashboardgroup;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
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
            $reports = Report::latest()->get();
            $applications = Application::where('status', 1)
                ->latest()
                ->get();

            return view('backend.report.index', compact('reports', 'applications'));
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
            // dd('prateek');
            $application = Application::find(session()->get('applicationid'));
            // session()->forget('applicationid');
            $fieldids = $application->applicationfields()->pluck('fieldid');
            $fields = Field::find($fieldids);

            // dd($fieldids, $fields);
            return view('backend.report.create', compact('fields', 'application'));
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
            if (isset($request->selectapplication) && $request->selectapplication == 'true') {
                # code...
                // dd($request->applicationid);
                session()->put('applicationid', $request->applicationid);
                return redirect()->route('report.create');
            } else {
                # code...
                dd($request->all());
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function chart_result(Request $request)
    {
        try {
            $application = Application::find($request->applicationid);
            $formdata = $application->formdata()->get();
            $formdataarray = [];
            for ($i = 0; $i < count($formdata); $i++) {
                # code...
                array_push($formdataarray, json_decode($formdata[$i]->data, true));
                $formdataarray[$i]['id'] = $formdata[$i]->id;
            }

            $matchedfieldids = [];
            for ($i = 0; $i < count($request->select); $i++) {
                # code...
                // dd($i);
                // dd($request->operators[$i], count($request->filter));
                if ($request->select[$i] == 'groupby') {
                    # code...
                    // dd($request->fieldname[$i]);
                } elseif ($request->select[$i] == 'countof') {
                    # code...
                    $count = $this->countof($request->fieldname[$i], $formdataarray);
                    // dd($count);
                    array_push($matchedfieldids, $count);
                }
            }
            $labels =[];
            $data = [];
            for ($i=0; $i <count($matchedfieldids) ; $i++) { 
                # code...
                // dd(array_keys($matchedfieldids[$i]), array_values($matchedfieldids[$i]), $matchedfieldids);
                array_push($labels, array_keys($matchedfieldids[$i])[0]);
                array_push($data, array_values($matchedfieldids[$i])[0]);
            }

            // dd($data, $labels);
            return view('backend.report.chartresult', compact('application', 'matchedfieldids', 'labels', 'data'));
        } catch (\Exception $th) {
            //throw $th;
            return redirect()
                ->back()
                ->with('error', $th->getMessage());
        }
    }

    public function chart_result_show()
    {
        try {
            dd($request->all());

            return view('backend.report.index', compact('reports', 'applications'));
        } catch (\Exception $th) {
            //throw $th;
            return redirect()
                ->back()
                ->with('error', $th->getMessage());
        }
    }

    public function filter_result(Request $request)
    {
        // dd($request->all());
        $application = Application::find($request->applicationid);
        $formdata = $application->formdata()->get();

        $formdataarray = [];
        for ($i = 0; $i < count($formdata); $i++) {
            # code...
            array_push($formdataarray, json_decode($formdata[$i]->data, true));
            $formdataarray[$i]['id'] = $formdata[$i]->id;
        }

        // dd($request->all());
        $matchedfieldids = [];
        for ($i = 0; $i < count($request->filter); $i++) {
            # code...
            // dd($i);
            // dd($request->operators[$i], count($request->filter));
            if ($request->operators[$i] == 'contain') {
                # code...
                $arr = $this->containes($request->filter[$i], $request->values[$i], $formdataarray);
                if ($arr != []) {
                    for ($i = 0; $i < count($arr); $i++) {
                        # code...
                        array_push($matchedfieldids, $arr[$i]);
                    }
                }
            } elseif ($request->operators[$i] == 'notcontain') {
                # code...
                $arr = $this->notcontaines($request->filter[$i], $request->values[$i], $formdataarray);
                if ($arr != []) {
                    for ($i = 0; $i < count($arr); $i++) {
                        # code...
                        array_push($matchedfieldids, $arr[$i]);
                    }
                }
            } elseif ($request->operators[$i] == 'equal') {
                # code...
                $arr = $this->equal($request->filter[$i], $request->values[$i], $formdataarray);
                if ($arr != []) {
                    for ($i = 0; $i < count($arr); $i++) {
                        # code...
                        array_push($matchedfieldids, $arr[$i]);
                    }
                }
            } elseif ($request->operators[$i] == 'notequal') {
                # code...
                $arr = $this->notequal($request->filter[$i], $request->values[$i], $formdataarray);
                if ($arr != []) {
                    for ($i = 0; $i < count($arr); $i++) {
                        # code...
                        array_push($matchedfieldids, $arr[$i]);
                    }
                }
            }
        }

        
        $formdatas = Formdata::find($matchedfieldids);
        // dd($matchedfieldids, $formdatas);
        return view('backend.report.filterresult', compact('application', 'formdatas'));
        try {
        } catch (\Exception $th) {
            //throw $th;
            return redirect()
                ->back()
                ->with('error', $th->getMessage());
        }
    }

    public function sorting_result(Request $request)
    {
        try {
            dd($request->all());

            return view('backend.report.index', compact('reports', 'applications'));
        } catch (\Exception $th) {
            //throw $th;
            return redirect()
                ->back()
                ->with('error', $th->getMessage());
        }
    }

    public function containes($field, $value, $array)
    {
        $arr = [];
        for ($i = 0; $i < count($array); $i++) {
            # code...
            // dd($array[$i][$field], $field);
            if (isset($array[$i][$field]) && is_string($array[$i][$field]) && str_contains($array[$i][$field], $value)) {
                # code...
                // dd($array[$i]);
                array_push($arr, $array[$i]['id']);
            }
        }

        return $arr;
    }

    public function notcontaines($field, $value, $array)
    {
        $arr = [];
        for ($i = 0; $i < count($array); $i++) {
            # code...
            // dd($array[$i][$field], $field);
            if (isset($array[$i][$field]) && is_string($array[$i][$field]) && !str_contains($array[$i][$field], $value)) {
                # code...
                // dd($array[$i]);
                array_push($arr, $array[$i]['id']);
            }
        }

        return $arr;
    }

    public function equal($field, $value, $array)
    {
        $arr = [];
        for ($i = 0; $i < count($array); $i++) {
            # code...
            // dd($array[$i][$field], $field);
            if (isset($array[$i][$field]) && is_string($array[$i][$field]) && $array[$i][$field] == $value) {
                # code...
                // dd($array[$i]);
                array_push($arr, $array[$i]['id']);
            }
        }

        return $arr;
    }

    public function notequal($field, $value, $array)
    {
        $arr = [];
        for ($i = 0; $i < count($array); $i++) {
            # code...
            // dd($array[$i][$field], $field);
            if (isset($array[$i][$field]) && is_string($array[$i][$field]) && $array[$i][$field] != $value) {
                # code...
                // dd($array[$i]);
                array_push($arr, $array[$i]['id']);
            }
        }

        return $arr;
    }

    public function countof($field, $array)
    {
        $count = 0;
        for ($i = 0; $i < count($array); $i++) {
            # code...
            if (array_key_exists($field, $array[$i]) && $array[$i] != '') {
                # code...
                $count++;
            }
        }

        return [$field => $count];
    }
}
