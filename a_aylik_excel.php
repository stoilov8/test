<?
require_once 'excel/Classes/PHPExcel.php';
require_once("session.php");


$buay=0;

date_default_timezone_set('Europe/London');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

/** Include PHPExcel */

$objPHPExcel = new PHPExcel();


if(isset($_GET["id"])){ 
$hedef_id=$_GET["id"];
$user_ids=$_GET["user"];


for ($col = 'A'; $col != 'J'; $col++) {
       $objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
                }

                $objPHPExcel->getProperties()->setCreator("VizyonSOFT Yazılım")
							 ->setLastModifiedBy("VizyonSOFT Yazılım")
							 ->setTitle("VizyonSOFT Yazılım")
							 ->setSubject("VizyonSOFT Yazılım")
							 ->setDescription("VizyonSOFT Yazılım.")
							 ->setKeywords("VizyonSOFT Yazılım")
							 ->setCategory("VizyonSOFT Yazılım");

                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:E1');
                $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Test Baslik');
                $objPHPExcel->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);

                $objPHPExcel->getActiveSheet()->getStyle('A2:E2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                $objPHPExcel->getActiveSheet()->getStyle('A2:E2')->getFill()->getStartColor()->setARGB('FFFFFF00');
                // Add some data
                $objPHPExcel->getActiveSheet()->getStyle("A2:E2")->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle('A2:E2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);


                //echo date('H:i:s') , " Add some data" , EOL;
                $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A2', 'Satış Direktörü')
                            ->setCellValue('B2', 'Toplam Hedef')
                            ->setCellValue('C2', 'Premium Hedef')
                            ->setCellValue('D2', 'Sarjlı Hedef')
                            ->setCellValue('E2', 'Base Hedef');


                $i =3;
               
                    $objPHPExcel->getActiveSheet()->getStyle('A'.$i.'')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    $objPHPExcel->getActiveSheet()->getStyle('B'.$i.'')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    $objPHPExcel->getActiveSheet()->getStyle('C'.$i.'')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    $objPHPExcel->getActiveSheet()->getStyle('D'.$i.'')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    $objPHPExcel->getActiveSheet()->getStyle('E'.$i.'')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				 $i =4;	
					$objPHPExcel->getActiveSheet()->getStyle('A'.$i.'')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    $objPHPExcel->getActiveSheet()->getStyle('B'.$i.'')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    $objPHPExcel->getActiveSheet()->getStyle('C'.$i.'')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    $objPHPExcel->getActiveSheet()->getStyle('D'.$i.'')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    $objPHPExcel->getActiveSheet()->getStyle('E'.$i.'')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				 $i =5;	
					$objPHPExcel->getActiveSheet()->getStyle('A'.$i.'')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    $objPHPExcel->getActiveSheet()->getStyle('B'.$i.'')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    $objPHPExcel->getActiveSheet()->getStyle('C'.$i.'')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    $objPHPExcel->getActiveSheet()->getStyle('D'.$i.'')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    $objPHPExcel->getActiveSheet()->getStyle('E'.$i.'')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // Miscellaneous glyphs, UTF-8
					
				
					
			$sorgu_giris3=$link->prepare("SELECT id ,toplam_hedef, premium_hedef, base_hedef, sarjli_hedef, ay, yil FROM hedef WHERE user_id=? AND id=?");
			$sorgu_giris3->bind_param('ii',$user_ids,$hedef_id);
			$sorgu_giris3->execute();
			$sorgu_giris3->bind_result($type_id_hedef ,$toplam_hedef , $premium_hedef ,$base_hedef , $sarjli_hedef , $ay , $yil );
			$sorgu_giris3->store_result();
			$sayi=$sorgu_giris3->num_rows();
			$sorgu_giris3->fetch();
			
			$sorgu_giris2=$link->prepare("SELECT id, name , last_name , mail FROM users WHERE id=?");
			$sorgu_giris2->bind_param("i",$user_ids);
			$sorgu_giris2->execute();
			$sorgu_giris2->bind_result($ids ,$name , $last_name ,$mail);
			$sorgu_giris2->store_result();
			$sorgu_giris2->fetch();
			
			$sorgu_giris1=$link->prepare("SELECT id,tarih FROM satis_form WHERE satis_direktor=?");
			$sorgu_giris1->bind_param("i",$user_ids);
			$sorgu_giris1->execute();
			$sorgu_giris1->bind_result($satis_id,$satis_tarih);
			$sorgu_giris1->store_result();
			$sayi_satis=$sorgu_giris1->num_rows();
				while($sorgu_giris1->fetch()){
					$tarih_name_Satis=date("m.d.Y" , $satis_tarih);
					$parcala_satis=explode('.',$tarih_name_Satis);	
						
						
						if($parcala_satis[0]==$ay){
							$buay++;
						}
				}
				
				$ay_yazi=ay_cek($ay);
				
				if($buay>0){
						$sayi_satis_yuzde = $buay/$toplam_hedef*100;
						$sayi_satis_yuzde_format=yuzde($sayi_satis_yuzde);
						
						$sayi_satis_yuzde1 = $buay/$premium_hedef*100;
						$sayi_satis_yuzde_format1=yuzde($sayi_satis_yuzde1);
						
						$sayi_satis_yuzde2 = $buay/$base_hedef*100;
						$sayi_satis_yuzde_format2=yuzde($sayi_satis_yuzde2);
						
						$sayi_satis_yuzde3 = $buay/$sarjli_hedef*100;
						$sayi_satis_yuzde_format3=yuzde($sayi_satis_yuzde3);
						
						
						
						
					}else{
						$sayi_satis_yuzde_format=0;
						$sayi_satis_yuzde_format1=0;
						$sayi_satis_yuzde_format2=0;
						$sayi_satis_yuzde_format3=0;
						$sayi_satis_yuzde_format4=0;
					}
					
				
				$objPHPExcel->getActiveSheet()->setCellValue('A1', ''.$name.' '.$last_name.' - '.$ay_yazi.'  Ayı Aylık Hedef Raporu');				
				
				$objPHPExcel->getActiveSheet()->getStyle('A2:A5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                $objPHPExcel->getActiveSheet()->getStyle('A2:A5')->getFill()->getStartColor()->setARGB('DCB5B5');
				
                    $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A2', ''.$name.' '.$last_name.'')
							->setCellValue('A3', 'Hedef')
							->setCellValue('A4', 'Satış')
							->setCellValue('A5', 'Yüzde')
							
							->setCellValue('B3', ''.$toplam_hedef.'')
							->setCellValue('C3', ''.$premium_hedef.'')
							->setCellValue('D3', ''.$sarjli_hedef.'')
							->setCellValue('E3', ''.$base_hedef.'')
							
							->setCellValue('B4', ''.$buay.'')
							->setCellValue('C4', ''.$buay.'')
							->setCellValue('D4', ''.$buay.'')
							->setCellValue('E4', ''.$buay.'')
							
							
							->setCellValue('B5', '%'.$sayi_satis_yuzde_format.'')
							->setCellValue('C5', '%'.$sayi_satis_yuzde_format1.'')
							->setCellValue('D5', '%'.$sayi_satis_yuzde_format3.'')
							->setCellValue('E5', '%'.$sayi_satis_yuzde_format2.'');
							
							
                    $i++;
                
				
				




/// While burda kapanacak*********************************************


//burdan aşağısı dısya yaratmak için kardas**********************

// Rename worksheet
//echo date('H:i:s') , " Rename worksheet" , EOL;
$objPHPExcel->getActiveSheet()->setTitle('Hakman Aylık Hedef Raporu');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Save Excel 2007 file
//echo date('H:i:s') , " Write to Excel2007 format" , EOL;
$callStartTime = microtime(true);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
/// buradan ismini değiştirmek istiorsan değiştirirsin locasyonunu verır kayıt edersın kardas***********
$objWriter->save('excel_import/aylik_rapor'.$user_ids.'-'.$ay.'.xlsx');
$callEndTime = microtime(true);
$callTime = $callEndTime - $callStartTime;


}

?>

<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if IE 9]>         <html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">

		<title>Hakman Elektronik - Form Takip Sistemi</title>

        <meta name="description" content="ProUI is a Responsive Bootstrap Admin Template created by pixelcave and published on Themeforest.">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">

        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="img/favicon.ico">
        <link rel="apple-touch-icon" href="img/icon57.png" sizes="57x57">
        <link rel="apple-touch-icon" href="img/icon72.png" sizes="72x72">
        <link rel="apple-touch-icon" href="img/icon76.png" sizes="76x76">
        <link rel="apple-touch-icon" href="img/icon114.png" sizes="114x114">
        <link rel="apple-touch-icon" href="img/icon120.png" sizes="120x120">
        <link rel="apple-touch-icon" href="img/icon144.png" sizes="144x144">
        <link rel="apple-touch-icon" href="img/icon152.png" sizes="152x152">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- Bootstrap is included in its original form, unaltered -->
        <link rel="stylesheet" href="css/bootstrap.min.css">

        <!-- Related styles of various icon packs and plugins -->
        <link rel="stylesheet" href="css/plugins.css">

        <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
        <link rel="stylesheet" href="css/main.css">

        <!-- Include a specific file here from css/themes/ folder to alter the default theme of the template -->

        <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
        <link rel="stylesheet" href="css/themes.css">
        <!-- END Stylesheets -->

        <!-- Modernizr (browser feature detection library) & Respond.js (Enable responsive CSS code on browsers that don't support it, eg IE8) -->
        <script src="js/vendor/modernizr-2.7.1-respond-1.4.2.min.js"></script>
		
<script type="text/javascript">
function validateForm() {
    var x = document.getElementById('sifres').value;
	var y = document.getElementById('tip').value;
	var z = document.getElementById('names').value;
	var w = document.getElementById('lastnames').value;
	var v = document.getElementById('emails').value;
	//alert(y);
    if (x == null || x == "" || x.length < 6 ){
        alert("Şifreniz 6 karakterden fazla olmalıdır.");
        return false;
    }
	if (y == null || y == "" || y < 1 ){
	//alert(y);
	    alert("Kullanıcı Tipi Seçmelisiniz.");
        return false;
	}
	
	if (y == null || y == "" || y < 1 ){
	//alert(y);
	    alert("Kullanıcı Tipi Seçmelisiniz.");
        return false;
	}
	
	if (z == null || z == "" || z < 1 ){
	//alert(y);
	    alert("Kullanıcı İsmini Girmelisiniz.");
        return false;
	}
	
	if (w == null || w == "" || w < 1 ){
	//alert(y);
	    alert("Kullanıcı Soyismini Girmelisiniz.");
        return false;
	}
	
	if (v == null || v == "" || v < 1 ){
	//alert(y);
	    alert("Kullanıcı Mail Adresini Girmelisiniz.");
        return false;
	}else{
		var regex = /^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+.)+([.])+[a-zA-Z0-9.-]{2,4}$/;
		if (regex.test(v)==false)
		{
			alert("Mail Adresiniz Geçersiz!");
			document.getElementById('emails').Focus();
		}
	
	}
}
</script>

<script>
function mail_kontrol(mail)
{ 

//alert(mail);

if(mail!=''){
	var regex = /^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+.)+([.])+[a-zA-Z0-9.-]{2,4}$/;
		if (regex.test(mail)==false)
		{
			alert("Mail Adresiniz Geçersiz!");
			document.getElementById('emails').Focus();
		}
}
}
</script>

<script type="text/javascript">
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
</script>


    </head>
    <!-- In the PHP version you can set the following options from inc/config file -->
    <!--
        Available body classes:

        'page-loading'      enables page preloader
    -->
    <body>
        <!-- Preloader -->
        <!-- Preloader functionality (initialized in js/app.js) - pageLoading() -->
        <!-- Used only if page preloader is enabled from inc/config (PHP version) or the class 'page-loading' is added in body element (HTML version) -->
        <div class="preloader themed-background">
            <h1 class="push-top-bottom text-light text-center"><strong>Vizyon</strong>Soft</h1>
            <div class="inner">
                <h3 class="text-light visible-lt-ie9 visible-lt-ie10"><strong>Loading..</strong></h3>
                <div class="preloader-spinner hidden-lt-ie9 hidden-lt-ie10"></div>
            </div>
        </div>

        <div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations">
            <!-- Alternative Sidebar -->
            <div id="sidebar-alt">
                <!-- Wrapper for scrolling functionality -->
                <div class="sidebar-scroll">
                    <!-- Sidebar Content -->
                    <div class="sidebar-content">
                        <!-- Chat -->
                        <!-- Chat demo functionality initialized in js/app.js -> chatUi() -->
                        <a href="page_ready_chat.html" class="sidebar-title">
                            <i class="gi gi-comments pull-right"></i> <strong>Chat</strong>UI
                        </a>
                        <!-- Chat Users -->
                        <ul class="chat-users clearfix">
                            <li>
                                <a href="javascript:void(0)" class="chat-user-online">
                                    <span></span>
                                    <img src="img/placeholders/avatars/avatar12.jpg" alt="avatar" class="img-circle">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="chat-user-online">
                                    <span></span>
                                    <img src="img/placeholders/avatars/avatar15.jpg" alt="avatar" class="img-circle">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="chat-user-online">
                                    <span></span>
                                    <img src="img/placeholders/avatars/avatar10.jpg" alt="avatar" class="img-circle">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="chat-user-online">
                                    <span></span>
                                    <img src="img/placeholders/avatars/avatar4.jpg" alt="avatar" class="img-circle">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="chat-user-away">
                                    <span></span>
                                    <img src="img/placeholders/avatars/avatar7.jpg" alt="avatar" class="img-circle">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="chat-user-away">
                                    <span></span>
                                    <img src="img/placeholders/avatars/avatar9.jpg" alt="avatar" class="img-circle">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="chat-user-busy">
                                    <span></span>
                                    <img src="img/placeholders/avatars/avatar16.jpg" alt="avatar" class="img-circle">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <span></span>
                                    <img src="img/placeholders/avatars/avatar1.jpg" alt="avatar" class="img-circle">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <span></span>
                                    <img src="img/placeholders/avatars/avatar4.jpg" alt="avatar" class="img-circle">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <span></span>
                                    <img src="img/placeholders/avatars/avatar3.jpg" alt="avatar" class="img-circle">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <span></span>
                                    <img src="img/placeholders/avatars/avatar13.jpg" alt="avatar" class="img-circle">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <span></span>
                                    <img src="img/placeholders/avatars/avatar5.jpg" alt="avatar" class="img-circle">
                                </a>
                            </li>
                        </ul>
                        <!-- END Chat Users -->

                        <!-- Chat Talk -->
                        <div class="chat-talk display-none">
                            <!-- Chat Info -->
                            <div class="chat-talk-info sidebar-section">
                                <img src="img/placeholders/avatars/avatar5.jpg" alt="avatar" class="img-circle pull-left">
                                <strong>John</strong> Doe
                                <button id="chat-talk-close-btn" class="btn btn-xs btn-default pull-right">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                            <!-- END Chat Info -->

                            <!-- Chat Messages -->
                            <ul class="chat-talk-messages">
                                <li class="text-center"><small>Yesterday, 18:35</small></li>
                                <li class="chat-talk-msg animation-slideRight">Hey admin?</li>
                                <li class="chat-talk-msg animation-slideRight">How are you?</li>
                                <li class="text-center"><small>Today, 7:10</small></li>
                                <li class="chat-talk-msg chat-talk-msg-highlight themed-border animation-slideLeft">I'm fine, thanks!</li>
                            </ul>
                            <!-- END Chat Messages -->

                            <!-- Chat Input -->
                            <form action="index.html" method="post" id="sidebar-chat-form" class="chat-form">
                                <input type="text" id="sidebar-chat-message" name="sidebar-chat-message" class="form-control form-control-borderless" placeholder="Type a message..">
                            </form>
                            <!-- END Chat Input -->
                        </div>
                        <!--  END Chat Talk -->
                        <!-- END Chat -->

                        <!-- Activity -->
                        <a href="javascript:void(0)" class="sidebar-title">
                            <i class="fa fa-globe pull-right"></i> <strong>Activity</strong>UI
                        </a>
                        <div class="sidebar-section">
                            <div class="alert alert-danger alert-alt">
                                <small>just now</small><br>
                                <i class="fa fa-thumbs-up fa-fw"></i> Upgraded to Pro plan
                            </div>
                            <div class="alert alert-info alert-alt">
                                <small>2 hours ago</small><br>
                                <i class="gi gi-coins fa-fw"></i> You had a new sale!
                            </div>
                            <div class="alert alert-success alert-alt">
                                <small>3 hours ago</small><br>
                                <i class="fa fa-plus fa-fw"></i> <a href="page_ready_user_profile.html"><strong>John Doe</strong></a> would like to become friends!<br>
                                <a href="javascript:void(0)" class="btn btn-xs btn-primary"><i class="fa fa-check"></i> Accept</a>
                                <a href="javascript:void(0)" class="btn btn-xs btn-default"><i class="fa fa-times"></i> Ignore</a>
                            </div>
                            <div class="alert alert-warning alert-alt">
                                <small>2 days ago</small><br>
                                Running low on space<br><strong>18GB in use</strong> 2GB left<br>
                                <a href="page_ready_pricing_tables.html" class="btn btn-xs btn-primary"><i class="fa fa-arrow-up"></i> Upgrade Plan</a>
                            </div>
                        </div>
                        <!-- END Activity -->

                        <!-- Messages -->
                        <a href="page_ready_inbox.html" class="sidebar-title">
                            <i class="fa fa-envelope pull-right"></i> <strong>Messages</strong>UI (5)
                        </a>
                        <div class="sidebar-section">
                            <div class="alert alert-alt">
                                Debra Stanley<small class="pull-right">just now</small><br>
                                <a href="page_ready_inbox_message.html"><strong>New Follower</strong></a>
                            </div>
                            <div class="alert alert-alt">
                                Sarah Cole<small class="pull-right">2 min ago</small><br>
                                <a href="page_ready_inbox_message.html"><strong>Your subscription was updated</strong></a>
                            </div>
                            <div class="alert alert-alt">
                                Bryan Porter<small class="pull-right">10 min ago</small><br>
                                <a href="page_ready_inbox_message.html"><strong>A great opportunity</strong></a>
                            </div>
                            <div class="alert alert-alt">
                                Jose Duncan<small class="pull-right">30 min ago</small><br>
                                <a href="page_ready_inbox_message.html"><strong>Account Activation</strong></a>
                            </div>
                            <div class="alert alert-alt">
                                Henry Ellis<small class="pull-right">40 min ago</small><br>
                                <a href="page_ready_inbox_message.html"><strong>You reached 10.000 Followers!</strong></a>
                            </div>
                        </div>
                        <!-- END Messages -->
                    </div>
                    <!-- END Sidebar Content -->
                </div>
                <!-- END Wrapper for scrolling functionality -->
            </div>


<?require("yan_menu.php")?>

            <!-- Main Container -->
            <div id="main-container">
               
<?require("header.php")?>
                <!-- END Header -->

                <!-- Page content -->
                <div id="page-content">
                    <!-- Blank Header -->
                    <div class="content-header">
                        <div class="header-section">
                            <h1>
                                Satış Direktörleri Aylık Hedef Raporu <br><small>Rapor Başarı İle Yüklenmiştir.</small>
								
								<a class="btn btn-sm btn-primary" href="a_aylık_hedef.php" style="float: right;margin-top: -5px;" id="confirm" data-original-title="">
								  Geri
								</a>
								<a class="btn btn-sm btn-warning" href="excel_import/aylik_rapor<?=$user_ids.'-'.$ay?>.xlsx"  style="float: right;margin-top: -5px;" id="confirm" data-original-title="">
								 İndir
								</a>
                            </h1>
                        </div>
                    </div>
  
                    <!-- END Blank Header -->


                    <!-- END Example Block -->
                </div>
                <!-- END Page Content -->

                <!-- Footer -->
<?require("footer.php")?>
                <!-- END Footer -->
            </div>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->

        <!-- Scroll to top link, initialized in js/app.js - scrollToTop() -->
        <a href="#" id="to-top"><i class="fa fa-angle-double-up"></i></a>

        <!-- User Settings, modal which opens from Settings link (found in top right user menu) and the Cog link (found in sidebar user info) -->
        <div id="modal-user-settings" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header text-center">
                        <h2 class="modal-title"><i class="fa fa-pencil"></i> Settings</h2>
                    </div>
                    <!-- END Modal Header -->

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <form action="index.html" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" onsubmit="return false;">
                            <fieldset>
                                <legend>Vital Info</legend>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Username</label>
                                    <div class="col-md-8">
                                        <p class="form-control-static">Admin</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="user-settings-email">Email</label>
                                    <div class="col-md-8">
                                        <input type="email" id="user-settings-email" name="user-settings-email" class="form-control" value="admin@example.com">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="user-settings-notifications">Email Notifications</label>
                                    <div class="col-md-8">
                                        <label class="switch switch-primary">
                                            <input type="checkbox" id="user-settings-notifications" name="user-settings-notifications" value="1" checked>
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>Password Update</legend>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="user-settings-password">New Password</label>
                                    <div class="col-md-8">
                                        <input type="password" id="user-settings-password" name="user-settings-password" class="form-control" placeholder="Please choose a complex one..">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="user-settings-repassword">Confirm New Password</label>
                                    <div class="col-md-8">
                                        <input type="password" id="user-settings-repassword" name="user-settings-repassword" class="form-control" placeholder="..and confirm it!">
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-group form-actions">
                                <div class="col-xs-12 text-right">
                                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-sm btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- END Modal Body -->
                </div>
            </div>
        </div>
        <!-- END User Settings -->

        <!-- Include Jquery library from Google's CDN but if something goes wrong get Jquery from local file (Remove 'http:' if you have SSL) -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>!window.jQuery && document.write(decodeURI('%3Cscript src="js/vendor/jquery-1.11.1.min.js"%3E%3C/script%3E'));</script>

        <!-- Bootstrap.js, Jquery plugins and Custom JS code -->
        <script src="js/vendor/bootstrap.min.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/app.js"></script>
    </body>
</html>