<?php
session_start();
  $input = $_FILES["input"];
  $btn = $_POST["extract"];
  $filter = $_POST["filter"];
  $folderLocation = "exImage";
  $_SESSION["file"] = $input["name"];
  $session = isset($_SESSION["file"]) ? $_SESSION["file"] : " ";
  $mailNum = $fake = 0;
  $correctCount =0;
  $arr = [];
  $result;
  class CorrectMail{
    public $count =0;
    public function google($mail, $provider){
    
    $list = ($provider === "all" ? "@gmail.com" : $provider);
      if(strripos($mail, $provider) !== false) {
        $this->count++;// to get the number of correct email
         return $mail;
      }
  
        return false;
      
    }
    public function getCount(){
  //return the number of correct email
       return $this->count;
    }
  }
  
?>
<html>
  <head>
    <title>Email Extractor</title>
    <meta name="author" content="Ajala John (Johnnykay)">
    <meta name="description" content="Streamline your email list by filtering
    out gmail, yahoo, or outlook addresses with EmailExtract.">
    <meta name="keywords" content="emailextract, extractingo, email extractor">
    <meta name="color-scheme" content="light">
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
    integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css"
    integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./mail.css">
  </head>
  <body>
      <nav class="nav">
        <h2>Email<span>Extract</span></h2>
        
        <span class="bx bx-moon" id="mode"></span>
      </nav>
      <main>
        <section class="formField">
          <div class="content">
    <h2><span class="bx bx-upload"></span>  Upload file to extract email addresses only</h2>
    <p>This tool helps you to filter email addresses(like gmail.com) from domain-specific email and other
    wrong emails</p>
    <ol>
      <li>Upoad your email file i.e (.csv or .txt)</li>
      <li>The tool processes and separates email as filtered.</li>
      <li>Copy real email address for easy use</li>
    </ol>
  </div>
<form action="" method="POST" enctype="multipart/form-data">
  <span>Upload your email file here: </span>
  <div class="wrap">
  <input type="file" accept=".txt,.csv" id="file" name="input" required="true"
  value = "<?php echo $session;?>">
  </div>
  <div class="filter">
  <label for="filter">Filter: </label>
  <select name="filter">
    <option value="@gmail.com">Gmail</option>
    <option value="@yahoo.com">Yahoo</option>
    <option value="@outlook.com">Outlook</option>
  </select>
  <button name="extract">Extract</button>
  </div>
  <?php
  //button onclick
  if(isset($btn)){
    $class = new CorrectMail();
    
    //move uploaded file to folder
   move_uploaded_file($_FILES["input"]["tmp_name"], "$folderLocation/".basename($_FILES["input"]["name"]));
   //open file uploaded with more than one line of emails
   $file = fopen("$folderLocation/".basename($input["name"]), "r");
   
   //csv file formats
   $csvMimes = array('application/x-csv', 'text/csv', 'application/csv');
// check and return query according to file format
$row = (in_array($_FILES['input']['type'],$csvMimes)) ? fgetcsv($file) : fgets($file);
   ?>
   <div class="wrapChunk" id="wrapChunk">

   <textarea class="chunk" id="chunk">
   <?php
   while($row !== false){
    $mailNum++;

    $email = is_array($row) ? $row[0] : $row; // Handle CSV or TXT
    $result = $class->google($email, $filter);

    if ($result !== false) {
        echo htmlspecialchars($result);
        
    }

    $row = (in_array($_FILES['input']['type'], $csvMimes)) ? fgetcsv($file) : fgets($file);
   }

   fclose($file);

   ?>
  </textarea>
 <h2 id="counted">Chunk (<?= $filter; ?> : <?= $class->getCount(); //the numbers of correct email?>) </h2>
  
 <button type="button" class="copy" name="copy" id="copy" onclick="copyToClipboard()">Copy Chunks</button>
  </div>
  <?php
  echo "<script>alert($mailNum); </script>";
  }
  ?>

</form>
</section>
<section class="contact">
  <?php require_once("./contact.php"); ?>
</section>

</main>
<footer>
  <!-- footer top -->
  
  <div class="top">
  <div class="nav">
      <h2>Email<span>Extract</span></h2>
  </div>
  <div class="socials">
    <a href="https://www.facebook.com/johnnykay123"><span class="bx bxl-facebook"></span></a>
    <a href="https://wa.me/09057326602"><span class="bx bxl-whatsapp"></span></a>
    <a href="mailto:kayjohnny611@gmail.com"><span class="bx bxl-gmail"></span></a>
    <a href="https://vm.tiktok.com/ZMBtbUMdf/"><span class="bx bxl-tiktok"></span></a>
  </div>
  </div>

  <div class="copyRight" style="text-align:center;">
   <cite> &copy; 2025 All Rights Reserved. Developed by <strong>Johnnykay</strong>
   </cite>
  </div>
</footer>
<script src="./mail.js"></script>
<script>

</script>
</body>
</html>