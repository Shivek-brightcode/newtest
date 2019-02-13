<?php

    class database{

        private $host = "localhost";
        private $user = "root";
        private $pass = "";
        private $db = "pmegp";
        private $link;

        function __construct(){
            date_default_timezone_set('Asia/Kolkata');
            $this->link= new mysqli($this->host,$this->user,$this->pass,$this->db);
        }
        function insert($table,$columns,$values,$display=false){
			$query="INSERT INTO ";
			$query.=$table ;$query.=$columns;$query.=" VALUES ".$values;
			if($display){ echo $query; }
			if($this->link->query($query)){ return true; }
			else{ return mysqli_error($this->link);}
        }
        function insertfromtable($table,$columns,$table2,$columns2,$where,$display=false){
			$query="INSERT INTO $table $columns";
			$query.=" SELECT $columns2 from $table2 ";
			if($where!=''){ 
				$query.="where $where";
			}
			if($display){ echo $query; }
			if($this->link->query($query)){ return true; }
			else{ return mysqli_error($this->link);}
		
        }
        function get_count($table,$where='',$field='',$display=false){
            $query="SELECT count(";
			if($field!=''){ $query.=$field; }else{$query.="id";}
			$query.=") as count from ".$table;
            if($where!=''){ $query.=" where ".$where; }
            if($display){echo $query;}
            $execute = $this->link->query($query) ;
            if($execute){
                $array = $execute->fetch_assoc();
                return $array['count'];
            }
            else {
                return mysqli_error($this->link);
            }
        }
        function update($table,$col_values,$where,$display=false){
			$query="UPDATE ".$table." set ";
			$query.=$col_values." where ".$where;
			if($display){ echo $query; }
			if($this->link->query($query)){ return true; }
			else{ return mysqli_error($this->link);}
		}

		function search($table,$column='',$col_val1,$value1,$display=false){
			$query="SELECT ";
			if($column != ''){ $query.= $column." from ";}else{ $query .= "* from ";}
			$query .= $table." where (";
			$query .= $col_val1 ." LIKE '";
			$query .= $value1 . "%')";
			if($display){ echo $query; }
			$run=$this->link->query($query);
			$result=array();
			if($run){
				if($run->num_rows>0){
					while($rows=$run->fetch_assoc()){
						$result[]=$rows;
					}
					return $result;
				}
				else{
					return false;	
				}
			}
			else{ return mysqli_error($this->link);}
			

		}
        function get_details($table,$column='',$where='',$display=false){
			$query="SELECT ";
			if($column!=''){ $query.=$column." from "; }else{ $query.="* from "; }
			$query.=$table;
			if($where!=''){ $query.=" where ".$where; }else{ $query.=" "; }
			if($display){ echo $query; }
			$run=$this->link->query($query);
			if($run){
				if($run->num_rows==1){
					return $run->fetch_assoc();
				}
				else{
					return false;	
				}
			}
			else{ return mysqli_error($this->link);}	
		}
        function get_rows($table,$column='',$where='',$order='',$limit='',$group='',$display=false){
			$query="SELECT ";
			if($column!=''){ $query.=$column." from "; }else{ $query.="* from "; }
			$query.=$table;
			if($where!=''){ $query.=" where ".$where; }else{ $query.=" "; }
			if($group!=''){ $query.=" group by ".$group; }else{ $query.=" "; }
			if($order!=''){ $query.=" order by ".$order; }else{ $query.=" "; }
			if($limit!=''){ $query.=" limit ".$limit; }else{ $query.=" "; }
			if($display){ echo $query; }
			$run=$this->link->query($query);
			$result=array();
			if($run){
				if($run->num_rows>0){
					while($rows=$run->fetch_assoc()){
						$result[]=$rows;
					}
					return $result;
				}
				else{
					return false;	
				}
			}
			else{ return mysqli_error($this->link);}	
		}


    
		function pagination($ref,$pages,$page,$pagefilters=''){
			$pagination=$current="";
			if($pages>1){
				if($page!=1){
					$pagination.=$this->createpagelinks($ref,$page-1,"Prev",$current,$pagefilters);
				}
				for($i=1;$i<=$pages;$i++){
					if($i<4 || $i>$pages-3 || $i==$page || $i==$page-1 || $i==$page+1 || $i==$page-2 || $i==$page+2){
						if($i==$page){$current=true;}else{$current='';}
						$pagination.=$this->createpagelinks($ref,$i,$i,$current,$pagefilters);
					}
					elseif($pages>5 && ($i==4 || $i==$pages-3)){
						$pagination.=" <ul class='pagination pagination-sm'><li><a>...</a></li></ul> ";
					}
				}
				if($page!=$pages){
					$pagination.=$this->createpagelinks($ref,$page+1,"Next",$current,$pagefilters);
				}
			}
			return $pagination;
		}
		
		function createpagelinks($ref,$page,$link,$current,$pagefilters){
			$pagelink="<ul class='pagination pagination-sm'>";
			$pagelink.="<li";
			if($current!=''){$pagelink.=" class='active'";}
			$pagelink.="><a href='".$ref."&pageno=".$page.$pagefilters."'>".$link."</a></li>";
			$pagelink.="</ul> ";
			return $pagelink;
		}
		function Imageupload($dir,$inputname,$allext,$pass_width,$pass_height,$newname){
			if (file_exists($_FILES["$inputname"]["tmp_name"])) {
				//do this contain any file check
				$file_extension = strtolower( pathinfo($_FILES["$inputname"]["name"], PATHINFO_EXTENSION));
				$error = "";
			   if( in_array($file_extension, $allext)){
				   //file extension check
				list($width, $height, $type, $attr) = getimagesize($_FILES ["$inputname"]["tmp_name"]);
				
			   if ($width == "$pass_width" && $height == "$pass_height") {
					//dimension check
					$tmp=$_FILES["$inputname"]["tmp_name"];
					$extension[1] ="jpg";
					//$extension = explode(".", $_FILES["$inputname"]["name"]);
					$name=$newname.".".$extension[1];
					//$extension[1] ="jpg";				  
					if(move_uploaded_file($tmp, "$dir" .$newname.".".$extension[1])){
						return true;
						//echo "$dir $newname.$extension[1]";
					}
				} 
				else{
					$error .= "Please upload photo size must be $pass_width X $pass_height";
					//echo $error;
				}
			   }
			   else{
				$error .="Please Upload an Image";
				//echo $error;
			   }
			}
			else{
				//print_r($_FILES);
				$error .="Please Select an Image";
				// $error;
			}
			return $error;
		}
		
	}
	function resize_image($file, $width, $height,$dir,$newname,$ext) {
		list($w, $h) = getimagesize($file);
		/* calculate new image size with ratio */
		$ratio = max($width/$w, $height/$h);
		$h = ceil($height / $ratio);
		$x = ($w - $width / $ratio) / 2;
		$w = ceil($width / $ratio);
		/* read binary data from image file */
		$imgString = file_get_contents($file);
		/* create image from string */
		$image = imagecreatefromstring($imgString);
		$tmp = imagecreatetruecolor($width, $height);
		imagecopyresampled($tmp, $image,
		0, 0,
		$x, 0,
		$width, $height,
		$w, $h);
		imagejpeg($tmp, "$dir" .$newname."."."$ext", 100);
		//	return $file;
		
		/* cleanup memory */
		imagedestroy($image);
		imagedestroy($tmp);
	}
	
?>