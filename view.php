<body>
  <div id="cars">
    <div class="car">
      <form method="POST" action="controller.php" enctype="multipart/form-data">
        <input type="text" name="type" style="display: none;" value="add">
        <input placeholder="Price" required type="number" name="price">
        <input placeholder="brand" required type="text" name="brand">
        <input placeholder="model" required type="text" name="model">
        <input placeholder="year" required type="number" name="year">
        <input placeholder="mileage" required type="number" name="mileage">
        <input placeholder="Image" type="file" name="image">
        <input type="submit" value="Add new">
      </form>
    </div>
    <?php
    include 'controller.php';
    $cars=$controller->getData();
    
    foreach ($cars as $car){
      echo '<div class="car">

              <img class="car-image" src="./images/'.$car->image.'"/>
              <div class="car-price">'.$car->price.'</div>

              <div class="car-name">
                <a href="" class="car-name-brand">'.$car->brand.'</a>
                <div class="car-name-model">'.$car->model.'</div>
              </div>

              <div class="car-info">
                <div class="car-info-year"> Year: '.$car->year.'</div>
                <div class="car-info-mileage"> Mileage: '.$car->mileage.'</div>
              </div>

              <div class="car-buttons">
                <button class="car-buttons-delete" data-id="'.$car->id.'" onclick="event.preventDefault()">Delete</button>
                <button class="car-buttons-edit" data-id="'.$car->id.'">Edit</button>
              </div>

              <form action="controller.php" method="POST" enctype="multipart/form-data"  class="hide"  id='.$car->id.'>
                <input type="text" name="type" style="display: none;" value="edit">


                <input placeholder="Price" type="number" name="price" id="">
                <input placeholder="brand" required type="text" name="brand" id="">
                <input placeholder="model" required type="text" name="model" id="">
                <input placeholder="year" required type="number" name="year" id="">
                <input placeholder="mileage" type="number" name="mileage" id="">
                <input placeholder="Image" type="file" name="image">
                <input type="number" name="id" style="display: none;" value="'.$car->id.'">
          
                <div class="form-actions">
                <button data-id="'.$car->id.'" class="form-actions-close" onclick="event.preventDefault()">Cancel</button> 
                <input type="submit" >
                </div>
          
              </form>

            </div>';
    }
    ?>
  </div>
  <script src="script.js"></script>
  <link rel="stylesheet" href="style.css">
</body>