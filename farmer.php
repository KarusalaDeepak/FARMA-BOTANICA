<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "farmer.css">
    <title>FARMER</title>
</head>
<body>
    <div id = "head">
        <h1 id = "h1" class="rainbow"><b>FARMER</b></h1>
    </div> 

    <div>
        <ul class = "navigation">        
            <li id = "CropAdvertisementButton"><a href="#">Crop Advertisement</a></li>
            <li id = "BuyingStatusButton"><a href="#">Buying Status</a></li>
            <li id = "FarmingTipsButton"><a href="#">Farming Tips</a></li>
            <li id = "ComplaintPageButton"><a href="#">Complaint Page</a></li>
            <li id = "ViewComplaintStatusButton"><a href="#">View Complaint Status</a></li>
            <li id = "WeatherButton"><a href="WeatherTastic/index.html">Know about Weather</a></li>
            <li><button id = "LogoutButton" style = "margin:0px; background-color:transparent; font-size:large;">Logout</button></li>
        </ul>
    </div>

    <span class="entry" id = "EntryButton"></span>
        
    <div class = "CropAdvertisement" id = "CropAdvertisement" style = "display:none;">
        <h3>Crop Advertisement</h3>
        <style>
            #tta {
                border-collapse: collapse;
                width: 52%;
                color: #588c7e;
                font-family: 'Roboto', sans-serif;
                text-align: center;
                margin-left: 25%;
            }
            #tta th {
                background-color: crimson;
                color: white;
                text-align: center;
            }
            #tta tr:nth-child(even) {
                background-color: #f2f2f2;
            }
        </style>
        <table id  = "tta">
            <tr>
                <th>Supplier ID  </th>
                <th>Supplier Mobile Number</th>
                <th>Crop ID</th>
                <th>Crop Name</th>
                <th>Required Quantity</th>
                <th>Sell It</th>
            </tr>
            <?php
            $con = mysqli_connect("localhost:3309","root","","farmerwebservice");
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                exit();
            }
            $sql = "SELECT * FROM crop_advertisement INNER JOIN supplier WHERE crop_advertisement.SUPPLIER_ID =  supplier.SUPPLIER_ID";
            $result = mysqli_query($con, $sql);
            while($row = mysqli_fetch_assoc($result)){
                $SUPPLIER_ID = $row['SUPPLIER_ID'];
                $CROP_ID = $row['CROP_ID'];
                $CROP_NAME = $row['CROP_NAME'];
                echo
                    "<form action = 'sell_crop.php' method = 'POST'><tr>
                        <td><input style = 'background-color:transparent; border:none; outline:none; width: 50px;' name = 'u' type = 'text' value = '$SUPPLIER_ID' readonly></td>
                        <td>" . $row["SUPPLIER_CONTACT_NUMBER"]. "</td>
                        <td><input style = 'background-color:transparent; border:none; outline:none; width: 50px;' name = 'i' type = 'text' value = '$CROP_ID' readonly></td>
                        <td><input style = 'background-color:transparent; border:none; outline:none; width: 50px;' name = 'k' type = 'text'. value = '$CROP_NAME' readonly></td>
                        <td>" . $row["REQUIRED_QUANTITY"]. "</td>
                        <td>".
                        "<button type = 'submit' style = 'margin: 0px; padding: 0px; height: 20px; width:60px; font-size:13px'>SELL</button>"
                        ."</td>
                    </tr>
                    </form>";
            }
        ?>
    </table>
    </div>

    <div class = "BuyingStatus" id = "BuyingStatus" style = "display:none;">
        <h3>Buying Status</h3>
        <table id  = "tta">
            <tr>
                <th>Supplier ID  </th>
                <th>Supplier Mobile Number</th>
                <th>Crop ID</th>
                <th>Crop Name</th>
                <th>Farmer ID</th>
                <th>Status</th>
            </tr>
            <?php
                $con = mysqli_connect("localhost:3309","root","","farmerwebservice");
                if (mysqli_connect_errno()) {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    exit();
                }
                $sql = "SELECT * FROM sell_crop INNER JOIN supplier WHERE sell_crop.SUPPLIER_ID =  supplier.SUPPLIER_ID";
                $result = mysqli_query($con, $sql);
                while($row = mysqli_fetch_assoc($result)){
                    echo 
                        "<tr>
                            <td>" . $row["SUPPLIER_ID"] . "</td>
                            <td>" . $row["SUPPLIER_CONTACT_NUMBER"]. "</td>
                            <td>" . $row["CROP_ID"] . "</td>
                            <td>" . $row["CROP_NAME"] . "</td>
                            <td>" . $row["FARMER_ID"] . "</td>
                            <td>" . $row["SELLING_STATUS"] . "</td>
                        </tr>";
                    }
            ?>
    </table>
    </div>

    <div class = "FarmingTips" id = "FarmingTips" style = "display:none;">
        <h3>Farming Tips</h3>
        <table id  = "tta">
            <tr>
                <th>S.No</th>
                <th>Description</th>
                <th>Date & Time</th>
            </tr>
            <?php
            $con = mysqli_connect("localhost:3309","root","","farmerwebservice");
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                exit();
            }

            $sql = "SELECT * FROM farming_tips ORDER BY dt ASC";
            $result = mysqli_query($con, $sql);
            while($row = mysqli_fetch_assoc($result)){
                echo 
                    "<tr>
                        <td>" . $row["SERIAL_NUMBER"] . "</td>
                        <td>" . $row["TIPS_DESCRIPTION"]. "</td>
                        <td>" . $row["dt"] . "</td>
                    </tr>";
                }
        ?>
    </table>
    </div>

    <div class = "ComplaintPage" id = "ComplaintPage" style = "display:none;">
        <h3>Complaint Page</h3>
        <form action = "utilities/Complaintpagedetails.php" method = "POST" target="DummyFrame">
            <table style = "width: 400px;margin-left:38%">
            <tr>
                <td>Farmer ID: </td>
                <td><input type="text" name = "Farmer_ID" required></td>
            </tr>
            <tr>
                <td>Complaint ID:</td>
                <?php
                    $con = mysqli_connect("localhost:3309","root","","farmerwebservice");
                    if (mysqli_connect_errno()) {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                        exit();
                    }

                    $sql = "SELECT * FROM complaint_page ORDER BY COMPLAINT_NUMBER DESC LIMIT 1";
                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_array($result);
                    $complaintno = $row["COMPLAINT_NUMBER"];
                    if ($complaintno == "")
                    {
                        $complaintno = 1;
                    }
                    else
                    {
                        $complaintno++;
                    }
                ?>
                <td><input type="text" name = "Complaint_ID" value = "<?php echo $complaintno++;?>" readonly></td>
            </tr>
            <tr>
                <td>Complaint Type:</td>
                <td><select name = "Complaint_Type" required>
                <option value = "--Select--">--Select--</option>
                <option value = "CropIssue">Crop Issue</option>
                <option value = "AboutSupplier">About Supplier</option>
                <option value = "TechnicalProblem">Technical Problem</option>
                </select></td>
            </tr>
            <tr>
                <td>Complaint:</td>
                <td><textarea rows = '6' cols = '25' name = "Complaintdescription" placeholder="Enter Description here...." required></textarea></td>
            </tr>
        </table>
        <br>
        <button style = "margin-left:4.5%">Submit</button>
        </form>
        <div class="alert alert-success" role="alert" style = "display: none; text-align-last: center;">
        Complaint was Registered!
        </div>
    </div>

    <div class = "ViewComplaintStatus" id = "ViewComplaintStatus" style = "display:none;">
        <h3>View Complaint Status</h3>
        <table id  = "tta">
            <tr>
                <th>Complaint Number</th>
                <th>Farmer ID</th>
                <th>Complaint Type</th>
                <th>Complaint Description</th>
                <th>Status</th>
            </tr>
            <?php
                $con = mysqli_connect("localhost:3309","root","","farmerwebservice");
                if (mysqli_connect_errno()) {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    exit();
                }
                $sql = "SELECT * FROM complaint_page ORDER BY COMPLAINT_NUMBER ASC";
                $result = mysqli_query($con, $sql);
                while($row = mysqli_fetch_assoc($result)){
                    echo 
                        "<tr>
                            <td>" . $row["COMPLAINT_NUMBER"]. "</td>
                            <td>" . $row["FARMER_ID"] . "</td>
                            <td>" . $row["COMPLAINT_TYPE"] . "</td>
                            <td>" . $row["COMPLAINT_DESCRIPTION"] . "</td>
                            <td>" . $row["COMPLAINT_STATUS"] . "</td>
                        </tr>";
                    }
            ?>
        </table>
    </div>

    <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/typed.js/1.1.7/typed.min.js'></script>
    <script>
        if(sessionStorage.getItem("userID") == null)
        {
            $('html').html("");
        } 

        document.addEventListener('DOMContentLoaded', 
            function(){
                Typed.new('.entry',{
                strings: ["Hi Farmer!", "You are the backbone of our country", "We Celebrate the joy of", "AGRICULTURE."],
                typeSpeed: 2});
            });

        $('#CropAdvertisementButton').on('click', function() {
            $('#heading').hide();
            $('#FarmingTips').hide();
            $('#ComplaintPage').hide();
            $('#ViewComplaintStatus').hide();
            $('#BuyingStatus').hide();
            $('#EntryButton').hide();
            $('#CropAdvertisement').show();
        });  
        $('#BuyingStatusButton').on('click', function() {
            $('#heading').hide();
            $('#FarmingTips').hide();
            $('#ComplaintPage').hide();
            $('#ViewComplaintStatus').hide();
            $('#CropAdvertisement').hide();
            $('#EntryButton').hide();
            $('#BuyingStatus').show();
        });  
        $('#FarmingTipsButton').on('click', function() {
            $('#heading').hide();
            $('#CropAdvertisement').hide();
            $('#ComplaintPage').hide();
            $('#ViewComplaintStatus').hide();
            $('#BuyingStatus').hide();
            $('#EntryButton').hide();
            $('#FarmingTips').show();
        });  
        $('#ViewComplaintStatusButton').on('click', function() {
            $('#heading').hide();
            $('#FarmingTips').hide();
            $('#ComplaintPage').hide();
            $('#CropAdvertisement').hide();
            $('#BuyingStatus').hide();
            $('#EntryButton').hide();
            $('#ViewComplaintStatus').show();
        });  
        $('#WeatherButton').on('click', function() {
            $('#heading').hide();
            $('#FarmingTips').hide();
            $('#CropAdvertisement').hide();
            $('#ViewComplaintStatus').hide();
            $('#BuyingStatus').hide();
            $('#EntryButton').hide();
            $('#ComplaintPage').hide();
        });
        $('#ComplaintPageButton').on('click', function() {
            $('#heading').hide();
            $('#FarmingTips').hide();
            $('#ViewComplaintStatus').hide();
            $('#BuyingStatus').hide();
            $('#EntryButton').hide();
            $('#CropAdvertisement').hide();
            $('#ComplaintPage').show();
        });  
        $('#CropAdvertisementButton').on('click', function() {
            $('#heading').hide();
            $('#FarmingTips').hide();
            $('#ComplaintPage').hide();
            $('#ViewComplaintStatus').hide();
            $('#BuyingStatus').hide();
            $('#EntryButton').hide();
            $('#CropAdvertisement').show();
        });  
        $('#LogoutButton').on('click', function() {
            sessionStorage.clear();
            window.location = 'index.html';
        });
    </script>
</body>
    <iframe name="DummyFrame" style="display:none;"></iframe>
</html>

