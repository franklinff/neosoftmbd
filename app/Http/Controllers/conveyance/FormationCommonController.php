<?php

namespace App\Http\Controllers\conveyance;

use App\conveyance\scApplicationType;
use App\conveyance\SfApplication;
use App\conveyance\SfApplicationStatusLog;
use App\conveyance\SfScrtinyByEmMaster;
use App\conveyance\SfScrtinyByEmMasterDetail;
use App\conveyance\SocietyConveyanceDocumentMaster;
use App\Http\Controllers\Common\CommonController;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Storage;
use Yajra\DataTables\DataTables;
use Mpdf\Mpdf;
use App\OlApplication;
use App\SocietyOfferLetter;
use App\LayoutUser;

class FormationCommonController extends Controller
{
    public function __construct()
    {
        $this->list_num_of_records_per_page = config('commanConfig.list_num_of_records_per_page');
        $this->CommonController = new CommonController();
    }

    public function index(Request $request, Datatables $datatables)
    {
        $getData = $request->all();
        $data = $this->listApplicationData($request);
        $typeId = scApplicationType::where('application_type', '=', 'Formation')->value('id');
        $columns = [
            ['data' => 'radio', 'name' => 'radio', 'title' => '', 'searchable' => false],
            ['data' => 'rownum', 'name' => 'rownum', 'title' => 'Sr No.', 'searchable' => false],
            ['data' => 'application_no', 'name' => 'application_no', 'title' => 'Application Number'],
            ['data' => 'date', 'name' => 'date', 'title' => 'Date', 'class' => 'datatable-date'],
            ['data' => 'societyApplication.name', 'name' => 'societyApplication.name', 'title' => 'Society Name'],
            ['data' => 'societyApplication.building_no', 'name' => 'societyApplication.building_no', 'title' => 'building No'],
            ['data' => 'societyApplication.address', 'name' => 'societyApplication.address', 'title' => 'Address', 'class' => 'datatable-address'],
            ['data' => 'Status', 'name' => 'Status', 'title' => 'Status'],
        ];

        // dd($data);
        if ($datatables->getRequest()->ajax()) {

            return $datatables->of($data)
                ->editColumn('rownum', function ($data) {
                    static $i = 0; $i++;return $i;
                })

                ->editColumn('radio', function ($data) {
                    $url = route('formation.view_application', ['id' => encrypt($data->id)]);
                    return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" name="application_id" onclick="geturl(this.value);" value="' . $url . '" ><span></span></label>';
                })
                ->editColumn('application_no', function ($data) {

                    return $data->application_no;
                })
                ->editColumn('societyApplication.name', function ($data) {

                    return $data->societyApplication->name;
                })
                ->editColumn('societyApplication.building_no', function ($data) {

                    return $data->societyApplication->building_no;
                })
                ->editColumn('societyApplication.address', function ($data) {

                    return "<span>" . $data->societyApplication->address . "</span>";
                })
                ->editColumn('date', function ($data) {

                    return date(config('commanConfig.dateFormat'), strtotime($data->created_at));
                })

                ->editColumn('Status', function ($data) use ($request) {

                    $status = $data->sfApplicationLog->status_id;

                    if ($request->update_status) {
                        if ($request->update_status == $status) {
                            $config_array = array_flip(config('commanConfig.formation_status'));
                            $value = ucwords(str_replace('_', ' ', $config_array[$status]));
                            return '<span class="m-badge m-badge--' . config('commanConfig.formation_status_color.' . $status) . ' m-badge--wide">' . $value . '</span>';
                        }
                    } else {
                        $config_array = array_flip(config('commanConfig.formation_status'));

                        $value = ucwords(str_replace('_', ' ', $config_array[$status]));
                        return '<span class="m-badge m-badge--' . config('commanConfig.formation_status_color.' . $status) . ' m-badge--wide">' . $value . '</span>';
                    }

                })
                ->rawColumns(['radio', 'application_no', 'society_name', 'Status', 'building_name', 'societyApplication.address', 'date', 'typeId'])
                ->make(true);

        }

        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        return view('admin.formation.index', compact('html', 'header_data', 'getData', 'folder_name'));

    }

    protected function getParameters()
    {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering' => 'isSorted',
            "order" => [1, "asc"],
            "pageLength" => $this->list_num_of_records_per_page,
        ];
    }

    // list all data
    public function listApplicationData($request)
    {
        // dd($request->all());
        $conveyanceId = scApplicationType::where('application_type', '=', config('commanConfig.applicationType.Formation'))->value('id');

        $applicationData = SfApplication::with(['applicationLayoutUser', 'societyApplication', 'sfApplicationLog' => function ($q) use ($conveyanceId) {
            $q->where('user_id', Auth::user()->id)
                ->where('role_id', session()->get('role_id'))
                ->where('application_master_id', $conveyanceId)
                ->orderBy('id', 'desc');
        }])

            ->whereHas('sfApplicationLog', function ($q) use ($conveyanceId) {
                $q->where('user_id', Auth::user()->id)
                    ->where('role_id', session()->get('role_id'))
                    ->where('application_master_id', $conveyanceId)
                    ->orderBy('id', 'desc');
            });

            if($request->submitted_at_from)
            {
                $applicationData=$applicationData->where(\DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"),'>=',date('Y-m-d',strtotime($request->submitted_at_from)));
           // dd($applicationData->toSql());
            }

            if($request->submitted_at_to)
            {
                $applicationData=$applicationData->where(\DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"),'<=',date('Y-m-d',strtotime($request->submitted_at_to)));
            }

        $applicationData = $applicationData->orderBy('sf_applications.id', 'desc')->get();
        $listArray = [];
        //dd($applicationData);
        if ($request->update_status) {

            foreach ($applicationData as $app_data) {
                if ($app_data->sfApplicationLog->status_id == $request->update_status) {
                    $listArray[] = $app_data;
                }
            }
        } else {
            $listArray = $applicationData;
        }

        return $listArray;
    }

    public function ViewApplication(Request $request, $applicationId)
    {
        $disabled = 1;
        $id = decrypt($applicationId);
        $sf_documents = SocietyConveyanceDocumentMaster::with(['sf_document_status' => function ($q) use ($id) {
            return $q->where(['application_id' => $id]);
        }])->where(['application_type_id' => 3])->get();
        $sf_application = SfApplication::find($id);
        if($request->print)
            {
                //return view('frontend.society.society_formation.print_application',compact('sf_application'));
                $content = view('frontend.society.society_formation.print_application',compact('sf_application'));
                $folder_name = 'society_formation_certificate';

                $header_file = view('admin.REE_department.offer_letter_header');
                $footer_file = view('admin.REE_department.offer_letter_footer');
                //$pdf = \App::make('dompdf.wrapper');
                $fileName=time() . 'society_formation_certificate.pdf';
                $pdf=new Mpdf([
                    'default_font_size' => 9,
                    'default_font' => 'Times New Roman'
                ]);
                $pdf->autoScriptToLang = true;
                $pdf->autoLangToFont = true;
                $pdf->setAutoBottomMargin = 'stretch';
                $pdf->setAutoTopMargin = 'stretch';
                $pdf->SetHTMLHeader($header_file);
                $pdf->SetHTMLFooter($footer_file);
                $pdf->WriteHTML($content);
                $pdf->Output($fileName, 'D');
            }
        return view('admin.formation.view_application', compact('sf_application', 'sf_documents', 'disabled'));

        //return view('admin.conveyance.common.view_application',compact('data'));
    }

    //revert application child id
    public function getRevertApplicationChildData($society_id)
    {
       $SocietyOfferLetter= SocietyOfferLetter::find($society_id);
       $society_user_id=$SocietyOfferLetter->user_id;
       $society_user=User::where('id',$society_user_id)->get();
      // dd($society_user);
        $role_id = Role::where('id', Auth::user()->role_id)->first();
        $result = json_decode($role_id->conveyance_child_id);
        $child = "";
        //dd($result);
        if ($result) {
            $layout_id_array=LayoutUser::where(['user_id'=>auth()->user()->id])->get()->toArray();
            $layout_ids = array_column($layout_id_array, 'layout_id');
            $child = User::with(['roles', 'LayoutUser' => function ($q) use($layout_ids){
                $q->whereIn('layout_id', $layout_ids);
            }])
                ->whereHas('LayoutUser', function ($q) use($layout_ids){
                    $q->whereIn('layout_id', $layout_ids);
                })
                ->whereIn('role_id', $result)->get();
        }

        if($child)
        {
            $child = $child->merge($society_user);
        }
        //dd($child);
        return $child;
    }

    //forward Application parent Id

    public function getForwardApplicationParentData()
    {
        $result = array();
        if (session()->get('role_name') == config('commanConfig.dyco_engineer')) {
            $role_id = Role::where('name', config('commanConfig.estate_manager'))->first();
            $result[] = $role_id->id;
        } else {
            $role_id = Role::where('id', Auth::user()->role_id)->first();
            $result = json_decode($role_id->conveyance_parent_id);
        }
        // dd($result);
        $parent = "";
        if ($result) {
            $layout_id_array=LayoutUser::where(['user_id'=>auth()->user()->id])->get()->toArray();
            $layout_ids = array_column($layout_id_array, 'layout_id');
            $parent = User::with(['roles', 'LayoutUser' => function ($q) use($layout_ids){
                $q->whereIn('layout_id', $layout_ids);
            }])
                ->whereHas('LayoutUser', function ($q) use($layout_ids){
                    $q->whereIn('layout_id', $layout_ids);
                })
            // ->whereHas('roles', function ($q) {
            //     $q->where('name', config('commanConfig.estate_manager'));
            // })
                ->whereIn('role_id', $result)->get();
        }
        //dd($parent);
        return $parent;
    }

    // get current status of application
    public function getCurrentStatus($application_id, $masterId)
    {
        $current_status = SfApplicationStatusLog::where('application_id', $application_id)
            ->where('application_master_id', $masterId)
            ->where('user_id', Auth::user()->id)
            ->where('role_id', session()->get('role_id'))
            ->orderBy('id', 'desc')->first();

        return $current_status;
    }

    public function getForwardApplicationData($applicationId)
    {
        // dd($applicationId);
        $data = SfApplication::with('societyApplication')
            ->where('id', $applicationId)->first();
        $society_id=$data->society_id;
        $data->society_role_id = Role::where('name', config('commanConfig.society_offer_letter'))->value('id');
        $data->status = $this->getCurrentStatus($applicationId, $data->sc_application_master_id);
        $data->parent = $this->getForwardApplicationParentData();
        $data->child = $this->getRevertApplicationChildData($society_id);
        return $data;
    }

    // get logs of DYCO dept
    public function getLogsOfDYCODepartment($applicationId, $masterId)
    {

        $roles = array(config('commanConfig.dycdo_engineer'), config('commanConfig.dyco_engineer'));

        $status = array(config('commanConfig.formation_status.forwarded'), config('commanConfig.formation_status.reverted'));

        $dycoRoles = Role::whereIn('name', $roles)->pluck('id');
        $dycologs = SfApplicationStatusLog::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)
            ->where('application_master_id', $masterId)->whereIn('role_id', $dycoRoles)->whereIn('status_id', $status)->get();

        return $dycologs;
    }

    // get logs of EM dept
    public function getLogsOfEmDepartment($applicationId, $masterId)
    {

        $roles = array(config('commanConfig.estate_manager'));

        $status = array(config('commanConfig.formation_status.forwarded'), config('commanConfig.formation_status.reverted'));

        $dycoRoles = Role::whereIn('name', $roles)->pluck('id');
        $dycologs = SfApplicationStatusLog::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)
            ->where('application_master_id', $masterId)->whereIn('role_id', $dycoRoles)->whereIn('status_id', $status)->get();

        return $dycologs;
    }

    // get logs of Society
    public function getLogsOfSociety($applicationId, $masterId)
    {
        $roles = array(config('commanConfig.society_offer_letter'));

        $status = array(config('commanConfig.formation_status.forwarded'), config('commanConfig.formation_status.reverted'));

        $societyRoles = Role::whereIn('name', $roles)->pluck('id');
        $ocietylogs = SfApplicationStatusLog::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)->where('society_flag', '=', '1')->where('application_master_id', $masterId)->whereIn('role_id', $societyRoles)->whereIn('status_id', $status)->get();
        // dd($societyRoles);

        return $ocietylogs;
    }

    public function commonForward(Request $request, $applicationId)
    {
        $applicationId = decrypt($applicationId);
        $sf_application = SfApplication::with('societyApplication')->where('id', $applicationId)->first();
        $data = $this->getForwardApplicationData($applicationId);
        $societyLogs = $this->getLogsOfSociety($applicationId, $data->sc_application_master_id);
        $dycoLogs = $this->getLogsOfDYCODepartment($applicationId, $data->sc_application_master_id);
        $EmLogs = $this->getLogsOfEmDepartment($applicationId, $data->sc_application_master_id);

        return view('admin.formation.forward_application', compact('data', 'societyLogs', 'dycoLogs','EmLogs', 'sf_application'));
    }

    public function saveForwardApplication(Request $request)
    {
        //return $request->all();
        $forwardData = $this->forwardApplication($request);
        return redirect()->route('get_sf_applications.index')->with('success', 'Application sent successfully.');
    }

    // forward and revert application
    public function forwardApplication(Request $request)
    {

        $Scstatus = "";
        $data = SfApplication::where('id', $request->applicationId)->first();
        $applicationStatus = $data->application_status;
        $masterId = $data->sc_application_master_id;

        $dycdoId = Role::where('name', config('commanConfig.dycdo_engineer'))->value('id');
        $dycoId = Role::where('name', config('commanConfig.dyco_engineer'))->value('id');

        if ($request->check_status == 1) {
            
            $status = config('commanConfig.formation_status.forwarded');
        } else {
            $status = config('commanConfig.formation_status.reverted');
        }
        if($data->no_dues_certificate_sent_to_society==1 && session()->get('role_name')==config('commanConfig.dycdo_engineer'))
        {
            $Tostatus = config('commanConfig.formation_status.processed_to_DDR');
            
        }else
        {
            $Tostatus = config('commanConfig.formation_status.in_process');
        }
        

        $application = [[
            'application_id' => $request->applicationId,
            'user_id' => Auth::user()->id,
            'role_id' => session()->get('role_id'),
            'status_id' => $status,
            'to_user_id' => $request->to_user_id,
            'to_role_id' => $request->to_role_id,
            'remark' => $request->remark,
            'current_status'=>1,
            'application_master_id' => $masterId,
            'created_at' => Carbon::now(),
        ],
            [
                'application_id' => $request->applicationId,
                'user_id' => $request->to_user_id,
                'role_id' => $request->to_role_id,
                'status_id' => $Tostatus,
                'to_user_id' => null,
                'to_role_id' => null,
                'remark' => $request->remark,
                'current_status'=>1,
                'open'=>1,
                'application_master_id' => $masterId,
                'created_at' => Carbon::now(),
            ],
        ];
        \DB::transaction(function () use($request,$application,$masterId,$Tostatus,$Scstatus){
            foreach($application as $application_log_statu)
            {
                SfApplicationStatusLog::where(['application_id'=>$request->applicationId,'open'=>1])->update(['open'=>0]);
                SfApplicationStatusLog::where(['application_id'=>$request->applicationId,'current_status'=>1,'user_id'=>$application_log_statu['user_id']])->update(['current_status'=>0]);
                $inserted_application_log = SfApplicationStatusLog::insert([$application_log_statu]);
            }
            if ($Scstatus != "") {
                SfApplication::where('id', $request->applicationId)->where('sc_application_master_id', $masterId)
                    ->update(['application_status' => $Tostatus]);
            }
        });
        //SfApplicationStatusLog::insert($application);
        
    }

    public function get_em_checklist_and_remarks_for_sf($application_id, $user_id)
    {
        $SfScrtinyByEmMaster = SfScrtinyByEmMaster::all();
        foreach ($SfScrtinyByEmMaster as $data) {
            $detail = SfScrtinyByEmMasterDetail::where(['sf_application' => $application_id, 'sf_scrutiny_master_by_em_id' => $data->id])->first();
            if ($detail) {

            } else {
                $enter_detail = new SfScrtinyByEmMasterDetail;
                $enter_detail->user_id = $user_id;
                $enter_detail->sf_application = $application_id;
                $enter_detail->sf_scrutiny_master_by_em_id = $data->id;
                $enter_detail->save();
            }
        }

        $final_detail = SfScrtinyByEmMasterDetail::with(['question'])->where(['sf_application' => $application_id])->get();
        return $final_detail;

    }

    public function get_sf_em_srutiny_and_remark($id)
    {
        $read_only = 0;
        $applicationId = decrypt($id);
        $SfScrtinyByEmMaster = SfScrtinyByEmMaster::all();
        $sf_application = SfApplication::with(['societyApplication', 'sfScrutinyByEM'])->where('id', $applicationId)->first();
        //dd($sf_application->sfScrutinyByEM);
        if (session()->get('role_name') != config('commanConfig.estate_manager') || $sf_application->no_dues_certificate_sent_to_society != 0) {
            $read_only = 1;
        }
        if (session()->get('role_name') == config('commanConfig.estate_manager') || $sf_application->sfScrutinyByEM->count() > 0) {
            $check_list_and_remarks = $this->get_em_checklist_and_remarks_for_sf($sf_application->id, auth()->user()->id);
        }
        //dd($check_list_and_remarks);
        $data = $this->getForwardApplicationData($applicationId);
        return view('admin.formation.scrutiny_and_remark', compact('check_list_and_remarks', 'sf_application', 'data', 'SfScrtinyByEmMaster', 'read_only'));
    }

    public function upload_em_scrutiny_document_for_sf(Request $request)
    {
        $file = $request->file('file');
        if ($file->getClientMimeType() == 'application/pdf') {
            $extension = $request->file('file')->getClientOriginalExtension();
            $dir = 'architect_layout_details';
            $filename = uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
            $storage = Storage::disk('ftp')->putFileAs($dir, $request->file('file'), $filename);
            if ($storage) {
                $enter_detail = SfScrtinyByEmMasterDetail::where(['sf_application' => $request->application_id, 'id' => $request->report_id, 'user_id' => auth()->user()->id])->first();
                if ($enter_detail) {
                    $enter_detail->file = $storage;
                    $enter_detail->save();

                }

                $response_array = array(
                    'status' => true,
                    'file_path' => config('commanConfig.storage_server') . "/" . $storage,
                    'doc_id' => $enter_detail->id,
                );
            } else {
                $response_array = array(
                    'status' => false,
                    'message' => 'file not uploaded',
                );
            }

        } else {
            $response_array = array(
                'status' => false,
                'message' => 'PDF file is required',
            );
        }

        return response()->json($response_array);
    }

    public function post_sf_em_srutiny_and_remark(Request $request)
    {
        $lables = $request->lable;
        $remarks = $request->remark;
        $j = 0;
        foreach ($request->report_id as $report_ids) {
            $detail = SfScrtinyByEmMasterDetail::where(['id' => $report_ids, 'sf_application' => $request->sf_application])->first();
            if ($detail) {
                if (isset($lables[$j])) {
                    if ($lables[$j] == 1) {
                        $detail->label1 = 1;
                        $detail->label2 = 0;
                    }
                    if ($lables[$j] == 2) {
                        $detail->label1 = 0;
                        $detail->label2 = 1;
                    }
                }

                $detail->remark = isset($remarks[$j]) ? $remarks[$j] : '';
                $detail->save();

            }
            $j++;
        }
        return back()->withSuccess('data added successfully!!!');
    }

    public function get_no_dues_certificate($id)
    {
        $content = "";
        $applicationId = decrypt($id);
        $sf_application = SfApplication::with('societyApplication')->where('id', $applicationId)->first();
        //dd($sf_application->societyApplication->building_no);
        if ($sf_application->no_dues_certificate_in_text != "") {

            $content = Storage::disk('ftp')->get($sf_application->no_dues_certificate_in_text);
        }

        return view('admin.formation.no_dues_certificate', compact('content', 'sf_application'));
    }

    public function post_no_dues_certificate(Request $request)
    {
        $no_due_certificate_pdf_file = "";
        $no_due_certificate_txt_file = "";
        $id = $request->applicationId;
        $applicaion_data = SfApplication::where('id', $request->applicationId)->first();
        if ($applicaion_data) {
            $pdf_file = $applicaion_data->no_due_certificate;
            if ($pdf_file) {
                $no_due_certificate_pdf_file = explode('/', $pdf_file);
                $no_due_certificate_pdf_file = end($no_due_certificate_pdf_file);
            }

            $text_file = $applicaion_data->no_due_certificate;
            if ($text_file) {
                $no_due_certificate_txt_file = explode('/', $text_file);
                $no_due_certificate_txt_file = end($no_due_certificate_txt_file);
            }
        }
        //dd($no_due_certificate_file);
        $content = str_replace('_', "", $_POST['ckeditorText']);
        $folder_name = 'society_formation_no_dues';

        $header_file = view('admin.REE_department.offer_letter_header');
        $footer_file = view('admin.REE_department.offer_letter_footer');
        //$pdf = \App::make('dompdf.wrapper');
        $pdf=new Mpdf([
            'default_font_size' => 9,
            'default_font' => 'Times New Roman'
        ]);
        $pdf->autoScriptToLang = true;
        $pdf->autoLangToFont = true;
        $pdf->setAutoBottomMargin = 'stretch';
        $pdf->setAutoTopMargin = 'stretch';
        $pdf->SetHTMLHeader($header_file);
        $pdf->SetHTMLFooter($footer_file);
        $pdf->WriteHTML($content);
        //$pdf->loadHTML($header_file . $content . $footer_file);

        $fileName = $no_due_certificate_pdf_file != "" ? $no_due_certificate_pdf_file : (time() . 'no_dues_certificate_' . $id . '.pdf');
        $filePath = $folder_name . "/" . $fileName;

        if (!(Storage::disk('ftp')->has($folder_name))) {
            Storage::disk('ftp')->makeDirectory($folder_name, $mode = 0777, true, true);
        }
        Storage::disk('ftp')->put($filePath, $pdf->Output($fileName, 'S'));
       // $file = $pdf->output();

        //text offer letter

        $folder_name1 = 'sf_no_dues_certificate';

        if (!(Storage::disk('ftp')->has($folder_name1))) {
            Storage::disk('ftp')->makeDirectory($folder_name1, $mode = 0777, true, true);
        }
        $file_nm = $no_due_certificate_txt_file != "" ? $no_due_certificate_txt_file : (time() . "no_dues_certificate_in_text_" . $id . '.txt');
        $filePath1 = $folder_name1 . "/" . $file_nm;

        Storage::disk('ftp')->put($filePath1, $content);
        //$filePath1="";
        SfApplication::where('id', $request->applicationId)->update(["no_due_certificate" => $filePath, "no_dues_certificate_in_text" => $filePath1]);
        // OlApplication::where('id',$request->applicationId)->update(["drafted_offer_letter" => $filePath]);
        return redirect()->route('formation.em_srutiny_and_remark', ['id' => encrypt($request->applicationId)])->withSuccess('Certificate Generated!');
    }

    public function society_documents($id)
    {
        $disabled = 1;
        $id = decrypt($id);
        $sf_documents = SocietyConveyanceDocumentMaster::with(['sf_document_status' => function ($q) use ($id) {
            return $q->where(['application_id' => $id]);
        }])->where(['application_type_id' => 3])->get();
        $sf_application = SfApplication::find($id);
        return view('admin.formation.society_documents', compact('sf_application', 'sf_documents', 'disabled'));

    }

    public function send_no_due_to_society(Request $request)
    {
        $application_id = decrypt($request->application_id);
        $sf_application = SfApplication::find($application_id);
        $sf_application->no_dues_certificate_sent_to_society = 1;
        $sf_application->save();
        if ($sf_application) {
            return back()->withSuccess('sent to society');
        } else {
            return back()->withError('Something went wrong!!!');
        }
        //dd($sf_application);
    }
}
