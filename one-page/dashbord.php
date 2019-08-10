     <?php

     include_once('header.php');



     if( !isset( $_SESSION['userid'] ) ) {
      if( $_SESSION['type'] == '1' ) {
        header('Location: ' . PATH . '/admin');
      }         
      if( $_SESSION['type'] == '2' ) {
        header('Location: ' . PATH . '/gym' );
      }         
      if($_SESSION['type'] == '3'){
        echo '<script type="text/javascript">location.href="login.php"</script>';
      }
      
    }



    ?>





    <?php 


    if(isset($_POST['latitude']) && isset($_POST['longitude'])){
      $_SESSION['latitude'] = $_POST['latitude'];
      $_SESSION['longitude'] = $_POST['longitude'];
    }



    $db=new Database();
    $error='';



    $message = array(null, null);






    $stmnt='select * from subscriber where  email ="'.$_SESSION['userid']. '"';


    $result = $db->display($stmnt);

    if(is_null($result[0]['class_id']))
      echo '<script type="text/javascript">location.href="add-class.php"</script>';





    $stmnt='select * from gym_class where delete_status = 0';


    $result = $db->display($stmnt);





    ?>
    <!-- Main Banner area-->

    <!-- Start feature classes area -->

    <div class="pricing" id="pricing" >
     <h2 class="section-title-default title-bar-high">Choose your Classes</h2>
     <div class="container">
       <div class="row">
        <h3>welcome to site message</h3>

        <a href="setgym.php" class="btn btn-primary">find gym</a>

        <?php

        if($result)
          foreach ($result as $key => $value) {


          }

          ?>



        </div>
      </div>
    </div>
    <!-- end pricing -->

    <!-- End feature product area -->



    <?php

    include_once('footer.php');

    ?>