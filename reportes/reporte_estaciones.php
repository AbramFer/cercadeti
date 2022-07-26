<?php
    include_once("../conexion/aut_config.inc.php");
    include_once("../funciones_generales.php");
    //include_once("../componentes_mios/fpdf184/fpdf.php");
    include_once("../componentes_mios/fpdf184/rotation.php");
    $conexion = mysqli_connect("$sql_host", "$sql_usuario", "$sql_pass", "$sql_db");

    //include("../configuracion.php");

    /*

    $url = explode("?",$_SERVER['HTTP_REFERER']);
    $pag_referida=$url[0];
    $redir=$pag_referida;
    // chequear si se llama directo al script.
    if ($_SERVER['HTTP_REFERER'] == "")
    {
    die(header ("Location:  ../index.php?error_login=7"));
    //die ("Error cod.:1 - Acceso incorrecto!");
    exit;
    }

    */
    
    



    $pdf = new PDF_Rotate("L", "mm", "A4");
    //$pdf=new FPDF("L", "mm", "A4");
    

    $sql2 = "SELECT * FROM estaciones ORDER BY id_estaciones";
    $query2 = mysqli_query($conexion, $sql2);

    while ($row2 = mysqli_fetch_assoc($query2)) {
        $id_estaciones = $row2["id_estaciones"];
        $nombre = $row2["nombre"];



        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        
        //$pdf->SetFillColor(200,220,255); //AZUL
        $pdf->SetFillColor(200,200,200);//GRIS
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0,0,0);
        $pdf->SetLineWidth(.1);
        
        $pdf->SetFont('Arial','B',10);
        $pdf->SetLeftMargin(15);
        
        $pdf->SetY(15);
        $pdf->Cell(0,4,utf8_decode('CERCA DE TI - GUANARE 2022'),0,1,'C',0);//
        $pdf->Cell(0,4,utf8_decode('REPORTE DE ESTACIÓN: '.$nombre),0,1,'C',0);//
        $pdf->Ln(5);

        $pdf->SetFillColor(200,220,255);    
        
        $pdf->SetFont('Times','B',6);   
        $fill = false;


        $pdf->Cell(8,3,utf8_decode("Cód"),1,0,'L',0);//
        $pdf->Cell(14,3,utf8_decode("Cédula"),1,0,'L',0);//
        $pdf->Cell(45,3,utf8_decode("Nombre"),1,0,'L',0);//
        $pdf->Cell(12,3,utf8_decode("Edad"),1,0,'L',0);//
        $pdf->Cell(7,3,utf8_decode("Sexo"),1,0,'L',0);//
        $pdf->Cell(17,3,utf8_decode("Teléfono"),1,0,'L',0);//
        $pdf->Cell(80,3,utf8_decode("Dirección"),1,1,'L',0);//


        $sql = "SELECT * FROM miembros, inscripcion_estaciones WHERE miembros.id_miembro=inscripcion_estaciones.id_miembro AND inscripcion_estaciones.id_estaciones=$id_estaciones ORDER BY miembros.codigo";
        $query = mysqli_query($conexion, $sql);


        while ($row = mysqli_fetch_array($query)){
            $id = $row["id_miembro"];
            $codigo = $row["codigo"];
            $cedula = $row["cedula"];
            $nombre = $row["nombres"]. " " .$row["apellidos"];
            $fecha_nacimiento = $row["fecha_nacimiento"];
            $sexo = $row["sexo"];
            $telefono = $row["telefono"];
            $peso = $row["peso"];
            $estatura = $row["estatura"];
            $direccion = $row["direccion"];
            $edad = CalculaEdad2($fecha_nacimiento);


            


            $pdf->Cell(8,3,utf8_decode($codigo),1,0,'L',0);//
            $pdf->Cell(14,3,utf8_decode($cedula),1,0,'L',0);//
            $pdf->Cell(45,3,utf8_decode($nombre),1,0,'L',0);//
            $pdf->Cell(12,3,utf8_decode($edad." Años"),1,0,'C',0);//
            $pdf->Cell(7,3,utf8_decode($sexo),1,0,'C',0);//
            $pdf->Cell(17,3,utf8_decode($telefono),1,0,'L',0);//
            $pdf->Cell(80,3,utf8_decode($direccion),1,1,'L',0);//

        }

        

    }



////////////////////////////////////////////////////////////////////////////////////
    $i = 0;
    

    //$pdf->Output("CLUBES_UVOC.pdf","I");
    $pdf->Output();

















    function inscrito_estacion($estacion, $id_miembro, $conexion){
        $sql = "SELECT * FROM inscripcion_estaciones WHERE id_miembro=$id_miembro AND id_estaciones=$estacion";
        $quer = mysqli_query($conexion, $sql);
        $num_row = mysqli_num_rows($quer);
        if ($num_row>0) {
            return "X";
        } else {
            return "-";
        }
    }





    
?>
