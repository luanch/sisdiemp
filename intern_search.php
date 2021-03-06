<?php
	if(!isset($_COOKIE["login"]))
		echo("<script>window.location.href='login.html';</script>");
?>
<html>
<head>
<title>Cadastro de Empresa</title>
<link href="diempStyle.css" rel="Stylesheet" type="text/css" />
<meta charset="UTF-8">
<script type="text/javascript" src="jquery-1.10.2.min.js"></script>
		
<script type="text/javascript">
	function fillUnits(){
		$.post("search.php",{what:"units"},function(data){
			$(".campo:nth-of-type(1)").append(data);
		});
	}
	function fillCourses(chosenUnit){
		$.post("search.php",{what:"courses", unit:chosenUnit},function(data){
			$(".campo:nth-of-type(2)").html("<option>Selecione o Curso...</option>");
			$(".campo:nth-of-type(2)").append(data);
		});
	}	
	function showResults(){
		var unidade=$(".campo:nth-of-type(1)").val();
		var curso=$(".campo:nth-of-type(2)").val();	

		if(unidade == "Selecione a Unidade...")
			alert("Necessário a escolha da unidade")
		else if(curso == "Selecione o Curso...")
			alert("Necessário a escolha do curso");
		
		info={what:"intern", unit: unidade, course: curso};
		
		if(unidade!="Selecione a Unidade..." && curso!="Selecione o Curso..."){
			if( $(".stdSearchResult").length ) $(".stdSearchResult").remove();
			$.post("search.php",info,function(data){
				$(".box").append("<div class='stdSearchResult' style='width: 1300px; font-size: initial'><br>"+data+"</div>");
			});
		}
	}
</script>
</head>

<body  onload="fillUnits()">
<center>
	<div class="main">
		<a href="index.php">
		<div class="logo">
			<img id="cefetimg" src="logoCefet.gif" alt="LogoCefet">
		</div>
		</a>
		Sistema Diemp
		<div><a style=" color:white; width: 45px; margin-top:-25px; float: right; display: initial;" href="sair.php">Sair</a></div>
	</div>
	<div class="box">
		<div class="stdIntro">
			<span id="welcome">
				Pesquisa de Estagiários por Curso
			</span>
			<p><p><p>
			<div id="eu">
				<form class="form-wrapper">
					<select onchange="fillCourses(this.value)" class="campo" style="width: 350px; text-align: center" required>
						<option>Selecione a Unidade...</option>
					</select>
					<select class="campo" style="width: 350px; text-align: center" required>
						<option>Selecione o Curso...</option>
					</select>
					<input onclick="showResults()" value="Pesquisar" style="width: 350px; font-size: 16px;" class="submit">
				</form>
			</div><br>
		</div>
	</div>		
</center>
</body>
</html>