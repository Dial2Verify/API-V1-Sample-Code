<!--  
  @author Dial2Verify Labs, India
  @copyright 2013
  Built on Dial2Verify API V1 ( http://kb.dial2verify.in/?q=5 )
-->

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Phone Verification by Dial2Verify ( www.dial2verify.com )</title>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript">
	var attempt=1;
		$(document).ready(function(){
			$("#enter_number").submit(function(e) {
			 e.preventDefault();
			 initiateDial2Verify();
			});
		});
		
		function initiateDial2Verify() {
			showCodeForm(1); 
			checkStatus();
		}
		
		function showCodeForm(code) {
			$("#dial2verify").fadeIn();
			$("#enter_number").fadeOut();
			$("#waiting_msg").text("Waiting for missed call from "+$("#phone_number").val());
		}
		
		function checkStatus() {
			$.post("status.php", { phone_number : $("#phone_number").val() }, 
				   function(data) { updateStatus(data.status); }, "json");
		}
		


		function updateStatus(current) {
                        attempt =attempt+1;
                        if ( attempt == 15 ) { TimeoutCheck(); }
                        else
                        if (current === "unverified") {
				$("#status").text("Approx waiting time left: "+(15-attempt)+" Seconds.");
                           
				setTimeout(checkStatus, 1000);
			}                        
                         else if (current === "Verified")
                        {
				success(); 
			}

		}
			
		function success() {
			$("#status").text("Verified!");
                       
		}

		function TimeoutCheck() {
			$("#status").text("Verification Failed!");
		}

	</script>
</head>
<body>
	<form id="enter_number">
		<p>Enter your phone number:</p>
		<p><input type="text" name="phone_number" id="phone_number" /></p>
		<p><input type="submit" name="submit" value="Verify" /></p>
	</form>
	
	<div id="dial2verify" style="display: none;">
		<p id="waiting_msg"></p>
		<p><strong id="status">Loading ..</strong></p>
	</div>
</body>
</html>

