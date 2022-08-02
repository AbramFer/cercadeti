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


$sql2 = "SELECT * FROM estaciones ORDER BY id_estaciones";
$query2 = mysqli_query($conexion, $sql2);
$numrow_estaciones = mysqli_num_rows($query2);

$spreadsheet = new Spreadsheet();

$hoja = 0;
while ($row2 = mysqli_fetch_assoc($query2)) {
    $nombre = $row2["nombre"];
    $id_estaciones = $row2["id_estaciones"];

    // Attach the "My Data" worksheet as the first worksheet in the Spreadsheet object
    $myWorkSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, $nombre);
    $spreadsheet->addSheet($myWorkSheet, $hoja);
    $spreadsheet->setActiveSheetIndex($hoja);
    $sheet = $spreadsheet->getActiveSheet();

    //tamaño de la fuente
    $spreadsheet->getDefaultStyle()->getFont()->setName('Calibri');
    $spreadsheet->getDefaultStyle()->getFont()->setSize(11);
    

    $sheet->getColumnDimension('A')->setWidth(10);
    $sheet->getColumnDimension('B')->setWidth(15);
    $sheet->getColumnDimension('C')->setWidth(60);
    $sheet->getColumnDimension('D')->setWidth(10);
    $sheet->getColumnDimension('E')->setWidth(12);
    $sheet->getColumnDimension('F')->setWidth(20);
    $sheet->getColumnDimension('G')->setWidth(60);

    //membrete
    $sheet->setCellValue('A1', 'Cerca de ti Guanare - 2022');
    $sheet->setCellValue('A2', 'Listado: '.$nombre);
    $sheet->mergeCells("A1:G1");
    $sheet->mergeCells("A2:G2");
    $sheet->getStyle("A1:G2")->applyFromArray($bordes_totales);
    $sheet->getStyle("A1:G2")->applyFromArray($negrita);
    $sheet->getStyle("A1:G2")->applyFromArray($centrado);


    $sql = "SELECT * FROM miembros, inscripcion_estaciones WHERE miembros.id_miembro=inscripcion_estaciones.id_miembro AND inscripcion_estaciones.id_estaciones=$id_estaciones ORDER BY miembros.codigo";
        $query = mysqli_query($conexion, $sql);

    $fila = 2;
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

        $sheet->getStyle('B'.$fila)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
    }

    $sheet->getStyle("A".$fila_aux.":G".$fila)->applyFromArray($bordes_totales);






    $hoja++;

}



$writer = new Xlsx($spreadsheet);
mkdir("xls/", 0777, true);
$file = 'xls/estaciones.xlsx';
$writer->save($file);

header("Location: ".$file);
?>
