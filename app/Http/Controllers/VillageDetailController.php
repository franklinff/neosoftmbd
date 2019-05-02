<?php

namespace App\Http\Controllers;

use App\Board;
use App\District;
use App\Http\Controllers\Dashboard\ArchitectLayoutDashboardController;
use App\Http\Requests\village_detail\EditVillageDetailRequest;
use App\Http\Requests\village_detail\VillageDetailRequest;
use App\LandSource;
use App\Layout\ArchitectLayout;
use App\SocietyDetail;
use App\Taluka;
use App\VillageDetail;
use App\DeletedVillages;
use App\LeaseDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Common\CommonController;
use DB;
use File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use function PHPSTORM_META\elementType;
use Storage;
use Symfony\Component\HttpFoundation\Session\Session;
use Yajra\DataTables\DataTables;
use Config;
use Excel;

class VillageDetailController extends Controller
{
    public $header_data = array(
        'menu' => 'Village Detail',
        'menu_url' => 'village_detail',
        'page' => '',
        'side_menu' => 'village_detail'
    );

    protected $list_num_of_records_per_page;

    public function __construct()
    {
        $this->CommonController = new CommonController();
        $this->list_num_of_records_per_page = Config::get('commanConfig.list_num_of_records_per_page');
    }


    public function print_data(Request $request)
    {
        $getData = [
            'village_name' =>session()->get('village_name'),
            'sr_no' =>session()->get('sr_no'),
            'villageLandSource' =>session()->get('villageLandSource')

        ];
        $village_data = VillageDetail::with(['villageLandSource', 'villageBoard','getDistrictName','getTalukaName'])
        ->where('user_id', Auth::user()->id)
        ->where('role_id', session()->get('role_id'))->join('boards', 'lm_village_detail.board_id', '=', 'boards.id')->join('land_source', 'lm_village_detail.land_source_id', '=', 'land_source.id');

        if($getData['village_name'])
        {
            $village_data = $village_data->where('village_name', 'like', '%'.$getData['village_name'].'%');
        }

        if($getData['sr_no'])
        {
            $village_data = $village_data->where('sr_no', 'like', '%'.$getData['sr_no'].'%');
        }

        if($getData['villageLandSource'])
        {
            $village_data = $village_data->where('land_source_id',$getData['villageLandSource']);
        }

$village_data = $village_data->selectRaw( DB::raw('lm_village_detail.id, boards.board_name as board,lm_village_detail.sr_no,lm_village_detail.village_name,land_source.source_name as source,lm_village_detail.land_address
,lm_village_detail.district,
lm_village_detail.taluka,
lm_village_detail.total_area,
lm_village_detail.possession_date,
lm_village_detail.remark,
lm_village_detail.other_remark,
lm_village_detail.other_land_source,
lm_village_detail.7_12_extract,
lm_village_detail.7_12_mhada_name,
lm_village_detail.property_card,
lm_village_detail.property_card_mhada_name,
lm_village_detail.land_cost,
lm_village_detail.extract_file_name,
lm_village_detail.created_at,
lm_village_detail.updated_at'))->get();
// dd($village_data);
        if(count($village_data) == 0){
                $dataListMaster = [];
                $dataList = [];
                $dataList['id'] = '';
                $dataList['Board'] = '';
                $dataList['Land Survey No'] = '';
                $dataList['Village Name'] = '';
                $dataList['Land Source'] = '';
                $dataList['Other Land Source'] = '';
                $dataList['Land Address'] = '';
                $dataList['District'] = '';
                $dataList['Taluka'] = '';
                $dataList['Total Area'] = '';
                $dataList['Possession Date'] = '';
                $dataList['Remark'] = '';
                $dataList['Other Remark'] = '';
                $dataList['Land Cost'] = '';
                $dataList["Is 7/12 on MHADA's Name"] = '';
                $dataList['Property Card'] = '';
                $dataList['Is Property card (PR card) is on MHADA’s name'] = '';
                $dataList['7/12 Extract'] = '';
                $dataList['7/12 Extract file name'] = '';
                $dataListKeys = array_keys($dataList);
                $dataListMaster[]=$dataList;
            }else{
                $i=1;
                foreach ($village_data as $dataList_key => $dataList_value) {
                    $dataList = [];
                    $dataList['id'] = $i;
                    $dataList['Board'] = $dataList_value['board'];
                    $dataList['Land Survey No'] = $dataList_value['sr_no'];
                    $dataList['Village Name'] = $dataList_value['village_name'];
                    $dataList['Land Source'] = $dataList_value['source'];
                    $dataList['Other Land Source'] = $dataList_value['other_land_source'] ?? NULL;
                    $dataList['Land Address'] = $dataList_value['land_address'];
                    $dataList['District'] = $dataList_value['getDistrictName']['district_name'];
                    $dataList['Taluka'] = $dataList_value['getTalukaName']['taluka_name'];
                    $dataList['Total Area'] = $dataList_value['total_area'];
                    $dataList['Possession Date'] = $dataList_value['possession_date'];
                    $dataList['Remark'] = $dataList_value['remark'];
                    $dataList['Other Remark'] = $dataList_value['other_remark'] ?? NULL;
                    $dataList['Land Cost'] = $dataList_value['land_cost'];
                    $dataList["Is 7/12 on MHADA's Name"] = ($dataList_value['7_12_mhada_name'] == 1) ? 'yes' : 'no';
                    $dataList['Property Card'] = $dataList_value['property_card'];
                    $dataList['Is Property card (PR card) is on MHADA’s name'] = ($dataList_value['property_card_mhada_name']) ? 'yes' : 'no';
                    $dataList['7/12 Extract'] = ($dataList_value['7_12_extract']) ? 'yes':'no' ;
                    $dataList['7/12 Extract file name'] = $dataList_value['extract_file_name'];
                    
                    $dataListKeys = array_keys($dataList);
                    $dataListMaster[]=$dataList;
                    $i++;
                }
            }
            
            return view('admin.print_data',compact('dataListMaster' ,'dataListKeys')); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Datatables $datatables)
    {
        $header_data = $this->header_data;
        $getData = $request->all();

        $lease_count = $this->getNotificationCount();
        session()->put('lease_end_date_count', $lease_count);

        $columns = [
            // ['data' => 'radio','name' => 'radio','title' => '','searchable' => false],
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
//            ['data' => 'villageBoard','name' => 'villageBoard.board_name','title' => 'Board Name'],
            ['data' => 'village_name','name' => 'village_name','title' => 'Village Name'],
            ['data' => 'sr_no','name' => 'sr_no','title' => 'Survey Number'],
            ['data' => 'villageLandSource','name' => 'villageLandSource.source_name','title' => 'Type of Land'],
//            ['data' => 'land_address', 'name' => 'land_address', 'title' => 'Land Address'],
            ['data' => 'possession_date','name' => 'possession_date','title' => 'Possession Date'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];

        if($request->excel)
        {
            $getData = [
                'village_name' =>session()->get('village_name'),
                'sr_no' =>session()->get('sr_no'),
                'villageLandSource' =>session()->get('villageLandSource')

            ];

            $village_data = VillageDetail::with(['villageLandSource', 'villageBoard','getDistrictName','getTalukaName'])
                                            ->where('user_id', Auth::user()->id)
                                            ->where('role_id', session()->get('role_id'))->join('boards', 'lm_village_detail.board_id', '=', 'boards.id')->join('land_source', 'lm_village_detail.land_source_id', '=', 'land_source.id');

            if($getData['village_name'])
            {
                $village_data = $village_data->where('village_name', 'like', '%'.$getData['village_name'].'%');
            }

            if($getData['sr_no'])
            {
                $village_data = $village_data->where('sr_no', 'like', '%'.$getData['sr_no'].'%');
            }

            if($getData['villageLandSource'])
            {
                $village_data = $village_data->where('land_source_id',$getData['villageLandSource']);
            }

//            dd($village_data->get()->toArray());

            $village_data = $village_data->selectRaw( DB::raw('lm_village_detail.id, boards.board_name as board,lm_village_detail.sr_no,lm_village_detail.village_name,land_source.source_name as source,lm_village_detail.land_address
            ,lm_village_detail.district
            ,lm_village_detail.taluka,
            lm_village_detail.total_area,
            lm_village_detail.possession_date
            ,lm_village_detail.remark,
            lm_village_detail.other_remark,
            lm_village_detail.other_land_source,
            lm_village_detail.7_12_extract
            ,lm_village_detail.7_12_mhada_name,
            lm_village_detail.property_card
            ,lm_village_detail.property_card_mhada_name,
            lm_village_detail.land_cost
            ,lm_village_detail.extract_file_name,
            lm_village_detail.created_at,
            lm_village_detail.updated_at'))->get();
            // dd($village_data);

            if(count($village_data) == 0){
                $dataListMaster = [];
                $dataList = [];
                $dataList['id'] = '';
                $dataList['Board'] = '';
                $dataList['Land Survey No'] = '';
                $dataList['Village Name'] = '';
                $dataList['Land Source'] = '';
                $dataList['Other Land Source'] = '';
                $dataList['Land Address'] = '';
                $dataList['District'] = '';
                $dataList['Taluka'] = '';
                $dataList['Total Area'] = '';
                $dataList['Possession Date'] = '';
                $dataList['Remark'] = '';
                $dataList['Other Remark'] = '';
                $dataList['Land Cost'] = '';
                $dataList["Is 7/12 on MHADA's Name"] = '';
                $dataList['Property Card'] = '';
                $dataList['Is Property card (PR card) is on MHADA’s name'] = '';
                $dataList['7/12 Extract'] = '';
                $dataList['7/12 Extract file name'] = '';
                $dataListMaster[]=$dataList;
            }else{
                $i=1;
                foreach ($village_data as $dataList_key => $dataList_value) {
                    
                    $dataList = [];
                    $dataList['id'] = $i;
                    $dataList['Board'] = $dataList_value['board'];
                    $dataList['Land Survey No'] = $dataList_value['sr_no'];
                    $dataList['Village Name'] = $dataList_value['village_name'];
                    $dataList['Land Source'] = $dataList_value['source'];
                    $dataList['Other Land Source'] = $dataList_value['other_land_source'] ?? NULL;
                    $dataList['Land Address'] = $dataList_value['land_address'];
                    $dataList['District'] = $dataList_value['getDistrictName']['district_name'];
                    $dataList['Taluka'] = $dataList_value['getTalukaName']['taluka_name'];
                    $dataList['Total Area'] = $dataList_value['total_area'];
                    $dataList['Possession Date'] = $dataList_value['possession_date'];
                    $dataList['Remark'] = $dataList_value['remark'];
                    $dataList['Other Remark'] = $dataList_value['other_remark'] ?? NULL;
                    $dataList['Land Cost'] = $dataList_value['land_cost'];
                    $dataList["Is 7/12 on MHADA's Name"] = ($dataList_value['7_12_mhada_name'] == 1) ? 'yes' : 'no';
                    $dataList['Property Card'] = $dataList_value['property_card'];
                    $dataList['Is Property card (PR card) is on MHADA’s name'] = ($dataList_value['property_card_mhada_name']) ? 'yes' : 'no';
                    $dataList['7/12 Extract'] = ($dataList_value['7_12_extract']) ? 'yes':'no' ;
                    $dataList['7/12 Extract file name'] = $dataList_value['extract_file_name'];
                    
                    $dataListKeys = array_keys($dataList);
                    $dataListMaster[]=$dataList;
                    $i++;
                }
            }

            return Excel::create('village_details_'.date('Y_m_d_H_i_s'), function($excel) use($dataListMaster){

                $excel->sheet('mySheet', function($sheet) use($dataListMaster)
                {
                    $sheet->fromArray($dataListMaster);
                });
            })->download('csv');
        }

        if ($datatables->getRequest()->ajax()) {

            DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));

            $village_data = VillageDetail::with(['villageLandSource', 'villageBoard'])
                                            ->where('user_id', Auth::user()->id)
                                            ->where('role_id', session()->get('role_id'))
                                            ->orderBy('id', 'desc');

            if($request->village_name)
            {
                session()->put('village_name',$request->village_name);
                $village_data = $village_data->where('village_name', 'like', '%'.$request->village_name.'%');
            }else{
                session()->forget('village_name');
            }

            if($request->sr_no)
            {
                session()->put('sr_no',$request->sr_no);
                $village_data = $village_data->where('sr_no', 'like', '%'.$request->sr_no.'%');
            }else{
                session()->forget('sr_no');
            }

            if($request->villageLandSource)
            {
                session()->put('villageLandSource',$request->villageLandSource);
                $village_data = $village_data->where('land_source_id',$request->villageLandSource);
            }else{
                session()->forget('villageLandSource');
            }

            $village_data = $village_data->selectRaw( DB::raw('@rownum  := @rownum  + 1 AS rownum').',village_name, lm_village_detail.id as id, board_id, sr_no, land_source_id, land_address, possession_date');

            return $datatables->of($village_data)
                // ->editColumn('radio', function ($village_data) {
                    // $url = route('village_detail.show', base64_encode($village_data->id));
                    // return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" onclick="geturl(this.value);" value="'.$url.'" name="village_data_id"><span></span></label>';
                // })
                ->editColumn('rownum', function ($village_data) {
                    static $i = 0;
                    $i++;
                    return $i;
                })
                ->editColumn('village_name', function ($village_data) {
                    return $village_data->village_name;
                    //return "<a href='".route('society_detail.index', $village_data->id)."'>$village_data->village_name</a>";
                })
                ->editColumn('sr_no', function ($village_data) {
                    return $village_data->sr_no;
                })
//                ->editColumn('villageBoard', function ($village_data) {
//                    return $village_data->villageBoard->board_name;
//                })
                ->editColumn('possession_date', function ($village_data) {
                    return date(config('commanConfig.dateFormat'), strtotime($village_data->possession_date));
                })
                ->editColumn('villageLandSource', function ($village_data) {
                    return $village_data->villageLandSource->source_name;
                })
                ->editColumn('actions', function ($village_data) {
                    return view('admin.village_detail.actions', compact('village_data'))->render();
                })
                ->rawColumns(['sr_no', 'villageLandSource', 'village_name', 'actions'])
                ->make(true);
        }

        $lands = LandSource::get();
        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        return view('admin.village_detail.index', compact('html','lands' ,'header_data','getData'));
    }

    protected function getParameters() {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering'   =>'isSorted',
            "order"=> [5, "desc" ],
            "pageLength" => $this->list_num_of_records_per_page
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $header_data = $this->header_data;
        $arrData['board'] = Board::where('status', 1)->get();
        $arrData['land_source'] = LandSource::where('status', 1)->get();

        $districts = District::get();

        return view('admin.village_detail.create', compact('header_data', 'arrData','districts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VillageDetailRequest $request)
    {
        $village_data = [
            'board_id' => $request->board_id,
            'sr_no' => $request->sr_no,
            'village_name' => $request->village_name,
            'land_source_id' => $request->land_source_id,
            'land_address' => $request->land_address,
            'district' => $request->district,
            'taluka' => $request->taluka,
            'remark' => $request->remark,
            'total_area' => $request->total_area,
            'property_card_area' => $request->property_card_area,
            'possession_date' => $request->possession_date,
            '7_12_mhada_name' => $request->mhada_name,
            'property_card' => $request->property_card,
            'property_card_mhada_name' => $request->property_card_mhada_name,
            'land_cost' => $request->land_cost,
            'user_id' => Auth::user()->id,
            'role_id' => session()->get('role_id')
        ];

        if($request->remark == 'other')
            $village_data += [
                'other_remark' =>$request->other_remark
            ];

        if($request->land_source_id == 4)
            $village_data += [
                'other_land_source' =>$request->other_land_source
            ];

        $time = time();

        if($request->file_upload == 1) {
            if ($request->hasFile('extract')) {
                $extension = $request->file('extract')->getClientOriginalExtension();
                if ($extension == "pdf") {
                    $name = File::name(str_replace(' ','_',($request->file('extract')->getClientOriginalName()))) . '_' . $time . '.' . $extension;
                    $folder_name = "7_12_extract_document";
                    $path = '/'.$folder_name.'/';
                    $fileUpload = $this->CommonController->ftpFileUpload($folder_name,$request->file('extract'),$name);
                    $village_data['7_12_extract'] = 1;
                    $village_data['extract_file_path'] = $path;
                    $village_data['extract_file_name'] = $name;
                } else {
                    return redirect()->back()->with('error', 'Invalid type of file uploaded (only pdf allowed)');
                }

            } else {
                return redirect()->back()->with('error', 'Please select file to upload');
            }
        }
        else
        {
            $village_data['extract_file_path'] = '';
            $village_data['extract_file_name'] = '';
            $village_data['7_12_extract'] = 0;
            $village_data['property_card_mhada_name'] = 0;
        }
        
        VillageDetail::create($village_data);

        return redirect('/village_detail')->with(['success'=> 'Village added succesfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id=base64_decode($id);
        $header_data = $this->header_data;
        $arrData['board'] = Board::where('status', 1)->get();
        $arrData['land_source'] = LandSource::where('status', 1)->get();
        $arrData['village_data'] = VillageDetail::FindOrFail($id)->toArray();
        $districts = District::get();
        $talukas = Taluka::get();
        return view('admin.village_detail.show', compact('header_data', 'arrData','districts','talukas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id=base64_decode($id);
        $header_data = $this->header_data;
        $arrData['board'] = Board::where('status', 1)->get();
        $arrData['land_source'] = LandSource::where('status', 1)->get();
        $arrData['village_data'] = VillageDetail::FindOrFail($id)->toArray();

        $districts = District::get();
        $talukas = Taluka::get();
//         dd($arrData['village_data']['taluka']);
        return view('admin.village_detail.edit', compact('header_data', 'arrData','districts','talukas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditVillageDetailRequest $request, $id)
    {
        $village = VillageDetail::find($id);
        $village_data = [
            'board_id' => $request->board_id,
            'sr_no' => $request->sr_no,
            'village_name' => $request->village_name,
            'land_source_id' => $request->land_source_id,
            'land_address' => $request->land_address,
            'district' => $request->district,
            'taluka' => $request->taluka,
            'total_area' => $request->total_area,
            'possession_date' => $request->possession_date,
            'remark' => $request->remark,
            '7_12_mhada_name' => $request->mhada_name,
            'property_card' => $request->property_card,
            'property_card_area' => $request->property_card_area,
            'property_card_mhada_name' => $request->property_card_mhada_name,
            'land_cost' => $request->land_cost,
            'user_id' => Auth::user()->id,
            'role_id' => session()->get('role_id')
        ];

        if($request->remark == 'other') $village_data += [ 'other_remark' =>$request->other_remark ];
        else $village_data += [ 'other_remark' => '' ];

        if($request->land_source_id == 4) $village_data += [ 'other_land_source' =>$request->other_land_source ];
        else $village_data += [ 'other_land_source' => '' ];

//        dd($request->all());

        $time = time();
        $folder_name = '7_12_extract_document';
        if($request->file_upload == 1) {
            if ($request->hasFile('extract')) {
                $extension = $request->file('extract')->getClientOriginalExtension();
                if ($extension == "pdf") {
                    // Deleting previous file
                    $previous_file = VillageDetail::where('id',$id)->value('extract_file_name');
                    if($previous_file) Storage::disk('ftp')->delete($folder_name.'/'.$previous_file);
                    // Uploading new file
                    $name = File::name(str_replace(' ','_',($request->file('extract')->getClientOriginalName()))) . '_' . $time . '.' . $extension;
                    $path='/'.$folder_name.'/';
                    $this->CommonController->ftpFileUpload($folder_name,$request->file('extract'),$name);
                    $village_data['7_12_extract'] = 1;
                    $village_data['extract_file_path'] = $path;
                    $village_data['extract_file_name'] = $name;
                } else {
                    return redirect()->back()->with('error', 'Invalid type of file uploaded (only pdf allowed)');
                }

            } else {
                // Deleting previous file
                $previous_file = VillageDetail::where('id',$id)->value('extract_file_name');
                if($previous_file) Storage::disk('ftp')->delete($folder_name.'/'.$previous_file);
                // Setting null value in database
                $village_data['extract_file_path'] = $request->extract_file_path;
                $village_data['extract_file_name'] = $request->extract_file_name;
            }
        }
        else {
            // Deleting previous file
            $previous_file = VillageDetail::where('id',$id)->value('extract_file_name');
            if($previous_file) Storage::disk('ftp')->delete($folder_name.'/'.$previous_file);

            // Setting null value in database
            $village_data['extract_file_path'] = '';
            $village_data['extract_file_name'] = '';
            $village_data['7_12_extract'] = 0;
            $village_data['property_card_mhada_name'] = 0;

        }

        $village->update($village_data);

        return redirect('/village_detail')->with(['success'=> 'Village edited succesfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $villageDetails = VillageDetail::findOrfail($id);
        $villageDetails->delete();

        DeletedVillages::create([
            'village_details_id' => $id,
            'land_name'          => $villageDetails->village_name,
            'day'                => date('l'),
            'date'               => date('Y-m-d'),
            'time'               => date("h:i:s"),
            'reason'             => $request->input('delete_message'),
            ]);

        return redirect()->back()->with(['success'=> 'Village deleted succesfully']);
    }

    public function loadDeleteVillageUsingAjax(Request $request){
        $id = $request->id;
        return view('admin.village_detail.villageDeteleReason', compact('id'))->render();
    }

    /**
     * Show the offer letter dashboard.
     *
     * Author: Prajakta Sisale.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard(){

        //Revision in Layout
        $architect_layout_count = ArchitectLayout::all()->count();
        $land_count = VillageDetail::get()->count();

        return view('admin.common.land_dashboard',compact('architect_layout_count','land_count'));

    }

    /**
     * Show the offer letter dashboard using ajax.
     *
     * Author: Prajakta Sisale.
     *
     *  @return json response
     */
    public function ajaxdashboard(Request $request){
        if($request->ajax()){

            if($request->module_name == "Land Summary"){
                // data of society with lease and without lease
                $current_date = date('Y-m-d');

                $society_data_with_active_lease= SocietyDetail::whereHas('societyLease',function($q) use($current_date){
                    $q->where('lease_renewal_date','>', $current_date)->where('lease_status',1);
                })->orderBy('id', 'desc')->get()->count();

                $society_data_with_expired_lease= SocietyDetail::whereHas('societyLease',function($q) use($current_date){
                    $q->where('lease_renewal_date','<', $current_date)->where('lease_status',1);
                })->orderBy('id', 'desc')->get()->count();


                $dashboardData = array();
                $dashboardData['Total Number of Lands'][0] = VillageDetail::get()->count();
                $dashboardData['Total Number of Lands'][1] = route('village_detail.index');
                $dashboardData['Total Number of Societies'][0] = SocietyDetail::get()->count();
                $dashboardData['Total Number of Societies'][1] = route('society_detail.index');
//                $dashboardData['Total Number of Leases'][0] = LeaseDetail::get()->count();
//                $dashboardData['Total Number of Leases'][1] = route('lease_detail.index',0);
                $dashboardData['Total Number of Societies with Active Lease'][0] = $society_data_with_active_lease;
                $dashboardData['Total Number of Societies with Active Lease'][1] = route('society_detail.index').'?society_name=&sr_no=&lease_status=1&village=';

                $dashboardData['Total Number of Societies with Expired Lease'][0] = $society_data_with_expired_lease;
                $dashboardData['Total Number of Societies with Expired Lease'][1] = route('society_detail.index').'?society_name=&sr_no=&lease_status=0&village=';

                return $dashboardData;
            }

            if($request->module_name == "Revision in Layout"){
                if (session()->get('role_name') == config('commanConfig.land_manager')) {

                    $architect_dashboard = new ArchitectLayoutDashboardController();
                    $data['Total Number of Applications'] = $architect_dashboard->total_no_of_appln_for_revision();
                    $data['Applications Pending'] = $architect_dashboard->pending_layout_before_layout_and_excel();
                    $data['Applications Forwarded'] = $architect_dashboard->forwarded_layout_before_layout_and_excel();

                    return $data;
                }
            }
        }
    }



    public function getNotificationCount(){
        $lease_detail = LeaseDetail::with('leaseSociety')->where('lease_status',1)->get();

//        dd($lease_detail);
        $lease_count = 0;
        foreach($lease_detail as $lease_detail_val) {
            if ($lease_detail_val->lease_renewed_period) {

                $lease_start_date = $lease_detail_val->lease_renewal_date;
                $lease_period = '+' . $lease_detail_val->lease_renewed_period . ' years';
                $lease_end_date = date('Y-m-d', strtotime($lease_period, strtotime($lease_start_date)));
                $current_date = date('Y-m-d');
                $notification_from_date = date('Y-m-d', strtotime('-3 days', strtotime($lease_end_date)));
            }
            else{
                $lease_start_date = $lease_detail_val->lease_start_date;
                $lease_period = '+' . $lease_detail_val->lease_period . ' years';
                $lease_end_date = date('Y-m-d', strtotime($lease_period, strtotime($lease_start_date)));
                $current_date = date('Y-m-d');
                $notification_from_date = date('Y-m-d', strtotime('-3 days', strtotime($lease_end_date)));

            }
            if ($current_date >= $notification_from_date) {
                if ($lease_detail_val->lease_renewed_period){
                    $notification_to_date = date('Y-m-d', strtotime('-1 day', strtotime($lease_detail_val->lease_renewal_date)));
                    if ($current_date < $notification_to_date) {
                        $lease_count++;
                    }
                }
                else {
                    $lease_count++;
                }
            }
        }
//        echo "<br/>===>>>>";print_r($lease_count);
//die();

//        dd($lease_count);
        return $lease_count;

    }

    public function getTalukaByAjax(Request $request){
        if($request->ajax()){
            $talukas = Taluka::where('district_id',$request->district_id)->get();

//            $html = '';
            $html = '<select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="taluka" name="taluka">';
            $html .= '<option value="" style="font-weight: normal;">Select Taluka</option>';

            foreach($talukas as $key => $value){
                $html .= '<option value="'.$value->id.'"'.(($request->taluka == $value->id) ? 'selected' : "").">".$value->taluka_name.'</option>';
            }
            $html .= '</select>';

            return $html;
        }


//            $html = '<option value="Select Taluka">Select Taluka</option>';
//            foreach($talukas as $key => $value){
//                $html .= '<option value="'.$value->id.'">'.$value->taluka_name.'</option>';
//            }
//
//            return $html;
//        }

    }


}
