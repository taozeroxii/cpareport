<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$name = $detail = $tel = "";
$name_err = $address_err = $salary_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "ระบุหน่วยงานของท่าน.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    // Validate detail
    $input_address = trim($_POST["detail"]);
    if(empty($input_address)){
        $address_err = "ระบุรายละเอียดข้อมูลที่ต้องการอย่างละเอียด เพื่อใช้ในการประกอบการทำรายงานที่ถูกต้อง.";     
    } else{
        $detail = $input_address;
    }
    
    // Validate tel
    $input_salary = trim($_POST["tel"]);
    if(empty($input_salary)){
        $salary_err = "ระบุเบอร์ภายในของท่าน.";     
    } elseif(!ctype_digit($input_salary)){
        $salary_err = "Please enter a positive integer value.";
    } else{
        $tel = $input_salary;
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($address_err) && empty($salary_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO list_report (name, detail, tel) VALUES (?, ?, ?)";
        mysqli_set_charset($link,"utf8");     
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_address, $param_salary);

            // Set parameters
            $param_name = $name;
            $param_address = $detail;
            $param_salary = $tel;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>แบบขอรายงาน</h2>
                    </div>
                    <p>กรอกข้อมูลที่ต้องการรายงาน.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>หน่วยงาน</label>
                            <input type="text" name="name" placeholder="หน่วยงานของท่าน" class="form-control" value="<?php echo $name; ?>" >
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                            <label>รายละเอียด</label>
                            <textarea name="detail" rows="5"  class="form-control" placeholder="รายละเอียดข้อมูลที่ขอรายงานอย่างละเอียด" value="<?php echo $detail; ?>"></textarea>
                            <span class="help-block"><?php echo $address_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($salary_err)) ? 'has-error' : ''; ?>">
                            <label>เบอร์ภายใน</label>
                            <input type="text" name="tel" class="form-control" placeholder="เบอร์ภายในของท่าน" value="<?php echo $tel; ?>">
                            <span class="help-block"><?php echo $salary_err;?></span>
                        </div>












                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>






                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>