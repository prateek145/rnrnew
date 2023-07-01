<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\backend\Application;
use App\Models\backend\Group;
use App\Models\backend\Application_roles;
use App\Helpers\Helper;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        // dd('prateek');
        return view('backend.home');
    }

    public function index()
    {
        return view('home');
    }

    public function user_home()
    {
        try {
            //code...

            $loggedinuser = auth()->user();
            $userroles = $loggedinuser->userroles()->pluck('roleids');
            $applicationids = Application_roles::where('roleid', $userroles)->where('read', '!=', '0')->pluck('applicationid');
            $applications = Application::find($applicationids);
            // dd($userroles, $applicationids, $applications);
            return view('backend.backenduserhome', compact('applications'));
        } catch (\Exception $th) {
            //throw $th;
            return redirect()
                ->back()
                ->with('error', $th->getMessage());
        }
    }

    public function razorpay(Request $request)
    {
        try {
            //code...
            // Generated @ codebeautify.org
            dd('prateek');
            $data = [
                'amount' => 50000,
                'amount_paid' => 0,
                'currency' => 'INR',
            ];
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://api.razorpay.com/v1/orders',
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_COOKIEFILE => 'file.txt',
                CURLOPT_COOKIEJAR => 'file.txt',
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
                CURLOPT_USERPWD => 'rzp_live_lhgrMO0eBVfInc' . ':' . '2R7huhzG3LPvngJ23kTvqR7M',
            ]);

            $response = curl_exec($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            $res = json_decode($response, true);

            dd($res);
        } catch (\Throwable $th) {
            //throw $th;
            // return response()->json(
            //     [
            //         'status' => '400',
            //         'data' => [];
            //     ]
            // );
        }
    }

    public function chart(){
        // dd('prateek');
        return view('backend.chart.index');
    }
}
