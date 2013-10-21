<?php
    $state=$_GET['name'];
    if ($state=="")
    	    $state="USA";
    $stateNo = 0;
    $file = fopen("StateInfo.csv","r");
    while (!feof($file) ) {
        $line_of_text = fgetcsv($file);  
    }

    while (trim($line_of_text[$stateNo])!=trim($state))
    	    $stateNo = $stateNo +21;
    fclose($file);
?>
 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>State Information</title>
        <link rel="stylesheet" href="accordionMenu.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <link rel="stylesheet" href="Style.css" />
        <script>
            $(function() {
                $("#accordion").accordion();
            });
        </script>
    </head>
 
    <body>

        <h2><?php echo $state ?><img src="flags/<?php echo $state ?>.gif" width="20%"/></h2>
        <div id="accordion">
        <h3>Demographics</h3>
        <div>
            <p>Population: <?php echo $line_of_text[$stateNo+11] ?><br>
               Obesity rate: <?php echo $line_of_text[$stateNo+6] ?><br>
               State ranking for<br>math/science education: <?php echo $line_of_text[$stateNo+14] ?><br>
               Average hourly wage: <?php echo $line_of_text[$stateNo+13] ?>
            </p>
        </div>
 
        <h3>Geography</h3>
        <div>
                <p>Area: <?php echo $line_of_text[$stateNo+12] ?><br>
               Capital city: <?php echo $line_of_text[$stateNo+7] ?><br>
               Largest city: <?php echo $line_of_text[$stateNo+8] ?><br>
               Average annual rainfall: <?php echo $line_of_text[$stateNo+5] ?><br>
            <?php if ($state == "USA") echo "<a href=\"http://form-filledgraph.comze.com/HW3.html\">Dominant Foreign Language</a>\n" ?>
                
</p>
        </div>
  
        <h3>Places to Go and See</h3>
        <div>
                <p>Top college: <?php echo $line_of_text[$stateNo+10] ?><br>
               Top three attractions:<br>
               &#8226 <?php echo $line_of_text[$stateNo+2] ?><br>
               &#8226 <?php echo $line_of_text[$stateNo+3] ?><br>
               &#8226 <?php echo $line_of_text[$stateNo+4] ?></p>
        </div>
  
        <h3>Sports</h3>
        <div>
                <p>NFL: <?php echo $line_of_text[$stateNo+15] ?><br>
                   MLB: <?php echo $line_of_text[$stateNo+16] ?><br>
                   NBA: <?php echo $line_of_text[$stateNo+17] ?><br>
               NHL: <?php echo $line_of_text[$stateNo+18] ?></p>
        </div>
  
        <h3>Entertainment</h3>
        <div>
                <p>Movie star from this state: <?php echo $line_of_text[$stateNo+19] ?><br>
               Signature song: <?php echo $line_of_text[$stateNo+9] ?></p>
        </div>
  
        <h3>Fun Facts</h3>
        <div>
                <p>Signature food: <?php echo $line_of_text[$stateNo+1] ?><br>
               Pop vs. soda vs. Coke: <?php echo $line_of_text[$stateNo+20] ?></p>
        </div>
    </body>
</html>
