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
    } else {

      echo '<script type="text/javascript">location.href="setgym.php"</script>';

    }



    $db=new Database();
    $error='';



    $message = array(null, null);


    if (isset( $_POST['did'])) {
      var_dump($_POST);


      $stmnt  = 'insert into attendance (gym_id ,sub_id,at_date ,gym_key )
      values(:gym_id,:sub_id,:at_date ,:gym_key )';
      $params = array(
        ':gym_id' => $_POST['did'],
        ':sub_id' => $_SESSION['userid0'],
        ':at_date ' => $_POST['date'],
        ':gym_key' => rand(1000,10000) 
      );

      var_dump( $params);
      if ($db->execute_query($stmnt, $params)) {
        $message = '<div class="alert alert-success">Successfully addedn!</div>';

     //   echo '<script type="text/javascript">location.href="dashbord.php"</script>';

      } else {
        $message = '<div class="alert alert-danger">something wrong</div>';
      }


    }











    $stmnt='select * from gym where  latitude ="'.$_SESSION['longitude']. '" AND   longitude ="'.$_SESSION['latitude']. '" ORDER BY date DESC LIMIT 1';


    $result = $db->display($stmnt);








    ?>
    <!-- Main Banner area-->

    <!-- Start feature classes area -->

    <div class="pricing" id="pricing" >
      <h2 class="section-title-default title-bar-high"></h2>
      <div class="container">
        <div class="row"> 


          <style type="text/css">
          .panel-body p {
            color: black;
          }
        </style>
        <?php

        if($result){
          ?>



          <div class="panel">

            <div class="panel-head">
              <h3><?php echo $result[0]["gym_name"]; ?></h3>
            </div>

            <div class="panel-body">

              <div class="col-md-12">
                <div class="col-sm-4">
                  <strong>gym licenseid</strong>
                </div>
                <div class="col-sm-8">
                  <p><?php echo $result[0]["gym_licenseid"]; ?></p>
                </div>
              </div>




              <div class="col-md-12">
                <div class="col-sm-4">
                  <strong>gym name</strong>
                </div>
                <div class="col-sm-8">
                  <p><?php echo $result[0]["gym_name"]; ?></p>
                </div>
              </div>





              <div class="col-md-12">
                <div class="col-sm-4">
                  <strong>gym  owner</strong>
                </div>
                <div class="col-sm-8">
                  <p><?php echo $result[0]["gym_owner"]; ?></p>
                </div>
              </div>




              <div class="col-md-12">
                <div class="col-sm-4">
                  <strong>gym  email</strong>
                </div>
                <div class="col-sm-8">
                  <p><?php echo $result[0]["gym_email"]; ?></p>
                </div>
              </div>




              <div class="col-md-12">
                <div class="col-sm-4">
                  <strong>gym  mobile</strong>
                </div>
                <div class="col-sm-8">
                  <p><?php echo $result[0]["mobile"]; ?></p>
                </div>
              </div>


              <div class="col-md-12">
                <div class="col-sm-4">
                  <strong>Cash / month</strong>
                </div>
                <div class="col-sm-8">
                  <p style="color: red; font-size: 30px;"><?php echo $result[0]["amount"]; ?> INR</p>
                </div>
              </div>

              <form method="post"   action="">

                <div class="col-md-12">
                  <div class="col-sm-4">
                    <strong>Date</strong>
                  </div>
                  <div class="col-sm-8">
                    <input type="date" name="date" required="" id="datefield"  format="YYYY/MM/DD"  min='<?php
                    echo date('Y-m-d');
                    ?>' max='2018-04-19'>
                  </div>
                </div>





                <br>


                <br>



                <div class="col-md-12">
                  <div class="col-sm-4"> 
                  </div>
                  <div class="col-sm-8">

                    <input type="hidden" name="did" value="<?php echo $result[0]["id"]; ?>">
                    <button style="margin-top: 20px;" class="btn btn-primary btn-lg" >book now</button>

                  </div>
                </div>



              </form>


            </div>

          </div>




          <?php
        }

        ?>


      </script>

    </div>
  </div>
</div>
<!-- end pricing -->

<!-- End feature product area -->



<?php

include_once('footer.php');

?>