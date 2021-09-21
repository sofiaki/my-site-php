<?php
$semester = $_GET['examino'];

//Δημιουργία query για την ανάκτηση των στοιχείων των φοιτητών για το επιλεγμένο εξάμηνο.
require 'connectDB.php';
$sql = "SELECT xristis.onoma, xristis.eponymo, xristis.id_xristi, COUNT(eggrafes.vathmos) AS ar_mathimaton, AVG(eggrafes.vathmos) AS mo
			FROM xristis 
			INNER JOIN examino ON rolos='Φοιτητής' AND examino.ar_examinou=$semester AND xristis.id_xristi=examino.id_xristi
			JOIN eggrafes ON xristis.id_xristi=eggrafes.id_xristi AND eggrafes.vathmos>'4'
			JOIN mathimata ON mathimata.id_mathimatos=eggrafes.id_mathimatos AND mathimata.examino=$semester 
			GROUP BY xristis.eponymo
			ORDER BY xristis.eponymo ASC" ;
$result = $conn->query($sql);

//Δημιουργία αρχείου XML
$imp = new DOMImplementation;
$dtd = $imp->createDocumentType('foititesExaminou','','foititesExaminou.dtd');
$xml = $imp->createDocument("","",$dtd);
$xml->encoding = 'UTF-8';
$xml->formatOutput = true;

//Δημιουργία στοιχείου ρίζα.
$foitites = $xml->createElement("foititesExaminou");
$xml->appendChild($foitites);
//Μεταβλητή που δείχνει τον αύξοντα αριθμό του φοιτητή.
$i = 1;
while ($row = $result->fetch_assoc()) {
	
	$onomaf = $row['onoma'];
	$eponymof = $row['eponymo'];
	$mathimataf = $row['ar_mathimaton'];
	$mof = $row['mo'];
	
	// Δημιουργία στοιχείου-παιδιού του στοιχείου-ρίζα.
	$foititis = $xml->createElement("foititis");
	$foititis->setAttribute("n", $i);
	$foitites->appendChild($foititis);
	
	// Δημιουργία τα στοιχείων- παιδιών του στοιχείου foitites.
	$onoma = $xml->createElement("onoma",$onomaf);
	$foititis->appendChild($onoma);
	
	$eponymo = $xml->createElement("eponymo",$eponymof);
	$foititis->appendChild($eponymo);
	
	$mathimata = $xml->createElement("mathimata",$mathimataf);
	$foititis->appendChild($mathimata);
	
	$mo = $xml->createElement("mesosOros",$mof);
	$foititis->appendChild($mo);
	
	++$i;
}			
$xml->saveXML();
$xml->save("foititesExaminou".$semester.".xml");


//Μετατροπή 
$xml_filename = "foititesExaminou".$semester.".xml";
$xsl_filename  = "foititesExaminou.xsl";

// Φόρτωση του xml
$xml = new DOMDocument();
$xml->load($xml_filename);

// Φόρτωση του xsl
$xsl = new DOMDocument();
$xsl->load($xsl_filename);

if (!$xml->validate()) {
	
	echo "<p>Το XML αρχείο δεν είναι έγκυρο σύμφωνα με το DTD. Παρακαλώ επικοινωνήστε με την τεχνική υποστήριξη.</p>";
	
} else {

	// Επεξεργασία κι εξαγωγή αποτελεσμάτων
	$proc = new XSLTProcessor();
	$proc->importStyleSheet($xsl);
	echo $proc->transformToXML($xml);
}
echo '<a class="btn btn-primary stretched-link" href="./administration.php#menu2">Επιστροφή</a>';

?>