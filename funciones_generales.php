<?php 
	function CalculaEdad2($fecha) {
		list($Y,$m,$d) = explode("-",$fecha);
		$edad = ( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
		return $edad;
	}

	function se_otro($valor){
		if ($valor=="M") {
			return "Masculino";
		} else {
			return "Femenino";
		}

	} 

	function se($valor){
		if ($valor=="M") {
			echo "Masculino";
		} else {
			echo "Femenino";
		}

	} 

	function calculo($conexion, $tipo_club){
		if ($tipo_club==3) {
			$tclub = "id_club_conquis";
			$tmiembro = "tipo_miembro_conquis";
		} else if ($tipo_club==4) {
			$tclub = "id_club_conquis";
			$tmiembro = "tipo_miembro_conquis";
		} else if ($tipo_club==5) {
			$tclub = "id_club_aventureros";
			$tmiembro = "tipo_miembro_aventureros";
		}
		$sql = "SELECT fecha_nacimiento, $tmiembro, sexo, bautismo FROM miembros as m, clubes as c WHERE m.$tclub=c.id_club";
		$result = mysqli_query($conexion, $sql);
		//echo mysqli_error($conexion);

		$row = array(
			'bebes'=>0,
			'aventureros'=>0,
			'conquistadores'=>0,
			'guiasmayores'=>0,

			'director'=>0,
			'subirector'=>0,
			'miembro'=>0,
			'economo'=>0,
			'representante'=>0,

			'hombres'=>0,
			'mujeres'=>0,

			'bautizado'=>0,
			'nobautizado'=>0
		);

		while($re = mysqli_fetch_assoc($result)){
			$fecha = $re['fecha_nacimiento'];
			$sexo = $re['sexo'];
			$bautismo = $re['bautismo'];
			$tipo_miembro = $re[$tmiembro];
			$edad = CalculaEdad2($fecha);

			if ($edad>=4 AND $edad<=9) {
				$row['aventureros']++;
			} else if ($edad>=10 AND $edad<=15) {
				$row['conquistadores']++;
			} else if ($edad>=16) {
				$row['guiasmayores']++;
			} else {
				$row['bebes']++;
			}

			if ($sexo=="F") {
				$row["mujeres"]++;
			} else if ($sexo=="M") {
				$row["hombres"]++;
			}

			if ($bautismo=="1") {
				$row["bautizado"]++;
			} else if ($bautismo=="0") {
				$row["nobautizado"]++;
			}
			

			if($tipo_miembro==1){
				$row['director']++;
			}else if($tipo_miembro==2){
				$row['subdirector']++;
			}else if($tipo_miembro==3){
				$row['subdirector']++;
			}else if($tipo_miembro==4){
				$row['miembro']++;
			}else if($tipo_miembro==5){
				$row['economo']++;
			} else if($tipo_miembro==6){
				$row["representante"]++;
			}



		}
		
		return $row;

  	}

?>