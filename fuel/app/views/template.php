<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">    
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo $title;?></title>

    <!-- Bootstrap core CSS -->
    <?php echo Asset::css('bootstrap.css');?>
    <?php echo Asset::css('signin.css');?>
    <?php echo Asset::css('grid.css');?>

    </head>

    <div class="container">
        
        <?php $user = Session::get('user'); //Used to check if user is signed in for footer and logout button ?>
        
        <body>        
                
                <div class="page-header">
                    <h1>CD Collections</h1>
                    <?php if($user != null) : ?>
                        <a class="btn btn-default" href="/signin/logout">Log Out</a>
                    <?php endif;?>
                </div>
                <?php echo $content; ?>
            
        </body>
        
        <footer>
        <?php         
        if ($user != null){ 
            $profile = Auth::get_profile_fields();
            echo sprintf('<p>Curently Logged in: %s %s', $profile['first'], $profile['last']);  
        }      
        ?>
        </footer>
    </div><!-- /.container -->
</html>
