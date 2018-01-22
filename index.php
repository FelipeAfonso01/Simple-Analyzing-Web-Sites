<style>
	.result{
		display:none;	
	}	
</style>
<?php
	if(isset($_POST['salvar'])){
		$url = $_POST['url'];
		require('simple_html_dom.php');
		$html = file_get_html("$url");
		$title = $html->find('title');
		$cont_external_links = 0;
		$cont_internal_links = 0;
		foreach($html->find('a') as $a){
			$regex = $regex = "#(https?|ftp)://.#";
			if(preg_match_all($regex, $a, $matches)){
				foreach($matches as $match){
					$cont_external_links +=1;
			   }
			}else{
				$cont_internal_links +=1;
			}	
		}
		echo '<style>.result{display:block}</style>';
	}

?>

<!DOCTYPE html>
	<form method="POST" action="">
		<center>
			<div style="background-color:#eee; margin-left: 200px; margin-right: 200px;">
				<h4>Enter URL</h4>
				<input type="text" name="url" style="height:30px;width:300px"><br><br>
				<input type="submit" name="salvar" value="GO!" style="width:80px">
			</div>
		</center>
	</form>
	<div class="result">
		<center>
			<hr>
			<h2>Result</h2>
			<table border="1" text-align="center">
				<tr>
					<td>Page Title</td><td><?= @$title[0]->plaintext ?></td>
				</tr>
				<tr>
					<td>External Links</td><td><?= @$cont_external_links ?></td>
				</tr>
				<tr>
					<td>Internal Links</td><td><?= @$cont_internal_links ?></td>
				</tr>
			</table>
		<center>
	</div>
</html>