<?php
session_start();
include("../php/top.php");
?>

<link rel="stylesheet" type="text/css" href="../css/wireframe.css">
<script type="text/javascript" src="../js/pumps.js"></script>
</head>

<body onLoad="loadIt()">
 <header>
   <div class="heading">Bob's Garage</div>
        <div> 
        <br/>
        <strong>Gas Pumps</strong><br/>
        
    
    		</div>
    
<?php
include("../php/nav.php");
?>
		
   <nav class="sideNav"><h2>Side Navigation</h2>
    <ul>
      <li><a  href="#">READ BEFORE ORDERDERING</a></li>
      <li><a href="#">Restoration Album</a></li>
      <li><a href="#">Catalog</a></li>
      <li><a href="#">T & C</a></li>
      <li><a href="#">We're not Amazon</a></li>
      <li><a href="#">You need it?</a></li>
      <li><a href="#">Why, the best?</a></li>
      <li><a href="#">Contact Us</a></li>
    </ul>
    </nav>
  </header>
  
  <main>
  <section class="productContainer">
  <?php
  if(count($_POST)>0)
  {
    if(isset($_POST['Name']))
    {
      $_POST['Name']=filter_var($_POST['Name'],FILTER_SANITIZE_STRING);
      $_SESSION['Name']=$_POST['Name'];
    }
    if(isset($_POST['Email']))
    {
      $_POST['Email']=filter_var($_POST['Email'],FILTER_SANITIZE_STRING);
    $_SESSION['Email']=$_POST['Email'];
      
    }
    if(isset($_POST['textarea']))
    {
      $_POST['textarea']=filter_var($_POST['textarea'],FILTER_SANITIZE_STRING);
     $_POST['textarea']=str_replace(array("\r", "\n"), ' ', $_POST['textarea']);
    $_SESSION['textarea']=$_POST['textarea'];
      
    }
    if(isset($_POST['tel']))
    {
      $_POST['tel']=filter_var($_POST['tel'],FILTER_SANITIZE_STRING);
      $_SESSION['tel']=$_POST['tel'];
    }
    if(strlen($_POST['Name'])>0 && strlen($_POST['Email'])>0 && strlen($_POST['tel'])>0 && strlen($_POST['textarea'])>0)
    {
      redirect("reciept.php");
    }
    
  }
  function redirect($url) { //stackoverflow
    ob_start();
    header('Location: '.$url);
    ob_end_flush();
    die();
}
  function addToCart()
  {
    
	    
	  if(isset($_POST['id']))
	  {
	    if(checkInStore($_POST['id']))
		  {
		    
			  if(checkInCart($_POST['id']))
			  {
		
				  $_SESSION['cart'][$_POST['id']]=1;
			  }
			  else{
			    echo '<script>window.alert("product already in cart.")</script>';
			  }
		  }
		  else{
			    echo '<script>window.alert("Hey Hacker, we don\'t sell this product.")</script>';
			  }
	  }
  }
  
  function removeFromCart($pumpid)
  {
	  if(isset($_SESSION['cart'][$pumpid]))
	  {
	    if($_SESSION['cart'][$pumpid]==1)
	      {
		      $_SESSION['cart'][$pumpid]=0;
	      }
	    else
	      {
			    echo '<script>window.alert("product not in cart.")</script>';
			  }
  }
    else
    {
      echo '<script>window.alert("I don\'t know which pump you\'re taking about.")</script>';
    }
    
  }
  
  function checkInCart($pumpID)
  {
	  foreach($_SESSION['cart'] as $key=>$values)
	  {
	    if($key==$pumpID && $values>0)
	    return false;
	  }
	  return true;
  }
  function checkEmptyCart()
  {
    if(isset($_SESSION['cart']))
    {
      foreach($_SESSION['cart'] as $key=>$value)
      {
        if($value==1)
        return true;
      }
    }
    return false;
  }
  
  function checkInStore($pumpid)
  {
	    $pumpsid=array('GP8002','GB96CSUN','TK39TLSIG');
	  foreach($pumpsid as $value)
	  {
	    if($pumpid==$value)
		  return true;
	  }
	  return false;
  }
  
  if(count($_POST)>0)
  { 
    
    if(!isset($_SESSION['cart']))
    {
      
      $_SESSION['cart']=array('GP8002'=>'0','GB96CSUN'=>'0','TK39TLSIG'=>'0');
    }
    if(isset($_POST['add']))
    {
      addToCart();
    }
    else if(isset($_POST['remove']))
    {
      removeFromCart($_POST['id']);
    }
    else {
    
    }
  }
  
  
  $pumps=array('1'=>array(
      'title'=>'1947 Tokheim Model 39 Cut-Down',
  'description'=>'Interesting example of a post-war Tokheim Cut Down 39 (Tall). Ad glass over the window. Texaco green and red.',
  'id'=>'GP8002',
  'imagePath'=>'../img/GP8002.jpg',
  'Price'=>'6495.00'),
  '2'=>array(
      'title'=>'1938 Gilbert & Barker Model 96C Sunray',
  'description'=>'Beautiful authentic yellow and orange paint scheme highlight this Sunray Gilbert & Barker early electric gas pump. Completely restored inside and out. Correct Gilbarco nozzle. Museum quality. (Rolling Stand Not Included)',
  'id'=>'GB96CSUN',
  'imagePath'=>'../img/GB96CSUN.gif',
  'Price'=>'6395.00'),
  '3'=>array(
      'title'=>'1939 Tokheim Model 39 (Tall) Signal Gasoline
',
  'description'=>'
Impressive size and paint scheme, this Tokheim 39 Tall Signal Gasoline pump signaled that the end of the pre-war, "tall" pump era was coming to a close. This magnificent example with its vintage gas brand is near mint. Completely restored. Correct Tokheim nozzle. Near mint. (Rolling Stand Not Included)',
  'id'=>'TK39TLSIG',
  'imagePath'=>'../img/TK39TLSIG.gif',
  'Price'=>'5495.00'));
  $_SESSION['pumps']=$pumps; 
  foreach($pumps as $pumpKey=>$value)
  {
      echo '<form action="pumps.php" class="prodForm" method="POST">';
      
    echo '<img class="prodDesc" src="'.$value['imagePath'],'">';
    echo '<div class="prod">'.'<h3>'.$value['title'].'</h3><br>'.'<input type="hidden" name="id" value="'.$value['id'].'"/>Product ID:'.$value['id'];
      echo '<br>'.$value['description'];
      echo '<br>Price: $'.$value['Price'];
      if($_SESSION['cart'][$value['id']]>0) // Trev debug: reverse the checking order!
      {
          echo '<br><button  value="'.$pumpKey.'" name="remove">Remove from Cart</button>';
          
      }
      else
      {
          echo '<br><button  value="'.$pumpKey.'"name="add">Add to Cart</button>';
      }
      
      
      
      echo '</div></form><br><br>';
      
  }
  ?></section>
	
  <section >
  
  <form onSubmit="return submitIt()" id="custForm" action="pumps.php" method="POST">
  <fieldset>
  <legend><h2>Student Details</h2></legend>
  <label for="Name">Name:</label><br><input type="text" id="Name" name="Name"/><br>
  <label for="Email">email:</label><br><input type="email" id="Email" name="Email"  /><br>
  <label for="textarea">Address:</label><br><textarea id="textarea" name="textarea" rows="3" columns="5" >
  </textarea><br>
  <label for="tel">Phone No.:</label><br>
  <input type="text" pattern="[\+\(\)0-9x ]+" name="tel" id="tel" onChange="checkPhone()" onKeyUp="northAm()"><span id="northAm"><img src="../img/NANP.png"></span>
  <br>
  <input type="checkbox" name="remember" id="remember"><label for="remember">Remember Me</label><br> 
  <?php
  if(checkEmptyCart())
  {
    echo '<button type="submit" form="custForm">Checkout</button>';
  }
  else {
    echo '<button type="submit" form="custForm" disabled>Checkout</button>';
  }
  ?>
  </fieldset>
  </form></section>
  </main>
<?php
include("../php/bottom.php");
?>