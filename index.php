<?php require "config.php"; ?>
<?php if(isset($_POST['submit'])){
    if(!empty($_POST['url'])){
        $url=$_POST['url'];
        
        $sql=$conn->prepare("INSERT INTO urls(url) VALUES (:url)");
        $sql -> execute([':url' => $url]);
        header('Location: index.php');
    }
}

// Getting the data :
$sql=$conn->query("SELECT * FROM urls");
$sql->execute();
$allData=$sql->fetchAll(PDO::FETCH_OBJ)
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <style>
            body {overflow: hidden;}
            
            .margin {
                margin-top: 200px
            }
        </style>
    </head>
    <body>
       
    <form method='post' class="margin">
        <div class="container">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <form class="card p-2 margin">
                        <div class="input-group">
                        <input type="text" name='url' class="form-control" placeholder="your url">
                        <div class="input-group-append">
                            <button type="submit" name='submit' class="btn btn-success">Shorten</button>
                        </div>
                        </div>
                    </form>
                </div>
           </div>
        </div>
    </form>

    <!-- Generate link -->
    <?php

        $numbers = '0123456789'; // Numbers to choose from
        $uppercaseLetters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'; // Uppercase letters to choose from
        $lowercaseLetters = 'abcdefghijklmnopqrstuvwxyz'; // Lowercase letters to choose from

        $randomChain = '';
        $randomChain .= $numbers[rand(0, 9)]; // First number (0-9)
        $randomChain .= $numbers[rand(0, 9)]; // Second number (0-9)
        $randomChain .= $uppercaseLetters[rand(0, 25)]; // First uppercase letter (A-Z)
        $randomChain .= $uppercaseLetters[rand(0, 25)]; // Second uppercase letter (A-Z)
        $randomChain .= $numbers[rand(0, 9)]; // Third number (0-9)
        $randomChain .= $lowercaseLetters[rand(0, 25)]; // Lowercase letter (a-z)
        $randomChain .= $numbers[rand(0, 9)]; // Fourth number (0-9)

        
    ?>

        <div class="conatiner" id='refresh'>
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <table class="table mt-4">
                        <thead>
                            <tr>
                            <th scope="col">url</th>
                            <th scope="col">shortcut</th>
                            <th scope="col">click average</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($allData as $data): ?>
                            <tr>
                            <td><?php echo $data->url;?></td>
                            <td><a href="http://localhost/shorteningService/<?php echo $data->id;?>" target="_blank">http://localhost/shorteningService/<?php echo $data->id;?></a></td>
                            <td><?php echo $data->click;?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                 </div>
             </div>
        </div>
        <?php if(isset($_POST['submit'])): ?>
        <?php if(empty($_POST['url'])): ?>
            <script>
                alert("Please enter a URL");
            </script>
        <?php endif; ?>
        <?php endif; ?>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" ></script>
        <script>

            $(document).ready(function(){
                $("#refresh").click(function(){
                    setInterval(function(){
                        $('body').load("index.php");
                    }, 5000);
                })
            })
        </script>
        <!-- Core theme JS-->
    </body>
</html>


   