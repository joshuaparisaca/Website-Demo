<?php

$connection = mysqli_connect("localhost", "root", "", "test");

// To protect MySQL injection for Security purpose
$email = stripslashes($_POST['emailinput']);
$email = mysqli_real_escape_string($connection, $email);

$firstname = stripslashes($_POST['firstnameinput']);
$firstname = mysqli_real_escape_string($connection, $firstname);

$lastname = stripslashes($_POST['lastnameinput']);
$lastname = mysqli_real_escape_string($connection, $lastname);

$address = stripslashes($_POST['addressinput']);
$address = mysqli_real_escape_string($connection, $address);

$city = stripslashes($_POST['cityinput']);
$city = mysqli_real_escape_string($connection, $city);

$state = stripslashes($_POST['stateinput']);
$state = mysqli_real_escape_string($connection, $state);

$zip = stripslashes($_POST['zipinput']);
$zip = mysqli_real_escape_string($connection, $zip);

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if (isset($_POST['addPerson']))
    {
        $query = mysqli_query($connection, "INSERT INTO people_table (email, firstname, lastname, street, city, state, zip)
                                            VALUES ('$email','$firstname','$lastname','$address','$city','$state', '$zip');");
        if($query) // will return true if succefull else it will return false
        {
            header('Location: welcome.php');
        }
        else
        {            
            echo "<script>alert('Person already on database');document.location='welcome.php'</script>";

        }
    } 
    elseif (isset($_POST['modifyPerson'])) 
    {
        $query = mysqli_query($connection, "UPDATE people_table
                                            SET firstname = '$firstname', lastname = '$lastname', street = '$address', city = '$city', state = '$state', zip = '$zip'
                                            WHERE email = '$email';");
        if($query) // will return true if succefull else it will return false
        {
            header('Location: welcome.php');
        }
        else
        {
            echo "<script>alert('Person not modified');document.location='welcome.php'</script>";
        }

    } 
    elseif (isset($_POST['deletePerson'])) 
    {
        $query = mysqli_query($connection, "DELETE FROM people_table WHERE email = '$email';");
        if($query) // will return true if succefull else it will return false
        {
            header('Location: welcome.php');
        }
        else
        {
            echo "<script>alert('Person not deleted');document.location='welcome.php'</script>";
        }
    } 
}
else 
{
    echo "Youre not supposed to be here";
}