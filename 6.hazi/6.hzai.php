<?php
$firstNameErr = $lastNameErr= $emailErr=$attendErr= $pdfErr= $termsErr ="";
$valid_formats = array("application/pdf");

if (isset($_POST['submit'])) {

    $correct = true;

    if (empty($_POST['firstName'])) {
        $firstNameErr = "<br>" . "First name is required!";
        $correct = false;
    } else{
        $fname = test_input($_POST['firstName']);
    }

    if (empty($_POST['lastName'])) {
        $lastNameErr = "<br>" . "Last name is required!";
        $correct = false;
    } else{
        $lname = test_input($_POST['lastName']);
    }

    if (empty($_POST['email'])) {
        $emailErr = "<br>" . "Email is required!";
        $correct = false;
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "<br>" . "Invalid email format!";
        $correct = false;
    }

    if (empty($_POST['attend'])) {
        $attendErr = "<br>" . "Please check at least one event!";
        $correct = false;
    }



    if ($_FILES['abstract']['name'] == "") {
        $pdfErr = "<br>" . "Please choose a pdf file!";
        $correct = false;
    } elseif (!in_array($_FILES['abstract']['type'], $valid_formats)) {
        $pdfErr = "<br>" . "Invalid format, please choose a pdf file!";
        $correct = false;
    } elseif ($_FILES['abstract']['size'] > 1024 * 1024 * 3) {
        $pdfErr = "<br>" . "The size of pdf is too big!";
        $correct = false;
    }

    if (!isset($_POST['terms'])) {
        $termsErr = "<br>" . "Please indicate that you accept the Terms and Conditions!";
        $correct = false;
    }

    if ($correct) {
        echo '<h2>Your Form:</h2>';
        echo "First name: " . $fname . "</p>";
        echo "Last name: " . $lname . "</p>";
        echo "E-mail: " . $_POST['email'] . "</p>";
        echo "I will attend: " . "<br>";
        foreach ($_POST['attend'] as $event) {
            echo $event . "<br>";
        }

        echo "Your T-Shirt size is ";
        if ($_POST['tshirt'] == "P") {
            echo "The size is not selected!";
        } else {
            echo $_POST['tshirt'] . ".";
        }
        echo "<br>" .'File name is: ' . $_FILES['abstract']['name'];
    }
}

function test_input($data){
    return htmlspecialchars($data);
}
?>

<h3>Online conference registration</h3>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
    <label for="fname"> First name:
        <input type="text" name="firstName">
    </label>
    <span><?php echo $firstNameErr; ?></span>
    <br><br>
    <label for="lname"> Last name:
        <input type="text" name="lastName">
    </label>
    <span><?php echo $lastNameErr; ?></span>
    <br><br>
    <label for="email"> E-mail:
        <input type="text" name="email">
    </label>
    <span><?php echo $emailErr; ?></span>
    <br><br>
    <label for="attend"> I will attend:<br>
        <input type="checkbox" name="attend[]" value="Event1">Event 1<br>
        <input type="checkbox" name="attend[]" value="Event2">Event2<br>
        <input type="checkbox" name="attend[]" value="Event3">Event2<br>
        <input type="checkbox" name="attend[]" value="Event4">Event3<br>
    </label>
    <span><?php echo $attendErr; ?></span>
    <br><br>
    <label for="tshirt"> What's your T-Shirt size?<br>
        <select name="tshirt">
            <option value="P">Please select</option>
            <option value="S">S</option>
            <option value="M">M</option>
            <option value="L">L</option>
            <option value="XL">XL</option>
        </select>
    </label>
    <br><br>
    <label for="abstract"> Upload your abstract<br>
        <input type="file" name="abstract"/>
    </label>
    <span><?php echo $pdfErr; ?></span>
    <br><br>
    <input type="checkbox" name="terms" value="">I agree to terms & conditions.<br>
    <span><?php echo $termsErr; ?></span>
    <br><br>
    <input type="submit" name="submit" value="Send registration"/>
</form>