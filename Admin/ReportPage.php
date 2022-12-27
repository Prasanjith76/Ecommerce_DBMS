<?php include('../Database/DatabaseConnection.php'); ?>

<?php
  $sql = 'SELECT Order_ID,Date_Of_Order,First_Name,Last_Name,Total_Value FROM `order`,`user`,`cart` WHERE `order`.User_ID = `user`.User_ID AND `order`.Cart_ID = `cart`.Cart_ID AND `order`.Guest_ID IS NULL;';
  $result = mysqli_query($adminconnection,$sql);
  $customer_order_report = mysqli_fetch_all($result,MYSQLI_ASSOC);

  $sql = 'SELECT min(Date_Of_Order) FROM `order`;';
  $result = mysqli_query($adminconnection,$sql);
  $min_date = strtotime(mysqli_fetch_all($result,MYSQLI_ASSOC)[0]['min(Date_Of_Order)']) ;
  $min_year = date('Y',$min_date);
  $max_year = date('Y');

  $sql = 'SELECT Product_ID,Title FROM `product`;';
  $result = mysqli_query($adminconnection,$sql);
  $products = mysqli_fetch_all($result,MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <div class="h1 text-start pb-5">Report</div>
    
        <div class="row align-items-start gap-5 justify-content-between mb-5">
          <div class="col card text-black py-3 bg-light">
            <div class="h4 caption-top text-start mb-4">Quarterly Sales Report</div>
            <table class="table caption-top table-secondary table-bordered">
              <div class="d-flex flex-row">
                <div class="d-flex gap-3">
                  <div>
    
                  <select
                    class="form-select mb-3"
                    aria-label="Default select example"
                  >
                    <option selected>Select Year</option>
                    <?php for($i=$min_year;$i<=$max_year;$i++): ?>
                      <option value=<?php echo $i; ?>><?php echo $i; ?></option>
                    <?php endfor; ?>
                  </select>
                  </div>
                  <div>
    
                  <select
                    class="form-select mb-3"
                    aria-label="Default select example"
                  >
                    <option selected>Select Quarter</option>
                    <option value="1">First Quater</option>
                    <option value="2">Second Quater</option>
                    <option value="1">Third Quater</option>
                    <option value="2">Fourth Quater</option>
                  </select>
                  </div>
                </div>
                <div class="ms-3">
                  <button class="btn btn-warning">Show</button>
                </div>
              </div>
              <thead>
                <tr>
                  <th scope="col">Date</th>
                  <th scope="col">Variant</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Price</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>I Phone</td>
                  <td>100</td>
                  <td>2</td>
                </tr>
                <tr>
                  <th scope="row">1</th>
                  <td>I Phone</td>
                  <td>100</td>
                  <td>2</td>
                </tr>
              </tbody>
            </table>
          </div>
    
          <div class="col card text-black bg-light py-3">
            <div class="h4 caption-top text-start mb-4">Customer Order Report</div>
            <table class="table caption-top table-secondary table-bordered">
              <thead>
                <tr>
                  <th scope="col">Date</th>
                  <th scope="col">Customer</th>
                  <th scope="col">Order ID</th>
                  <th scope="col">Total</th> 
                </tr>
              </thead>
              <tbody>
                <?php foreach($customer_order_report as $report): ?>
                <tr>
                  <th><?php echo $report['Date_Of_Order'];?></th>
                  <td><?php echo $report['First_Name'].' '.$report['Last_Name'];?></td>
                  <td><?php echo $report['Order_ID'];?></td>
                  <td><?php echo $report['Total_Value'];?></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
    
        <div class="d-flex flex-column bd-highlight mb-3 text-start lead gap-2">
          <div class="p-3 bd-highlight card bg-light text-black d-flex flex-column gap-2">
            <div class="h4 mb-3">Product with most number of sales</div>
            <div class="d-flex flex-row gap-2">
              <div>
                <select class="form-select" aria-label="Default select example">
                <option selected>Select Year</option>
                    <?php for($i=$min_year;$i<=$max_year;$i++): ?>
                      <option value=<?php echo $i; ?>><?php echo $i; ?></option>
                    <?php endfor; ?>
                </select>
              </div>
              <div>
                <select class="form-select" aria-label="Default select example">
                  <option selected>Select Month</option>
                  <option value="1">January</option>
                  <option value="2">February</option>
                  <option value="3">March</option>
                  <option value="4">April</option>
                  <option value="5">May</option>
                  <option value="6">June</option>
                  <option value="7">July</option>
                  <option value="8">August</option>
                  <option value="9">September</option>
                  <option value="10">October</option>
                  <option value="11">November</option>
                  <option value="12">December</option>
                </select>
              </div>
              <div>
                <button class="btn btn-warning">Search</button>
              </div>
            </div>
            <div>
              <span>Product: </span>
              <span class="text-warning fw-bold">Answer</span>
            </div>
          </div>
          <div class="p-3 bd-highlight card bg-light text-black d-flex flex-column gap-2">
            <div class="h4 mb-3">Product category with most orders</div>
            <div class="d-flex flex-row gap-2">
              <div>
                <select class="form-select" aria-label="Default select example">
                <option selected>Select Year</option>
                    <?php for($i=$min_year;$i<=$max_year;$i++): ?>
                      <option value=<?php echo $i; ?>><?php echo $i; ?></option>
                    <?php endfor; ?>
                </select>
              </div>
              <div>
                <select class="form-select" aria-label="Default select example">
                  <option selected>Select Month</option>
                  <option value="1">January</option>
                  <option value="2">February</option>
                  <option value="3">March</option>
                  <option value="4">April</option>
                  <option value="5">May</option>
                  <option value="6">June</option>
                  <option value="7">July</option>
                  <option value="8">August</option>
                  <option value="9">September</option>
                  <option value="10">October</option>
                  <option value="11">November</option>
                  <option value="12">December</option>
                </select>
              </div>
              <div>
                <button class="btn btn-warning">Search</button>
              </div>
            </div>
            <div>
              <span>Category: </span>
              <span class="text-warning fw-bold">Answer</span>
            </div>
          </div>
          <div class="p-3 bd-highlight card bg-light text-black d-flex flex-column gap-2">
            <div class="h4 mb-3">Time period with most interest to a product</div>
            <div class="d-flex flex-row gap-2">
              <div>
                <select class="form-select" aria-label="Default select example">
                  <option selected>Select Product</option>
                  <?php foreach($products as $product): ?>
                    <option value=<?php echo $product['Product_ID'] ?>><?php echo $product['Title'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div>
                <button class="btn btn-warning">Search</button>
              </div>
            </div>
            <div>
              <span>Month: </span>
              <span class="text-warning fw-bold">Answer</span>
            </div>
          </div>
        </div>
      </div>
</body>
</html>