<html>
    <head>
<link rel="stylesheet" type="text/css" href="../css/style.css"></head>
    <body class="reciept">
        <img src="../img/gasboy_150.gif">
    <div class="heading">Bob's Garage</div>Contact Us:678-494-2996
    
        <hr>
        <h3>Customer Details</h3>
        <strong> Name: </strong><?php
        
        session_start();
        $fp=fopen("../Orders/order.tsv","a");
        
        echo $_SESSION['Name'];
        
        ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong> E-Mail: </strong><a href="<?php
        echo $_SESSION['Email'];
        ?>"><?php
        echo $_SESSION['Email'];
        
        
        ?></a><br>
        <strong> Address: </strong><?php
        echo $_SESSION['textarea'];
        
        
        ?><br>
        <strong> Phone: </strong><?php
        echo $_SESSION['tel'];
        
        $customerDetails=array($_SESSION['Name'],$_SESSION['Email'],$_SESSION['textarea'],$_SESSION['tel']);
        
        date_default_timezone_set('Australia/Melbourne');
            
        echo "<br>Time: ".date("h:i:sa")."<br>Date: ".date("Y/m/d") . "<br>"; //w3schools.com
        ?>
        <hr>
        <table border="1" class="table2">
            <caption>ORDER</caption>
        <tr>
        <td>
            <strong>Item</strong></td><td><strong>Description</strong></td><td><strong>Price</strong></td>
        
        </tr>
        
        <?php
        $total=0.00;
        foreach($_SESSION['pumps'] as $pumpKey=>$value)
        {
           if($_SESSION['cart'][$value['id']]>0)
           {
               echo '<tr>';
               echo '<td>'.$value['id'].'</td>';
               
        
               echo '<td>'.$value['title'].'</td>';
               echo '<td>'.$value['Price'].'</td>';
                $total=$total+$value['Price'];
               echo '</tr>';
           }
        }
        foreach($_SESSION['cart'] as $key=>$value)
        {
            if($value==1)
            $customerDetails[]=$key."-";
        }
        fputcsv($fp,$customerDetails,"\t");
        
        
        echo '<tr>';
               echo '<td colspan="2">Total Amount Due:</td>';
               
               echo '<td>'.number_format((float)$total,2,".",'').'</td>';//from stackoverflow
                
               echo '</tr>';
               fclose($fp);
        ?>
        </table>
        <hr>
        <h1>Thanks for shopping with us.</h1>
        <hr>
        <br>
        <h2>BOB's GARAGE</h2>
        <strong>ABN:</strong>0123 54789<br>
        
        <address>4140 JVL Industrial Park Dr. #102,<br>
        Marietta,<br>
        GA 30066 (Just off I-575)</address>
    </body>
</html>