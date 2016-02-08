<?php
// 	error_reporting(E_ALL);
// 	ini_set('error_log', 'path_to_log_file');
// 	ini_set('log_errors_max_len', 0);
// 	ini_set('log_errors', true);

//       if( $_POST["data"] ) {
//       	echo "posted";
//         // $data = json_decode(stripslashes($_POST['data']));
//         // // here i would like use foreach:

//         //   foreach($data as $d){
//         //      echo $d;
//         }
//       }

if (is_ajax()) {
  if (isset($_POST["action"]) && !empty($_POST["action"])) { //Checks if action value exists
    $action = $_POST["action"];
    switch($action) { //Switch case for value of action
      case "updateCategoryPanel": update_category_panel(); break;
    }
  }
}

//Function to check if the request is an AJAX request
function is_ajax() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function update_category_panel(){
  $returnHTML = "";
  

  $categories = json_decode($_POST[categoryJson], true);
  //echo json_encode($categories);
   foreach ($categories as $category){ 
	    $returnHTML .= "<div id=\"div".$category[id]."fake\" class=\"alternative_cls\">";


	    $returnHTML .=  "<button type=\"select\" id = \"categoryButton" . $category[number] . " \" onclick=\"changeCategory(" . $category[number] . ")\"><span class=\"buttontext\">→</span></button>";
	    $returnHTML .=  "<input id=\"category" . $category[number] . "ColorFake\" class=\"categoryText\" type=\"text\" onkeyup=\"updateD3Legend()\" id=\"" . $category[labelId] . "\" value = \"" . $category[legendText] ."\">";
	    if($category[number] > 0){
	      $returnHTML .=  "<button type=\"delete\" onclick=\"deleteCategory(" . $category[id] . ")\">X</button>";
	    }
	    $returnHTML .=  "</div>";       
    }
  
  $return["json"] = json_encode($returnHTML);
  echo json_encode($return);
}
?>