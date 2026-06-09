<?php
// Ensure the COM extension is enabled in your php.ini
//extension=php_com_dotnet.dll

// 1. Initialize MS Word via COM
$word = new COM("Word.Application") or die("Unable to start Word");
$word->Visible = 1; // Set to 0 to run in the background

// 2. Create a new document or open an existing one
$document = $word->Documents->Add();

// 3. Define the path to your RTF file
// Note: OLE often works best with absolute paths
$rtfFilePath = realpath("./Hardware.rtf");

// 4. Access the Shapes collection to Add OLE Object
$shapes = $document->Shapes;

// AddOLEObject parameters: ClassType, FileName, LinkToFile, DisplayAsIcon, IconFileName, IconIndex, IconLabel, Anchor
$oleObject = $shapes->AddOLEObject(
    'Word.Document.8', // Or 'Excel.Sheet.8', 'Package', etc. depending on your object type
    $rtfFilePath,      // FileName
    true,             // LinkToFile
    true,             // DisplayAsIcon
);

// 5. Save the document and clean up
$document->SaveAs2("./documentate.rtf");
$document->Close();
$word->Quit();
?>
