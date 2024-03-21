<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Dairy Cart</title>
    <link rel="stylesheet" href="css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script type="text/javascript">
  function computeCost() {
    $bhusaQuantity = document.getElementById("bhusa").value;
    $goliPendQuantity = document.getElementById("goli_pend").value;
    $sarakiPendQuantity = document.getElementById("saraki_pend").value;
    $sengdanaPendQuantity = document.getElementById("sengdana_pend").value;

    // Compute the total cost
    $totalCost = $bhusaQuantity * 500 + $goliPendQuantity * 1300 + $sarakiPendQuantity * 1200 + $sengdanaPendQuantity * 2000;

    // Display the total cost
    document.getElementById("cost").value = $totalCost;
  }
</script>

    <style media="screen">
      .LOGO{
        height: 80px;
        width: auto;
        float: left;
        margin-left: 30px;
      }
      h3{
        text-align: center;
        color: green;
        font-size: 40px;
      }
      .form{
        margin-left: 30px;
        margin-right: 40px;
      }
      img{
        height: 60px;
        width: 120px;
      }
      p.VALUES{
        margin-right: 230px;
        float: right;
      }
      .list{
        float: right;
        margin-right: 40px;
      }
      .list li{
        display: inline-block;
        margin-right: 30px;
        margin-top: 30px;
      }
      .list li a{
        text-decoration: none;
        font-size: 15px;
        color:black;
        font-family: serif;
        font-weight: bold;
      }
      .list li:hover{
        border-bottom: 4px solid black;
        transition: .3s;
      }
      .details{
        margin-top: 30px;
      }
      .modal-title{
        text-align: center;
        color: green;
      }
    </style>
  </head>
  <body>
    <a href="startpage.php">  
      <img src="images/NATURE-ONE-DAIRY-CORPORATE-LOGO-01.png"  alt="logo" class="LOGO">
    </a>
    <ul class="list">
      <li> 
        <a href="startpage.php" class="effect"><i class="fas fa-home"></i>  HOME</a> 
      </li>
      <li> 
        <a href="Service.php" class="effect"><i class="fas fa-dolly-flatbed"></i>  SERVICES</a> 
      </li>
    </ul>
    <div class="form">
      <form action="Dairypro.php" method="POST">
        <h3> Animal Feed </h3>
        <p class="details">
          
          <!-- Add field for farmer ID -->
          <label for="farmer_id">Farmer ID
            <input type="text" name="farmer_id" value="" placeholder="FARMER ID">
          </label>
          <a href="cust_History.html">
            <button type="button" class="btn btn-danger" style="float:right;">
              <i class="fas fa-history"></i> Payment History
            </button>
          </a>
        </p>
        <table class="table">
          <tr class="bg-success">
            <th></th>
            <th> Product Name </th>
            <th> Price </th>
            <th> Product ID </th>
            <th> Quantity </th>
          </tr>
          <tr>
            <td><img src="images/bhusa.jpeg" alt="bhusa"></td>
            <th> Bhusa </th>
            <td><i class="fas fa-rupee-sign"></i> 500 </td>
            <td> <label for="id_1"> <input type="Checkbox" name="id_1" value="208"/> 209 </label> </td>
            <td> <input type="text" name="quantity1" id="bhusa" value="0" size="10" /> </td>
          </tr>
          <tr>
            <td> <img src="images/goli pend.jpg" alt="goli_pend"></td>
            <th> Goli Pend </th>
            <td><i class="fas fa-rupee-sign"></i> 1300 </td>
            <td> <label for="id_2"> <input type="Checkbox" value="207" name="id_2"/> 205</label> </td>
            <td> <input type="text" id="goli_pend" name="quantity2" value="0" size="10" /> </td>
          </tr>
          <tr>
            <td> <img src="images/sarakipend.jpeg" alt="saraki_pend"></td>
            <th> Saraki Pend </th>
            <td><i class="fas fa-rupee-sign"></i> 1200 </td>
            <td> <label for="id_3"> <input type="Checkbox" name="id_3" value="209"/> 206 </label> </td>
            <td> <input type="text" id="saraki_pend" name="quantity3" value="0" size="10" /> </td>
          </tr>
          <tr>
            <td> <img src="images/sengdanapend.jpeg" alt="sengdana_pend"></td>
            <th> Sengdana Pend </th>
            <td><i class="fas fa-rupee-sign"></i> 2000 </td>
            <td> <label for="id_4"> <input type="Checkbox" name="id_4" value="205"/> 207 </label> </td>
            <td> <input type="text" id="sengdana_pend" name="quantity4" value="0" size="10" /> </td>
          </tr>
          <tr class="bg-success">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </table>

  <!-- Button for precomputation of the total cost -->

        <p class="VALUES">

          <input type="button" name="Total_cost" value="Total Cost" onclick="computeCost();" class="btn btn-success" required/>
 <i class="fas fa-rupee-sign"></i>
          <input type = "text"  size = "15"  id = "cost" onfocus = "this.blur();" />
        </p>

  <!-- The submit and reset buttons -->

        <p class="submit">
          <input type = "submit" name="save_the_form_data"  value = "Submit Order"  class="btn btn-success"/>
          <input type = "reset"  value = "Clear Order Form" class="btn btn-danger"/>
        </p>
      </form>

  </div>

<!-- ###########################################################################################################################################################  -->



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>
