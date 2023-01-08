<!DOCTYPE html>
<html>
    <?php
    session_start();
$conn = mysqli_connect("localhost", "root", "", "blog");
?>
    <head>
        <meta charset="utf-8" />
        <title>MSwDev Blog!</title>
        <link rel="stylesheet"
        type="text/css"
        href="style.css" >
    
    </head>

    <body>
        <header>
            <h1 onclick="refreshfunction()">MSwDev Students Blog!
            <img src = "vuw.png" alt = "vuw" id="img">
            <script>
                function refreshfunction(){
                    window.location.href='http://localhost/index.php'
                }
                </script>

            </h1>
            
        </header>
        
        <main>
            <form action="index.php" method="get" id="searchblogs">
            <input type="text" name="searchvalue" placeholder="search blogs by keyword">
            <input type="submit" value="submit">
            <input type="button" value="clear results" id="clearbutton" onclick="clearsearchfunction()">
                
            <script>
                function clearsearchfunction(){
                    window.location.href='http://localhost/index.php';
                }
    </script>
            

</form>

              
        <?php
        
        if(isset($_REQUEST['searchvalue'])){
            $target = $_REQUEST['searchvalue'];
            
            // $results = $conn->query("SELECT * FROM `blogs` WHERE `title`='$target' OR `username`='$target'");
            $results = $conn->query("SELECT * FROM `blogs` WHERE `description` LIKE '%$target%' OR 
            `title` LIKE '%$target%' OR `username` LIKE '%$target%';");
            
            ?><br><?php
            echo "Search Results:";
            foreach($results as $row){
                $searchid=$row['ID'];
                ?> 
                <?php 
                $targetupper=strtoupper($target);
                 $row2=str_ireplace($target,"<span class='highlight'>$targetupper</span>",$row);
                 ?>
                <ul id="searchresultslist">
                <br><li onclick="viewsearchfunction(<?php echo $searchid?>)"><span> TITLE: <?php echo $row2['title']; ?>&nbsp;&nbsp; DATE: <?php echo $row2['date'];?> &nbsp;&nbsp;AUTHOR: <?php echo $row2['username']?></span>
            <br> DESCRIPTION: <?php echo $row2['description']?></li>
            <script>
                    function viewsearchfunction(ID){
                         window.location.href='http://localhost/readblog.php?ID='+ID;
                    }
                    </script>
            </ul>
                <br>
                <?php

            }
           
        }
        ?>
        <br><br>

        <?php
        $displayall = $conn->query("SELECT * FROM `blogs`");
       ?>
       <p id="t">ALL BLOGS:</p>
       <br>
       <?php
        foreach($displayall as $row){
            $allid=$row['ID'];
            ?><br>
            <ul>
           <li onclick="viewallfunction(<?php echo $allid?>)"> <span> TITLE: <?php echo $row['title']; ?>&nbsp;&nbsp; DATE: <?php echo $row['date'];?> &nbsp;&nbsp;AUTHOR: <?php echo $row['username']?></span>
            <p> DESCRIPTION: <?php echo $row['description']?></p></li>
            <script>
                    function viewallfunction(ID){
                         window.location.href='http://localhost/readblog.php?ID='+ID;
                    }
                    </script>
        </ul>
            <br>
            <?php
        }
            ?>


</main>

    <div id ="sidebar">
        <?php
         
        
        if (isset($_SESSION['name']))
        {
            ?> <?php echo '<div font-size="x-large"> Welcome '.$_SESSION['name'].'</div>';
            ?>
            
            <br>
            <span id="login">Not you? Login here</span>
            <br>
            <br>
            <span id="create"> Create a blog </span>
            <br>
            <br>
            <div id="yourblogs"> Your blogs: </div>
            <?php
            $queryname=$_SESSION['name'];
            $blogs = $conn->query("SELECT * FROM `blogs` WHERE `username`='$queryname'");
            foreach($blogs as $blog){
                ?>
               <?php $id=$blog['ID']; ?>
                <br>
                <span id="view" onclick="viewfunction(<?php echo $id?>)"><?php echo $blog['title'];?> </span>
                <script>
                    function viewfunction(ID){
                         window.location.href='http://localhost/readblog.php?ID='+ID;
                    }
                    </script>
                <br>
                <br>
                <?php
            }
        }
        else{
            ?>
            <div> You must login to view or create your blog entries </div>
            <span id="login">Click to login </span>
            <?php
        }
        ?>
</div>

        


        <script type="module" src="script.js"></script>
    </body>
    </html>






</html>