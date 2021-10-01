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


class loginController extends Controller
{
	
	public function logout (){
		session_start();
		$myuser = \Session::get('logged');
		session_destroy();
		return view('welcome');

	}

	public function logoutadmin(Request $request)
    {

        $this->guard()->logout();
        $request->session()->invalidate();
        return redirect()->intended('adminlogin');
    }
    
    	//Function for Administrator Login
    public function Adminlogin(Request $request){

		        $this->validate($request,[
		    		'username' => 'required',
		    		'password' => 'required',

		    	]); 
		    	
		    	$data=$request->all();
		        $username=$data['username'];
		        $password = $data['password'];
		        $pass = md5($password);

		        $myadmin = new admin;
		    	$myuser = $myadmin::all()->where('username','=',$username)->first();
		    	if($myuser){	
		    		if($myuser->password == $pass){
		    			if($myuser->rights == "admin"){

		    				session_start();
		    			\Session::put('logged', $myuser);


				        $alluploadd = new uploadd;
				        $sumofalluploadd = count($alluploadd::all());
				        $newviewupd = $alluploadd::all();

				        $allTerminas = new Terminas;
				        $sumofallTerminas = count($allTerminas::all());
				        $newallTerminas = $allTerminas::all();

				        $ddtt = date('d-m-Y');
				        $fnn = $myuser->fullname;
				        $fnnid = $myuser->id;

		        		DB::insert('insert into logintimestamp(userid, fullname, lasttime) values (?,?,?)',[$fnnid,$fnn,$ddtt]);

				        $admindata = array('myuser'=>$myuser,'sumofalluploadd'=>$sumofalluploadd,'newviewupd'=>$newviewupd, 'newallTerminas'=>$newallTerminas);

				        return view('dashboard',$admindata);

		    			}else{
		    				session_start();
		    			\Session::put('logged', $myuser);


				        $alluploadd = new uploadd;
				        $sumofalluploadd = count($alluploadd::all());
				        $newviewupd = $alluploadd::all();

				        $allTerminas = new Terminas;
				        $sumofallTerminas = count($allTerminas::all());
				        $newallTerminas = $allTerminas::all();

				        $ddtt = date('d-m-Y');
				        $fnn = $myuser->fullname;
				        $fnnid = $myuser->id;

		        		DB::insert('insert into logintimestamp(userid, fullname, lasttime) values (?,?,?)',[$fnnid,$fnn,$ddtt]);

				        $admindata = array('myuser'=>$myuser,'sumofalluploadd'=>$sumofalluploadd,'newviewupd'=>$newviewupd, 'newallTerminas'=>$newallTerminas);
				        return view('dashboarduser',$admindata);

		    			}
		    			

		                // $admindata = array('myuser'=>$myuser);
		    			
		    		}else{
		    			
		    			 return redirect()->intended('/');
		    		}

		    	}else{
		    		return redirect()->intended('/');
		    	} 
    }

    public function uploadpage(){
        session_start();
        $myuser = \Session::get('logged');

      
        $alluploadd = new uploadd;
        $sumofuploadd = count($alluploadd::all());
        $newviewuploadd = $alluploadd::all();

        $allTerminas = new Terminas;
		$sumofallTerminas = count($allTerminas::all());
		$newallTerminas = $allTerminas::all();

        $admindata = array('myuser'=>$myuser,'sumofuploadd'=>$sumofuploadd, 'newallTerminas'=>$newallTerminas);

        return view('upl',$admindata);

    }

    public function uploadpageuser(){
        session_start();
        $myuser = \Session::get('logged');

      
        $alluploadd = new uploadd;
        $sumofuploadd = count($alluploadd::all());
        $newviewuploadd = $alluploadd::all();

        $allTerminas = new Terminas;
		$sumofallTerminas = count($allTerminas::all());
		$newallTerminas = $allTerminas::all();

        $admindata = array('myuser'=>$myuser,'sumofuploadd'=>$sumofuploadd, 'newallTerminas'=>$newallTerminas);

        return view('uploadpageuser',$admindata);

    }



    public function addterminal(){
        session_start();
        $myuser = \Session::get('logged');

        $alluploadd = new uploadd;
        $sumofuploadd = count($alluploadd::all());
        $newviewuploadd = $alluploadd::all();

        $allTerminas = new Terminas;
		$sumofallTerminas = count($allTerminas::all());
		$newallTerminas = $allTerminas::all();

        $admindata = array('myuser'=>$myuser,'sumofuploadd'=>$sumofuploadd, 'newallTerminas'=>$newallTerminas);

        return view('addterminal',$admindata);
    }

    public function adduser(){
        session_start();
        $myuser = \Session::get('logged');

        $alluploadd = new uploadd;
        $sumofuploadd = count($alluploadd::all());
        $newviewuploadd = $alluploadd::all();

        $allTerminas = new Terminas;
		$sumofallTerminas = count($allTerminas::all());
		$newallTerminas = $allTerminas::all();

        $admindata = array('myuser'=>$myuser,'sumofuploadd'=>$sumofuploadd, 'newallTerminas'=>$newallTerminas);

        return view('addusers',$admindata);
    }



     public function dashboardpg(){
        session_start();
        $myuser = \Session::get('logged');

        $alluploadd = new uploadd;
        $sumofuploadd = count($alluploadd::all());
        $newviewuploadd = $alluploadd::all();

        $alluploadd = new uploadd;
		$sumofalluploadd = count($alluploadd::all());
		$newviewupd = $alluploadd::all();

		$allTerminas = new Terminas;
		$sumofallTerminas = count($allTerminas::all());
		$newallTerminas = $allTerminas::all();


		$admindata = array('myuser'=>$myuser,'sumofalluploadd'=>$sumofalluploadd,'newviewupd'=>$newviewupd, 'sumofuploadd'=>$sumofuploadd, 'newallTerminas'=>$newallTerminas);

        // $admindata = array('myuser'=>$myuser,'sumofuploadd'=>$sumofuploadd);

        return view('dashboard',$admindata);
    }

     public function dashboardpguser(){
        session_start();
        $myuser = \Session::get('logged');

        $alluploadd = new uploadd;
        $sumofuploadd = count($alluploadd::all());
        $newviewuploadd = $alluploadd::all();

        $alluploadd = new uploadd;
		$sumofalluploadd = count($alluploadd::all());
		$newviewupd = $alluploadd::all();

		$allTerminas = new Terminas;
		$sumofallTerminas = count($allTerminas::all());
		$newallTerminas = $allTerminas::all();


		$admindata = array('myuser'=>$myuser,'sumofalluploadd'=>$sumofalluploadd,'newviewupd'=>$newviewupd, 'sumofuploadd'=>$sumofuploadd, 'newallTerminas'=>$newallTerminas);

        // $admindata = array('myuser'=>$myuser,'sumofuploadd'=>$sumofuploadd);

        return view('dashboarduser',$admindata);
    }

 

    public function FileUploads(Request $req){
    	

	try {
        session_start();
        $myuser = \Session::get('logged');

        $datas=$req->all();

        // $compname=$datas['compname'];
        $Termina=$datas['Termina'];
        $xmlfile=$datas['myfiles'];
		$files = $req->myfiles;
		$fileCount = count($files);

		$destination = base_path() . '/public/xmluploads';
		$storedXMLPath = base_path() . '/public/xmledits/';

		$storedFiles = [];
		for($i = 0; $i < $fileCount; $i++){
			$xmlfile = $files[$i];
			$fileExt = $xmlfile->extension();
        	$dt = date('d-m-Y');
			
			if ($fileExt == "xml"){

				// mkdir('helloworld');

				// $data = $req->input('myfiles');
				// $xmlrealfile = $i."-".$req->file('myfiles')[$i]->getClientOriginalName();
				$xmlrealfile = $req->file('myfiles')[$i]->getClientOriginalName();
				
				$req->file('myfiles')[$i]->move($destination, $xmlrealfile);
	
				$xmlDataString = file_get_contents(public_path('xmluploads/'.$xmlrealfile));
				$xmlObject = simplexml_load_string($xmlDataString);
						   
				$json = json_encode($xmlObject);
				$phpDataArray = json_decode($json, true); 
				
						

		        $Iden_Reg_Num1 = trim(json_encode($phpDataArray["Identification_segment"]["Registry_number"]),'"');
		        $Iden_Date1 = trim(json_encode($phpDataArray["Identification_segment"]["Date"]),'"');
		        $Iden_Bol_Ref1 = trim(json_encode($phpDataArray["Identification_segment"]["Bol_reference"]),'"');
		        $Iden_Reg_Code1 = trim(json_encode($phpDataArray["Identification_segment"]["Customs_office_segment"]["Code"]),'"');

		        $Cont_Registry_num = isset($phpDataArray["Container"])? $phpDataArray["Container"] : [];
				$Cont_Registry_number = isset($Cont_Registry_num["Reference"])? $Cont_Registry_num["Reference"] : "";

				$Cont_TypeA1 = isset($phpDataArray["Container"])? $phpDataArray["Container"] : [];
				$Cont_Type = isset($Cont_TypeA1["Type"])? $Cont_TypeA1["Type"] : "";
		        
		        $Cont_SealsA1 = isset($phpDataArray["Container"])? $phpDataArray["Container"] : [];
				$Cont_Seals = isset($Cont_SealsA1["Seals"])? $Cont_SealsA1["Seals"] : "";
		        
		        $Cont_Number = trim(json_encode(isset($phpDataArray["Container"]["Number"])),'"');

		        $countt = 0; 
						foreach($phpDataArray['Container'] as $container){
							$countt ++;
				}
		        $Bol_Line_number1 = trim(json_encode($phpDataArray["Bol_specific_segment"]["Line_number"]),'"');
		        $Bol_Previous_document_reference1 = trim(json_encode($phpDataArray["Bol_specific_segment"]["Previous_document_reference"]),'"');
		        $Bol_Bol_Nature1 = trim(json_encode($phpDataArray["Bol_specific_segment"]["Bol_Nature"]),'"');
		        $Bol_Unique_carrier_reference1 = trim(json_encode($phpDataArray["Bol_specific_segment"]["Unique_carrier_reference"]),'"');
		        $Customs_office_segment1 = trim(json_encode(isset($phpDataArray["Bol_specific_segment"]["Customs_office_segment"])),'"');
		        $Bol_Total_number_of_containers1 = trim(json_encode($phpDataArray["Bol_specific_segment"]["Total_number_of_containers"]),'"');
		        $Bol_Total_gross_mass_manifested1 = trim(json_encode($phpDataArray["Bol_specific_segment"]["Total_gross_mass_manifested"]),'"');
		        $Bol_Volume_in_cubic_meters1 = trim(json_encode($phpDataArray["Bol_specific_segment"]["Volume_in_cubic_meters"]),'"');
		        $Bol_Bol_type_segment1 = trim(json_encode($phpDataArray["Bol_specific_segment"]["Bol_type_segment"]["Code"]),'"');
		        $Bol_Exporter_segment_code1 = trim(json_encode($phpDataArray["Bol_specific_segment"]["Exporter_segment"]["Code"]),'"');
		        $Bol_Exporter_segment_Name1 = trim(json_encode($phpDataArray["Bol_specific_segment"]["Exporter_segment"]["Name"]),'"');
		        $Bol_Exporter_segment_Addr1 = trim(json_encode($phpDataArray["Bol_specific_segment"]["Exporter_segment"]["Address"]),'"');
		        $Bol_Consignee_segment_code1 = trim(json_encode($phpDataArray["Bol_specific_segment"]["Consignee_segment"]["Code"]),'"');
		        $Bol_Consignee_segment_Name1 = trim(json_encode($phpDataArray["Bol_specific_segment"]["Consignee_segment"]["Name"]),'"');
		        $Bol_Consignee_segment_Addr1 = trim(json_encode($phpDataArray["Bol_specific_segment"]["Consignee_segment"]["Address"]),'"');
		        $Bol_Notify_segment_Code1 = trim(json_encode($phpDataArray["Bol_specific_segment"]["Notify_segment"]["Code"]),'"');
		        $Bol_Notify_segment_Name1 = trim(json_encode($phpDataArray["Bol_specific_segment"]["Notify_segment"]["Name"]),'"');
		        $Bol_Notify_segment_Addr1 = trim(json_encode($phpDataArray["Bol_specific_segment"]["Notify_segment"]["Address"]),'"');
		        $Bol_Place_of_loading_segment1 = trim(json_encode($phpDataArray["Bol_specific_segment"]["Place_of_loading_segment"]["Code"]),'"');
		        $Bol_Place_of_unloading_segment1 = trim(json_encode($phpDataArray["Bol_specific_segment"]["Place_of_unloading_segment"]["Code"]),'"');
		        $Bol_Packages_segment_code1 = trim(json_encode($phpDataArray["Bol_specific_segment"]["Packages_segment"]["Package_type_code"]),'"');
		        $Bol_Packages_segment_pkg1 = trim(json_encode($phpDataArray["Bol_specific_segment"]["Packages_segment"]["Number_of_packages"]),'"');
		        // $Bol_Shipping_marks1 = trim(json_encode($phpDataArray["Bol_specific_segment"]["Shipping_marks"]),'"');
		        $Bol_Goods_description1 = trim(json_encode($phpDataArray["Bol_specific_segment"]["Goods_description"]),'"');
		        $B0l_Freight_segment_val1 = trim(json_encode($phpDataArray["Bol_specific_segment"]["Freight_segment"]["Value"]),'"');
		        $B0l_Freight_segment_curr1 = trim(json_encode($phpDataArray["Bol_specific_segment"]["Freight_segment"]["Currency"]),'"');
		        $Bol_Freight_segment_Indi_code1 = trim(json_encode($phpDataArray["Bol_specific_segment"]["Freight_segment"]["Indicator_segment"]["Code"]),'"');
		        $Bol_Customs_segment_val1 = trim(json_encode($phpDataArray["Bol_specific_segment"]["Customs_segment"]["Value"]),'"');
		        $Bol_Customs_segment_curr1 = trim(json_encode($phpDataArray["Bol_specific_segment"]["Customs_segment"]["Currency"]),'"');
		        $Bol_Transport_segment_val1 = trim(json_encode($phpDataArray["Bol_specific_segment"]["Transport_segment"]["Value"]),'"');
		        $Bol_Transport_segment_curr1 = trim(json_encode($phpDataArray["Bol_specific_segment"]["Transport_segment"]["Currency"]),'"');
		        $Bol_Insurance_segment_val1 = trim(json_encode($phpDataArray["Bol_specific_segment"]["Insurance_segment"]["Value"]),'"');
		        $Bol_Insurance_segment_curr1 = trim(json_encode($phpDataArray["Bol_specific_segment"]["Insurance_segment"]["Currency"]),'"');
		        $Bol_Seals_segment_noSeal1 = trim(json_encode($phpDataArray["Bol_specific_segment"]["Seals_segment"]["Number_of_seals"]),'"');
		        $Bol_Seals_segment_MarkSeal1 = trim(json_encode($phpDataArray["Bol_specific_segment"]["Seals_segment"]["Marks_of_seals"]),'"');
		        $Bol_Seals_segment_SealCode1 = trim(json_encode($phpDataArray["Bol_specific_segment"]["Seals_segment"]["Sealing_party_code"]),'"');
		        $Bol_Information_part_a1 = trim(json_encode($phpDataArray["Bol_specific_segment"]["Information_part_a"]),'"');
		        $Bol_Operations_segment_Code1 = trim(json_encode($phpDataArray["Bol_specific_segment"]["Operations_segment"]["Location_segment"]["Code"]),'"');
		        $Bol_Operations_segment_Info1 = trim(json_encode($phpDataArray["Bol_specific_segment"]["Operations_segment"]["Location_segment"]["Information"]),'"');

		       
		        $IdSegmentString = $this->getIdSegment($phpDataArray,$Iden_Reg_Num1,$Iden_Date1,$Iden_Bol_Ref1,$Iden_Reg_Code1);

				$BolSpecificSegmentString = $this->getBolSpecificSegment($phpDataArray,$countt, $Termina, $Bol_Line_number1,$Bol_Previous_document_reference1,$Bol_Bol_Nature1,$Bol_Unique_carrier_reference1,$Bol_Total_number_of_containers1,$Bol_Total_gross_mass_manifested1,$Bol_Volume_in_cubic_meters1,$Bol_Bol_type_segment1 ,$Bol_Exporter_segment_code1 ,$Bol_Exporter_segment_Name1 ,$Bol_Exporter_segment_Addr1 ,$Bol_Consignee_segment_code1 ,$Bol_Consignee_segment_Name1,$Bol_Consignee_segment_Addr1,$Bol_Notify_segment_Code1,$Bol_Notify_segment_Name1,$Bol_Notify_segment_Addr1,$Bol_Place_of_loading_segment1,$Bol_Place_of_unloading_segment1,$Bol_Packages_segment_code1,$Bol_Packages_segment_pkg1,$Bol_Goods_description1,$B0l_Freight_segment_val1,$B0l_Freight_segment_curr1,$Bol_Freight_segment_Indi_code1,$Bol_Customs_segment_val1,$Bol_Customs_segment_curr1,$Bol_Transport_segment_val1,$Bol_Transport_segment_curr1,$Bol_Insurance_segment_val1,$Bol_Insurance_segment_curr1,$Bol_Seals_segment_noSeal1,$Bol_Seals_segment_MarkSeal1 ,$Bol_Seals_segment_SealCode1,$Bol_Information_part_a1,$Bol_Operations_segment_Code1,$Bol_Operations_segment_Info1,$Cont_Registry_number,$Cont_Type,$Cont_Number,$Cont_Seals);

				

				$xmlString = '<?xml version="1.0" encoding="UTF-8" standalone="no"?>
								<twm_bol>';
				$xmlString .= $IdSegmentString;
				$xmlString .= $BolSpecificSegmentString;

				$xmlString .= "</twm_bol>";
				$fileName = $xmlrealfile; //$storedXMLPath. "EditedXML-".$i.".xml";
				array_push($storedFiles, $fileName);
				file_put_contents($storedXMLPath.$fileName, $xmlString);
	
			}

		}


		$uniqueTime = time();
    	// $zipfileName = storage_path("app/public/xml-zips-$uniqueTime.zip");
    	$zipfileName = storage_path("app/public/".$Termina."-$uniqueTime.zip");
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
		return back()->with('bolrerror','The selected file is not a BOL file. Please select a BOL file');
	}
}

	public function getIdSegment($phpDataArray,$Iden_Reg_Num1,$Iden_Date1,$Iden_Bol_Ref1,$Iden_Reg_Code1 ){
		$string = '';
  //       $IdSegment = isset($phpDataArray["Identification_segment"])? $phpDataArray["Identification_segment"]: [];
		// $regNumber = isset($IdSegment["Registry_number"])? $IdSegment["Registry_number"] : '';
		// $segmentDate = isset($IdSegment["Date"])? $IdSegment["Date"] : '';
		// $bolReference = isset($IdSegment["Bol_reference"])? $IdSegment["Bol_reference"] : '';
		// $custmomOfficeSegment = isset($IdSegment["Customs_office_segment"])? $IdSegment["Customs_office_segment"] : [];
		// $segmentCode = isset($custmomOfficeSegment["Code"])? $custmomOfficeSegment["Code"] : '';
		$Iden_Reg_Num2 = isset($IdBolSpec["identification_segment"]['Registry_number'])? $IdBolSpec["identification_segment"]['Registry_number'] : $Iden_Reg_Num1;
		$Iden_Date2 = isset($IdBolSpec["identification_segment"]['Date'])? $IdBolSpec["identification_segment"]['Date'] : $Iden_Date1;
		$Iden_Bol_Ref2 = isset($IdBolSpec["identification_segment"]['Bol_reference'])? $IdBolSpec["identification_segment"]['Bol_reference'] : $Iden_Bol_Ref1;
		$Iden_Custom_seg2 = isset($IdBolSpec["identification_segment"]['Customs_office_segment']['Code'])? $IdBolSpec["identification_segment"]['Customs_office_segment']['Code'] : $Iden_Reg_Code1;
		
	 
        
        $string = '<identification_segment>';
        $string .= '<registry_number>'. $Iden_Reg_Num2 . '</registry_number>';
        $string .= '<date>'.date("d/m/Y", strtotime($Iden_Date2) ). '</date>';
        $string .= '<bol_reference>'. $Iden_Bol_Ref2 . '</bol_reference>';
        $customString = '<Customs_office_segment>
        					<Code>' .$Iden_Custom_seg2 .'</Code>
        				</Customs_office_segment>';
        $string .= $customString;
        $string .= '</identification_segment>';

        return $string;

    }

	public function getBolSpecificSegment($phpDataArray,$countt,$Termina, $Bol_Line_number1, $Bol_Previous_document_reference1,$Bol_Bol_Nature1,$Bol_Unique_carrier_reference1,$Bol_Total_number_of_containers1,$Bol_Total_gross_mass_manifested1,$Bol_Volume_in_cubic_meters1,$Bol_Bol_type_segment1 ,$Bol_Exporter_segment_code1 ,$Bol_Exporter_segment_Name1 ,$Bol_Exporter_segment_Addr1 ,$Bol_Consignee_segment_code1 ,$Bol_Consignee_segment_Name1,$Bol_Consignee_segment_Addr1,$Bol_Notify_segment_Code1,$Bol_Notify_segment_Name1,$Bol_Notify_segment_Addr1,$Bol_Place_of_loading_segment1,$Bol_Place_of_unloading_segment1,$Bol_Packages_segment_code1,$Bol_Packages_segment_pkg1,$Bol_Goods_description1,$B0l_Freight_segment_val1,$B0l_Freight_segment_curr1,$Bol_Freight_segment_Indi_code1,$Bol_Customs_segment_val1,$Bol_Customs_segment_curr1,$Bol_Transport_segment_val1,$Bol_Transport_segment_curr1,$Bol_Insurance_segment_val1,$Bol_Insurance_segment_curr1,$Bol_Seals_segment_noSeal1,$Bol_Seals_segment_MarkSeal1 ,$Bol_Seals_segment_SealCode1,$Bol_Information_part_a1,$Bol_Operations_segment_Code1,$Bol_Operations_segment_Info1,$Cont_Registry_number,$Cont_Type,$Cont_Number,$Cont_Seals){

		$string = '';
		$IdBolSpec = isset($phpDataArray["bol_specific_segment"])? $phpDataArray["bol_specific_segment"]: [];
		$line_number = isset($IdBolSpec["line_number"])? $IdBolSpec["line_number"]: $Bol_Line_number1;
		$Bol_Bol_Natureg = isset($IdBolSpec["bol_nature"])? $IdBolSpec["bol_nature"]: $Bol_Bol_Nature1;
		$unique_carrier_reference = isset($IdBolSpec["unique_carrier_reference"])? $IdBolSpec["unique_carrier_reference"] : $Bol_Unique_carrier_reference1;
		$total_gross_mass_manifested = isset($IdBolSpec["total_gross_mass_manifested"])? $IdBolSpec["total_gross_mass_manifested"] : $Bol_Total_gross_mass_manifested1;
		$volume_in_cubic_meters = isset($IdBolSpec["volume_in_cubic_meters"])? $IdBolSpec["volume_in_cubic_meters"] : $Bol_Volume_in_cubic_meters1;
		
		$bol_type_segment = isset($IdBolSpec["Bol_type_segment"])? $IdBolSpec["Bol_type_segment"] : [];
		$bol_type_segmentCode = isset($bol_type_segment["Code"])? $bol_type_segment["Code"] : "";

		$GrougpdescripCode = isset($IdBolSpec["Goods_description"])? $IdBolSpec["Goods_description"] : $Bol_Goods_description1;

		$exporter_segment = isset($IdBolSpec["exporter_segment"])? $IdBolSpec["exporter_segment"] : [];
		$exporter_segmentCode = isset($exporter_segment["Code"])? $exporter_segment["Code"] : "";

		$exporter_segment = isset($IdBolSpec["exporter_segment"])? $IdBolSpec["exporter_segment"] : [];
		$exporter_segmentName = isset($exporter_segment["name"])? $exporter_segment["name"] : "";

		$exporter_segment = isset($IdBolSpec["exporter_segment"])? $IdBolSpec["exporter_segment"] : [];
		$exporter_segmentAddr = isset($exporter_segment["address"])? $exporter_segment["address"] : "";

		$consignee_segment = isset($IdBolSpec["consignee_segment"])? $IdBolSpec["consignee_segment"] : [];
		$consignee_segmentCode = isset($consignee_segment["Code"])? $consignee_segment["Code"] : "";

		$consignee_segment = isset($IdBolSpec["consignee_segment"])? $IdBolSpec["consignee_segment"] : [];
		$consignee_segmentName = isset($consignee_segment["name"])? $consignee_segment["name"] : "";

		$consignee_segment = isset($IdBolSpec["consignee_segment"])? $IdBolSpec["consignee_segment"] : [];
		$consignee_segmentAddr = isset($consignee_segment["address"])? $consignee_segment["address"] : "";

		$notify_segment = isset($IdBolSpec["notify_segment"])? $IdBolSpec["notify_segment"] : [];
		$notify_segmentCode = isset($notify_segment["Code"])? $notify_segment["Code"] : "";

		$notify_segment = isset($IdBolSpec["notify_segment"])? $IdBolSpec["notify_segment"] : [];
		$notify_segmentName = isset($notify_segment["name"])? $notify_segment["name"] : "";

		$notify_segment = isset($IdBolSpec["notify_segment"])? $IdBolSpec["notify_segment"] : [];
		$notify_segmentAddr = isset($notify_segment["address"])? $notify_segment["address"] : "";


		$place_of_loading = isset($IdBolSpec["place_of_loading"])? $IdBolSpec["place_of_loading"] : [];
		$place_of_loadingCode = isset($place_of_loading["code"])? $place_of_loading["code"] : $Bol_Place_of_loading_segment1;

		$place_of_unloadingB = isset($IdBolSpec["place_of_loading"])? $IdBolSpec["place_of_loading"] : [];
		$place_of_unloadingBCode = isset($place_of_unloadingB["Code"])? $place_of_unloadingB["Code"] : $Bol_Place_of_unloading_segment1;

		$freight_segment = isset($IdBolSpec["freight_segment"])? $IdBolSpec["freight_segment"] : [];
		$freight_segmentCurr = isset($freight_segment["currency"])? $freight_segment["currency"] : "";

		$packages_segment = isset($IdBolSpec["packages_segment"])? $IdBolSpec["packages_segment"] : [];
		$packages_segmentGoods = isset($packages_segment["currency"])? $packages_segment["currency"] : "";

		$seals_segmentNum = isset($IdBolSpec["seals_segment"])? $IdBolSpec["seals_segment"] : [];
		$seals_segmentNumSeals = isset($seals_segmentNum["number_of_seals"])? $seals_segmentNum["number_of_seals"] : "";

		$seals_segmentMark = isset($IdBolSpec["mark_of_seals"])? $IdBolSpec["mark_of_seals"] : [];
		$seals_segmentMarkSeal = isset($seals_segmentMark["mark_of_seals"])? $seals_segmentMark["mark_of_seals"] : "";

		$seals_segmentS = isset($IdBolSpec["seals_segment"])? $IdBolSpec["seals_segment"] : [];
		$seals_segmentSealP = isset($seals_segmentS["sealing_party_code"])? $seals_segmentS["sealing_party_code"] : "";

		$operations_segment = isset($IdBolSpec["Operations_segment"])? $IdBolSpec["Operations_segment"] : [];
		$operations_segmentC = isset($operations_segment["Location_segment"])? $operations_segment["Location_segment"] : [];
		$operations_segmentCode = isset($operations_segmentC["Code"])? $operations_segmentC["Code"] : "";

		$Information_part_a = isset($IdBolSpec["Information_part_a"])? $IdBolSpec["Information_part_a"] : "";
		
		


       $string = "<bol_specific_segment><line_number>".$line_number."</line_number><Bol_nature>".$Bol_Bol_Natureg."</Bol_nature><master_bol>
						<customs_office_code>XXX</customs_office_code>
						<registry_number>XXX</registry_number>
						<date_of_departure />
						<master_bol_reference>XXX</master_bol_reference>
					</master_bol><unique_carrier_reference>AGENT-BP000638</unique_carrier_reference>
        			<total_number_of_containers>".$countt."</total_number_of_containers>
        			<total_gross_mass_manifested>".$line_number."</total_gross_mass_manifested>
        			<volume_in_cubic_meters>".$total_gross_mass_manifested."</volume_in_cubic_meters><bol_type_segment>
						<code></code>
					</bol_type_segment>
					<exporter_segment>
						<code /><name></name>
						<address></address>
					</exporter_segment>
					<consignee_segment>
						<code /><name></name>
						<address></address>
					</consignee_segment>
					<notify_segment>
						<code /><name></name>
						<address></address>
					</notify_segment>
					<place_of_loading>
						<code>".$place_of_loadingCode."</code>
					</place_of_loading>
					<Place_of_unloading>
						<destport_code>".$place_of_loadingCode."</destport_code>
							<terminal_operator>
							<terminalop_berthcode>".$Termina."</terminalop_berthcode>
							</terminal_operator>
					</Place_of_unloading><freight_segment>
						<bol_freight_cost />
						<currency></currency>
						<indicator_segment />
					</freight_segment>
					<packages_segment>
						<package_type_code></package_type_code>
						<number_of_packages></number_of_packages>
						<cargo_class_segment>
							<cargo_code></cargo_code>
							<cargo_qty></cargo_qty>
							<cargo_uom></cargo_uom>
							<cargo_freight />
						</cargo_class_segment>
						<shipping_marks/>
						<goods_description>".$GrougpdescripCode."</goods_description>
					</packages_segment>
					<customs_segment>
						<value />
						<currency />
					</customs_segment>
					<transport_segment>
						<value />
						<currency />
					</transport_segment>
					<insurance_segment>
						<value />
						<currency />
					</insurance_segment>
					<seals_segment>
						<number_of_seals></number_of_seals>
						<mark_of_seals></mark_of_seals>
						<sealing_party_code></sealing_party_code>
						<Information_part_a></Information_part_a>
					</seals_segment>
					<operations_segment>
						<location_segment>
							<code></code>
							<information />
						</location_segment>
					</operations_segment>";

					// $a = $phpDataArray['Container'];
		
		foreach($phpDataArray['Container'] as $container){


					
					$Cont_Registry_number1 = isset($container["Reference"])? $container["Reference"]: $Cont_Registry_number;
					

					$Cont_Seals1 = isset($container["Seals"])? $container["Seals"]: $Cont_Seals;
					$Cont_Type1 = isset($container["Type"])? $container["Type"]: $Cont_Type;
					// $Cont_Empty_full1 = isset($container["Empty_full"])? $container["Empty_full"]: $Cont_Empty_full;
					// $Cont_Marks11 = isset($container["Marks1"])? $container["Marks1"]: $Cont_Marks1;
					// $Cont_Sealing_party1 = isset($container["Sealing_party"])? $container["Sealing_party"]: $Cont_Sealing_party;


		if($Cont_Type1=="20OT"){
			$Cargo_Type = "DCBA20CI";
		}elseif($Cont_Type1=="20FL"){
			$Cargo_Type = "DCBA20CI";
		}elseif($Cont_Type1=="20DV"){
			$Cargo_Type = "DCBA20CL";
		}elseif($Cont_Type1=="20FR"){
			$Cargo_Type = "DCBA20CI";
		}elseif($Cont_Type1=="20TC"){
			$Cargo_Type = "DCBA20CI";
		}elseif($Cont_Type1=="20VT"){
			$Cargo_Type = "DCBA20CI";
		}elseif($Cont_Type1=="20RF"){
			$Cargo_Type = "DCBB20CR";
		}elseif($Cont_Type1=="40DV"){
			$Cargo_Type = "DCBA40CL";
		}elseif($Cont_Type1=="40FR"){
			$Cargo_Type = "DCBA40CI";
		}elseif($Cont_Type1=="40HC"){
			$Cargo_Type = "DCBA40CL";
		}elseif($Cont_Type1=="40OT"){
			$Cargo_Type = "DCBA40CI";
		}elseif($Cont_Type1=="40RF"){
			$Cargo_Type = "DCBB40CR";
		}elseif($Cont_Type1=="40MF"){
			$Cargo_Type = "DCBEVTM";
		}elseif($Cont_Type1=="60MF"){
			$Cargo_Type = "DCBEVTM";
		}elseif($Cont_Type1=="20MF"){
			$Cargo_Type = "DCBEVTM";
		}elseif($Cont_Type1=="30MF"){
			$Cargo_Type = "DCBEVTM";
		}elseif($Cont_Type1=="50MF"){
			$Cargo_Type = "DCBEVTM";
		}elseif($Cont_Type1=="80MF"){
			$Cargo_Type = "DCBEVTM";
		}else{
			$Cargo_Type = " ";
		}
				

			$string .= "<container>
            				<reference>".$Cont_Registry_number1."</reference>
            				<number>1</number>
            				<type>".$Cont_Type1."</type>
            				<Empty_full>1/1</Empty_full>
            				<seals>".$Cont_Seals1."</seals>
            				<mark1></mark1>
        					<mark2 />
            				<sealing_party></sealing_party>
							<cargo_class_segment>
								<cargo_code>".$Cargo_Type."</cargo_code>
								<cargo_freight></cargo_freight>
							</cargo_class_segment>
						</container>
						";
		}
		$string .= '</bol_specific_segment>
		';
		return $string;
}


	public function allxml(){
        session_start();
        $myuser = \Session::get('logged');
        

        $alluploadd = new uploadd;
        $sumofalluploadd = count($alluploadd::all());

        $newviewupd = $alluploadd::all();

        $allTerminas = new Terminas;
		$sumofallTerminas = count($allTerminas::all());
		$newallTerminas = $allTerminas::all();

        $data = array('myuser'=>$myuser,'sumofalluploadd'=>$sumofalluploadd,'newviewupd'=>$newviewupd,'newallTerminas'=>$newallTerminas);

        return view('dashboard',$data);
    }



     public function addterm(Request $req){

     			$data=$req->all();
     			
		        $TermName=$data['TermName'];
		        $TermCode = $data['TermCode'];

		        if ($TermName =="" || $TermCode == ""){
		        	return back()->with('error','Please fill in all data');
		        }else{
		        	DB::insert('insert into terminal(TerminalName, TerminalCode) values (?,?)',[$TermName,$TermCode]);
		        	return back()->with('success','Terminal'.$TermName.'successfully added');

		        }
     } 

     	public function passupd(Request $req){

     			$data=$req->all();
     			
		        $TermName=$data['unames'];
		        $TermCode = $data['pwd'];

		        if ($TermName =="" || $TermCode == ""){
		        	return back()->with('error','Please fill in all data');
		        }else{
		        	DB::insert('insert into terminal(TerminalName, TerminalCode) values (?,?)',[$TermName,$TermCode]);
		        	return back()->with('success','Terminal'.$TermName.'successfully added');

		        }
     } 
     

          public function chanpass(Request $req){

     			session_start();
		        $myuser = \Session::get('logged');

		      
		        $alluploadd = new uploadd;
		        $sumofuploadd = count($alluploadd::all());
		        $newviewuploadd = $alluploadd::all();

		        $allTerminas = new Terminas;
				$sumofallTerminas = count($allTerminas::all());
				$newallTerminas = $allTerminas::all();

		        $admindata = array('myuser'=>$myuser,'sumofuploadd'=>$sumofuploadd, 'newallTerminas'=>$newallTerminas);

		        return view('changpawrd',$admindata);
     }


          public function cp(Request $req){

     			session_start();
		        $myuser = \Session::get('logged');

		      
		        $alluploadd = new uploadd;
		        $sumofuploadd = count($alluploadd::all());
		        $newviewuploadd = $alluploadd::all();

		        $allTerminas = new Terminas;
				$sumofallTerminas = count($allTerminas::all());
				$newallTerminas = $allTerminas::all();

		        $admindata = array('myuser'=>$myuser,'sumofuploadd'=>$sumofuploadd, 'newallTerminas'=>$newallTerminas);

		        return view('changpawrduser',$admindata);
     }


   public function adduse(Request $req){

     			$data=$req->all();
     			
		        $uname=$data['uname'];
		        $fname=$data['fname'];
		        $email=$data['email'];
		        $rights = $data['rights'];
		        $pwd = "5f4dcc3b5aa765d61d8327deb882cf99";

		        if ($uname =="" || $fname == "" || $email =="" || $rights == ""){
		        	return back()->with('error','Please fill in all data');
		        }else{
		        	DB::insert('insert into administrator(username, password, email, fullname, rights) values (?,?,?,?,?)',[$uname,$pwd,$email,$fname,$rights]);
		        	return back()->with('success'.$fname.'successfully added');

		        }
     }


       public function updpass(Request $req){

     			session_start();
       			$myuser = \Session::get('logged');
     			$data=$req->all();
     			$idd = $myuser->id;
     			
		        
		        $pwd=$data['pwd'];
		        $p = md5($pwd);

		        DB::update('update administrator set password = ? where id = ?',[$p,$idd]);
		        return back()->with('chpp','successfully updated');
     }



       public function updpass2(Request $req){

     			session_start();
       			$myuser = \Session::get('logged');
     			$data=$req->all();
     			$idd = $myuser->id;
     			
		        
		        $pwd=$data['pwd'];
		        $p = md5($pwd);

		        DB::update('update administrator set password = ? where id = ?',[$p,$idd]);
		        return back()->with('chpp','successfully updated');
     }


    
    public function Exportxml($id)
	    {
	        session_start();
        	$myuser = \Session::get('logged');

	        $user = DB::table('uploadd')->where('id', $id)->first();
			$newfilename = $user->fileext;

			$xmlDataString = file_get_contents(public_path('xmluploads/'.$newfilename));
	        $xmlObject = simplexml_load_string($xmlDataString);
	                   
	        $json = json_encode($xmlObject);
	        $phpDataArray = json_decode($json, true); 

	        

	         // dd($phpDataArray);

	        //INITIALIZING THE FIRST SEGMENT
	        $Iden_seg_reg_num = trim(json_encode($phpDataArray["Identification_segment"]["Registry_number"]),'"');
	        $Iden_seg_dated = trim(json_encode($phpDataArray["Identification_segment"]["Date"]),'"');
	        $Iden_seg_bol_ref = trim(json_encode($phpDataArray["Identification_segment"]["Bol_reference"]),'"');
	        $Iden_seg_custom_off_seg= trim(json_encode($phpDataArray["Identification_segment"]["Customs_office_segment"]["Code"]),'"');


	        // $user2 = DB::table('identification_segment')->where('xmlid', $id)->first();
	        // $xid = $user2->xmlid;

	        $user2 = DB::table('identification_segment')
                ->where('xmlid', $id)
                ->first();
	        
	       
	        if($user2){
	        	
	        	DB::update('update identification_segment set reg_number = ?,dated=?,bol_ref=?,custom_seg=? where xmlid = ?',[$Iden_seg_reg_num,$Iden_seg_dated,$Iden_seg_bol_ref,$Iden_seg_custom_off_seg,$id]);
	        }else{
	        	
	        	DB::insert('insert into identification_segment(xmlid, reg_number,dated,bol_ref,custom_seg) values (?,?,?,?,?)',[$id,$Iden_seg_reg_num,$Iden_seg_dated,$Iden_seg_bol_ref,$Iden_seg_custom_off_seg]);
	        }


	        //INITIALIZING THE THIRD SEGMENT
	        $contt=$phpDataArray["Container"];
			$x=count($contt);
				$rd = rand(10000,99999);
				for($i=0; $i < $x ; $i++) 
    				{
            			$ref1 = trim(json_encode($contt[$i]["Reference"]),'"');
		            	$num1 = trim(json_encode($contt[$i]["Number"]),'"');
						$typ1 = trim(json_encode($contt[$i]["Type"]),'"');
						$emp1 = trim(json_encode($contt[$i]["Empty_full"]),'"');
						$sea1 = trim(json_encode($contt[$i]["Seals"]),'"');
						$mar1 = trim(json_encode($contt[$i]["Marks1"]),'"');
						$mar2 = trim(json_encode($contt[$i]["Marks2"]),'"');
						$sea2 = trim(json_encode($contt[$i]["Sealing_party"]),'"');
					    
					
	        			DB::insert('insert into container(xmlid, Referencez,Numberz,Typez,Empty,Seals,Mark1,mark2,Sealing_party,uniq) values (?,?,?,?,?,?,?,?,?,?)',[$id,$ref1,$num1,$typ1,$emp1,$sea1,$mar1,$mar2,$sea2,$rd]);
	        			}

    				
	        
	        // $string = substr($dataList, 1, -1);
	        //INITIALIZING THE SECOND SEGMENT
	        $Bol_Line_number = trim(json_encode($phpDataArray["Bol_specific_segment"]["Line_number"]),'"');
	        $Bol_Previous_document_reference = trim(json_encode($phpDataArray["Bol_specific_segment"]["Previous_document_reference"]),'"');
	        $Bol_Bol_Nature = trim(json_encode($phpDataArray["Bol_specific_segment"]["Bol_Nature"]),'"');
	        $Bol_Unique_carrier_reference = trim(json_encode($phpDataArray["Bol_specific_segment"]["Unique_carrier_reference"]),'"');
	        $Bol_Total_number_of_containers = trim(json_encode($phpDataArray["Bol_specific_segment"]["Total_number_of_containers"]),'"');
	        $Bol_Total_gross_mass_manifested = trim(json_encode($phpDataArray["Bol_specific_segment"]["Total_gross_mass_manifested"]),'"');
	        $Bol_Volume_in_cubic_meters = trim(json_encode($phpDataArray["Bol_specific_segment"]["Volume_in_cubic_meters"]),'"');
	        $Bol_Bol_type_segment = trim(json_encode($phpDataArray["Bol_specific_segment"]["Bol_type_segment"]["Code"]),'"');
	        $Bol_Exporter_segment_code = trim(json_encode($phpDataArray["Bol_specific_segment"]["Exporter_segment"]["Code"]),'"');
	        $Bol_Exporter_segment_Name = trim(json_encode($phpDataArray["Bol_specific_segment"]["Exporter_segment"]["Name"]),'"');
	        $Bol_Exporter_segment_Addr = trim(json_encode($phpDataArray["Bol_specific_segment"]["Exporter_segment"]["Address"]),'"');
	        $Bol_Consignee_segment_code = trim(json_encode($phpDataArray["Bol_specific_segment"]["Consignee_segment"]["Code"]),'"');
	        $Bol_Consignee_segment_Name = trim(json_encode($phpDataArray["Bol_specific_segment"]["Consignee_segment"]["Name"]),'"');
	        $Bol_Consignee_segment_Addr = trim(json_encode($phpDataArray["Bol_specific_segment"]["Consignee_segment"]["Address"]),'"');
	        $Bol_Notify_segment_Code = trim(json_encode($phpDataArray["Bol_specific_segment"]["Notify_segment"]["Code"]),'"');
	        $Bol_Notify_segment_Name = trim(json_encode($phpDataArray["Bol_specific_segment"]["Notify_segment"]["Name"]),'"');
	        $Bol_Notify_segment_Addr = trim(json_encode($phpDataArray["Bol_specific_segment"]["Notify_segment"]["Address"]),'"');
	        $Bol_Place_of_loading_segment = trim(json_encode($phpDataArray["Bol_specific_segment"]["Place_of_loading_segment"]["Code"]),'"');
	        $Bol_Place_of_unloading_segment = trim(json_encode($phpDataArray["Bol_specific_segment"]["Place_of_unloading_segment"]["Code"]),'"');
	        $Bol_Packages_segment_code = trim(json_encode($phpDataArray["Bol_specific_segment"]["Packages_segment"]["Package_type_code"]),'"');
	        $Bol_Packages_segment_pkg = trim(json_encode($phpDataArray["Bol_specific_segment"]["Packages_segment"]["Number_of_packages"]),'"');
	        $Bol_Shipping_marks = trim(json_encode($phpDataArray["Bol_specific_segment"]["Shipping_marks"]),'"');
	        $Bol_Goods_description = trim(json_encode($phpDataArray["Bol_specific_segment"]["Goods_description"]),'"');
	        $B0l_Freight_segment_val = trim(json_encode($phpDataArray["Bol_specific_segment"]["Freight_segment"]["Value"]),'"');
	        $B0l_Freight_segment_curr = trim(json_encode($phpDataArray["Bol_specific_segment"]["Freight_segment"]["Currency"]),'"');
	        $Bol_Freight_segment_Indi_code = trim(json_encode($phpDataArray["Bol_specific_segment"]["Freight_segment"]["Indicator_segment"]["Code"]),'"');
	        $Bol_Customs_segment_val = trim(json_encode($phpDataArray["Bol_specific_segment"]["Customs_segment"]["Value"]),'"');
	        $Bol_Customs_segment_curr = trim(json_encode($phpDataArray["Bol_specific_segment"]["Customs_segment"]["Currency"]),'"');
	        $Bol_Transport_segment_val = trim(json_encode($phpDataArray["Bol_specific_segment"]["Transport_segment"]["Value"]),'"');
	        $Bol_Transport_segment_curr = trim(json_encode($phpDataArray["Bol_specific_segment"]["Transport_segment"]["Currency"]),'"');
	        $Bol_Insurance_segment_val = trim(json_encode($phpDataArray["Bol_specific_segment"]["Insurance_segment"]["Value"]),'"');
	        $Bol_Insurance_segment_curr = trim(json_encode($phpDataArray["Bol_specific_segment"]["Insurance_segment"]["Currency"]),'"');
	        $Bol_Seals_segment_noSeal = trim(json_encode($phpDataArray["Bol_specific_segment"]["Seals_segment"]["Number_of_seals"]),'"');
	        $Bol_Seals_segment_MarkSeal = trim(json_encode($phpDataArray["Bol_specific_segment"]["Seals_segment"]["Marks_of_seals"]),'"');
	        $Bol_Seals_segment_SealCode = trim(json_encode($phpDataArray["Bol_specific_segment"]["Seals_segment"]["Sealing_party_code"]),'"');
	        $Bol_Information_part_a = trim(json_encode($phpDataArray["Bol_specific_segment"]["Information_part_a"]),'"');
	        $Bol_Operations_segment_Code = trim(json_encode($phpDataArray["Bol_specific_segment"]["Operations_segment"]["Location_segment"]["Code"]),'"');
	        $Bol_Operations_segment_Info = trim(json_encode($phpDataArray["Bol_specific_segment"]["Operations_segment"]["Location_segment"]["Information"]),'"');


	      	$user1 = DB::table('bol_specific_segment')
                ->where('xmlid', $id)
                ->first();

	        if($user1){

	        	DB::update('update bol_specific_segment set Line_number=?,Previous_document_reference=?,Bol_Nature=?,Unique_carrier_reference=?,Total_number_of_containers=?,Total_gross_mass_manifested=?,Volume_in_cubic_meters=?,Bol_type_segment_code=?,Exporter_segment_code=?,Exporter_segment_name=?,Exporter_segment_addr=?,Consignee_segment_code=?,Consignee_name=?,Consignee_segment_addr=?,Notify_segment_code=?,Notify_segment_name=?,Notify_segment_addr=?,Place_of_loading_segment_code=?,Place_of_unloading_segment_code=?,Package_type_code=?,Number_of_packages=?,Shipping_marks=?,Goods_description=?,Freight_segment_val=?,Freight_segment_cur=?,Indicator_segment_code=?,Customs_segment_val=?,Customs_segment_cur=?,Transport_segment_val=?,Transport_segment_cur=?,Insurance_segment_val=?,Insurance_segment_cur=?,Number_of_seals=?,Marks_of_seals=?,Sealing_party_code=?,Information_part_a=?,Location_segment_code=?,Location_segment_info=? where xmlid = ?',[$Bol_Line_number,$Bol_Previous_document_reference,$Bol_Bol_Nature,$Bol_Unique_carrier_reference,$Bol_Total_number_of_containers,$Bol_Total_gross_mass_manifested,$Bol_Volume_in_cubic_meters,$Bol_Bol_type_segment,$Bol_Exporter_segment_code,$Bol_Exporter_segment_Name,$Bol_Exporter_segment_Addr,$Bol_Consignee_segment_code,$Bol_Consignee_segment_Name,$Bol_Consignee_segment_Addr,$Bol_Notify_segment_Code,$Bol_Notify_segment_Name,$Bol_Notify_segment_Addr,$Bol_Place_of_loading_segment,$Bol_Place_of_unloading_segment,$Bol_Packages_segment_code,$Bol_Packages_segment_pkg,$Bol_Shipping_marks,$Bol_Goods_description,$B0l_Freight_segment_val,$B0l_Freight_segment_curr,$Bol_Freight_segment_Indi_code,$Bol_Customs_segment_val,$Bol_Customs_segment_curr,$Bol_Transport_segment_val,$Bol_Transport_segment_curr,$Bol_Insurance_segment_val,$Bol_Insurance_segment_curr,$Bol_Seals_segment_noSeal,$Bol_Seals_segment_MarkSeal,$Bol_Seals_segment_SealCode,$Bol_Information_part_a,$Bol_Operations_segment_Code,$Bol_Operations_segment_Info,$id]);
	        }else{
	       
	        	DB::insert('insert into bol_specific_segment(xmlid,Line_number,Previous_document_reference,Bol_Nature,Unique_carrier_reference,Total_number_of_containers,Total_gross_mass_manifested,Volume_in_cubic_meters,Bol_type_segment_code,Exporter_segment_code,Exporter_segment_name,Exporter_segment_addr,Consignee_segment_code,Consignee_name,Consignee_segment_addr,Notify_segment_code,Notify_segment_name,Notify_segment_addr,Place_of_loading_segment_code,Place_of_unloading_segment_code,Package_type_code,Number_of_packages,Shipping_marks,Goods_description,Freight_segment_val,Freight_segment_cur,Indicator_segment_code,Customs_segment_val,Customs_segment_cur,Transport_segment_val,Transport_segment_cur,Insurance_segment_val,Insurance_segment_cur,Number_of_seals,Marks_of_seals,Sealing_party_code,Information_part_a,Location_segment_code,Location_segment_info) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',[$id,$Bol_Line_number,$Bol_Previous_document_reference,$Bol_Bol_Nature,$Bol_Unique_carrier_reference,$Bol_Total_number_of_containers,$Bol_Total_gross_mass_manifested,$Bol_Volume_in_cubic_meters,$Bol_Bol_type_segment,$Bol_Exporter_segment_code,$Bol_Exporter_segment_Name,$Bol_Exporter_segment_Addr,$Bol_Consignee_segment_code,$Bol_Consignee_segment_Name,$Bol_Consignee_segment_Addr,$Bol_Notify_segment_Code,$Bol_Notify_segment_Name,$Bol_Notify_segment_Addr,$Bol_Place_of_loading_segment,$Bol_Place_of_unloading_segment,$Bol_Packages_segment_code,$Bol_Packages_segment_pkg,$Bol_Shipping_marks,$Bol_Goods_description,$B0l_Freight_segment_val,$B0l_Freight_segment_curr,$Bol_Freight_segment_Indi_code,$Bol_Customs_segment_val,$Bol_Customs_segment_curr,$Bol_Transport_segment_val,$Bol_Transport_segment_curr,$Bol_Insurance_segment_val,$Bol_Insurance_segment_curr,$Bol_Seals_segment_noSeal,$Bol_Seals_segment_MarkSeal,$Bol_Seals_segment_SealCode,$Bol_Information_part_a,$Bol_Operations_segment_Code,$Bol_Operations_segment_Info]);
	        }
			


        $UploadInView = new uploadd;
        $UploadInViewSum = $UploadInView::all();

        $IdenSegInView = new IdenSeg;
        $IdenSegInViewSum = $IdenSegInView::all();

        $ContiaInView = new Contia;
        $ContiaInViewSum = $ContiaInView::all();

        $BolSpecInView = new BolSpec;
        $BolSpecInViewSum = $BolSpecInView::all();

        $data = array('myuser'=>$myuser,'UploadInViewSum'=>$UploadInViewSum,'IdenSegInViewSum'=>$IdenSegInViewSum,'ContiaInViewSum'=>$ContiaInViewSum,'BolSpecInViewSum'=>$BolSpecInViewSum);

	    // return view('viewnewxml',$data);

        			
				    $result=DB::table('identification_segment')->where('id', $id)->first();
					if($result>0){
					$xml = new DOMDocument("1.0");
					 
					// It will format the output in xml format otherwise
					// the output will be in a single row
					$xml->formatOutput=true;
					$fitness=$xml->createElement("identification_segment");
					$xml->appendChild($fitness);
					while($row=mysqli_fetch_array($result)){
					    $user=$xml->createElement("identification_segment");
					    $fitness->appendChild($user);
					     
					    $reg_number=$xml->createElement("reg_number", $row['reg_number']);
					    $user->appendChild($reg_number);
					     
					    $dated=$xml->createElement("dated", $row['dated']);
					    $user->appendChild($dated);
					     
					    $bol_ref=$xml->createElement("bol_ref", $row['bol_ref']);
					    $user->appendChild($bol_ref);
					     
					    $custom_seg=$xml->createElement("custom_seg", $row['custom_seg']);
					    $user->appendChild($custom_seg);
					  
					}
					//echo "<xmp>".$xml->saveXML()."</xmp>";
					$xml->save("public/report123.xml");
					}
		}
    }

    					