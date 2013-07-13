<?php 

require 'header.php';

$csn_utid = $_REQUEST['CSNUtID'];

server_log($sql, 'MySQL');
//$mysqli = mysqli_connect('localhost', 'root', 'guest', 'mydata');
//$res = mysqli_query($mysqli, $sql);
$names = get_names();
$name = $names[array_rand($names)];
$data = array('first' => $names[0], 'last' => $names[1]);

header('Content-Type: application/json');
echo json_encode($data);



















function get_names() {
return array(
array('Leonard', 'James Akaar'),
array('Akorem', 'Laan'),
array('Kiaphet', 'Amman'sor'),
array('Robert', 'April'),
array('Sarah', 'April'),
array('Jonathan', 'Archer'),
array('Dr.', 'Arridor'),
array('Jeremy', 'Aster'),
array('Marla', 'Aster'),
array('Mr.', 'Atoz'),
array('Badar', 'N'D'D'),
array('Lyndsay', 'Ballard'),
array('Reginald', 'Barclay'),
array('Professor', 'Honey Bare'),
array('Bareil', 'Antos'),
array('Amsha', 'Bashir'),
array('Julian', 'Bashir'),
array('Richard', 'Bashir'),
array('Marta', 'Batanides'),
array('Morgan', 'Bateson'),
array('Gabriel', 'Bell'),
array('Margaret', 'Blackwell'),
array('Philip', 'Boyce'),
array('Leah', 'Brahms'),
array('Richard', 'Castillo'),
array('Christine', 'Chapel'),
array('Pavel', 'Chekov'),
array('L.', 'Q. "Sonny" Clemonds'),
array('Zefram', 'Cochrane'),
array('J.M.', 'Colt'),
array('Kimara', 'Cretak'),
array('Beverly', 'Crusher'),
array('Jack', 'Crusher'),
array('Wesley', 'Crusher'),
array('Crystalline', 'Entity'),
array('Jal', 'Culluh'),
array('Jenna', 'D'Sora'),
array('Arne', 'Darvin'),
array('Carmen', 'Davila'),
array('Audrid', 'Dax'),
array('Curzon', 'Dax'),
array('Emony', 'Dax'),
array('Ezri', 'Dax'),
array('Jadzia', 'Dax'),
array('Joran', 'Dax'),
array('Lela', 'Dax'),
array('Tobin', 'Dax'),
array('Torias', 'Dax'),
array('Yedrin', 'Dax'),
array('Richard', 'Daystrom'),
array('Willard', 'Decker'),
array('Matt', 'Decker'),
array('Stefan', 'DeSeve'),
array('Klim', 'Dokachin'),
array('Guruk', 'Dolim'),
array('Jose', 'Dominguez'),
array('Sarina', 'Douglas'),
array('Skrain', 'Dukat'),
array('Duras,', 'son of Ja'rod'),
array('Duras,', 'son of Toral'),
array('Amelia', 'Earhart'),
array('Julius', 'Eaton'),
array('Kay', 'Eaton'),
array('Michael', 'Eddington'),
array('Albert', 'Einstein'),
array('Tam', 'Elbrun'),
array('Gul', 'Evek'),
array('Kivas', 'Fajo'),
array('Dr.', 'Farek'),
array('John', 'Farrell'),
array('Female', 'Changeling'),
array('Karen', 'Farris'),
array('Marla', 'E. Finn'),
array('Vic', 'Fontaine'),
array('Richard', 'Galen'),
array('Elim', 'Garak'),
array('Rachel', 'Garrett'),
array('Garth', 'of Izar'),
array('Forra', 'Gegen'),
array('Frola', 'Gegen'),
array('Iliana', 'Ghemor'),
array('Tekeny', 'Ghemor'),
array('Sonya', 'Gomez'),
array('Amanda', 'Grayson'),
array('Annika', 'Hansen'),
array('Erin', 'Hansen'),
array('Irene', 'Hansen'),
array('Magnus', 'Hansen'),
array('J.P.', 'Hanson'),
array('John', 'Harriman'),
array('Willie', 'Hawkins'),
array('Stephen', 'Hawking'),
array('Erika', 'Hernandez'),
array('Dixon', 'Hill'),
array('Felisa', 'Howard'),
array('Maggie', 'Hubbell'),
array('K.C.', 'Hunter'),
array('Mark', 'Jameson'),
array('Kathryn', 'Janeway'),
array('Jarok,', 'Alidar'),
array('Edward', 'Jellico'),
array('Ma'Bor', 'Jetrel'),
array('Michael', 'Jonas'),
array('Cyrano', 'Jones'),
array('Lenara', 'Kahn'),
array('Anton', 'Karidian'),
array('Lenore', 'Karidian'),
array('Walker', 'Keel'),
array('Edith', 'Keeler'),
array('Captain', 'Keogh'),
array('Harry', 'Kim'),
array('Kira', 'Meru'),
array('Kira', 'Nerys'),
array('Kira', 'Taban'),
array('Kira', 'Pohl'),
array('Kira', 'Reon'),
array('Aurelan', 'Kirk'),
array('George', 'Kirk'),
array('George', 'Samuel Kirk'),
array('James', 'T. Kirk'),
array('Peter', 'Kirk'),
array('Winona', 'Kirk'),
array('Klingon', 'Captain'),
array('Klingon', 'Captain'),
array('Sirna', 'Kolrami'),
array('Anastasia', 'Komononov'),
array('Roger', 'Korby'),
array('Darlene', 'Kursky'),
array('Edward', 'La Forge'),
array('Geordi', 'La Forge'),
array('Silva', 'La Forge'),
array('Natima', 'Lang'),
array('Sam', 'Lavelle'),
array('Robin', 'Lefler'),
array('Janice', 'Lester'),
array('Li', 'Nalas'),
array('Nick', 'Locarno'),
array('Lori', 'Ciana'),
array('Phillipa', 'Louvois'),
array('Kieran', 'MacDuff'),
array('Albert', 'Macklin'),
array('Kila', 'Marr'),
array('Carol', 'Marcus'),
array('David', 'Marcus'),
array('Aamin', 'Marritza'),
array('Angela', 'Martine'),
array('Martus', 'Mazur'),
array('Dr.', 'M'Benga'),
array('Marla', 'McGivers'),
array('Jose', 'I. Mendez'),
array('Ki', 'Mendrossen'),
array('Korenna', 'Mirell'),
array('Gary', 'Mitchell'),
array('Mora', 'Pol'),
array('James', 'Moriarty'),
array('Crell', 'Moset'),
array('Harry', 'Mudd'),
array('Anne', 'Mulhall'),
array('Kevin', 'Mulkahey'),
array('Alynna', 'Nechayev'),
array('Isaac', 'Newton'),
array('Dr.', 'Noah'),
array('Helen', 'Noel'),
array('Keiko', 'Ishikawa O'Brien'),
array('Kirayoshi', 'O'Brien'),
array('Miles', 'Edward O'Brien'),
array('Molly', 'O'Brien'),
array('Katie', 'O'Claire'),
array('Ralph', 'Offenhouse'),
array('Alyssa', 'Ogawa'),
array('Thadiun', 'Okona'),
array('Kai', 'Opaka'),
array('Douglas', 'Pabst'),
array('Miral', 'Paris'),
array('Owen', 'Paris'),
array('Thomas', 'Eugene Paris'),
array('John', 'Frederick Paxton'),
array('Melora', 'Pazlar'),
array('Elise', 'Picard'),
array('Jean-Luc', 'Picard'),
array('Marie', 'Picard'),
array('Maurice', 'Picard'),
array('RenÃ©', 'Picard'),
array('Robert', 'Picard'),
array('Yvette', 'Picard'),
array('Walter', 'Pierce'),
array('Christopher', 'Pike'),
array('Mark', 'Piper'),
array('Vedek', 'Porta'),
array('Erik', 'Pressman'),
array('Captain', 'Proton'),
array('Katherine', 'Pulaski'),
array('Dr.', 'Dalen Quaice'),
array('Rear', 'Admiral Gregory Quinn'),
array('Devinoni', 'Ral'),
array('Berlinghoff', 'Rasmussen'),
array('Clare', 'Raymonds'),
array('Cyrus', 'Redblock'),
array('Dexter', 'Remmick'),
array('Paul', 'Rice'),
array('Kyle', 'Riker'),
array('Thomas', 'Riker'),
array('William', 'Thomas Riker'),
array('Kevin', 'Thomas Riley'),
array('Roy', 'Ritterhouse'),
array('Ro', 'Laren'),
array('Richard', 'Robau'),
array('Rain', 'Robinson'),
array('Amanda', 'Rogers'),
array('Romulan', 'Commander'),
array('Romulan', 'Commander'),
array('Romulan', 'Commander'),
array('Romulan', 'Commander'),
array('Romulan', 'Commander'),
array('Romulan', 'Commander'),
array('Romulan', 'Commander'),
array('Romulan', 'Commander'),
array('Romulan', 'Crewman'),
array('William', 'J. Ross'),
array('Admiral', 'Connaught Rossa'),
array('Jeremiah', 'Rossa'),
array('Herbert', 'Rossoff'),
array('Michael', 'Rostov'),
array('Jackson', 'Roykirk'),
array('Alexander', 'Rozhenko'),
array('Helena', 'Rozhenko'),
array('Nikolai', 'Rozhenko'),
array('Sergey', 'Rozhenko'),
array('Benny', 'Russell'),
array('Burt', 'Ryan'),
array('Satan's', 'Robot'),
array('Norah', 'Satie'),
array('Tryla', 'Scott'),
array('Dr.', 'Selar'),
array('Seven', 'of Nine'),
array('Gideon', 'Seyetik'),
array('Shakaar', 'Edon'),
array('Jaglom', 'Shrek'),
array('Khan', 'Noonien Singh'),
array('Benjamin', 'Lafayette Sisko'),
array('Jake', 'Sisko'),
array('Jennifer', 'Sisko'),
array('Joseph', 'Sisko'),
array('Korenna', 'Sisko'),
array('Sito', 'Jaxa'),
array('Jessica', 'Sloan'),
array('Luther', 'Sloan'),
array('Lily', 'Sloane'),
array('Arik', 'Soong'),
array('Noonien', 'Soong'),
array('Tolian', 'Soran'),
array('Henry', 'Starling'),
array('Dr.', 'Paul Stubbs'),
array('Lon', 'Suder'),
array('Michael', 'Sullivan'),
array('Demora', 'Sulu')
);
}

?>