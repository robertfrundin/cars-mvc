<?php
class Controller{
  
  public function checkRequiredFields(){
    if (($_POST['brand']!='') and ($_POST['model']!='') and ($_POST['year']!='') and ($_POST['mileage']!='') and ($_POST['mileage']!='')){
      return true;
    }
    else{
      return false;
    }
  }
  public function getData(){
    include 'model.php';
    return $model->getData();
  }

  public function handleRequest(){
    $type=$_POST['type'];
    switch($type){
      case 'edit':
        $this->handleEditing();
        break;

      case 'add':
        $this->handleAdding();
        break;

      case 'delete':
        $this->handleDeleting();
        break;
    }
  }

  private function handleAdding(){
    $allFieldsAreSet=$this->checkRequiredFields();
    if (!$allFieldsAreSet){
      die('required fields are missing');
    }
    include 'model.php';
    $carsList=$model->getData();
    $uploadedFile=$_FILES['image'];
    var_dump($_FILES);
    if ($uploadedFile['name']!=''){
      $model->saveFile($uploadedFile);

    }
    else{
      die('cannot add a car without an image');
    }
    $generatedId=Car::generateCarId($carsList);
    array_push($carsList, new Car(
      $generatedId,
      $_POST['brand'],
      $_POST['model'],
      $_POST['year'],
      $_POST['price'],
      $_POST['mileage'],
      basename($uploadedFile['name'])
      
    ));
    $model->saveData($carsList);
  }
  private function handleEditing(){
    include 'model.php';
    $carsList=$model->getData();
    $newFileUploaded=false;
    $uploadedFile=$_FILES['image'];
    
    if ($uploadedFile['name']!=''){
      $newFileUploaded=true;
      $model->saveFile($uploadedFile);
    }
    
    $id=$_REQUEST['id'];
    $carNotFound=true;
    foreach($carsList as $key=>$value){
      
      if ($carsList[$key]->id==$id){
        $carNotFound=false;
        if($_REQUEST['price']!=''){
          $carsList[$key]->price=$_REQUEST['price'];
        }
        if($_REQUEST['brand']!=''){
          $carsList[$key]->brand=$_REQUEST['brand'];
        }
        if($_REQUEST['model']!=''){
          $carsList[$key]->model=$_REQUEST['model'];
        }
        if($_REQUEST['year']!=''){
          $carsList[$key]->year=$_REQUEST['year'];
        }
        if($_REQUEST['mileage']!=''){
          $carsList[$key]->mileage=$_REQUEST['mileage'];
        }
        if ($newFileUploaded){
          $carsList[$key]->image=basename($_FILES['image']['name']);
        }
      }
    }
    if ($carNotFound){
      die('unable to find the car by id');
    }
    $model->saveData($carsList);
  }
  private function handleDeleting(){
    include 'model.php';
    $carsList=$model->getData();
    $id=$_POST['id'];
    foreach($carsList as $key =>$value){
      if ($carsList[$key]->id==$id){  
        unset($carsList[$key]);
      }
    }
    $model->saveData($carsList);
  }

}

$controller=new Controller();
$controller->handleRequest();



?>