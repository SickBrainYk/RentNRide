<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMINISTRATOR</title>
</head>
<body>

<style>
*{
    margin: 0;
    padding: 0;
}
.hai{
    width: 100%;
    background: linear-gradient(to top, rgba(0,0,0,0)50%, rgba(0,0,0,0)50%),url("../images/carbg2.jpg");
    background-position: center;
    background-size: cover;
    height: 109vh;
    animation: infiniteScrollBg 50s linear infinite;
}
.navbar{
    width: 1200px;
    height: 75px;
    margin: auto;
}
.icon{
    width:200px;
    float: left;
    height : 70px;
}
.logo{
    color: #ff7200;
    font-size: 35px;
    font-family: Arial;
    padding-left: 20px;
    float:left;
    padding-top: 10px;
}
.menu{
    width: 400px;
    float: left;
    height: 70px;
}
ul{
    float: left;
    display: flex;
    justify-content: center;
    align-items: center;
}
ul li{
    list-style: none;
    margin-left: 62px;
    margin-top: 27px;
    font-size: 14px;
}
ul li a{
    text-decoration: none;
    color: black;
    font-family: Arial;
    font-weight: bold;
    transition: 0.4s ease-in-out;
}
.content-table{
   border-collapse: collapse;
    font-size: 1em;
    border-radius: 5px 5px 0 0;
    overflow: hidden;
    box-shadow:0 0  20px rgba(0,0,0,0.15);
    margin-left : 100px ;
    margin-top: 25px;
    width: 1300px;
    height: 300px;
}
.content-table thead tr{
    background-color: orange;
    color: white;
    text-align: left;
}
.content-table th,
.content-table td{
    padding: 12px 15px;
}
.content-table tbody tr{
    border-bottom: 1px solid #dddddd;
}
.content-table tbody tr:nth-of-type(even){
    background-color: #f3f3f3;
}
.content-table tbody tr:last-of-type{
    border-bottom: 2px solid orange;
}
.header{
    margin-top: -700px;
    margin-left: 650px;
}
</style>
<?php
require_once('connection.php');
$query="SELECT * FROM booking ORDER BY BOOK_ID DESC";    
$queryy=mysqli_query($con,$query);
?>

<div class="hai">
    <div class="navbar">
        <div class="icon">
            <h2 class="logo">CaRs</h2>
        </div>
        <div class="menu">
            <ul>
            <li><a href="pemilikmobil.php">VEHICLE MANAGEMENT</a></li>
                    <li><a href="pemilikuser.php">USERS</a></li>
                    <li><a href="pemilikdash.php">FEEDBACKS</a></li>
                    
                    <li><a href="pemilikbook.php">BOOKING REQUEST</a></li>
                  <li> <button class="nn"><a href="index.php">LOGOUT</a></button></li>
            </ul>
        </div>
     </div>
</div>
<div>
    <h1 class="header">BOOKINGS</h1>
    <div>
        <table class="content-table">
            <thead>
                <tr>
                    <th>CAR ID</th>
                    <th>EMAIL</th>
                    <th>BOOK PLACE</th>
                    <th>BOOK DATE</th>
                    <th>DURATION</th>
                    <th>PHONE NUMBER</th>
                    <th>DESTINATION</th>
                    <th>RETURN DATE</th>
                    <th>BOOKING STATUS</th>
                </tr>
            </thead>
            <tbody>
            <?php while($res=mysqli_fetch_array($queryy)){ ?>
                <tr class="active-row">
                    <td><?php echo $res['CAR_ID'];?></td>
                    <td><?php echo $res['EMAIL'];?></td>
                    <td><?php echo $res['BOOK_PLACE'];?></td>
                    <td><?php echo $res['BOOK_DATE'];?></td>
                    <td><?php echo $res['DURATION'];?></td>
                    <td><?php echo $res['PHONE_NUMBER'];?></td>
                    <td><?php echo $res['DESTINATION'];?></td>
                    <td><?php echo $res['RETURN_DATE'];?></td>
                    <td><?php echo $res['BOOK_STATUS'];?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
