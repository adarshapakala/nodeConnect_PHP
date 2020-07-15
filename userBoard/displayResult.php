<?php
include('..\registerUser\server.php');
include ('simple_html_dom.php');

$result ='';

$resultHTML =file_get_html($_SESSION['reportpath']);
$allTable =$resultHTML->find('table');
$resultTable = $allTable[1]->find('tr');
$resultString = explode(":", $resultTable[1]);
?>


<!DOCTYPE html>
<html>
<head>
	<title>Result</title>
</head>
<body>
	<form method="post" action="displayResult.php">
		<?php if ($resultString[0] ='Result' and $resultString[1] ='Passed'): ?>
		
			<h2> The soulution submitted passed the unit tests </h2>
			<button type="submit" class="btn" name="continueToNextQ">Continue to Next Questions</button	>
		<?php else:?>
			<h2> The soulution submitted filed the unit test </h2>
			<button type="submit" class="btn" name="retrySameQ">Re-attempt Question</button>
		
		<?php endif ?>
	</form>


</body>
</html>