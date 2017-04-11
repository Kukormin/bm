<?
//<title>1C - belmebel</title>

try
{
	$import = new \Local\Import\Import();
	$import->start();
}
catch (\Local\Import\ImportException $e)
{
	$strImportErrorMessage = $e->getMessage();
}
