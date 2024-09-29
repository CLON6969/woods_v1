<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "woods";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch data from the programs table

$allprograms = "SELECT
  programs.program_name,
  GROUP_CONCAT(DISTINCT certifications.certification_name ORDER BY certifications.certification_name) AS certifications,
  years_of_study.year_number,
  mood_of_study.mood_name,
  allprograms.allprograms_id
FROM
  allprograms
JOIN
  programs ON allprograms.program_id = programs.program_id
JOIN
  certifications ON allprograms.certification_id = certifications.certification_id
JOIN
  years_of_study ON allprograms.years_of_study_id = years_of_study.years_of_study_id
JOIN
  mood_of_study ON allprograms.mood_id = mood_of_study.mood_id
WHERE
  mood_of_study.mood_name = 'All'
GROUP BY
  programs.program_name,
  years_of_study.year_number,
  mood_of_study.mood_name,
  allprograms.allprograms_id
ORDER BY
  programs.program_name;
 ";
$result = $conn->query($allprograms);



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
   <!--styles links-->
   <link rel="stylesheet" href="Resources/programsview.css?v=<?php echo time(); ?>">

   <!--fontawsome links-->
   <link rel="stylesheet" href="Resources/fontawesome/css/solid.css">
   <link rel="stylesheet" href="Resources/fontawesome/webfonts/fa-solid-900.woff2">
   <link rel="stylesheet" href="Resources/fontawesome/css/all.css">
   <link rel="stylesheet" href="Resources/fontawesome/css/brands.css">
   <link rel="stylesheet" href="Resources/fontawesome/css/fontawesome.css">
   <link href="Resources/fontawesome/css/solid.css" rel="stylesheet" />
   <title>WOODS TRAINING INSTITUTE</title>
</head>

<body>

    <main>

        <div class="head">
            <h1>All Programs</h1>
        </div>

        <div class="bar_view"></div>

        <section class="container">

            <ul class="program-list program">
                <li class="titles">
                    <div class="p_name1">Program</div>
                    
                    <div class="certification">Certification</div>

                    <div class="p_duration1">Years</div>

                    <div class="study_mood1">Mode of Study</div>
                </li>
            </ul>

            <ul class="program-list program">
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                       
                        echo "<li>";
                        echo "<div class='program-name'>" . $row["program_name"] . "</div>";
                        
                        echo "<div class='certification'>" . $row["certifications"] . "</div>";
                        echo "<div class='p_duration'>" . $row["year_number"] . "</div>";


                        echo "<div class='study_mood'>";

                     // this condition is based on the study mmod
                    
                        if ($row["mood_name"] == "Online") {

                            echo "<div class='online'>";
                            echo "<i class='fas fa-chalkboard-teacher'></i> ";
                            echo "Online ";
                            echo "</div>";
   
                        } elseif ($row["mood_name"] == "Full-time") {


                            echo "<div class='fulltime'>";
                            echo "<i class='fas fa-school'></i> ";
                            echo "Full-time ";
                            echo "</div>";

                        } elseif ($row["mood_name"] == "Distance") {

                            echo "<div class='distance'>";
                            echo "<i class='fa-solid fa-people-arrows'></i> ";
                            echo "Distance ";
                            echo "</div>";
                        } elseif ($row["mood_name"] == "All") {

                            echo "<div class='online'>";
                            echo "<i class='fas fa-chalkboard-teacher'></i> ";
                            echo "Online ";
                            echo "</div>";

                            echo "<div class='fulltime'>";
                            echo "<i class='fas fa-school'></i> ";
                            echo "Full-time ";
                            echo "</div>";

                            echo "<div class='distance'>";
                            echo "<i class='fa-solid fa-people-arrows'></i> ";
                            echo "Distance ";
                            echo "</div>";
                          
                        } elseif ($row["mood_name"] == "Full-time and Distance") {

                            echo "<div class='fulltime'>";
                            echo "<i class='fas fa-school'></i> ";
                            echo "Full-time ";
                            echo "</div>";

                            echo "<div class='distance'>";
                            echo "<i class='fa-solid fa-people-arrows'></i> ";
                            echo "Distance ";
                            echo "</div>";
                        } elseif ($row["mood_name"] == "Online and Full-time") {

                            echo "<div class='online'>";
                            echo "<i class='fas fa-chalkboard-teacher'></i> ";
                            echo "Online ";
                            echo "</div>";

                            echo "<div class='fulltime'>";
                            echo "<i class='fas fa-school'></i> ";
                            echo "Full-time ";
                            echo "</div>";

                        } elseif ($row["mood_name"] == "Online and Distance") {

                            echo "<div class='online'>";
                            echo "<i class='fas fa-chalkboard-teacher'></i> ";
                            echo "Online ";
                            echo "</div>";

                            echo "<div class='distance'>";
                            echo "<i class='fa-solid fa-people-arrows'></i> ";
                            echo "Distance ";
                            echo "</div>";

                        } else  {

                            echo "<div class='distance'>";
                            echo "<i class='fas fa-question'></i> ";
                            echo "</div>";

                        }
                        
                        echo "</div>";
                        echo "</li>";
                    }
                } else {
                    echo "<li>No results found</li>";
                }
                // Close the database connection
                $conn->close();
                ?>
            </ul>

        </section>

    </main>

</body>
</html>



