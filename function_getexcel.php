<?PHP
/* $file = "c:/spreadhseet/test.xls"; */

_get_excel("c:/dev/index/test.xls");

function _get_excel ($file) {
$filename = $file;
$sheet1 = 1;
$sheet2 = "sheet2";
$excel_app = new COM("Excel.application") or Die ("Did not connect");
print "Application name: {$excel_app->Application->value}\n" ;
print "Loaded version: {$excel_app->Application->version}\n";
$Workbook = $excel_app->Workbooks->Open("$filename") or Die("Did not open $filename $Workbook");
$Worksheet = $Workbook->Worksheets($sheet1);
$Worksheet->activate;
$excel_cell = $Worksheet->Range("C4");
$excel_cell->activate;
$excel_result = $excel_cell->value;
print "$excel_result\n";
$Worksheet = $Workbook->Worksheets($sheet2);
$Worksheet->activate;
$excel_cell = $Worksheet->Range("C4");
$excel_cell->activate;
$excel_result = $excel_cell->value;
print "$excel_result\n";
#To close all instances of excel:
$Workbook->Close;
unset($Worksheet);
unset($Workbook);
$excel_app->Workbooks->Close();
$excel_app->Quit();
unset($excel_app);
}
?>