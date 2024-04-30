<?php
include "config.php";

$first_name = "";
$last_name = "";
$email = "";
$password = "";
$gender = "";

if (isset($_POST['submit'])) {
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];

    // Check if email already exists
    $check_email_query = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($check_email_query);
    if ($result->num_rows > 0) {
        echo "Error: Email already exists";
    } else {
        // Insert new record if email doesn't exist
        $sql = "INSERT INTO users (firstname, lastname, email, password, gender) VALUES ('$first_name', '$last_name', '$email', '$password', '$gender')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>

<body>
    <h2>Signup Form</h2>
    <form action="" method="POST">
        <fieldset>
            <legend>Personal Information:</legend>
            First Name: <br>
            <input type="text" name="firstname" value="<?php echo $first_name; ?>">
            <br>
            Last Name: <br>
            <input type="text" name="lastname" value="<?php echo $last_name; ?>">
            <br>
            Email: <br>
            <input type="text" name="email" value="<?php echo $email; ?>">
            <br>
            Password: <br>
            <input type="password" name="password">
            <br>
            Gender: <br>
            <input type="radio" name="gender" value="Male" <?php if ($gender == 'Male') echo 'checked'; ?>>Male
            <input type="radio" name="gender" value="Female" <?php if ($gender == 'Female') echo 'checked'; ?>>Female
            <br><br>
            <input type="submit" name="submit" value="Submit">
        </fieldset>
    </form>
</body>

</html>
