<?php

namespace App\Http\Controllers;

use App\Hearing;
use App\HearingStatusLog;
use App\UploadCaseJudgement;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Auth;
use App\RtiDepartmentUser;
use App\Http\Controllers\HearingController;
use App\Http\Controllers\Common\CommonController;
use Storage;

class UploadCaseJudgementController extends Controller
{
    public $header_data = array(
        'menu' => 'Hearing',
        'menu_url' => 'hearing',
        'upload' => 'Upload Case Document'
    );
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
    public function create($id)
    {
        $id = decrypt($id);
        $department_id = RtiDepartmentUser::where('user_id',Auth::id())->value('department_id');
        $header_data = $this->header_data;
        $arrData['hearing_data'] = Hearing::with(['hearingStatus', 'hearingPrePostSchedule', 'hearingApplicationType',
            'hearingSchedule',
            'hearingSchedule.prePostSchedule',
            'hearingStatusLog' => function($q) use($department_id){
            $q->where('department_id', $department_id);
        }])
            ->where('id', $id)
            ->first();
        $hearing_data = $arrData['hearing_data'];
//        dd($hearing_data);

        $HearingController = new HearingController();
        $hearingLogs = $HearingController->getHearingLogs($id);        
//        dd($hearing_data);
        return view('admin.upload_case_judgement.add', compact('header_data', 'arrData', 'hearing_data','hearingLogs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'description' => "required",
            'upload_judgement_case' => "required|mimes:pdf",
        ]);

        $data = [
            'user_id' => Auth::user()->id,
            'hearing_id' => $request->hearing_id,
            'description' => $request->description,
            'case_year' => $request->case_year,
            'case_number' => $request->case_number,
        ];

        if(isset($request->pre_post_hearing_id))
            $data['pre_post_hearing_id'] = $request->pre_post_hearing_id;
        else
            $data['scheduled_hearing_id'] = $request->scheduled_hearing_id;

        $time = time();
        if($request->hasFile('upload_judgement_case')) {
            $extension = $request->file('upload_judgement_case')->getClientOriginalExtension();
            if ($extension == "pdf") {
                $name = File::name($request->file('upload_judgement_case')->getClientOriginalName()) . '_' . $time . '.' . $extension;
                // $path = Storage::putFileAs('/upload_judgement_case', $request->file('upload_judgement_case'), $name, 'public');
                
                $folder_name = 'upload_judgement_case';
                $file = $request->file('upload_judgement_case');

                $CommonController = new CommonController();
                $path = $CommonController->ftpFileUpload($folder_name,$file,$name);

                $data['upload_judgement_case'] = $path;
                $data['judgement_case_filename'] = File::name($request->file('upload_judgement_case')->getClientOriginalName()). '.' . $extension;
            } else {
                return redirect()->back()->with('error','Invalid type of file uploaded (only pdf allowed)');
            }

        }
        UploadCaseJudgement::create($data);

        $department_id = RtiDepartmentUser::where('user_id',Auth::id())->value('department_id');
//        $parent_role_id = User::where('role_id', session()->get('parent'))->first();
//
//        $child_role_id = User::where('role_id', session()->get('child'))->first();

//        if((session()->get('role_name') == config('commanConfig.co_pa')) || (session()->get('role_name') == config('commanConfig.joint_co_pa'))){
//            $user_id = $parent_role_id->id;
//            $session_key = 'parent';
//        }else{
//            $user_id = $child_role_id->id;
//            $session_key = 'child';
//        }

        $hearing_status_log = [
            [
                'hearing_id' => $request->hearing_id,
                'user_id' => Auth::user()->id,
                'role_id' => session()->get('role_id'),
                'department_id' => $department_id,
                'hearing_status_id' => ($request->close_case == 1) ? config('commanConfig.hearingStatus.case_closed') : config('commanConfig.hearingStatus.case_under_judgement'),
                'to_user_id' => NULL,
                'to_role_id' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]

            // [
            //     'hearing_id' => $request->hearing_id,
            //     'user_id' => $user_id,
            //     'role_id' => session()->get($session_key),
            //     'hearing_status_id' => ($request->close_case == 1) ? config('commanConfig.hearingStatus.case_closed') : config('commanConfig.hearingStatus.case_under_judgement'),
            //     'to_user_id' => NULL,
            //     'to_role_id' => NULL,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now()
            // ]
        ];

        HearingStatusLog::insert($hearing_status_log);
//
        return redirect('/hearing')->with('success','Case Judgement document uploaded successfully');
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
        $id = decrypt($id);
        $department_id = RtiDepartmentUser::where('user_id',Auth::id())->value('department_id');
        $header_data = $this->header_data;
        $arrData['hearing_data'] = Hearing::with(['hearingStatus', 'hearingPrePostSchedule', 'hearingApplicationType',
            'hearingSchedule',
            'hearingSchedule.prePostSchedule',
            'hearingStatusLog' => function($q) use($department_id){
                $q->where('department_id', $department_id);
            }])
            ->where('id', $id)
            ->first();
        $hearing_data = $arrData['hearing_data'];
        $arrData['hearing_status'] = HearingStatusLog::where('hearing_id', $id)->orderBy('id', 'desc')->first();

        $HearingController = new HearingController();
        $hearingLogs = $HearingController->getHearingLogs($id);         

        return view('admin.upload_case_judgement.edit', compact('header_data', 'arrData', 'hearing_data','hearingLogs'));
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
        $this->validate($request,[
            'description' => "required",
        ]);

        $data = [
            'user_id' => Auth::user()->id,
            'hearing_id' => $request->hearing_id,
            'description' => $request->description,
            'case_year' => $request->case_year,
            'case_number' => $request->case_number,
        ];

        if(isset($request->pre_post_hearing_id))
            $data['pre_post_hearing_id'] = $request->pre_post_hearing_id;
        else
            $data['scheduled_hearing_id'] = $request->scheduled_hearing_id;

        $time = time();
        if($request->hasFile('upload_judgement_case')) {
            $extension = $request->file('upload_judgement_case')->getClientOriginalExtension();
            if ($extension == "pdf") {
                $name = File::name($request->file('upload_judgement_case')->getClientOriginalName()) . '_' . $time . '.' . $extension;
                // $path = Storage::putFileAs('/upload_judgement_case', $request->file('upload_judgement_case'), $name, 'public');
                $folder_name = 'upload_judgement_case';
                $file = $request->file('upload_judgement_case');

                $CommonController = new CommonController();
                $path = $CommonController->ftpFileUpload($folder_name,$file,$name);

                $data['upload_judgement_case'] = $path;
                $data['judgement_case_filename'] = File::name($request->file('upload_judgement_case')->getClientOriginalName()). '.' . $extension;
            } else {
                return redirect()->back()->with('error','Invalid type of file uploaded (only pdf allowed)');
            }

        }
        else
        {
            $data['upload_judgement_case'] = $request->upload_case;
            $data['judgement_case_filename'] = $request->judgement_case_filename;
        }

        UploadCaseJudgement::create($data);
        $department_id = RtiDepartmentUser::where('user_id',Auth::id())->value('department_id');
        $parent_role_id = User::where('role_id', session()->get('parent'))->first();

        $child_role_id = User::where('role_id', session()->get('child'))->first();

        if((session()->get('role_name') == config('commanConfig.co_pa')) || (session()->get('role_name') == config('commanConfig.joint_co_pa'))){
            $user_id = $parent_role_id->id;
            $session_key = 'parent';
        }else{
            $user_id = $child_role_id->id;
            $session_key = 'child';
        }

        $hearing_status_log = [
            [
                'hearing_id' => $request->hearing_id,
                'user_id' => Auth::user()->id,
                'role_id' => session()->get('role_id'),
                'department_id' => $department_id,
                'hearing_status_id' => ($request->close_case == 1) ? config('commanConfig.hearingStatus.case_closed') : config('commanConfig.hearingStatus.case_under_judgement'),
                'to_user_id' => NULL,
                'to_role_id' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // [
            //     'hearing_id' => $request->hearing_id,
            //     'user_id' => $user_id,
            //     'role_id' => session()->get($session_key),
            //     'hearing_status_id' => ($request->close_case == 1) ? config('commanConfig.hearingStatus.case_closed') : config('commanConfig.hearingStatus.case_under_judgement'),
            //     'to_user_id' => NULL,
            //     'to_role_id' => NULL,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now()
            // ]
        ];
        HearingStatusLog::insert($hearing_status_log);
//
        return redirect('/hearing')->with('success','Case Judgement document uploaded successfully');
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
}
