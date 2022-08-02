<?php

require("../funciones_generales.php");
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


$bordes_totales = array(
    "borders" => array(
        "allBorders" => array(
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '#000000'],
        )
    ),
);



$sheet = $spreadsheet->getActiveSheet();

$sheet->getColumnDimension('A')->setWidth(10);
$sheet->getColumnDimension('B')->setWidth(15);
$sheet->getColumnDimension('C')->setWidth(60);
$sheet->getColumnDimension('D')->setWidth(10);
$sheet->getColumnDimension('E')->setWidth(12);
$sheet->getColumnDimension('F')->setWidth(20);
$sheet->getColumnDimension('G')->setWidth(60);

//$sheet->getRowDimension('1')->setRowHeight(55.50+0.72);



//Membrete
/*$sheet->mergeCells('A2:C2');
$sheet->mergeCells('A3:C3');*/

$sheet->setCellValue('A1', 'Cerca de ti Guanare - 2022');
$sheet->setCellValue('A2', 'Listado completo');

$sheet->getStyle("A1:R2")->applyFromArray($bordes_totales);
$sheet->getStyle("A1:R2")->applyFromArray($centrado);
$sheet->getStyle("A1:R2")->applyFromArray($negrita);

$fila = 3;
//Primera fila
$sheet->setCellValue('A'.$fila, 'Cód: ');
$sheet->setCellValue('B'.$fila, 'Cédula: ');
$sheet->setCellValue('C'.$fila, 'Nombre: ');
$sheet->setCellValue('D'.$fila, 'Edad: ');
$sheet->setCellValue('E'.$fila, 'Sexo: ');
$sheet->setCellValue('F'.$fila, 'Teléfono: ');
$sheet->setCellValue('G'.$fila, 'Dirección: ');

$sql2 = "SELECT * FROM estaciones ORDER BY id_estaciones";
$query2 = mysqli_query($conexion, $sql2);
$numrow_estaciones = mysqli_num_rows($query2);

$letra = "G";
while ($row2 = mysqli_fetch_assoc($query2)) {
    $nombre = $row2["nombre"];

	$letra++;
    $sheet->getStyle($letra.$fila)->applyFromArray($centrado);
	$sheet->setCellValue($letra.$fila, $nombre);

}


$sheet->getStyle('H'.$fila.":".$letra.$fila)->getAlignment()->setTextRotation(90);

$sheet->getStyle("A".$fila.":".$letra.$fila)->applyFromArray($bordes_totales);
$sheet->getStyle("A".$fila.":".$letra.$fila)->applyFromArray($negrita);

//membrete
$sheet->mergeCells("A1:".$letra."1");
$sheet->mergeCells("A2:".$letra."2");

$sql = "SELECT * FROM miembros ORDER BY codigo";
$query = mysqli_query($conexion, $sql);

//$fila++;
$fila_aux = $fila;

while ($row = mysqli_fetch_array($query)){
    $fila++;

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

    $sheet->setCellValue('A'.$fila,utf8_decode($codigo));
    $sheet->setCellValue('B'.$fila,utf8_decode($cedula." "));
    $sheet->setCellValue('C'.$fila,$nombre);
    $sheet->setCellValue('D'.$fila,$edad." Años");
    $sheet->setCellValue('E'.$fila,utf8_decode(se_otro($sexo)));
    $sheet->setCellValue('F'.$fila,utf8_decode($telefono));
    $sheet->setCellValue('G'.$fila,utf8_decode($direccion));

    $query3 = mysqli_query($conexion, $sql2);

	$letra = "G";
    while ($row3 = mysqli_fetch_assoc($query3)) {
        $id_estaciones = $row3["id_estaciones"];

        $bo = inscrito_estacion($id_estaciones, $id, $conexion);

        $letra++;
    	$sheet->setCellValue($letra.$fila,utf8_decode($bo));
        $sheet->getStyle($letra.$fila)->applyFromArray($centrado);
        //$pdf->Cell(7,3,utf8_decode(inscrito_estacion($id_estaciones, $id, $conexion)),1,0,'C',0);//

    }

}

$sheet->getStyle("A".$fila_aux.":".$letra.$fila)->applyFromArray($bordes_totales);



$query3 = mysqli_query($conexion, $sql2);
$fila++;
$letra = "G";

$sheet->setCellValue($letra.$fila, "Totales: ");
$sheet->getStyle($letra.$fila)->applyFromArray($derecha);
$sheet->getStyle($letra.$fila)->applyFromArray($bordes_totales);
$sheet->getStyle($letra.$fila)->applyFromArray($negrita);


while ($row3 = mysqli_fetch_assoc($query3)) {
    $id_estaciones = $row3["id_estaciones"];

    $sql4 = "SELECT count(id_ie) as cuenta FROM inscripcion_estaciones WHERE id_estaciones=".$id_estaciones;
    $qr = mysqli_query($conexion, $sql4);
    $rqr = mysqli_fetch_assoc($qr);
    $cantidad = $rqr["cuenta"];

    $letra++;
    $fila_aux++;
    $sheet->getStyle($letra.$fila)->applyFromArray($centrado);
    $sheet->getStyle($letra.$fila)->applyFromArray($bordes_totales);
    $sheet->getStyle($letra.$fila)->applyFromArray($negrita);
    $sheet->setCellValue($letra.$fila, $cantidad);

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

header("Location: ".$file);
//echo "<script> window.location='../?type=ordenes'; </script>";


?>
