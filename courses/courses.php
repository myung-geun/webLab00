<!DOCTYPE html>
<html>
<head>
    <title>Course list</title>
    <meta charset="utf-8" />
    <link href="courses.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div id="header">
    <h1>Courses at CSE</h1>
<!-- Ex. 1: File of Courses -->
    <p>
        <?php
            $temp = file("courses.tsv");
            $filesize = filesize("courses.tsv");
            $lines = sizeof($temp);
        ?>
        Course list has <?=$lines?> total courses
        and
        size of <?=$filesize?> bytes.
    </p>
</div>
<div class="article">
    <div class="section">
        <h2>Today's Courses</h2>
<!-- Ex. 2: Today’s Courses & Ex 6: Query Parameters -->
        <?php
            $listOfCourses = file("courses.tsv");
            $number = 4;
            $numberOfCourses = array();
            $random_arr = array();

            for ($i = 1; $i <= $lines; $i++) {
                array_push($random_arr, $i);
            }
            shuffle($random_arr);

            for ($i = 0; $i < $number; $i++) {
                array_push($numberOfCourses, $random_arr[$i]);
            }
            function getCoursesByNumber($listOfCourses, $numberOfCourses){
                $resultArray = array();
//                implement here.

                foreach ($numberOfCourses as $value) {
                    array_push($resultArray, $listOfCourses[$value-1]);
                }
                return $resultArray;
            }
        ?>
        <ol>
            <li><?=getCoursesByNumber($listOfCourses, $numberOfCourses)[0]?></li>
            <li><?=getCoursesByNumber($listOfCourses, $numberOfCourses)[1]?></li>
            <li><?=getCoursesByNumber($listOfCourses, $numberOfCourses)[2]?></li>
            <li><?=getCoursesByNumber($listOfCourses, $numberOfCourses)[3]?></li>
        </ol>
    </div>
    <div class="section">
        <h2>Searching Courses</h2>
<!-- Ex. 3: Searching Courses & Ex 6: Query Parameters -->
        <?php
            $listOfCourses = file("courses.tsv");
            $startCharacter = 'A';
            $resultArray = array();
            function getCoursesByCharacter($listOfCourses, $startCharacter){
                $resultArray = array();
//                implement here.
                foreach ($listOfCourses as $value) {
                    $letter=substr($value,0,1);
                    if(strcmp($letter,$startCharacter)==0){
                        array_push($resultArray,$value);
                    }
                }
                return $resultArray;
            }
        ?>
        <p>
            Courses that started by <strong><?=$startCharacter?></strong> are followings :
        </p>
        <ol>
            <?php
                $searchedCourses=getCoursesByCharacter($listOfCourses, $startCharacter);
                foreach ($searchedCourses as $value) { ?>
                    <li><?=$value?></li>
            <?php } ?>
        </ol>
    </div>
    <div class="section">
        <h2>List of Courses</h2>
<!-- Ex. 4: List of Courses & Ex 6: Query Parameters -->
        <?php
            function getCoursesByOrder($listOfCourses, $orderby){
                $resultArray = $listOfCourses;
//                implement here.
                return $resultArray;
            }
        ?>
        <p>
            All of courses ordered by <strong>alphabetical order</strong> are followings :
        </p>
        <ol>
            <li class="long">ARTIFICIAL INTELLIGENCE - CSE4007</li>
            <li>BIG DATA PROCESSING - CSE4036</li>
            <li class="long">COMPILER CONSTRUCTION - CSE3009</li>
            <li>COMPUTER NETWORKS - CSE3027</li>
            <li>CRYPTOGRAPHY - CSE3029</li>
            <li class="long">EMBEDDED OPERATING SYSTEMS - CSE4035</li>
            <li>MOBILE COMPUTING - CSE4045</li>
            <li class="long">SOFTWARE CONVERGENCE STRATEGY - CSE3031</li>
            <li class="long">WEB APPLICATION DEVELOPMENT - CSE3026</li>
        </ol>
    </div>
    <div class="section">
        <h2>Adding Courses</h2>
<!-- Ex. 5: Adding Courses & Ex 6: Query Parameters -->
        <p>Input course or code of the course doesn't exist.</p>
    </div>
</div>
<div id="footer">
    <a href="http://validator.w3.org/check/referer">
        <img src="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/images/w3c-html.png" alt="Valid HTML5" />
    </a>
    <a href="http://jigsaw.w3.org/css-validator/check/referer">
        <img src="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/images/w3c-css.png" alt="Valid CSS" />
    </a>
</div>
</body>
</html>