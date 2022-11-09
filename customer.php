<?php

include("includes.php"); // Contain all necessary include files 


if (isset($_REQUEST['form_action'])) {


    $form_action = $_REQUEST['form_action'];
    $error_msg = "";


    $first_name = $_REQUEST["first_name"];
    $last_name = $_REQUEST["last_name"];
    $email_address = $_REQUEST["email_address"];
    $passwd = $_REQUEST["passwd"];
    $rpasswd = $_REQUEST["rpasswd"];
    $phone_number = $_REQUEST["phone_number"];
    $address = $_REQUEST["address"];
    $gender = $_REQUEST["gender"];
    $dob = $_REQUEST["dob"];
    $femail = FILTER_VALIDATE_EMAIL;

    //Validation function
    function validate_name($name)
    {
        if (preg_match("/^([a-zA-Z' ]+)$/", $name)) {
            return true;
        } else {
            return false;
        }
    }


    function validate_phone($phone_number)
    {
        if (preg_match('/^[0-9]{11}+$/', $phone_number)) {
            // the format /^[0-9]{11}+$/ will check for phone number with 11 digits and only numbers
            return true;
        } else {
            return false;
        }
    }


    function validate_dob($dob)
    {
        if (preg_match('/^((((19|[2-9]\d)\d{2})\-(0[13578]|1[02])\-(0[1-9]|[12]\d|3[01]))|(((19|[2-9]\d)\d{2})\-(0[13456789]|1[012])\-(0[1-9]|[12]\d|30))|(((19|[2-9]\d)\d{2})\-02\-(0[1-9]|1\d|2[0-8]))|(((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))\-02\-29))$/', $dob)) {
            return true;
        } else {
            return false;
        }
    }


    //echo "Captured Values: ".$action.", ".$first_name.", ".$last_name.", ".$email_address.",
    //	   ".$passwd.", ".$rpasswd.", ".$phone_number.", ".$address.", ".$gender.", ".$dob.", ".$form_action;

    // Validation :
    if (trim($first_name) == "") {
        $error_msg .= "Please provide your first name.<br />";
    } elseif (validate_name($first_name) == false) {
        $error_msg .= "Enter correct first name.<br/>";
    }
    if (trim($last_name) == "") {
        $error_msg .= "Please provide your last name.<br />";
    } elseif (validate_name($last_name) == false) {
        $error_msg .= "Enter correct last name.<br/>";
    }
    if (trim($email_address) == "") {
        $error_msg .= "Please provide your email address.<br />";
    } elseif (!filter_var($email_address, $femail)) {
        $error_msg .= "Email address is wrong(Email should have @ and end with .co, .com, .org etc).<br/>";
    }
    if (trim($phone_number) == "") {
        $error_msg .= "Please provide a contact phone number.<br />";
    } elseif (validate_phone($phone_number) == false) {
        $error_msg .= "Please provide a correct contact phone number.<br />";
    }
    if (trim($address) == "") {
        $error_msg .= "Please provide your address.<br />";
    }

    if (trim($gender) == "") {
        $error_msg .= "Please select a gender.<br />";
    }

    if (trim($dob) == "") {
        $error_msg .= "Please provide your date of birth YYYY-MM-DD.<br />";
    } elseif (validate_dob($dob) == false) {
        $error_msg .= "Please provide a correct date of birth of format YYYY-MM-DD.<br />";
    }
    if (trim($passwd) == "") {
        $error_msg .= "Please provide a password<br />";
    }

    if (trim($passwd) != trim($rpasswd)) {
        $error_msg .= "Password and repeat password do not match<br />";
    }


    if ($error_msg == "") {

        // Put insert code here
        $sql = "INSERT INTO CUSTOMERS (first_name, last_name, email_address, passwd, phone_number, 
                          address, gender, dob)
            VALUES ('" . $first_name . "', '" . $last_name . "', '" . $email_address . "', '" . $password . "',
                '" . $phone_number . "', '" . $address . "', '" . $gender . "', '" . $dob . "');";

        //echo "SQL: ".$sql;

        if (mysqli_query($con, $sql)) {

            $last_id = mysqli_insert_id($con);
            $_SESSION['cust_id'] = $last_id;
            $_SESSION['form_action'] = $form_action;
            header("Location: viewCustomers.php"); // Redirect user to listCustomer.php

        } else {

            echo "Error: " . $sql . "" . mysqli_error($con);
        }
    }
} else {

    //echo "First time here";
    $form_action = "insert";
    $error_msg = "";
}

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <title> Create Customer </title>
    <link rel="stylesheet" href="css/style.css" />

</head>

<body>

    <div class="menu"> <?php include("nav_menu.php"); ?> </div>

    <div class="form">

        <h1> Create New Customer</h1>

        <form name="form" method="post" action="">

            <div class="error_msg"> <?php echo $error_msg; ?> </div>

            <p><input type="text" name="first_name" placeholder="Enter First Name" required /></p>

            <p><input type="text" name="last_name" placeholder="Enter Last Name" required /></p>

            <p><input type="text" name="email_address" placeholder="Enter Email" required /></p>

            <p><input type="text" name="phone_number" placeholder="Enter Phone Number" required /></p>

            <p><input type="text" name="address" placeholder="Enter Address" required /></p>

            <select class="select" name="gender" required>
                <option value="">Select gender...</option>
                <option value="M">Male</option>
                <option value="F">Female</option>
            </select>

            <p><input type="text" name="dob" placeholder="Enter Date of Birth YYYY-MM-DD" required /></p>

            <p><input type="password" name="passwd" placeholder="Enter Password" required /></p>

            <p><input type="password" name="rpasswd" placeholder="Re-enter Password" required /></p>

            <p><input type="hidden" name="form_action" value="<?php echo $form_action; ?>" required /></p>

            <p><input name="submit" type="submit" value="Submit" /></p>

        </form>
        <p style="color:#FF0000;"></p>

    </div>

    <br />
    <br />

    </div>
</body>

</html>