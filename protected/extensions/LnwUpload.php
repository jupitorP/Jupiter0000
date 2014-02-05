<?php

class LnwUpload extends CComponent {

    public $controller;
public  $path_tmp_img = '';
public $realpath='';


    public function __construct() {
        $file_path = str_replace("\\", "/", __FILE__);
        $root_path = str_replace("/protected/extensions/LnwUpload.php", "", $file_path);
        $this->path_tmp_img= $root_path.'/tmp/';
        $this->realpath=$root_path;
    }

  
    public function init() {
        
    }
    public function realPath() {
      //  $real_path = str_replace("\app\Controller\Component", "", dirname(__FILE__));
        return $this->realpath;
    }
	public function getFolder(){
		$y=date('Y');
		$m=date('m');
		$d=date('d');
		$mainFolder='images/products';
		//$s="$mainFoler/$y/$m/$d/s/";//รูปเล็ก
		//$b="$mainFoler/$y/$m/$d/b/";//รูปใหญ่  
		if(!file_exists("$mainFolder/thumbs/") && !is_dir("$mainFolder/thumbs/")){
			$this->make_path("$mainFolder/thumbs/");
		}
                
                if(!file_exists("$mainFolder/larges/") && !is_dir("$mainFolder/larges/")){
			$this->make_path("$mainFolder/larges/");
		}
		
		return $mainFolder;
	}
        
        public function getFolder2(){
		$y=date('Y');
		$m=date('m');
		$d=date('d');
		$mainFoler='images/products';
		//$s="$mainFoler/$y/$m/$d/s/";//รูปเล็ก
		//$b="$mainFoler/$y/$m/$d/b/";//รูปใหญ่  
		if(!file_exists("$mainFoler/$y/") && !is_dir("$mainFoler/$y/")){
			$this->make_path("$mainFoler/$y/");
		}
		if(!file_exists("$mainFoler/$y/$m/") && !is_dir("$mainFoler/$y/$m/")){
			$this->make_path("$mainFoler/$y/$m/");
		}
		if(!file_exists("$mainFoler/$y/$m/$d/") && !is_dir("$mainFoler/$y/$m/$d/")){
			$this->make_path("$mainFoler/$y/$m/$d/");
		}
		if(!file_exists("$mainFoler/$y/$m/$d/s/") && !is_dir("$mainFoler/$y/$m/$d/s/")){
			$this->make_path("$mainFoler/$y/$m/$d/s/");
		}
		if(!file_exists("$mainFoler/$y/$m/$d/b/") && !is_dir("$mainFoler/$y/$m/$d/b/")){
		   $this->make_path("$mainFoler/$y/$m/$d/b/");
		}
		return "$mainFoler/$y/$m/$d";
	}
      private function make_path($pathname) {
        mkdir($pathname,0777);
     }

    public function tmpuploadImg($options = array()) {
        
        
        if (!empty($_FILES)) {
            if (isset($_POST["PHPSESSID"])) {
                session_id($_POST["PHPSESSID"]);
            }
          //  session_start();
            ini_set("html_errors", "0");
            if (!isset($_FILES["Filedata"]) || !is_uploaded_file($_FILES["Filedata"]["tmp_name"]) || $_FILES["Filedata"]["error"] != 0) {
                echo "ERROR:invalid upload";
                exit(0);
            }
            $temp_file = $_FILES['Filedata']['tmp_name'];
           // echo $temp_file;
            $target_path = $this->get_target_folder($options);
           
            if (!file_exists($target_path)) {
              
               // CakeLog::write("debug", "Creating directory: $target_path");
                $old = @umask(0);
                @mkdir($target_path, 0777, true);
                @umask($old);
            }
            $sizee = GetimageSize($_FILES["Filedata"]["tmp_name"]);
            $chktype = $this->image_type_to_extension($sizee[2]);
            $new_img = $this->resizeimg($sizee, $_FILES["Filedata"]["tmp_name"], '', $chktype);
           /* if (!isset($_SESSION["file_info"])) {
                $_SESSION["file_info"] = array();
            }*/
            if ($chktype != false) {
                $filetype = $chktype;
            }else{
                echo 'ERROR: File Type Error';
                exit();
            }
			//$f=date('dmYHis');
            $file_id = md5($_FILES["Filedata"]["tmp_name"] + rand() * 100000) . '.' . $filetype;
           ob_start();
            $target_file = str_replace('//', '/', $target_path) . $file_id;
          //  echo $target_file.'<br />';
         //   move_uploaded_file($temp_file, $target_file);
            if (move_uploaded_file($temp_file, $target_file)) {
                //สร้างรูปแบบ thumb แสดงหน้าเว็บ

                switch ($chktype) {
                    case 'gif' :
                        imagegif($new_img, '', 75);
                        break;
                    case 'png' :
                    case 'jpg' :
                    case 'jpeg' :
                        imagejpeg($new_img, '', 75);
                        break;
                    default :
                        return false;
                        break;
                }

               $imagevariable = ob_get_contents();
               ob_end_clean();
			 //  print_r(Yii::app()->session);
			 $sesArray=Yii::app()->session['file_info'];
			   $sesArray["'".$file_id."'"]=$imagevariable;
			   Yii::app()->session['file_info'] = $sesArray;
              /*  $_SESSION["file_info"][$file_id] = $imagevariable;*/
                echo "FILEID:" . $file_id;
                exit();
            }
        }
    }

    public function resizeimg($sizee, $filetmp, $path='', $chktype) {
        //sizee=ขนาดกว้างxยว,ไฟล์temp,ที่อยุ่รูปภาพที่จะย่อขนาด,ชนิดของไฟล์รูป
        $img = '';
        switch ($chktype) {
            case 'gif' :
                $img = imagecreatefromgif($filetmp);
                break;
            case 'png' :
                $img = imagecreatefrompng($filetmp);
                break;
            case 'jpg' :
            case 'jpeg' :
                $img = imagecreatefromjpeg($filetmp);
                break;
            default :
                return false;
                break;
        }

        if (!$img) {
            echo "ERROR:could not create image handle " . $filetmp;
            exit(0);
        }

        $width = imageSX($img);
        $height = imageSY($img);

        if (!$width || !$height) {
            echo "ERROR:Invalid width or height";
            exit(0);
        }
        $target_width = 80;
        $target_height = 80;
        $target_ratio = $target_width / $target_height;

        $img_ratio = $width / $height;

        if ($target_ratio > $img_ratio) {
            $new_height = $target_height;
            $new_width = $img_ratio * $target_height;
        } else {
            $new_height = $target_width / $img_ratio;
            $new_width = $target_width;
        }

        if ($new_height > $target_height) {
            $new_height = $target_height;
        }
        if ($new_width > $target_width) {
            $new_height = $target_width;
        }

        $new_img = imagecreatetruecolor(80, 80);
        $bg = imagecolorallocate($new_img, 255, 255, 255);
        if (!@imagefill($new_img, 0, 0, $bg)) { // Fill the image black
            echo "ERROR:Could not fill new image";
            exit(0);
        }

        if (!@imagecopyresampled($new_img, $img, ($target_width - $new_width) / 2, ($target_height - $new_height) / 2, 0, 0, $new_width, $new_height, $width, $height)) {
            echo "ERROR:Could not resize image";
            exit(0);
        }
        return $new_img;
    }

    public function resizeRealImg($cType = 'resize', $photos, $dstfolder, $dstname=false, $newWidth=false, $newHeight=false, $quality = 75) {
        list($oldWidth, $oldHeight, $type) = getimagesize($photos);
        $ext = $this->image_type_to_extension($type);
        if (is_writeable($dstfolder)) {
            $dstimg = $dstfolder.'/'.$dstname;
        } else {
            echo($dstfolder . '/' . $dstname);
           echo("You must allow proper permissions for image processing. And the folder has to be writable.");
          echo("Run \"chmod 777 on '' folder\"");
          exit();
        }
        if ($newWidth OR $newHeight) {
            if (file_exists($dstimg)) {
                unlink($dstimg);
            } else {
                $size = GetimageSize($photos);
                $width = $size[0];
                $height = $size[1];

                if (!$width || !$height) {
                    echo "ERROR:Invalid width or height";
                    exit(0);
                }
                $startX = 0;
                $startY = 0;
                $target_width = $newWidth;
                $target_height = $newHeight;
                $target_ratio = $target_width / $target_height;

                $img_ratio = $width / $height;

                if ($target_ratio > $img_ratio) {
                    $new_height = $target_height;
                    $new_width = $img_ratio * $target_height;
                } else {
                    $new_height = $target_width / $img_ratio;
                    $new_width = $target_width;
                }

                if ($new_height > $target_height) {
                    $new_height = $target_height;
                }
                if ($new_width > $target_width) {
                    $new_height = $target_width;
                }
            }
        }
        switch ($ext) {
            case 'gif' :
                $oldImage = imagecreatefromgif($photos);
                break;
            case 'png' :
                $oldImage = imagecreatefrompng($photos);
                break;
            case 'jpg' :
            case 'jpeg' :
                $oldImage = imagecreatefromjpeg($photos);
                break;
            default :
                //image type is not a possible option
                return false;
                break;
        }
        $newImage = imagecreatetruecolor($newWidth, $newHeight);
        $bg = imagecolorallocate($newImage, 255, 255, 255);
        if (!@imagefill($newImage, 0, 0, $bg)) { // Fill the image black
            echo "ERROR:Could not fill new image";
            exit(0);
        }
        //imagecopyresampled($newImage, $oldImage, 0,0 , $startX, $startY, $newWidth, $newHeight, $oldWidth, $oldHeight);
        if (!@imagecopyresampled($newImage, $oldImage, ($target_width - $new_width) / 2, ($target_height - $new_height) / 2, 0, 0, $new_width, $new_height, $width, $height)) {
            echo "ERROR:Could not resize image";
            exit(0);
        }

        switch ($ext) {
            case 'gif' :
                imagegif($newImage, $dstimg, $quality);
                break;
            case 'png' :
            case 'jpg' :
            case 'jpeg' :
                imagejpeg($newImage, $dstimg, $quality);
                break;
            default :
                return false;
                break;
        }

        imagedestroy($newImage);
        imagedestroy($oldImage);

        return true;
    }

    function resizeImage($cType = 'resize', $photos, $dstfolder, $dstname=false, $newWidth=false, $newHeight=false, $quality = 75) {
        list($oldWidth, $oldHeight, $type) = getimagesize($photos);
        $ext = $this->image_type_to_extension($type);
        if (is_writeable($dstfolder)) {
            $dstimg = $dstfolder . DS . $dstname;
        } else {
            debug($dstfolder . DS . $dstname);
            debug("You must allow proper permissions for image processing. And the folder has to be writable.");
            debug("Run \"chmod 777 on '' folder\"");
            exit();
        }
        if ($newWidth OR $newHeight) {
            if (file_exists($dstimg)) {
                unlink($dstimg);
            } else {
                switch ($cType) {
                    default:
                    case 'resize':
                        $widthScale = 2;
                        $heightScale = 2;
                        $height = $newHeight;
                        $sizee = GetimageSize($photos);
                        //$width=round($height*$sizee[0]/$sizee[1]);
                        $applyWidth = $newWidth;
                        $applyHeight = round($newWidth * $sizee[1] / $sizee[0]);
                        $startX = 0;
                        $startY = 0;
                        break;
                    case 'resizeBig':
                        $widthScale = 2;
                        $heightScale = 2;
                        $sizee = GetimageSize($photos);
                        //$width=$sizee[0];
                        //$height=$sizee[1];
                        $applyWidth = $sizee[0];
                        $applyHeight = $sizee[1];
                        $startX = 0;
                        $startY = 0;
                        break;
                    case 'resizeCrop':
                        if ($newWidth > $oldWidth)
                            $newWidth = $oldWidth;
                        $ratioX = $newWidth / $oldWidth;

                        if ($newHeight > $oldHeight)
                            $newHeight = $oldHeight;
                        $ratioY = $newHeight / $oldHeight;

                        if ($ratioX < $ratioY) {
                            $startX = round(($oldWidth - ($newWidth / $ratioY)) / 2);
                            $startY = 0;
                            $oldWidth = round($newWidth / $ratioY);
                            $oldHeight = $oldHeight;
                        } else {
                            $startX = 0;
                            $startY = round(($oldHeight - ($newHeight / $ratioX)) / 2);
                            $oldWidth = $oldWidth;
                            $oldHeight = round($newHeight / $ratioX);
                        }
                        $applyWidth = $newWidth;
                        $applyHeight = $newHeight;
                        break;
                    case 'crop':
                        // -- a straight centered crop
                        $startY = ($oldHeight - $newHeight) / 2;
                        $startX = ($oldWidth - $newWidth) / 2;
                        $oldHeight = $newHeight;
                        $applyHeight = $newHeight;
                        $oldWidth = $newWidth;
                        $applyWidth = $newWidth;
                        break;
                }

                switch ($ext) {
                    case 'gif' :
                        $oldImage = imagecreatefromgif($photos);
                        break;
                    case 'png' :
                        $oldImage = imagecreatefrompng($photos);
                        break;
                    case 'jpg' :
                    case 'jpeg' :
                        $oldImage = imagecreatefromjpeg($photos);
                        break;
                    default :
                        //image type is not a possible option
                        return false;
                        break;
                }

                //create new image
                $newImage = imagecreatetruecolor($applyWidth, $applyHeight);

                //put old image on top of new image
                imagecopyresampled($newImage, $oldImage, 0, 0, $startX, $startY, $applyWidth, $applyHeight, $oldWidth, $oldHeight);

                switch ($ext) {
                    case 'gif' :
                        imagegif($newImage, $dstimg, $quality);
                        break;
                    case 'png' :
                    case 'jpg' :
                    case 'jpeg' :
                        imagejpeg($newImage, $dstimg, $quality);
                        break;
                    default :
                        return false;
                        break;
                }

                imagedestroy($newImage);
                imagedestroy($oldImage);

                return true;
            }
        } else {
            return false;
        }
    }

    public function image_type_to_extension($imagetype) {
        if (empty($imagetype))
            return false;

        switch ($imagetype) {
            case IMAGETYPE_GIF : return 'gif';
            case IMAGETYPE_JPEG : return 'jpg';
            case IMAGETYPE_PNG : return 'png';
            case IMAGETYPE_SWF : return 'swf';
            case IMAGETYPE_PSD : return 'psd';
            case IMAGETYPE_BMP : return 'bmp';
            case IMAGETYPE_TIFF_II : return 'tiff';
            case IMAGETYPE_TIFF_MM : return 'tiff';
            case IMAGETYPE_JPC : return 'jpc';
            case IMAGETYPE_JP2 : return 'jp2';
            case IMAGETYPE_JPX : return 'jpf';
            case IMAGETYPE_JB2 : return 'jb2';
            case IMAGETYPE_SWC : return 'swc';
            case IMAGETYPE_IFF : return 'aiff';
            case IMAGETYPE_WBMP : return 'wbmp';
            case IMAGETYPE_XBM : return 'xbm';
            default : return false;
        }
    }

    private function get_target_folder($options=array()) {
       // $doc_root = $this->get_doc_root($options);
        return $this->path_tmp_img;
    }

    private function get_doc_root($options=array()) {
        $doc_root = $this->remove_trailing_slash(env('DOCUMENT_ROOT'));
        if (isset($options["root"]) && strlen(trim($options["root"])) > 0) {
            $root = $this->remove_trailing_slash($options["root"]);
            $doc_root .= $root;
        }
        return $doc_root;
    }

    public function remove_trailing_slash($string) {
        $string_length = strlen($string);
        if (strrpos($string, "/") === $string_length - 1) {
            $string = substr($string, 0, $string_length - 1);
        }

        return $string;
    }
}
?>