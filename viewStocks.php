<?php

include("includes.php"); // Contain all necessary include files 
//$store_id = $_SESSION["store_id"];
//echo $store_id;
if (isset($_GET['show'])) {
	
   // echo "No Results";
    $query="SELECT STOCK.stock_id, STOCK.supply_date,STOCK.overhead_pct,STOCK.total_cost, supplier.supplier_name FROM STOCK, supplier
                     where stock.supplier_id = supplier.supplier_id";
           // echo $query;
    
} 

?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>
            List Stocks
        </title>
        <link rel="stylesheet" href="css/style.css" />
    </head>

    <body>

        <div class="menu"> <?php include("nav_menu.php"); ?> </div>
        <div class="form">

            <h1> List Stocks </h1>
            
	        <div class="msg"> <p></p> </div>

            <table width="100%" border="1" style="border-collapse:collapse;">
                <thead>
                    <tr>
                        <th><strong>Supply_date</strong></th>
                        <th><strong>Overhead Percentage</strong></th>
                        <th><strong>Total Cost</strong></th>
                        <th><strong>Supplier </strong></th>
                        <th><strong>View</strong></th>
                    </tr>
                </thead>
            <tbody>
                <?php

                  //echo $query;
                  $form_action = "edit";
                  $result = mysqli_query($con, $query);
                  while($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td align="center">
                                <?php echo $row["supply_date"] ; ?>
                            </td>
                            <td align="center">
                                <?php echo $row["overhead_pct"]; ?>
                            </td>
                            <td align="center">
                                <?php echo "$".number_format($row["total_cost"], 2, '.', ','); ?>
                            </td>
                            <td align="center">
                                <?php echo $row["supplier_name"]; ?>
                            <td align="center">
                                <a href="storeStockItems.php?stock_id=<?php echo $row['stock_id']; ?>">View</a>
                            </td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <br />
        </div>
    </body>
</html>
