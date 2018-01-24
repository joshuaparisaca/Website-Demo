<!--NEEDS INTERNET TO WORK PROPERLY-->
<?php
include('session.php');
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <title>Home</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="homeSheet.css" />
        <link rel="shortcut icon" href="letter_J.png" />
        
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css"/>  
        <script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>
        
        <script type="text/javascript" charset="utf-8">
            $(document).ready(function ()
            {
                $('#example').DataTable();
            });
        </script>
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top" style="border-radius:0;">
            <!--navbar-default or navbar-inverse for style color-->
            <div class="container-fluid">
                <!-- -fluid Makes sure that the entire width is taken -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span> <!-- Makes sure that when the screen width is very slim, 3 bars/icons are shown to drop down the menu below-->
                        <span class="icon-bar"></span> <!--data-target will activate on the list elements under the ID "myNavBar"-->
                    </button>
                    <a class="navbar-brand" href="welcome.php"><span class="glyphicon glyphicon-home"> </span> </a> <!-- navbar-brand This wont be inside the 3 abrs menu-->
                </div>

                <div class="collapse navbar-collapse" id="myNavbar">
                    <!-- This will initialize itself as "myNavbar"/ navbar-collapse will be squeezed into a drop-down menu -->
                    <ul class="nav navbar-nav">
                        <!-- navbar-nav SPECIFICALLY FOR ul/li so they appear across the navbar -->

                        <li class="active"><a href="Joshua_Parisaca_Resume.pdf" download>Resume</a></li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <!-- in a new navbar-nav in the same navbar, these items will appear on the right -->
                        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li> <!-- glyphicon will make a little icon for user and login-->
                    </ul>
                </div>
            </div>
        </nav>

        <div class="jumbotron jumbotron-fluid">
            <div class="container text-center "><!--This will center everything -->
                <h1 style="color:whitesmoke;">Data Project</h1>
                <p style="color:whitesmoke;">Below is a table of people</p>
                <p style="color:whitesmoke;">Insert, Delete, or Modify the table based on a provided email</p>
                <button type = "button" class = "btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal1">
                    Add Person
                </button>
            </div>
        </div>
        <div class="container">
            <div class="panel panel-default">
                <!-- Sourrounding a tbale with a panel will make it have a rounded border-->
                <table id="example" class="display" cellspacing="0" width="100%">
                    <!-- table classes: tabel, table table-hover, and table-responsive is for tables meant to view for mobile phone and desktop-->
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Zip</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = mysqli_query($connection, "SELECT email, firstname, lastname, street, city, state, zip FROM people_table");
                        while ($rowitem = mysqli_fetch_assoc($result)) {
                            echo "<tr onclick='myFunction(this)'>";
                            echo "<th>  <a href='#myModal2' data-toggle='modal'>" . $rowitem['email'] . " </a> </th>";
                            echo "<th>" . $rowitem['firstname'] . "</th>";
                            echo "<th>" . $rowitem['lastname'] . "</th>";
                            echo "<th>" . $rowitem['street'] . "</th>";
                            echo "<th>" . $rowitem['city'] . "</th>";
                            echo "<th>" . $rowitem['state'] . "</th>";
                            echo "<th>" . $rowitem['zip'] . "</th>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script type="text/javascript">
            // For demo to fit into DataTables site builder...
            $('#example')
                    .removeClass('display')
                    .addClass('table table-striped table-bordered table-hover');
        </script>

        <div id="myModal1" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Create a new user</h3>
                    </div>
                    <div class="modal-body">
                        <form id="createuserform" method="POST" action="submitform.php"  onsubmit="return required()">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email:</label>
                                <input type="text" class="form-control" name="emailinput" aria-describedby="emailHelp" value="">           
                            </div>
                            <div class="form-group">
                                <label for="firstnameinput">First Name:</label>
                                <input type="text" class="form-control" name="firstnameinput" value=""/>
                            </div>
                            <div class="form-group">
                                <label for="lastnameinput">Last Name:</label>
                                <input type="text" class="form-control"  name="lastnameinput" value=""/>
                            </div>
                            <div class="form-group">
                                <label for="addressinput">Address:</label>
                                <input type="text" class="form-control" name="addressinput" value=""/>
                            </div>
                            <div class="form-group">
                                <label for="cityinput">City:</label>
                                <input type="text" class="form-control" name="cityinput" value=""/>
                            </div>
                            <div class="form-group">
                                <label for="stateinput">State:</label>
                                <input type="text" class="form-control" name="stateinput" value="" maxlength="2"/>
                            </div>
                            <div class="form-group">
                                <label for="zipinput">Zip:</label>
                                <input type="text" class="form-control" name="zipinput" value="" maxlength="5"/>
                            </div>
                        </form> 
                    </div>
                    <div class="modal-footer">
                        <p class="pull-left" style="color:red;">Please complete all field</p>
                        <button type="Submit" name="addPerson" class="btn btn-primary" form="createuserform">Submit</button>
                    </div>
                    <script>
                        function required()
                        {
                            //USE THIS TO CHECK YOUR EMAIL
                            var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                            
                            var email = document.forms["createuserform"]["emailinput"].value;
                            var fname = document.forms["createuserform"]["firstnameinput"].value;
                            var lname = document.forms["createuserform"]["lastnameinput"].value;
                            var addr = document.forms["createuserform"]["addressinput"].value;
                            var city = document.forms["createuserform"]["cityinput"].value;
                            var state = document.forms["createuserform"]["stateinput"].value;
                            var zip = document.forms["createuserform"]["zipinput"].value;

                            if (email === "" || fname === "" || lname === "" || addr === "" || city === "" || state === "" || zip === "")
                            {
                                alert("Please complete all missing fields");
                                return false;
                            }
                            else if (!email.match(mailformat))
                            {
                                alert("Please enter a valid email");
                                return false;
                            } 
                            else if (!isNaN(zip) === false)
                            {
                                alert("Please enter a valid zip code");
                                return false;
                            } 
                            else
                            {
                                return true;
                            }
                        }
                    </script>
                </div>
            </div>
        </div>
        <div id="myModal2" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Personal Information</h4>
                    </div>
                    <div class="modal-body">
                        <form id="peopleform" method="POST" action="submitform.php">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email:</label>
                                <input type="text" class="form-control" name="emailinput" id="emailinput" aria-describedby="emailHelp" value="" readonly>     
                                    <script>
                                        var rowchosen;
                                        var emailchosen;
                                        var fnamechosen;
                                        var lnamechosen;
                                        var addresschosen;
                                        var citychosen;
                                        var statechosen;
                                        var zipchosen;

                                        function myFunction(x)
                                        {
//                                            reuse these variables to replace variables if theyre empty
                                            rowchosen = x.rowIndex;
                                            emailchosen = document.getElementById('example').rows[rowchosen].cells[0].innerText;
                                            fnamechosen = document.getElementById('example').rows[rowchosen].cells[1].innerText;
                                            lnamechosen = document.getElementById('example').rows[rowchosen].cells[2].innerText;
                                            addresschosen = document.getElementById('example').rows[rowchosen].cells[3].innerText;
                                            citychosen = document.getElementById('example').rows[rowchosen].cells[4].innerText;
                                            statechosen = document.getElementById('example').rows[rowchosen].cells[5].innerText;
                                            zipchosen = document.getElementById('example').rows[rowchosen].cells[6].innerText;

                                            document.getElementById("emailinput").value = emailchosen;
                                            document.getElementById("firstnameinput").value = fnamechosen;
                                            document.getElementById("lastnameinput").value = lnamechosen;
                                            document.getElementById("addressinput").value = addresschosen;
                                            document.getElementById("cityinput").value = citychosen;
                                            document.getElementById("stateinput").value = statechosen;
                                            document.getElementById("zipinput").value = zipchosen;
                                        }
                                        function testfunction()
                                        {
                                            var email = document.forms["peopleform"]["emailinput"].value;
                                            var fname = document.forms["peopleform"]["firstnameinput"].value;
                                            var lname = document.forms["peopleform"]["lastnameinput"].value;
                                            var addr = document.forms["peopleform"]["addressinput"].value;
                                            var city = document.forms["peopleform"]["cityinput"].value;
                                            var state = document.forms["peopleform"]["stateinput"].value;
                                            var zip = document.forms["peopleform"]["zipinput"].value;

                                            if (email === "" || fname === "" || lname === "" || addr === "" || city === "" || state === "" || zip === "")
                                            {
                                                alert("Don't leave anything empty");
                                                return false;
                                            }
                                            else if (!isNaN(zip) === false)
                                            {
                                                alert("Please enter a valid zip code");
                                                return false;
                                            }
                                            else
                                            {
                                                alert("Modified");
                                                return true;
                                            }
                                        }
                                        function confirmation()
                                        {
                                          return confirm('Do you really want to DELETE "' + emailchosen +'"');
                                        }
                                    </script>
                            </div>
                            <div class="form-group">
                                <label for="firstnameinput">First Name:</label>
                                <input type="text" class="form-control" name="firstnameinput" id="firstnameinput" value=""/>
                            </div>
                            <div class="form-group">
                                <label for="lastnameinput">Last Name:</label>
                                <input type="text" class="form-control"  name="lastnameinput" id="lastnameinput" value=""/>
                            </div>
                            <div class="form-group">
                                <label for="addressinput">Address:</label>
                                <input type="text" class="form-control" name="addressinput" id="addressinput" value=""/>
                            </div>
                            <div class="form-group">
                                <label for="cityinput">City:</label>
                                <input type="text" class="form-control" name="cityinput" id="cityinput" value=""/>
                            </div>
                            <div class="form-group">
                                <label for="stateinput">State:</label>
                                <input type="text" class="form-control" name="stateinput" id="stateinput" value="" maxlength="2"/>
                            </div>
                            <div class="form-group">
                                <label for="zipinput">Zip:</label>
                                <input type="text" class="form-control" name="zipinput" id="zipinput" value="" maxlength="5"/>
                            </div>
                        </form> 
                    </div>
                    <div class="modal-footer">
                        <!--                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                        <button type="Submit" name="deletePerson" class="btn btn-danger pull-left" form="peopleform" onclick="return confirmation(this);">Delete</button>
                        <button type="Submit" name="modifyPerson" class="btn btn-primary" form="peopleform"  onclick="return testfunction();">Modify</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>