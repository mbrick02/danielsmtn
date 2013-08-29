<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />

  <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame 
       Remove this if you use the .htaccess -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title>addDish</title>
  <meta name="description" content="" />
  <meta name="author" content="bricklerml" />

  <meta name="viewport" content="width=device-width; initial-scale=1.0" />

    <link rel="stylesheet" href="./includes/comon.css" type="text/css" />
  <script type="text/javascript" src="./includes/modernizr-1.7.js"></script>
  <script type="text/javascript" src="./includes/jquery-1.5.1.js"></script>
  <script type="text/javascript" src="./includes/placholder.js"></script>

  <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
  <link rel="shortcut icon" href="/favicon.ico" />
</head>

<body>
  <!--  form called from current Usufruct Invite page request to bring dish -->
  <!-- ? php require_once("../includes/db_connection.php"); ? -->
  <!-- ? php require_once("../includes/function.php"); ? -->
  <!-- ? php require_once("../includes/header.php"); ? -->
  <!-- ? php ????find_selected_page() for navigation ??? ? -->
  <!--  *** note this addDish form is for entering data but createDish puts it in the dbDish -->
  <div id="main">
    <header>
      <h1>addDish</h1>
    </header>
    <nav>
      <!-- php echo navigation($currentDMtnSect, $currentPage) **replace below** -->
      <p><a href="/">Home</a></p>
      
    </nav>

    <div id="main_section">
        <form action="createDish.php" method="post">
            <p><label for ="username">username: </label>
                <input name="username" type="text" id="username" 
                placeholder="placeholder username"/></p>
            <p><label for ="Text1">Field 1 lbl: </label>
                <input name="Text2" type="email" id="Text2" 
                placeholder="Placeholder Text 2"/></p>
            <p><label for ="Text1">Field 1: </label>
                <input name="Text3" type="url" id="Text3" 
                placeholder="Placeholder Text 3"/></p>
                
            <input type="submit" name="submit" value="Create Dish">
            
        </form>
    </div>

    <footer>
     <p>&copy; Copyright  by bricklerml</p>
    </footer>
  </div>
</body>
</html>