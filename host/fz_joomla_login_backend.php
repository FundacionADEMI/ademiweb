<?php
      $sProtocolUrl = (!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"]!="off")?"https":"http" ;
      if (dirname($_SERVER["REQUEST_URI"]) == "/"){
        $_SERVER["REQUEST_URI"] = "";
      }
      $sUrlAdmin = $sProtocolUrl . "://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["REQUEST_URI"]) . "/administrator/index.php";
      $sUser = $_POST['username'];
      $sPassw = $_POST['passwd'];

      if(!isset($sUser) || !isset($sPassw) || empty($sUser) || empty($sPassw))
	  header("Location: " . $sUrlAdmin);
      
?>
<html>
<head>
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
  <script>


				$.ajax({
					    url: "<?= $sUrlAdmin; ?>", 
					    dataType : "html",
					    success: function(data) {
						      var token = '' ;
						      $(':input', data).each(function(){
							    if ( $(this).val()== 1 ) { 
							        token =  $(this).attr('name');
							    }
						      });

						      $.ajax({
							  url: "<?= $sUrlAdmin; ?>",
							  type: "post",
							  data : "username=<?=$sUser;?>&passwd=<?=$sPassw;?>&lang=&option=com_login&task=login&return=aW5kZXgucGhw&"+token+"=1",
							  success: function(data){
							      location.href = "<?= $sUrlAdmin; ?>";
							  }
						      });
						      
						  

					    },
					    error:function(err){
						console.log(err);
					    }
				});

  </script>
</head>
<body>
</body>
</html>