  <?php
  define("db_server", "localhost");
  define("db_user", "root");
  define("db_password", "");
  define("db_database", "counties");
  $conn = mysqli_connect(db_server, db_user, db_password, db_database);
//   $id = $_POST['levels'];
    function Levels($currentLevelID, $conn){
       switch($currentLevelID){
           case 1:
                $sql = "SELECT id,name FROM country";
                break;
           case 2:
                $sql = "SELECT id,name FROM county";
                break;
           case 3:
                $sql = "SELECT id,name FROM subcounty";
                break;
           case 4:
                $sql =" SELECT id,name FROM `location`";
                break;
           case 5:
                $sql = "SELECT id,name FROM ward";
                break;
       }
        $result = mysqli_query($conn, $sql);
        return $result;
   }

    function country($id, $currentLevel, $conn, $searchingLevel){

        switch($currentLevel){
            //select all wards:

            case 1:
                //select all countries in:
                if($searchingLevel == 4)
                {
                    $sql ="SELECT country.name FROM location, subcounty, county, country WHERE location.id = '$id' AND location.subcountyID = subcounty.id AND county.id = subcounty.countyID AND country.id = county.countryID";

                }else if($searchingLevel == 2){
                    $sql ="SELECT country.name FROM country, county WHERE country.id = county.countryID AND county.id='$id'";
                }else if($searchingLevel == 3){
                    $sql ="SELECT country.name FROM county, subcounty, country WHERE subcounty.id = '$id' AND subcounty.countyID = county.id AND county.countryID = country.id";
                }else if($searchingLevel == 5){
                    $sql ="SELECT country.name FROM location,county, country, subcounty, ward WHERE ward.id = '$id' AND ward.locationID = location.id AND location.subcountyID = subcounty.id AND subcounty.countyID = county.id AND county.countryID = country.id";
                }else{
                    $sql ="SELECT name FROM country WHERE id='$id'";
                }
                break;

            case 2:
            //select all counties in:
                if($searchingLevel == 1)
                {
                    $sql ="SELECT county.name FROM county, country WHERE country.id = '$id' AND county.countryID = country.id";
                }else if($searchingLevel == 3){
                    $sql ="SELECT county.name FROM county, subcounty WHERE subcounty.id = '$id' AND subcounty.countyID = county.id";
                }else if($searchingLevel == 4){
                    $sql ="SELECT county.name FROM location, subcounty, county WHERE location.id = '$id' AND location.subcountyID = subcounty.id AND county.id = subcounty.countyID";
                }else if($searchingLevel == 5){
                    $sql ="SELECT county.name FROM location,county, subcounty, ward WHERE ward.id = '$id' AND ward.locationID = location.id AND location.subcountyID = subcounty.id AND subcounty.countyID = county.id";
                }else{
                    $sql ="SELECT county.name FROM county WHERE id='$id'";
                }
                break;
            case 3:
            //select all subcounties in:
                if($searchingLevel == 1)
                {
                    $sql = "SELECT name FROM  subcounty WHERE countyID IN (SELECT id FROM county WHERE countryID IN (SELECT id FROM country WHERE id ='$id'))";
                }else if($searchingLevel == 2){
                     $sql = "SELECT * FROM subcounty WHERE countyID = '$id'";
                }else if($searchingLevel == 4){
                     $sql ="SELECT subcounty.name FROM location, subcounty WHERE location.id = '$id' AND location.subcountyID = subcounty.id";
                }else if($searchingLevel == 5){
                     $sql ="SELECT subcounty.name FROM location,subcounty, ward WHERE ward.id = '$id' AND ward.locationID = location.id AND location.subcountyID = subcounty.id;";
                }else{
                    $sql ="SELECT subcounty.name FROM subcounty WHERE id='$id'";
                }
                break;
                // search by subcounty(table-subcounty)

            case 4:

                //select all locations in:
                if($searchingLevel == 1)
                {
                    $sql = "SELECT name FROM  `location` WHERE subcountyID IN (SELECT id FROM subcounty WHERE countyID IN (SELECT id FROM county WHERE countryID IN (SELECT id FROM country WHERE id ='$id')))";
                }else if($searchingLevel == 2){
                    $sql = "SELECT * FROM location WHERE subcountyID IN (SELECT id FROM subcounty WHERE countyID = '$id')";
                }else if($searchingLevel == 3){
                    $sql = "SELECT * FROM location WHERE subcountyID = '$id'";
                }else if($searchingLevel == 5){
                    $sql ="SELECT location.name FROM location, ward WHERE ward.id = '$id' AND ward.locationID = location.id;";
                }else{
                    $sql = "SELECT location.name FROM location WHERE id = '$id'";
                }
                break;
            case 5:
                if($searchingLevel == 1)
                {
                    $sql = "SELECT name FROM  ward WHERE locationID IN (SELECT id FROM location WHERE subcountyID IN (SELECT id FROM subcounty WHERE countyID IN (SELECT id FROM county WHERE countryID IN (SELECT id FROM country WHERE id ='$id'))))";
                }else if($searchingLevel == 2)
                {
                    $sql = "SELECT name FROM ward WHERE locationID IN (SELECT id FROM location WHERE subcountyID IN (SELECT id FROM subcounty WHERE countyID = '$id'))";
                }else if($searchingLevel == 3)
                {
                    $sql = "SELECT name FROM ward WHERE locationID IN (SELECT id FROM location WHERE subcountyID = '$id')";
                }else if($searchingLevel == 4)
                {
                    $sql = "SELECT name FROM ward WHERE locationID = '$id'";
                }else
                {
                    $sql = "SELECT name FROM ward WHERE id = '$id'";
                }
                break;

        }
        $result = mysqli_query($conn, $sql);
        return $result;
    }
    function getName($currentLevel, $conn){
        $sql = "SELECT name FROM levels WHERE id = $currentLevel";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_array($result)) {
            return $row['name'];
        }
    }
?>
