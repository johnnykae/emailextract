<?php 
   if(isset($_POST["contactBtn"])){
     $name = $_POST["name"];
     $email = $_POST["email"];
     $msg = $_POST["msg"];
     if(empty($name) || empty($email) || empty($msg)){
       return false;
     }
    
     $file = fopen("mail.json", "a");
     $message = [
       "Name: " => "$name",
       "Email: " => "$email",
       "Message" => "$msg"
     ];
     $json = json_encode($message);
     fwrite($file, $json."\n");
     $success = "Thanks for your feedback!. We will contact you soon if
     possible.";
     fclose($file);
   }
?>
   
    <form action="" method="post">
      <p><?= $success; ?></p>
      <h2>Send feedback</h2>
  <div class="grps">
      <div class="grp">
        <label for="name">Full Name</label>
        <input type="text" required name="name" id="name">
      </div>
      <div class="grp">
        <label for="name">Email</label>
        <input type="email" required name="email" id="email">
      </div>
  </div>
    <div class="grp">
        <label for="msg">Message</label>
        <textarea required name="msg" rows="10" id="msg"></textarea>
      </div>
      <input type="submit" value="Send" id="send" name="contactBtn">
    </form>
  <script>
    document.getElementById("send").onclick = ()=>{
      document.querySelector(".contact p").style.display = "block";
    }
  </script>