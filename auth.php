<?php

    session_start();
    
    if (!isset($_SESSION["email"])) {
	header("Location: login.php");
	exit(); 
    } 
    $guest = array("dashboard", "index", "searchMeds","cart");

    $customer =  array("index","cart","orderMeds","viewMeds", "viewOrders", "viewOrderDetail");
    
    $salesperson =  array("index", "viewMeds", "orderMeds",
                          "customer", "viewCustomers", "editCustomer", 
                          "category", "viewCategories", "editCategory", 
                          "medicine", "viewMedicines", "editMedicine", 
                          "stock", "viewStocks", "viewOrderDetail",
                          "order", "viewOrders", "viewStoreStocks", "storeStockItems",
                         "editStockItem");
    
    $manager =  array("index", "viewMeds", "orderMeds", 
                      "customer", "viewCustomers", "editCustomer", 
                      "category", "viewCategories", "editCategory", 
                      "medicine", "viewMedicines", "editMedicine", 
                      "stock", "viewStocks", "viewStoreStocks", "storeStockItems" ,
                      "order", "viewOrders", "viewOrderDetail",                             
                      "staff", "viewStaff", "editStaff", 
                      "store", "viewStores", "editStore", 
                      "supplier", "viewSuppliers", "editSupplier", 
                      "annualReport", "availability_giant_eagle", 
                      "availability_cvs", "availability_rite_aid", 
                      "MaxOrders", "BacklogMedicine", 
                      "LessAvailableMedicine", "Salespersonsales","SalesComparison","viewstats");

    $cur_page = basename($_SERVER['SCRIPT_NAME'], ".php");
    $role = $_SESSION["role"];
  	
    $have_access = FALSE;

    //echo "role: ".$role;
    
    if ($role == "guest") {
	$have_access = in_array($cur_page, $guest); 
    } elseif ($role == "customer") {
	$have_access = in_array($cur_page, $customer);
    } elseif ($role == "S") {
	$have_access = in_array($cur_page, $salesperson);
    } elseif ($role == "M") {
	$have_access = in_array($cur_page, $manager);
    }	
    
    if (!$have_access) {

	echo "<div class='form'><h3> Sorry you do not have privileges to use this page.</h3>";
	echo "<br/>Click here to get back to your <a href='dashboard.php'>Dashborad</a></div>";
	exit();
    }
?>

