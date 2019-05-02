<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\MasterLayout;
use App\SocietyDetail;
use App\VillageDetail;
use App\VillageSociety;
use DB;
use Illuminate\Http\Request;
use Mpdf\Mpdf;
use Excel;

class LandController extends Controller
{
    /**
     * Show the form for Report.
     *
     * Author: Prajakta Sisale.
     *
     * @return \Illuminate\Http\Response
     */
    public function land_village_society_reports()
    {
        $villages = VillageDetail::get();

        $layouts = MasterLayout::get();

        return view('admin.reports.land.village_society_reports',compact('villages','layouts'));
    }
    /**
     * Generate the village - society report.
     *
     * Author: Prajakta Sisale.
     *
     * @return \Illuminate\Http\Response
     */
    public function village_society_reports(Request $request)
    {

        $village_ids = $request->village_id;

        $village_names = VillageDetail::whereIn('id',$village_ids)->pluck('village_name')->toArray();

//        $societies = SocietyDetail::whereHas('Villages', function($q) use ($village_ids){
//            $q->whereIn('id',$village_ids);
//        })->get();

        $societies = VillageSociety::with('getVillageDetails','getSocietyDetails')
            ->whereIn('village_id',$village_ids)
            ->orderBy('village_id')
            ->get();

        if($request->pdf == 'pdf'){
            $report_format = $request->pdf;
        }
        else{
            $report_format = $request->excel;
        }

        if($societies){
            $result = $this->generateVillageSocietyReport($societies, $report_format, $village_names);
            if(!$result){
                return back()->with('error1', 'No Record Found');
            }
        }else{
            return back()->with('error1', 'No Record Found');

        }
    }

    /**
     * Generate the Report in excel or pdf format.
     *
     * Author: Prajakta Sisale.
     *
     * @return \Illuminate\Http\Response
     */
    public function generateVillageSocietyReport($data, $report_format, $village_names){
        $fileName = date('Y_m_d_H_i_s') . '_village_society_report.pdf';
        $village_names = implode(',',$village_names);

        $total_area = 0;
        $total_conveyance_area = 0;
        $dataListMaster = [];
        $i=1;
        foreach ($data as $datas) {
            $dataList = [];
            $dataList['id'] = $i;
            $dataList['Village'] = $datas->getVillageDetails->village_name;
            $dataList['Society Name'] = $datas->getSocietyDetails['society_name'] ;
            $dataList['Society Reg. No.'] = $datas->getSocietyDetails['society_reg_no'] ;
            $dataList['District'] = $datas->getSocietyDetails['getDistrictName']['district_name'] ;
            $dataList['Taluka'] = $datas->getSocietyDetails['getTalukaName']['taluka_name'] ;
            $dataList['Layout'] = $datas->getSocietyDetails->getLayoutName->layout_name  ?? NULL;
            $dataList['Survey Number'] = $datas->getSocietyDetails['survey_number'] ;
            $dataList['CTS Number'] = $datas->getSocietyDetails['cts_number'] ;
            $dataList['Name Of Chairman'] = $datas->getSocietyDetails['chairman'] ?? NULL;
            $dataList['Mobile no. Of Chairman'] = $datas->getSocietyDetails['chairman_mob_no'] ?? NULL;
            $dataList['Name Of Secretary'] = $datas->getSocietyDetails['secretary'] ?? NULL;
            $dataList['Mobile no. Of Secretary'] = $datas->getSocietyDetails['secretary_mob_no'] ?? NULL;
            $dataList['Society Address'] = $datas->getSocietyDetails['society_address'] ;
            $dataList['Society Email Id'] = $datas->getSocietyDetails['society_email_id'] ?? NULL;
            $dataList['Area'] = $datas->getSocietyDetails['area'] ;
            $dataList['Date mentioned on service tax letters'] = $datas->getSocietyDetails['date_on_service_tax'] ;
            $dataList['Surplus Charges'] = $datas->getSocietyDetails['surplus_charges'] ;
            $dataList['Last date of paying surplus charges'] = $datas->getSocietyDetails['surplus_charges_last_date'] ;
            $dataList['Land Name'] = $datas->getSocietyDetails->getLandName['land_name'] ;
            $dataList['Is Society Conveyed ?'] = ($datas->getSocietyDetails['society_conveyed'] == 1) ? 'yes' : 'no';;
            $dataList['Date Of Conveyance'] = $datas->getSocietyDetails['date_of_conveyance'] ?? NULL;
            $dataList['Area Of Conveyance'] = $datas->getSocietyDetails['area_of_conveyance'] ?? NULL;

            $total_area += $datas->getSocietyDetails['area'];
            $total_conveyance_area += $datas->getSocietyDetails['area_of_conveyance'];

            $dataListKeys = array_keys($dataList);
            $dataListMaster[]=$dataList;
            $i++;
        }

        $dataListMaster[] = ['id' => '',
            'Village' => '',
            'Society Name' => '',
            'Society Reg. No.' => '',
            'District' => '',
            'Taluka' => '',
            'Layout' => '',
            'Survey Number' => '',
            'CTS Number' => '',
            'Name Of Chairman' => '',
            'Mobile no. Of Chairman' => '',
            'Name Of Secretary' => '',
            'Mobile no. Of Secretary' => '',
            'Society Address' => '',
            'Society Email Id' => 'Total Area',
            'Area' => $total_area,
            'Date mentioned on service tax letters' => '',
            'Surplus Charges' => '',
            'Last date of paying surplus charges' => '',
            'Land Name' => '',
            'Is Society Conveyed ?' => '',
            'Date Of Conveyance' => 'Total Conveyance Area',
            'Area Of Conveyance' => $total_conveyance_area
        ];



        if (count($data) > 0) {

            if($report_format == 'pdf')
            {
                $content = view('admin.reports.land._village_society_report', compact('dataListMaster','village_names'));
                $header_file = '';
                $footer_file = '';

                $pdf = new Mpdf([
                    'default_font_size' => 9,
                    'default_font' => 'Times New Roman',
                    'orientation' => 'L',
                    'format' => 'A4-L',
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
            if($report_format == 'excel')
            {
                $village_names = str_replace(',','_',$village_names);
                return Excel::create(date('Y_m_d_H_i_s') . '_village_society_'.$village_names, function($excel) use($dataListMaster){

                    $excel->sheet('mySheet', function($sheet) use($dataListMaster)
                    {
                        $sheet->fromArray($dataListMaster);
                    });
                })->download('csv');
            }

            return true;

        } else {
            return false;
        }
    }

    /**
     * Generate the village - society area report.
     *
     * Author: Prajakta Sisale.
     *
     * @return \Illuminate\Http\Response
     */
    public function village_society_area_reports(Request $request)
    {

        $village_ids = $request->village_id;

        $village_names = VillageDetail::whereIn('id',$village_ids)->pluck('village_name')->toArray();

//        $societies = SocietyDetail::whereHas('Villages', function($q) use ($village_ids){
//            $q->whereIn('id',$village_ids);
//        })->get();

        $societies = VillageSociety::with('getVillageDetails','getSocietyDetails')
            ->whereIn('village_id',$village_ids)
            ->orderBy('village_id')
            ->get();

        if($request->pdf == 'pdf'){
            $report_format = $request->pdf;
        }
        else{
            $report_format = $request->excel;
        }

        if($societies){
            $result = $this->generateVillageSocietyAreaReport($societies, $report_format, $village_names);
            if(!$result){
                return back()->with('error2', 'No Record Found');
            }
        }else{
            return back()->with('error2', 'No Record Found');

        }
    }

    /**
     * Generate the Report in excel or pdf format.
     *
     * Author: Prajakta Sisale.
     *
     * @return \Illuminate\Http\Response
     */
    public function generateVillageSocietyAreaReport($data, $report_format, $village_names){

        $fileName = date('Y_m_d_H_i_s') . '_village_society_area_report.pdf';
        $village_names = implode(',',$village_names);

        if (count($data) > 0) {

            $dataListMaster = [];
            $i=1;
            $total_society_area = 0;
            $total_village_area = 0;

            foreach ($data as $key => $datas) {

                $dataList = [];
                $dataList['id'] = $i;


                if($key > 0){
                    if($datas->getVillageDetails->village_name == $dataListMaster[$key - 1]['Village Name']){
                        $village = $datas->getVillageDetails->village_name;
                    }

                    if($village == $datas->getVillageDetails->village_name){
                        $dataList['Village Name'] = "";
                        $dataList['Village Total Area(m.sq.)'] = "";
                    }else{
                        $dataList['Village Name'] = $datas->getVillageDetails->village_name;
                        $village_area = $datas->getVillageDetails->total_area;
                        $dataList['Village Total Area(m.sq.)'] = $village_area;

                        $total_village_area += $village_area;

                    }
                } else{
                    $dataList['Village Name'] = $datas->getVillageDetails->village_name;
                    $village_area = $datas->getVillageDetails->total_area;
                    $dataList['Village Total Area(m.sq.)'] = $village_area;
                    $total_village_area += $village_area;

                }

                $dataList['Society Name'] = $datas->getSocietyDetails['society_name'] ;
                $dataList['Society Area(m.sq.)'] = $datas->getSocietyDetails['area'] ;

                $total_society_area += $datas->getSocietyDetails['area'];

                $dataListKeys = array_keys($dataList);
                $dataListMaster[]=$dataList;
                $i++;
            }

            $dataListMaster[] = [ 'id' => '',
                'Village Name' => '',
                'Village Total Area(m.sq.)' => '',
                'Society Name'=> '',
                'Society Area(m.sq.)'=> ''
            ];

            $dataListMaster[] = [ 'id' => '',
                'Village Name' => 'Village Total Area(m.sq.)',
                'Village Total Area(m.sq.)' => $total_village_area,
                'Society Name'=> 'Society Total Area(m.sq.)',
                'Society Area(m.sq.)'=> $total_society_area
            ];

            if($report_format == 'pdf')
            {
                $content = view('admin.reports.land._village_society_area_report', compact('dataListMaster','village_names'));
                $header_file = '';
                $footer_file = '';

                $pdf = new Mpdf([
                    'default_font_size' => 9,
                    'default_font' => 'Times New Roman',
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
            if($report_format == 'excel')
            {

                $village_names = str_replace(',','_',$village_names);
                return Excel::create(date('Y_m_d_H_i_s') . '_village_society_area_report_'.$village_names, function($excel) use($dataListMaster){

                    $excel->sheet('mySheet', function($sheet) use($dataListMaster)
                    {
                        $sheet->fromArray($dataListMaster);
                    });
                })->download('csv');
            }

            return true;

        } else {
            return false;
        }
    }

    /**
     * Generate the layout - village - society area report.
     *
     * Author: Prajakta Sisale.
     *
     * @return \Illuminate\Http\Response
     */
    public function village_society_layout_area_reports(Request $request)
    {

        $layout_ids = $request->layout_id;

        $layout_names = MasterLayout::whereIn('id',$layout_ids)->pluck('layout_name')->toArray();

        $societies = SocietyDetail::join('master_layout','layout_id','=','master_layout.id')
            ->join('village_societies','lm_society_detail.id','=','village_societies.society_id')
            ->join('lm_village_detail','village_societies.village_id','=','lm_village_detail.id')
            ->whereIn('layout_id',$layout_ids)
            ->orderBy('layout_id')
            ->get(['master_layout.layout_name','lm_village_detail.village_name','lm_village_detail.total_area','lm_society_detail.society_name','lm_society_detail.area']);

        if($request->pdf == 'pdf'){
            $report_format = $request->pdf;
        }
        else{
            $report_format = $request->excel;
        }

        if($societies){
            $result = $this->generateVillageSocietyLayoutAreaReport($societies, $report_format, $layout_names);
            if(!$result){
                return back()->with('error3', 'No Record Found');
            }
        }else{
            return back()->with('error3', 'No Record Found');

        }
    }


    /**
     * Generate the Report in excel or pdf format.
     *
     * Author: Prajakta Sisale.
     *
     * @return \Illuminate\Http\Response
     */
    public function generateVillageSocietyLayoutAreaReport($data, $report_format, $layout_names){

        $fileName = date('Y_m_d_H_i_s') . '_layout_village_society_area_report.pdf';
        $layout_names = implode(',',$layout_names);

        if (count($data) > 0) {

            $dataListMaster = [];
            $i=1;
            $layout_village_area = 0;
            $society_area = 0;

            $latest_village = '';
            $latest_layout = '';

            foreach ($data as $key => $datas){
                $dataList = [];

                $dataList['id'] = $i;


                    if($datas->layout_name == $latest_layout){
                        $dataList['Layout Name'] = '';
                    }
                    else{
                        $latest_layout = $datas->layout_name;
                        $dataList['Layout Name'] = $datas->layout_name;
                    }

                    if($datas->village_name == $latest_village){
                        $dataList['Village Name'] = '';
                        $dataList['Village Area(m.sq.)'] = '';

                    }else{
                        $latest_village = $datas->village_name;
                        $dataList['Village Name'] = $datas->village_name;

                        $layout_village_area += $datas->total_area;
                        $dataList['Village Area(m.sq.)'] = $datas->total_area ;

                    }

                    $dataList['Society Name'] = $datas->society_name;

                    $society_area += $datas->area;
                    $dataList['Society Area(m.sq)'] = $datas->area;

                    $dataListKeys = array_keys($dataList);
                    $dataListMaster[]=$dataList;
                    $i++;

            }

//            foreach ($data as $key => $datas) {
////                dd($datas);
//                $dataList = [];
//
//                $layout = $datas->layout_name;
//
//                $dataList['id'] = $i;
//
//                $latest_layout = $layout;
//                $dataList['Layout Name'] = $layout;
//                $village_name = $datas->village_name;
//                $dataList['Village Name'] = $village_name;
//                $dataList['Village Area(m.sq.)'] = $datas->total_area ;
//                $dataList['Society Name'] = $datas->society_name;
//                $dataList['Society Area(m.sq)'] = $datas->area;
////                foreach ($datas->villages as $key1 =>$village){
////
////                    $village_name = $village->village_name;
////
////                    if(!(in_array($village->id, $village_ids))){
////
////                       if($key1 > 0) {
////                            if ($village_name == $dataListMaster[$key1 - 1]['Village Name']) {
////                                $dataList['Village Name'] = '';
////                                $dataList['Village Area(m.sq.)'] = '' ;
////
////                            } else {
////                                $dataList['Village Name'] = $village_name;
////                                $latest_village = $village_name;
////                                $dataList['Village Area(m.sq.)'] = $village->total_area ;
////
////                            }
////                        }
////                        else{
////                            $latest_village = $village_name;
////                            $dataList['Village Name'] = $village_name;
////                            $dataList['Village Area(m.sq.)'] = $village->total_area ;
////
////                        }
////
////                        $village_ids[] += $village->id;
////
////                        $dataList['Society Name'] = $datas->society_name;
////                        $dataList['Society Area(m.sq)'] = $datas->area;
////
////                        $layout_village_area += $village->total_area;
////
////                        $dataListKeys = array_keys($dataList);
////                        $dataListMaster[]=$dataList;
////                        $i++;
////
////                    }
////                    else{
////                        $dataList['id'] = $i;
////
////                            if($latest_village == $village_name){
////                                $dataList['Village Name'] = '';
////                            }
////                            else{
////                                $latest_village = $village_name;
////                                $dataList['Village Name'] = $village_name;
////                            }
////
////                        $dataList['Village Area(m.sq.)'] = '' ;
////                        $dataList['Society Name'] = $datas->society_name;
////                        $dataList['Society Area(m.sq)'] = $datas->area;
////
////                        $dataListKeys = array_keys($dataList);
////                        $dataListMaster[]=$dataList;
////                        $i++;
////
////                    }
////                }
//
//                $layout_village_area += $datas->total_area;
//
//                $society_area += $datas->area;
//
//            }

//                        dd($dataListMaster);
            $dataListMaster[] = [ 'id' => '',
                'Layout Name' => '',
                'Village Name' => '',
                'Village Area(m.sq.)'=> '',
                'Society Name' => '',
                'Society Area(m.sq)' => ''
            ];

            $dataListMaster[] = [ 'id' => '',
                'Layout Name' => '',
                'Village Name' => 'Total Layout Area ',
                'Village Area(m.sq.)'=> $layout_village_area,
                'Society Name' => 'Total Society Area',
                'Society Area(m.sq)' => $society_area
            ];

            if($report_format == 'pdf')
            {
                $content = view('admin.reports.land._layout_village_society_area_report', compact('dataListMaster','layout_names'));
                $header_file = '';
                $footer_file = '';

                $pdf = new Mpdf([
                    'default_font_size' => 9,
                    'default_font' => 'Times New Roman',
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
            if($report_format == 'excel')
            {

                $layout_names = str_replace(',','_',$layout_names);
                return Excel::create(date('Y_m_d_H_i_s') . '_layout_village_society_area_report_'.$layout_names, function($excel) use($dataListMaster){

                    $excel->sheet('mySheet', function($sheet) use($dataListMaster)
                    {
                        $sheet->fromArray($dataListMaster);
                    });
                })->download('csv');
            }

            return true;

        } else {
            return false;
        }
    }
}