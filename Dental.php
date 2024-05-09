<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dental Disease Predictor</title>
</head>
<body>
    
    <h1>Dental Disease Predictor</h1>
    <form method="post">
        <p>Question 1: Do you have Bad breath?</p>
        <input type="radio" name="q1" value="0" checked> No
        <input type="radio" name="q1" value="1"> Yes

        <p>Question 2: Do you have gums in pain?</p>
        <input type="radio" name="q2" value="0" checked> No
        <input type="radio" name="q2" value="1"> Yes

        <p>Question 3: Do you have sore on gums?</p>
        <input type="radio" name="q3" value="0" checked> No
        <input type="radio" name="q3" value="1"> Yes

        <p>Question 4: Do you have swollen or puffy gums?</p>
        <input type="radio" name="q4" value="0" checked> No
        <input type="radio" name="q4" value="1"> Yes

        <p>Question 5: Do you have Gums that feel tender when touched?</p>
        <input type="radio" name="q5" value="0" checked> No
        <input type="radio" name="q5" value="1"> Yes

        <p>Question 6: Do you have new spaces that develop between your teeth that look like black triangles?</p>
        <input type="radio" name="q6" value="0" checked> No
        <input type="radio" name="q6" value="1"> Yes

        <p>Question 7: Do you have tooth sensitivity?</p>
        <input type="radio" name="q7" value="0" checked> No
        <input type="radio" name="q7" value="1"> Yes

        <p>Question 8: Do you have Toothache, spontaneous pain or pain that occurs without any apparent cause?</p>
        <input type="radio" name="q8" value="0" checked> No
        <input type="radio" name="q8" value="1"> Yes

        <p>Question 9: Do you have Mild to sharp pain when eating or drinking something sweet, hot or cold?</p>
        <input type="radio" name="q9" value="0" checked> No
        <input type="radio" name="q9" value="1"> Yes

        <p>Question 10: Do you have Visible holes or pits in your teeth?</p>
        <input type="radio" name="q10" value="0" checked> No
        <input type="radio" name="q10" value="1"> Yes

        <p>Question 11: Do you have Pain when you bite down?</p>
        <input type="radio" name="q11" value="0" checked> No
        <input type="radio" name="q11" value="1"> Yes

        <p>Question 12: Do you have Brown, black or white staining on any surface of a tooth?</p>
        <input type="radio" name="q12" value="0" checked> No
        <input type="radio" name="q12" value="1"> Yes

        <p>Question 13: Do you have loose teeth?</p>
        <input type="radio" name="q13" value="0" checked> No
        <input type="radio" name="q13" value="1"> Yes

        <p>Question 14: Do you experience changes in speech?</p>
        <input type="radio" name="q14" value="0" checked> No
        <input type="radio" name="q14" value="1"> Yes

        <p>Question 15: Do you have Bleeding or numbness in the mouth</p>
        <input type="radio" name="q15" value="0" checked> No
        <input type="radio" name="q15" value="1"> Yes

        <p>Question 16: Do you have White or red patches on the mouth</p>
        <input type="radio" name="q16" value="0" checked> No
        <input type="radio" name="q16" value="1"> Yes        

        <p>Question 17: Do you have pain in tougue or hums</p>
        <input type="radio" name="q17" value="0" checked> No
        <input type="radio" name="q17" value="1"> Yes

        <p>Question 18: Do you have unexplained weight loss?</p>
        <input type="radio" name="q18" value="0" checked> No
        <input type="radio" name="q18" value="1"> Yes

        <p>Question 19: Do you have a lump in your neck?</p>
        <input type="radio" name="q19" value="0" checked> No
        <input type="radio" name="q19" value="1"> Yes

        <p>Question 20: Do you have foul-smelling breath?</p>
        <input type="radio" name="q20" value="0" checked> No
        <input type="radio" name="q20" value="1"> Yes

        <p>Question 21: Do you have dry or cracked mouth?</p>
        <input type="radio" name="q21" value="0" checked> No
        <input type="radio" name="q21" value="1"> Yes

        <p>Question 22: Do you have constant bitter or metallic taste?</p>
        <input type="radio" name="q22" value="0" checked> No
        <input type="radio" name="q22" value="1"> Yes        

        <p>Question 23: Do you have thick, mucousy saliva?</p>
        <input type="radio" name="q23" value="0" checked> No
        <input type="radio" name="q23" value="1"> Yes

        <!-- Repeat for questions 3 through 25 -->

        <input type="submit" name="S" value="Submit">
    </form>
</body>
</html>

<?php

require_once '\vendor\autoload.php';
use Phpml\Dataset\CsvDataset;
use Phpml\Classification\KNearestNeighbors;
if (isset($_POST['S'])) {
    $x = array();
    for ($i = 1; $i <= 23; $i++) {
        //echo "\n" . $_POST['q' . $i] . "\n";
        $x[$i-1] = $_POST['q' . $i];
    }
      
    $datasetPath = 'cleaned_dental_dataset1.csv';
    $dataset = new CsvDataset($datasetPath, 24, true);	
    $samples = $dataset->getSamples();
    foreach ($samples as &$sample) {
        array_shift($sample);
    }
	
    $X = $samples;
    $dataset = new CsvDataset($datasetPath,24, true);
    $y = $dataset->getTargets();
    $classifier = new KNearestNeighbors($k=4);
    $classifier->train($X, $y);
    $prediction = $classifier->predict($x);
    echo "Prediction: " . $prediction;
}

?>