<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use DB;
use Auth;
use Hash;
use session;

use App\Http\Controllers\loginController;
use App\Models\Admin as admin;
use App\Models\Uploadd as uploadd;
use App\Models\IdenSeg as IdenSeg;
use App\Models\Contia as Contia;
use App\Models\BolSpec as BolSpec;
use App\Models\Terminas as Terminas;
use League\Flysystem\Filesystem;
use League\Flysystem\ZipArchive\ZipArchiveAdapter;
use Symfony\Component\HttpKernel\Exception\HttpException;

class manifestController extends Controller
{
   


    public function uploadmanifest(){
        session_start();
        $myuser = \Session::get('logged');

        $alluploadd = new uploadd;
        $sumofuploadd = count($alluploadd::all());
        $newviewuploadd = $alluploadd::all();

        $allTerminas = new Terminas;
        $sumofallTerminas = count($allTerminas::all());
        $newallTerminas = $allTerminas::all();

        $admindata = array('myuser'=>$myuser,'sumofuploadd'=>$sumofuploadd, 'newallTerminas'=>$newallTerminas);

        return view('uploadmanifest',$admindata);
    }

    public function uploadmanifestuser(){
        session_start();
        $myuser = \Session::get('logged');

        $alluploadd = new uploadd;
        $sumofuploadd = count($alluploadd::all());
        $newviewuploadd = $alluploadd::all();

        $allTerminas = new Terminas;
        $sumofallTerminas = count($allTerminas::all());
        $newallTerminas = $allTerminas::all();

        $admindata = array('myuser'=>$myuser,'sumofuploadd'=>$sumofuploadd, 'newallTerminas'=>$newallTerminas);

        return view('uploadmanifestuser',$admindata);
    }


        public function manfileuploads(Request $req){
        try{
        session_start();
        $myuser = \Session::get('logged');

        $datas=$req->all();

        $TotG=$datas['TotGross'];
        // $NoBol=$datas['NoBol'];
        // $NoCont=$datas['NoCont'];
        // $NoPack=$datas['NoPack'];
        $Termina=$datas['Termina'];
        $xmlfile=$datas['myfiles'];
        $files = $req->myfiles;
        $fileCount = count($files);

        $destination = base_path() . '/public/manuploads';
        $storedXMLPath = base_path() . '/public/manedits/';

        $storedFiles = [];

        for($i = 0; $i < $fileCount; $i++){
            $xmlfile = $files[$i];
            $fileExt = $xmlfile->extension();
            $dt = date('d-m-Y');
            
            if ($fileExt == "xml"){

                $xmlrealfile = $req->file('myfiles')[$i]->getClientOriginalName();
                
                $req->file('myfiles')[$i]->move($destination, $xmlrealfile);
    
                $xmlDataString = file_get_contents(public_path('manuploads/'.$xmlrealfile));
                $xmlObject = simplexml_load_string($xmlDataString);
                           
                $json = json_encode($xmlObject);
                $phpDataArray = json_decode($json, true); 

                // dd($phpDataArray);


                $IdenSeg_Cus_Reg_val = trim(json_encode(isset($phpDataArray["Identification_segment"]["Registry_number"])),'"');
                $IdenSeg_Cus_Date_val = trim(json_encode(isset($phpDataArray["Identification_segment"]["Date"])),'"');
                $IdenSeg_Cus_Code_val = $phpDataArray["Identification_segment"]["Customs_office_segment"]["Code"];

                $GenLastDisVal = trim(json_encode(isset($phpDataArray["General_segment"]["Last_discharge"])),'"');
                $GenDateArrVal = trim(json_encode(isset($phpDataArray["General_segment"]["Arrival_segment"]["Date_of_arrival"])),'"');
                $GenTimeArrVal = trim(json_encode(isset($phpDataArray["General_segment"]["Arrival_segment"]["Time_of_arrival"])),'"');
                $GenDeptVal = $phpDataArray["General_segment"]["Departure_segment"]["Code"];
                $GenDestVal = $phpDataArray["General_segment"]["Destination_segment"]["Code"];
                $GenCarrCodetVal = trim(json_encode(isset($phpDataArray["General_segment"]["Carrier_segment"]["code"])),'"');
                $GenCarrNameVal = trim(json_encode(isset($phpDataArray["General_segment"]["Carrier_segment"]["Name"])),'"');
                // $GenNatTransCodeVal = $phpDataArray["General_segment"]["Transport_segment"]["Nationality_of_transport_segment"]["Code"];
                $GenNameTransVal = trim(json_encode(isset($phpDataArray["General_segment"]["Transport_segment"]["Name_of_transporter"])),'"');
                $GenModeTransCodeVal = $phpDataArray["General_segment"]["Transport_segment"]["Mode_of_transport_segment"]["Code"];
                $GenNatTransCodeVal = $phpDataArray["General_segment"]["Transport_segment"]["Nationality_of_transport_segment"]["Code"];
               
                
                
                $GenSeg = isset($phpDataArray["General_segment"])? $phpDataArray["General_segment"] : [];
                $ArrSeggg = isset($GenSeg["Arrival_segment"])? $GenSeg["Arrival_segment"] : [];

                    $GenLastDisVal_1 = isset($GenSeg["Last_discharge"])? $GenSeg["Last_discharge"] : $GenLastDisVal;
                    $GenDateArrVal_1 = isset($ArrSeggg["Date_of_arrival"])? $ArrSeggg["Date_of_arrival"] : $GenDateArrVal;
                    $GenTimeArrVal_1 = isset($ArrSeggg["Time_of_arrival"])? $ArrSeggg["Time_of_arrival"] : $GenTimeArrVal;
                    $GenDeptSeg = isset($GenSeg["Departure_segment"])? $GenSeg["Departure_segment"] : [];
                        $GenDeptVal_1 = isset($GenDeptSeg["code"])? $GenDeptSeg["code"] : $GenDeptVal;
                    $GenDestSeg = isset($GenSeg["Destination_segment"])? $GenSeg["Destination_segment"] : [];
                        $GenDestVal_1 = isset($GenDestSeg["code"])? $GenDestSeg["code"] : $GenDestVal;
                    $GenCarrSeg = isset($GenSeg["Carrier_segment"])? $GenSeg["Carrier_segment"] : [];
                        $GenCarrCodetVal_1 = isset($GenCarrSeg["code"])? $GenCarrSeg["code"] : $GenCarrCodetVal;
                        $GenCarrNameVal_1 = isset($GenCarrSeg["Name"])? $GenCarrSeg["Name"] : $GenCarrNameVal;


                    $GenTransSeg = isset($GenSeg["Transport_segment"])? $GenSeg["Transport_segment"] : [];
                        $GenNameTransVal_1 = isset($GenTransSeg["Name_of_transporter"])? $GenTransSeg["Name_of_transporter"] : $GenNameTransVal;

                        $GenTransSegMode = isset($GenTransSeg["Mode_of_transport_segment"])? $GenTransSeg["Mode_of_transport_segment"] : [];
                        $GenModeTransCodeVal_1 = isset($GenTransSegMode["code"])? $GenTransSegMode["code"] : $GenModeTransCodeVal;

                        $GenTransSegNat = isset($GenTransSeg["Nationality_of_transport_segment"])? $GenTransSeg["Nationality_of_transport_segment"]:[];
                        $GenNatTransCodeVal_1 = isset($GenTransSegNat["code"])? $GenTransSegNat["code"] : $GenNatTransCodeVal;


                $IdenSeg = isset($phpDataArray["Identification_segment"])? $phpDataArray["Identification_segment"] : [];
                    $IdenSeg_RegNum = isset($IdenSeg["Registry_number"])? $IdenSeg["Registry_number"] : $IdenSeg_Cus_Reg_val;
                    $IdenSeg_Date = isset($IdenSeg["Date"])? $IdenSeg["Date"] : $IdenSeg_Cus_Date_val;
                    $IdenSeg_Cus = isset($IdenSeg["Customs_office_segment"])? $IdenSeg["Customs_office_segment"] : [];
                        $IdenSeg_Cus_Code = isset($IdenSeg_Cus["code"])? $IdenSeg_Cus["code"] : $IdenSeg_Cus_Code_val;

                $ManIdSegmentString = $this->getManIdSegment($phpDataArray,$IdenSeg_Cus_Reg_val,$IdenSeg_Cus_Date_val,$IdenSeg_Cus_Code_val);
                
                $GengetIdSegment = $this->getManGenSegment($phpDataArray,$Termina,$GenLastDisVal_1,$GenDateArrVal_1,$GenTimeArrVal_1,$GenDeptVal_1,$GenCarrCodetVal_1,$GenCarrNameVal_1,$GenNameTransVal_1,$GenModeTransCodeVal_1,$GenNatTransCodeVal_1,$IdenSeg_Cus_Reg_val,$GenDestVal_1,$TotG,$GenNatTransCodeVal,$GenDestVal,$GenModeTransCodeVal);

                






                $xmlString = '<?xml version="1.0" encoding="UTF-8" standalone="no"?>
                                <TWM_Manifest>';
                $xmlString .= $ManIdSegmentString;
                $xmlString .= $GengetIdSegment;

                $xmlString .= "</TWM_Manifest>";
                $fileName = $xmlrealfile; //$storedXMLPath. "EditedXML-".$i.".xml";
                array_push($storedFiles, $fileName);
                file_put_contents($storedXMLPath.$fileName, $xmlString);
            }
        }

        $uniqueTime = time();
        // $zipfileName = storage_path("app/public/xml-zips-$uniqueTime.zip");
        $zipfileName = storage_path("app/public/"."MANIFEST"."-$uniqueTime.zip");
        $zip = new Filesystem(new ZipArchiveAdapter($zipfileName));
        $index=0;
        foreach($storedFiles as $storedFile){
            $file_content = file_get_contents($storedXMLPath.$storedFile);
            $zip->put($storedFile, $file_content);

            $index++;
        }
        $zip->getAdapter()->getArchive()->close();
        return response()->download($zipfileName)->deleteFileAfterSend(true);

        }catch(\Exception $exception){
            return back()->with('manerror','The selected file is not a Manifest file. Please select a Manifest file');
        }
    }

        public function getManIdSegment($phpDataArray,$IdenSeg_Cus_Reg_val,$IdenSeg_Cus_Date_val,$IdenSeg_Cus_Code_val){
            $string = '';

                $IdenSeg1 = isset($phpDataArray["Identification_segment"])? $phpDataArray["Identification_segment"] : [];
                    $IdenSeg_RegNum_New_val = isset($IdenSeg1["Registry_number"])? $IdenSeg1["Registry_number"] : $IdenSeg_Cus_Reg_val;
                    $IdenSeg_Date_New_val = isset($IdenSeg1["Date"])? $IdenSeg1["Date"] : $IdenSeg_Cus_Date_val;
                    $IdenSeg_Cus1 = isset($IdenSeg1["Customs_office_segment"])? $IdenSeg1["Customs_office_segment"] : [];
                        $IdenSeg_Cus_Code_New_val = isset($IdenSeg_Cus1["code"])? $IdenSeg_Cus1["code"] : $IdenSeg_Cus_Code_val;
         
                $string = '<Identification_segment>';
                $string .= '<Registry_number>'.$IdenSeg_RegNum_New_val.'</Registry_number>';
                $string .= '<Date>'.date("d/m/y", strtotime($IdenSeg_Date_New_val) ).'</Date>';
                $customString = '<Customs_office_segment>
                                    <code>'.$IdenSeg_Cus_Code_New_val.'</code>
                                </Customs_office_segment>';
                $string .= $customString;
                $string .= '</Identification_segment>';

            return $string;
        }

        public function getManGenSegment($phpDataArray,$Termina,$GenLastDisVal_1,$GenDateArrVal_1,$GenTimeArrVal_1,$GenDeptVal_1,$GenDestVal_1,$GenCarrCodetVal_1,$GenCarrNameVal_1,$GenNameTransVal_1,$GenModeTransCodeVal_1,$GenNatTransCodeVal_1,$IdenSeg_Cus_Reg_val,$TotG,$GenNatTransCodeVal,$GenDestVal,$GenModeTransCodeVal){

            $string = '';


                    $GenSeg = isset($phpDataArray["General_segment"])? $phpDataArray["General_segment"] : [];
                    $GenLastDisVal_2 = isset($GenSeg["Last_discharge"])? $GenSeg["Last_discharge"] : $GenLastDisVal_1;

                    $ArrSeggg = isset($GenSeg["Arrival_segment"])? $GenSeg["Arrival_segment"] : [];
                    $GenDateArrVal_2 = isset($ArrSeggg["Date_of_arrival"])? $ArrSeggg["Date_of_arrival"] : $GenDateArrVal_1;
                    $GenTimeArrVal_2 = isset($ArrSeggg["Time_of_arrival"])? $ArrSeggg["Time_of_arrival"] : $GenTimeArrVal_1;


                    // $GenDateArrVal_2 = isset($GenSeg["Date_of_arrival"])? $GenSeg["Date_of_arrival"] : $GenDateArrVal;
                    // $GenTimeArrVal_2 = isset($GenSeg["Time_of_arrival"])? $GenSeg["Time_of_arrival"] : $GenTimeArrVal;
                    $GenDeptSeg = isset($GenSeg["Departure_segment"])? $GenSeg["Departure_segment"] : [];
                        $GenDeptVal_2 = isset($GenDeptSeg["code"])? $GenDeptSeg["code"] : $GenDeptVal_1;
                    $GenDestSeg = isset($GenSeg["Destination_segment"])? $GenSeg["Destination_segment"] : [];
                        $GenDestVal_2 = isset($GenDestSeg["code"])? $GenDestSeg["Code"] : $GenDestVal_1;
                    $GenCarrSeg = isset($GenSeg["Carrier_segment"])? $GenSeg["Carrier_segment"] : [];
                        $GenCarrCodetVal_2 = isset($GenCarrSeg["code"])? $GenCarrSeg["code"] : $GenCarrCodetVal_1;
                        $GenCarrNameVal_2 = isset($GenCarrSeg["Name"])? $GenCarrSeg["Name"] : $GenCarrNameVal_1;


                    $GenTransSeg = isset($GenSeg["Transport_segment"])? $GenSeg["Transport_segment"] : [];
                        $GenNameTransVal_2 = isset($GenTransSeg["Name_of_transporter"])? $GenTransSeg["Name_of_transporter"] : $GenNameTransVal_1;
                        $GenTransSegMode = isset($GenTransSeg["Mode_of_transport_segment"])? $GenTransSeg["Mode_of_transport_segment"] : [];

                        $GenModeTransCodeVal_2 = isset($GenTransSegMode["code"])? $GenTransSegMode["code"] : $GenModeTransCodeVal_1;
                        $GenTransSegNat = isset($GenTransSeg["Nationality_of_transport_segment"])? $GenTransSeg["Nationality_of_transport_segment"] : [];
                        $GenNatTransCodeVal_2 = isset($GenTransSegNat["code"])? $GenTransSegNat["code"] : $GenNatTransCodeVal_1;


                    $GenTonnsSeg = isset($GenSeg["Tonnage_segment"])? $GenSeg["Tonnage_segment"] : [];
                        $GenGrossTonnVal_2 = isset($GenTonnsSeg["Gross_tonnage"])? $GenTonnsSeg["Gross_tonnage"] : $GenGrossTonnVal_1;
                        $GenNetTonnVal_2 = isset($GenTonnsSeg["Net_tonnage"])? $GenTonnsSeg["Net_tonnage"] : $GenNetTonnVal_1;


                    $string = "<General_segment>
                        <Master_information></Master_information>
                        <Last_discharge></Last_discharge>
                        <Arrival_segment>
                            <Date_of_arrival>".date("d/m/y", strtotime($GenDateArrVal_2) )."</Date_of_arrival>
                            <Time_of_arrival>".$GenTimeArrVal_2."</Time_of_arrival>
                        </Arrival_segment>
                        <Departure_segment>
                            <code>".$GenDeptVal_2."</code>
                        </Departure_segment>
                        <Destination_segment>
                            <destport_code>".$GenDestVal."</destport_code>
                            <terminal_operator>
                                <operatorberth_code>".$Termina."</operatorberth_code>
                            </terminal_operator>
                        </Destination_segment>
                        <Carrier_segment>
                            <unique_carrier_reference>AGENT-BP000638</unique_carrier_reference>
                            <Name>".$GenCarrNameVal_2."</Name>
                            <address></address>
                        </Carrier_segment>
                        <Transport_segment>
                            <Name_of_transporter>".$GenNameTransVal_2."</Name_of_transporter>
                            <Place_of_transporter></Place_of_transporter>
                            <Mode_of_transport_segment>
                                <code>".$GenModeTransCodeVal."</code>
                            </Mode_of_transport_segment>
                            <Nationality_of_transport_segment>
                                <code>".$GenNatTransCodeVal."</code>
                            </Nationality_of_transport_segment>
                            <Transporter_registration_segment>
                                <Registration_number>".$IdenSeg_Cus_Reg_val."</Registration_number>
                                <Registration_date></Registration_date>
                            </Transporter_registration_segment>
                        </Transport_segment>
                        <Tonnage_segment>
                            <Gross_tonnage>".$TotG."</Gross_tonnage>
                            <Net_tonnage>".$TotG."</Net_tonnage>
                        </Tonnage_segment>
                    </General_segment>";

            return $string;
        }

    }
                             

    
