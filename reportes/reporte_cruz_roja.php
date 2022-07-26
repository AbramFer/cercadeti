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


$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
$drawing->setName('Logo');
$drawing->setDescription('Logo');
$drawing->setPath('cruzroja.jpg');
$drawing->setWidthAndHeight(100, 100);
$drawing->setCoordinates('B1');

$spreadsheet = new Spreadsheet();
$drawing->setWorksheet($spreadsheet->getActiveSheet());

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
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
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
$sheet->getColumnDimension('B')->setWidth(45);
$sheet->getColumnDimension('C')->setWidth(15);
$sheet->getColumnDimension('D')->setWidth(10);
$sheet->getColumnDimension('E')->setWidth(10);
$sheet->getColumnDimension('F')->setWidth(10);
$sheet->getColumnDimension('G')->setWidth(10);
$sheet->getColumnDimension('H')->setWidth(30);
$sheet->getColumnDimension('I')->setWidth(20);
$sheet->getColumnDimension('J')->setWidth(10);

$sheet->getRowDimension('1')->setRowHeight(55.50);



//Membrete
/*$sheet->mergeCells('A2:C2');
$sheet->mergeCells('A3:C3');*/

/*$sheet->setCellValue('A7', 'Cerca de ti Guanare - 2022');
$sheet->setCellValue('A8', 'Listado completo');

$sheet->getStyle("A1:R2")->applyFromArray($bordes_totales);
$sheet->getStyle("A1:R2")->applyFromArray($centrado);
$sheet->getStyle("A1:R2")->applyFromArray($negrita);
*/
$fila = 1;
$sheet->mergeCells("A".$fila.":B3");
$sheet->mergeCells("C".$fila.":G".$fila);
$sheet->setCellValue('C'.$fila, 'CRUZ ROJA VENEZOLANA');
$sheet->mergeCells("H".$fila.":J3");
$fila++; //2
$sheet->mergeCells("C".$fila.":G".$fila);
$sheet->setCellValue('C'.$fila, 'FORMATO DE REGISTRO DE ACTIVIDADES');
$fila++; //3
$sheet->mergeCells("C".$fila.":G".$fila);
$sheet->setCellValue('C'.$fila, 'LISTADO DE ASISTENCIA');

$fila++; //4
$fila++; //5

$sheet->setCellValue('A'.$fila, 'Proyecto:_________________________________________________');
$sheet->setCellValue('C'.$fila, 'Tipo de actividad:___________________');
$sheet->setCellValue('F'.$fila, 'Lugar:____________________________________________');
$sheet->setCellValue('I'.$fila, 'Fecha:________________');

$sheet->mergeCells("A".$fila.":B".$fila);
$sheet->mergeCells("C".$fila.":E".$fila);
$sheet->mergeCells("F".$fila.":H".$fila);
$sheet->mergeCells("I".$fila.":J".$fila);




$fila = 7;
$fila_aux = $fila;
//Primera fila
$sheet->setCellValue('A'.$fila, 'N°');
$sheet->setCellValue('B'.$fila, 'Nombre');
$sheet->setCellValue('C'.$fila, 'Documento identificación');
$sheet->setCellValue('D'.$fila, 'Edad');
$sheet->setCellValue('E'.$fila, 'Sexo');
$sheet->mergeCells("E".$fila.":F".$fila);
$sheet->setCellValue('G'.$fila, 'Grupo de benef.');
$sheet->setCellValue('H'.$fila, 'N° de contacto');
$sheet->setCellValue('I'.$fila, 'Correo electronico');
$sheet->setCellValue('J'.$fila, 'Firma');
$fila++;
$sheet->setCellValue('E'.$fila, 'Hombre');
$sheet->setCellValue('F'.$fila, 'Mujer');

$sheet->mergeCells("A".$fila_aux.":A".$fila);
$sheet->mergeCells("B".$fila_aux.":B".$fila);
$sheet->mergeCells("C".$fila_aux.":C".$fila);
$sheet->mergeCells("D".$fila_aux.":D".$fila);
$sheet->mergeCells("G".$fila_aux.":G".$fila);
$sheet->mergeCells("H".$fila_aux.":H".$fila);
$sheet->mergeCells("I".$fila_aux.":I".$fila);
$sheet->mergeCells("J".$fila_aux.":J".$fila);





$sql2 = "SELECT * FROM estaciones ORDER BY id_estaciones";
$query2 = mysqli_query($conexion, $sql2);
$numrow_estaciones = mysqli_num_rows($query2);

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
    $sheet->setCellValue('B'.$fila,utf8_decode($nombre));
    $sheet->setCellValue('C'.$fila,utf8_decode($cedula." "));
    $sheet->setCellValue('D'.$fila,$edad." Años");

    if ($sexo=="F") {
        $sheet->setCellValue('E'.$fila,"");
        $sheet->setCellValue('F'.$fila,"X");
    } else {
        $sheet->setCellValue('E'.$fila,"X");
        $sheet->setCellValue('F'.$fila,"");
    }

    $sheet->getStyle("E".$fila)->applyFromArray($centrado);
    $sheet->getStyle("F".$fila)->applyFromArray($centrado);

    $sheet->setCellValue('G'.$fila,"");
    $sheet->setCellValue('H'.$fila,utf8_decode($telefono));
    $sheet->setCellValue('I'.$fila,"");
    $sheet->setCellValue('J'.$fila,"");

    $query3 = mysqli_query($conexion, $sql2);


}
$sheet->getStyle("A7:J".$fila)->applyFromArray($bordes_totales);

$fila++;
$fila++;
$fila++;






$sheet->setCellValue('A'.$fila,"Grupo de Beneficiarios:");
$fila++;
$sheet->setCellValue('B'.$fila,"1. Jefe de hogar ÚNICO");
$sheet->setCellValue('C'.$fila,"4. Gestante");
$sheet->setCellValue('F'.$fila,"7. Personal rentado");
$fila++;
$sheet->setCellValue('B'.$fila,"2. Con discapacidad");
$sheet->setCellValue('C'.$fila,"5. Lactante");
$sheet->setCellValue('F'.$fila,"8. Otro");
$fila++;
$sheet->setCellValue('B'.$fila,"3. Etnia");
$sheet->setCellValue('C'.$fila,"6. Voluntario/a CRV");
$sheet->setCellValue('G'.$fila,"Coordinador/a de la Actividad:_________________________________");
$fila++;
$fila++;
$sheet->setCellValue('E'.$fila,"HUMANIDAD . IMPARCIALIDAD - NEUTRALIDAD - INDEPENDENCIA - VOLUNTARIADO - UNIDAD - UNIVERSALIDAD");
$sheet->getStyle("E".$fila)->applyFromArray($centrado);



$sheet->getStyle("A5:J5")->applyFromArray($bordes_fuera_simple);
$sheet->getStyle("A1:J3")->applyFromArray($bordes_fuera_simple);
$sheet->getStyle("A1:B3")->applyFromArray($bordes_fuera_simple);
$sheet->getStyle("C1:G3")->applyFromArray($bordes_fuera_simple);
$sheet->getStyle("H1:J3")->applyFromArray($bordes_fuera_simple);
$sheet->getStyle("C1:C3")->applyFromArray($centrado);
$sheet->getStyle("A7:J7")->applyFromArray($centrado);
$sheet->getStyle("A7:J7")->applyFromArray($centrado);
$sheet->getStyle("A7:J7")->getAlignment()->setWrapText(true); 
$sheet->getStyle("B1")->applyFromArray($centrado);




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
$file = 'xls/cruzroja.xlsx';
$writer->save($file);

header("Location: ".$file);
//echo "<script> window.location='../?type=ordenes'; </script>";


?>
