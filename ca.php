
<html>
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body style ="background-color:skyblue;">

<div class="jumbotron" style ="background-color:skyblue;">
<div class = "row">
	<div class="col-lg-offset-2 col-lg-8">
			<h3><center>Computer Architecture Project - Hazard Detection</center></h3>
			<?php
			$i =0;
$n =0;
$in = 0;
$structural ="";
$branch = "";
			if(isset($_POST['submit']))
			{
				$new = 0;
				foreach($_POST as $key=>$value)
					{
							$n++;
							$array[$i] = $value;
							$i++;
					}
		
				$n = $n/4;
				
				for($loop = 0;$loop<$n-1;$loop++)
				{
						echo '<input type="text" list = "inst" size="6" name = "inst" value = '.$array[$new].'>';
			$new++;
			echo '<input type="text" list = "op1" size="6" name = "one1" placeholder = "RD" value = '.$array[$new].'>';
			$new++;
			echo '<input type="text" list = "op2" name = "two1" size="6" placeholder = "RS - 1" value = '.$array[$new].'>';
			$new++;
			
			echo '<input type="text" list = "op3" name = "three1" size="6" placeholder = "RS - 2" value = '.$array[$new].'><br>';
				$new++;
				}
				echo "<br><button class ='btn btn-danger' onclick ='window.location.href=\"ca.php\"'>Input another snippet</button><br><br>";
			}
			
			
			else{
				
			?>
			<form action="#" method ="POST"> 
			<input type="text" list = "inst" size="6" name = "inst">
			<datalist id='inst'>
			  <option value='ADD'>
			  <option value="SUB">
			  <option value="OR">
			  <option value="AND">
			  <option value="LD">
			  <option value="SD">
			  <option value='BNEZ'>
			  <option value='BEZ'>
			</datalist>
			<input type="text" list = "op1" size="6" name = "one1" placeholder = "RD" >
			<datalist id='op1'>
			  <option value='R1'>
			  <option value="R2">
			  <option value="R3">
			  <option value="R4">
			  <option value="R5">
			  <option value="R6">
			  <option value="R7">
			  <option value="R8">
			  <option value="R9">
			  <option value="R10">
			  <option value="R11">
			  <option value="R12">
				<option value="R13">
				<option value="R14">
				<option value="R15">
				<option value="R16">
				<option value="R17">
				<option value="R18">
				<option value="R19">
				<option value="R20">
				<option value="R21">
				<option value="R22">
				<option value="R23">
				<option value="R24">
				<option value="R25">
				<option value="R26">
				<option value="R27">
				<option value="R28">
				<option value="R29">
				<option value="R30">
				<option value="R31">
			
			</datalist>
			<input type="text" list = "op2" name = "two1" size="6" placeholder = "RS - 1">
			<input type="text" list = "op3" name = "three1" size="6" placeholder = "RS - 2">
			<button class ="btn btn-danger" onclick = "return okay();"> + </button>
			<div id="here">
			</div>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type ="submit" name ="submit" class="btn btn-success">
			
		<br><br><br><br><br>
		<?php
			}
			?>
		<table class="table table-striped table-bordered table-hover" >
			<tr>
			<th class ="text-center" style ="color:blue;"><i>Data Hazards</i></th>
		
			<th class ="text-center" style ="color:blue;"><i>Solutions</i></th>
			</tr>
			
			
			<?php

$i =0;
$n =0;
$in = 0;
$structural ="";
$branch = "";
if(isset($_POST['submit']))
{
	foreach($_POST as $key=>$value)
{
		$n ++;
		$array[$i] = $value;
		$i++;
}
		
		$n = $n/4;
		
		$i =0;
		for($j = 0;$j<$n -1;$j++)
		{
			if($j!=0)
			{	//Checking for RAW data hazards
		
				if($j==1)
				{
					
					if($array[$i+2] == $array[$i-3])
					{
						echo "<tr><td class ='text-center' style ='color:blue;'>RAW -  Lines:".$j." , ".($j - 1)." Register: ".$array[$i+2]."</td>";	  
						if($array[$i-4]=="LD" and ($array[$i]!="LD" or $array[$i]!="SD"))
						{

							echo "<td class ='text-center' style ='color:blue;'>Load delay ( 1 Stall) then Forwarding</td></tr>";
						}
						else
						{

							echo "<td class ='text-center' style ='color:blue;'>Forwarding</td></tr>";

						}
					}
					
					if($array[$i+3] == $array[$i-3])
					{
						echo "<tr><td class ='text-center' style ='color:blue;'>RAW -  Lines:".$j." , ".($j - 1)." Register: ".$array[$i+3]."</td>";  
						if($array[$i-4]=="LD" and ($array[$i]!="LD" or $array[$i]!="SD"))
						{

							echo "<td class ='text-center' style ='color:blue;'>Load delay ( 1 Stall) then Forwarding</td></tr>";
						}
						else
						{

							echo "<td class ='text-center' style ='color:blue;'>Forwarding</td></tr>";

						}
					}
					if(($array[$i]!='LD' and $array[$i]!='SD') and ($array[$i-4] == 'LD') and ($array[$i+2]!=$array[$i-3] and $array[$i+3]!=$array[$i-3]))
					{
						
						$structural .= "<tr><td class ='text-center' style ='color:blue;'>Lines:".$j." , ".($j - 1)." Both the Instructions are writing on the same resgister file on one clock cycle.</td><td class ='text-center' style ='color:blue;'>Use multiple write ports or Stall for 1 cycle.</td></tr>";
					}
					if($array[$i]=='BEZ')
				{
					
					$branch .= "<tr><td class ='text-center' style ='color:blue;'>Line:".$j."  If both the source registers are equal then branch will occur.</td><td class ='text-center' style ='color:blue;'>Multiple solutions exists but we are using a delayed branch here, if the branch is taken then the delay slot will be turned into NOP operation.</td></tr>";
				}
				if($array[$i]=='BNEZ')
				{
					
					$branch .= "<tr><td class ='text-center' style ='color:blue;'>Line:".$j."  If both the source registers are not equal then branch will occur.</td><td class ='text-center' style ='color:blue;'>Multiple solutions exists but we are using a delayed branch here, if the branch is taken then the delay slot will be turned into NOP operation.</td></tr>";
				}
					
				}
				if($j>1)
				{
					
					if($array[$i+2] == $array[$i-7])
					{
						echo "<tr><td class ='text-center' style ='color:blue;'>RAW -  Lines:".$j." , ".($j - 2)." Register: ".$array[$i+2]."</td>";  
						if($array[$i-8]=="LD" and ($array[$i]!="LD" or $array[$i]!="SD"))
						{
							echo "<td class ='text-center' style ='color:blue;'>Forwarding</td></tr>";
						}
						else
						{
							echo "<td class ='text-center' style ='color:blue;'>Nothing Special required</td></tr>";

						}
					}
					
					if($array[$i+3] == $array[$i-7])
					{
						echo "<tr><td class ='text-center' style ='color:blue;'>RAW -  Lines:".$j." , ".($j - 2)." Register: ".$array[$i+3]."</td>";  
						if($array[$i-8]=="LD" and ($array[$i]!="LD" or $array[$i]!="SD"))
						{
							echo "<td class ='text-center' style ='color:blue;'>Forwarding</td></tr>";
						}
						else
						{
							echo "<td class ='text-center' style ='color:blue;'>Nothing Special required</td></tr>";

						}
					}
					if($array[$i+2] == $array[$i-3])
					{
						echo "<tr><td class ='text-center' style ='color:blue;'>RAW -  Lines:".$j." , ".($j - 1)." Register: ".$array[$i+2]."</td>";  
						if($array[$i-4]=="LD" and ($array[$i]!="LD" or $array[$i]!="SD"))
						{
							echo "<td class ='text-center' style ='color:blue;'>Load delay ( 1 Stall) then Forwarding</td></tr>";
						}
						else
						{
							echo "<td class ='text-center' style ='color:blue;'>Forwarding</td></tr>";

						}
					}
					if($array[$i+3] == $array[$i-3])
					{
						echo "<tr><td class ='text-center' style ='color:blue;'>RAW -  Lines:".$j." , ".($j - 1)." Register: ".$array[$i+3]."</td>";  
						if($array[$i-4]=="LD" and ($array[$i]!="LD" or $array[$i]!="SD"))
						{
							echo "<td class ='text-center' style ='color:blue;'>Load delay ( 1 Stall) then Forwarding</td></tr>";
						}
						else
						{
							echo "<td class ='text-center' style ='color:blue;'>Forwarding</td></tr>";

						}
					}
					if(($array[$i]!='LD' and $array[$i]!='SD') and ($array[$i-4] == 'LD') and ($array[$i+2]!=$array[$i-3] and $array[$i+3]!=$array[$i-3]))
					{
						
						$structural .= "<tr><td class ='text-center' style ='color:blue;'>Lines:".$j." , ".($j - 1)." Both the Instructions are writing on the same resgister file on one clock cycle.</td><td class ='text-center' style ='color:blue;'>Use multiple write ports or Stall for 1 cycle.</td></tr>";
					}
					if($array[$i]=='BEZ')
				{
					
					$branch .= "<tr><td class ='text-center' style ='color:blue;'>Line:".$j."If both the source registers are equal then branch will occur.</td><td class ='text-center' style ='color:blue;'>Multiple solutions exists but we are using a delayed branch here, if the branch is taken then the delay slot will be turned into NOP operation.</td></tr>";
				}
				if($array[$i]=='BNEZ')
				{
					
					$branch .= "<tr><td class ='text-center' style ='color:blue;'>Line:".$j."If both the source registers are not equal then branch will occur.</td><td class ='text-center' style ='color:blue;'>Multiple solutions exists but we are using a delayed branch here, if the branch is taken then the delay slot will be turned into NOP operation.</td></tr>";
				}
				}
				
				
			}
			else{
				if($array[$i]=='BEZ')
				{
					
					$branch .= "<tr><td class ='text-center' style ='color:blue;'>Line:".$j."  If both the source registers are equal then branch will occur.</td><td class ='text-center' style ='color:blue;'>Multiple solutions exists but we are using a delayed branch here, if the branch is taken then the delay slot will be turned into NOP operation.</td></tr>";
				}
				if($array[$i]=='BNEZ')
				{
					
					$branch .= "<tr><td class ='text-center' style ='color:blue;'>Line:".$j."  If both the source registers are not equal then branch will occur.</td><td class ='text-center' style ='color:blue;'>Multiple solutions exists but we are using a delayed branch here, if the branch is taken then the delay slot will be turned into NOP operation.</td></tr>";
				}
			}
			$i = $i +4;
		}
		echo '
		<tr>
			<th class ="text-center" style ="color:blue;"><i>Structual Hazards</i></th>
		
			<th class ="text-center" style ="color:blue;"><i>Solutions</i></th>
			</tr>
		';
		
		echo $structural;
		echo '
		<tr>
			<th class ="text-center" style ="color:blue;"><i>Control Hazards</i></th>
		
			<th class ="text-center" style ="color:blue;"><i>Solutions</i></th>
			</tr>
		';
		echo $branch;
	
}

?>



			
			
			</tr>
			
		</table>
			
			
		
	</div>
</div>
</div>
</body>
</html>

<script>
var i = 2;
function okay()
{
	
	
	var my = '<input type="text" list = "inst" size="6" name = "inst'+i+'"><datalist id="inst"><option value="ADD"><option value="SUB"><option value="OR"><option value="AND"><option value="LD"><option value="SD"></datalist>&nbsp;<input type="text" list = "op1" size="6" name = "one'+i+'" placeholder = "RD"><datalist id="op1"><option value="R1"><option value="R2"><option value="R3"><option value="R4"><option value="R5"><option value="R6"><option value="R7"><option value="R8"><option value="R9"><option value="R10"><option value="R11"><option value="R12"><option value="R13"><option value="R14"><option value="R15"><option value="R16"><option value="R17"><option value="R18"><option value="R19"><option value="R20"><option value="R21"><option value="R22"><option value="R23"><option value="R24"><option value="R25"><option value="R26"><option value="R27"><option value="R28"><option value="R29"><option value="R30"><option value="R31"></datalist>&nbsp;<input type="text" name = "two'+i+'" size="6" placeholder = "RS - 1">&nbsp;<input type="text" list = "op3" name = "three'+i+'" size="6" placeholder = "RS - 2">&nbsp;<button class ="btn btn-danger" onclick = "return okay();"> + </button><div id="here"></div>';
	
	$("#here").append(my);
	i++;
	return false;
	
	
}
</script>
