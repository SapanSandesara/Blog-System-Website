<!DOCTYPE html>
<html>
    
    <?php
    session_start();
    $conn = mysqli_connect("localhost", "root", "", "blog");
    ?>
<head>
        <meta charset="utf-8" />
        <link rel="stylesheet"
        type="text/css"
        href="readstyle.css" >
    
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
            <?php
            $id=$_GET['ID'];
            $result = $conn->query("SELECT * FROM `blogs` WHERE `ID`='$id'");
            foreach($result as $row){
                // https://www.php.net/nl2br
                $content =$row['content'];
                echo '<p> Date posted:'.$row['date'].'</p>';
                echo '<p style="font-weight:bold;"> Author: '.$row['username'].'</p>';
                ?> <?php
                echo '<p style="font-weight:bold;"> Title: '.$row['title'].'</p>';
                ?><?php
                echo '<p style="font-weight:bold;"> Description: '.$row['description'].'</p>';
                ?><?php
                echo '<p style="font-size:x-large;">'.nl2br($content).'</p>';
                
            }

           
?>
    <?php 
   
    if(isset($_SESSION['name'])){
        ?>
    <div id="comments">
    <form method="post" id="readblog">
    <textarea name="commentbox" rows="5" cols="40" form="readblog"> Add a comment</textarea>
       <br>  
       <input type="submit" value = "submit">
        </form> 

        <?php
        
        if(isset($_REQUEST['commentbox'])){
            
            $name=$_SESSION['name'];
            $newcomment=$_REQUEST['commentbox'];
            $date=date('Y-m-d H:i:s');
            $conn->query("INSERT INTO `comments` VALUES(DEFAULT,'$name',$id,'$newcomment','$date')");
        }

        $result2 = $conn->query("SELECT * FROM `comments` WHERE `blogid`='$id'");
        ?>
        <p id="commenttag"> Comments:</p>
       
        <?php
        foreach($result2 as $row2){
            ?>
            <br>
             <div id="listcomments">
            <?php echo '<p style="font-weight:bold;"> User: '.$row2['username'].' Posted on: '.$row2['Date'].'</p>';
            ?>
            <?php echo '<p>'.$row2['comment'].'</p>';
            ?>
            
             </div>
             <?php
        }
        
        ?>
       
    <?php
}
else{
    echo 'login to view or add comments';
}

?>
</main>
</body>

</html>