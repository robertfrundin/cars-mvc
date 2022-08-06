<?php

class Car{
  public int $id;
  public string $brand;
  public string $model;
  public int $year;
  public int $mileage;
  public int $price;
  public string $image;

  public function __construct($id, $brand, $model, $year, $mileage, $price, $image)
  {
    $this->id=$id;
    $this->brand=$brand;
    $this->model=$model;
    $this->year=$year;
    $this->mileage=$mileage;
    $this->price=$price;
    $this->image=$image;
  }
  public static function generateCarId($array){
    $existingIds=[];
    foreach($array as $car){
     array_push($existingIds, $car->id);
    }
    $randomId=rand(0,100);
    while(in_array($randomId, $existingIds)){
     $randomId=rand(0,100);
    }
    return $randomId;
    
  }

}
class Model{
  public string $filePath;

  public string $data;

  public function __construct($path)
  {
    $this->filePath=$path;
    $this->data=file_get_contents($this->filePath) or die('unable to locate file');
  }



  public function getData(){
    $data=[];
    $this->data=file_get_contents($this->filePath);
    $carsArray= json_decode($this->data);
    foreach($carsArray as $car){
      $carObject=new Car(
        $car->id,
        $car->brand,
        $car->model,
        $car->year,
        $car->mileage,
        $car->price,
        $car->image,
      );
      $data[]=$carObject;
    }
    return $data;
  }
  
  public function saveFile($file){
    $uploadFolder = './images/';
    $uploadFileDir = $uploadFolder . basename($file['name']);
    if(!file_exists($uploadFileDir)){
      move_uploaded_file($file['tmp_name'], $uploadFileDir);
    }
  }
  
  public function saveData($data){
    file_put_contents($this->filePath, json_encode($data)) or die('unable to write into the storage file');
  }

}

$model=new Model('list.json');

?>