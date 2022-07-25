<?php

//require("../funciones_generales.php");
require '../conexion/aut_config.inc.php';
//require '../tool/utilidades.php';
$conexion = mysqli_connect("$sql_host", "$sql_usuario", "$sql_pass", "$sql_db");

date_default_timezone_set('America/Los_Angeles');

require '../componentes_mios/excel/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\SheetView;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


/*$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
$drawing->setName('Logo');
$drawing->setDescription('Logo');
//$drawing->setPath('lab.png');
$drawing->setWidthAndHeight(720, 74);
$drawing->setCoordinates('A1');*/

$spreadsheet = new Spreadsheet();
//$drawing->setWorksheet($spreadsheet->getActiveSheet());

//$spreadsheet->getActiveSheet()->getSheetView()->setView(SheetView::SHEETVIEW_PAGE_LAYOUT);

//tamaño de la fuente
$spreadsheet->getDefaultStyle()->getFont()->setName('Calibri');
$spreadsheet->getDefaultStyle()->getFont()->setSize(11);

// margenes del documento
$spreadsheet->getActiveSheet()->getPageMargins()->setTop(0.01);
$spreadsheet->getActiveSheet()->getPageMargins()->setRight(0.7);
$spreadsheet->getActiveSheet()->getPageMargins()->setLeft(0.7);
$spreadsheet->getActiveSheet()->getPageMargins()->setBottom(0.01);

$styleArray = [
    'font' => [
        'bold' => true,
    ],
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
    ],
    
];

$negrita = [
    'font' => [
        'bold' => true,
    ],
];

$centrado = [
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
    ],
    
];

$derecha = [
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
    ],
    
];

$bordes_fuera_simple = array(
    "borders" => array(
        "outline" => array(
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '#000000'],
        ),
    ),
);

$bordes_laterales_simples = array(
    "borders" => array(
        "left" => array(
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '#000000'],
        ),
        "right" => array(
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '#000000'],
        ),
    ),
);
$sheet = $spreadsheet->getActiveSheet();

$sheet->getColumnDimension('A')->setWidth(10);
$sheet->getColumnDimension('B')->setWidth(12);
$sheet->getColumnDimension('C')->setWidth(60);
$sheet->getColumnDimension('D')->setWidth(10);
$sheet->getColumnDimension('E')->setWidth(10);
$sheet->getColumnDimension('F')->setWidth(20);
$sheet->getColumnDimension('G')->setWidth(60);

//$sheet->getRowDimension('1')->setRowHeight(55.50+0.72);



//Membrete
/*$sheet->mergeCells('A2:C2');
$sheet->mergeCells('A3:C3');*/

//Primera fila
$sheet->setCellValue('A2', 'Cód: ');
$sheet->setCellValue('B2', 'Cédula: ');
$sheet->setCellValue('C2', 'Nombre: ');
$sheet->setCellValue('D2', 'Edad: ');
$sheet->setCellValue('E2', 'Sexo: ');
$sheet->setCellValue('F2', 'Teléfono: ');
$sheet->setCellValue('G2', 'Dirección: ');

$sql2 = "SELECT * FROM estaciones ORDER BY id_estaciones";
$query2 = mysqli_query($conexion, $sql2);

$letra = "H";
while ($row2 = mysqli_fetch_assoc($query2)) {
    $nombre = $row2["nombre"];

	$sheet->setCellValue($letra.'2', $nombre);
	$letra++;
    //$pdf->Cell(7,-20,$pdf->RotatedText($pdf->getX()+4,$pdf->getY()-1,utf8_decode($nombre),90),1,0,'C',0);
}

$sql = "SELECT * FROM miembros ORDER BY codigo";
$query = mysqli_query($conexion, $sql);

$i = 3;
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

    $sheet->setCellValue('A'.$i,utf8_decode($codigo));
    $sheet->setCellValue('B'.$i,utf8_decode($cedula));
    $sheet->setCellValue('C'.$i,utf8_decode($nombre));
    $sheet->setCellValue('D'.$i,$edad." Años");
    $sheet->setCellValue('E'.$i,utf8_decode($sexo));
    $sheet->setCellValue('F'.$i,utf8_decode($telefono));
    $sheet->setCellValue('G'.$i,utf8_decode($direccion));

    $query3 = mysqli_query($conexion, $sql2);

	$letra = "H";
    while ($row3 = mysqli_fetch_assoc($query3)) {
        $id_estaciones = $row3["id_estaciones"];

    	$sheet->setCellValue($letra.''.$i,utf8_decode(inscrito_estacion($id_estaciones, $id, $conexion)));
        //$pdf->Cell(7,3,utf8_decode(inscrito_estacion($id_estaciones, $id, $conexion)),1,0,'C',0);//

        $letra++;
    }

    $i++;
}

function CalculaEdad2($fecha) {
	list($Y,$m,$d) = explode("-",$fecha);
	$edad = ( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
	return $edad;
}

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


//definir area de impresión
//$sheet->getPageSetup()->setPrintArea('A1:J'.$fila_total);

$writer = new Xlsx($spreadsheet);
mkdir("xls/", 0777, true);
$file = 'xls/todos.xlsx';
$writer->save($file);

//header("Location: ../index2.php?type=ordenes_extra_gestion");
//echo "<script> window.location='../?type=ordenes'; </script>";






?>
