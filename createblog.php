<!DOCTYPE html>
<html>
<link rel="stylesheet"
        type="text/css"
        href="readstyle.css" >
    <?php
    session_start();
    $conn = mysqli_connect("localhost", "root", "", "blog");
    
    ?>
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
    <form action="createblog.php" method="post" id="createblog">
      <p id="createblog"> Create your blog!</p>
      
       <input type="text" name="title" placeholder="Title" id="textinput" required >
       <br>
       <!-- <input type="text" name="description" placeholder="short description" required >
       <br>
       <input type="text" name="content" placeholder="content" required>
       <br> -->
      
       

       <textarea name="description" rows="5" cols="40" form="createblog" placeholder="Description" required></textarea>
       <br>
       <textarea name="content" class="textarea" form="createblog" placeholder="Content" required></textarea>
       <br>
       <input type="submit" value = "submit" class="submitbutton">

       
    </form>
    <?php
    if(isset($_REQUEST['title'])){
        if(isset($_REQUEST['description'])){
            if(isset($_REQUEST['content'])){
                $temp1 = $_SESSION['name'];
                $temp2 = $_REQUEST['description'];
                $temp3 = $_REQUEST['content'];
                $temp4 = $_REQUEST['title'];
                $date = date('Y-m-d H:i:s');
                //$conn->query("INSERT INTO `blogs` VALUES(DEFAULT,'$_SESSION['name']','$date','$_REQUEST['description']','$_REQUEST['content']','$_REQUEST['title']')");
                $conn->query("INSERT INTO `blogs` VALUES(DEFAULT,'$temp1','$date','$temp2','$temp3','$temp4')");
                header("Location: http://localhost/index.php");
                exit();

            }
        }

    }
    ?>

</body>


    </html>
