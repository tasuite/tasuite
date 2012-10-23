<!DOCTYPE html> <!--x.removeChild(x.lastChild)-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>TA Application</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="TA Application Form">
  <meta name="author" content="AdamHunterDan">

  <!-- Le styles -->
  <link href="css/bootstrap.css" rel="stylesheet">
  <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
  <script type="text/javascript" src="js/jquery-ui-1.8.24.custom.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/ui-lightness/jquery-ui-1.8.24.custom.css">
  <style>
  body {
    padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
  }
  </style>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link href="css/bootstrap-responsive.css" rel="stylesheet">
  <script type="text/javascript">
  $(document).ready(function(){
    var availableCourses = [
      "CS 1010",
      "CS 1110",
      "CS 1111",
      "CS 1120",
      "CS 2102",
      "CS 2110",
      "CS 2150",
      "CS 3102",
      "CS 3240",
      "CS 3330",
      "CS 4102",
      "CS 4414",
      "CS 4630"
    ];
    $('.cname').autocomplete({
      source: availableCourses
    })

    var availableInstructors = [
      "Bloomfield",
      "Cettei",
      "Cohoon",
      "Davidson",
      "Evans",
      "Grimshaw",
      "Gurumurthi",
      "Horton",
      "Humphrey",
      "Knight",
      "Reynolds",
      "shelat",
      "Sherriff",
      "Skadron",
      "Son",
      "Stankovic",
      "Sullivan",
      "Weimer"
    ];
    $('.inst').autocomplete({
      source: availableInstructors
    })
    $('#remove').click(function(){
      document.getElementById('gradeInputs').removeChild(document.getElementById('gradeInputs').lastChild);
    })
    $('#add').click(function(){
      var curnum = parseInt(document.getElementById('gradeCount').value) + 1;
      document.getElementById('gradeCount').value = curnum + "";
      var newdiv = document.createElement('div');
      newdiv.setAttribute('class', 'control-group');
      newdiv.innerHTML =
        '<label class="control-label" for="inputCourse' + curnum + '">Course</label> \
              <div class="controls"> \
                <input type="text" class="cname" name="inputCourse' + curnum + '" placeholder="Course Name"> \
              </div> \
              <label class="control-label" for="inputInstructor' + curnum + '">Instructor</label> \
              <div class="controls"> \
                <input type="text" class="inst" name="inputInstructor' + curnum + '" placeholder="Instructor Name"> \
              </div> \
              <label class="control-label" for="inputYear' + curnum + '">Year</label> \
              <div class="controls"> \
                <select name="inputYear' + curnum + '"> \
                  <option>2009</option> \
                  <option>2010</option> \
                  <option>2011</option> \
                  <option>2012</option> \
                  <option>2013</option> \
                </select> \
              </div> \
              <label class="control-label" for="inputSemester' + curnum + '">Semester</label> \
              <div class="controls"> \
                <select name="inputSemester' + curnum + '"> \
                  <option>Spring</option> \
                  <option>Fall</option> \
                </select> \
              </div> \
              <label class="control-label" for="inputGrade' + curnum + '">Grade</label> \
              <div class="controls"> \
                <select name="inputGrade' + curnum + '"> \
                  <option>A+</option> \
                  <option>A</option> \
                  <option>A-</option> \
                  <option>B+</option> \
                  <option>B</option> \
                  <option>B-</option> \
                  <option>C+</option> \
                  <option>C</option> \
                </select> \
              </div>';
      document.getElementById('gradeInputs').appendChild(newdiv);
      $('.cname').autocomplete({
        source: availableCourses
      })
      $('.inst').autocomplete({
        source: availableInstructors
      })
    })
  })
  </script>
</head>
<body>

  <div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
      <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <a style="color: white" class="brand" href="#">TA Application</a>
        <div class="nav-collapse collapse">
          <ul class="nav">
<!--            <li><a href="http://www.mail.virginia.edu" target="_blank">UVa Mail</a></li>
            <li><a href="http://collab.itc.virginia.edu/portal" target="_blank">Collab</a></li>
            <li><a href="http://stardock.cs.virginia.edu/redmine" target="_blank">Redmine</a></li>
            <li><a href="http://www.virginia.edu/sis" target="_blank">SIS</a></li>
            <li><a href="http://rabi.phys.virginia.edu/mySIS/CS" target="_blank">Anti-SIS</a></li> -->
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row-fluid">
      <div class="span10">
        <form class="form-horizontal" method="post">
          <legend>Personal Information</legend>
          <div class="control-group">
            <label class="control-label" for="inputFname">First Name</label>
            <div class="controls">
              <input type="text" name="inputFname">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputLname">Last Name</label>
            <div class="controls">
              <input type="text" name="inputLname">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputCompid">UVa Computing ID</label>
            <div class="controls">
              <input type="text" name="inputCompid" value=<?php echo '"' . $_SERVER['PHP_AUTH_USER'] . '"' ?>  readonly>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputYear">Current Year</label>
            <div class="controls">
              <select name="inputYear">
                <option>1st Year</option>
                <option>2nd Year</option>
                <option>3rd Year</option>
                <option>4th Year</option>
                <option>5th Year</option>
              </select>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputSchool">School</label>
            <div class="controls">
              <select name="inputSchool">
                <option>College of Arts and Sciences</option>
                <option>School of Engineering and Applied Science</option>
                <option>School of Nursing</option>
                <option>School of Architecture</option>
                <option>School of Commerce</option>
              </select>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputStatement">Personal Statement</label>
            <div class="controls">
              <textarea name="inputStatement" rows=5 placeholder="Just a few lines is fine.  If someone referred you, let us know!"></textarea>
            </div>
          </div>
          <legend>Grades</legend>
          <div id="gradeInputs">
            <div class="control-group">
              <input type="hidden" id="gradeCount" value="1">
              <label class="control-label" for="inputCourse1">Course</label>
              <div class="controls">
                <input type="text" class="cname" name="inputCourse1" placeholder="Course Name">
              </div>
              <label class="control-label" for="inputInstructor1">Instructor</label>
              <div class="controls">
                <input type="text" class="inst" name="inputInstructor1" placeholder="Instructor Name">
              </div>
              <label class="control-label" for="inputYear1">Year</label>
              <div class="controls">
                <select name="inputYear1">
                  <option>2009</option>
                  <option>2010</option>
                  <option>2011</option>
                  <option>2012</option>
                  <option>2013</option>
                </select>
              </div>
              <label class="control-label" for="inputSemester1">Semester</label>
              <div class="controls">
                <select name="inputSemester1">
                  <option>Spring</option>
                  <option>Fall</option>
                </select>
              </div>
              <label class="control-label" for="inputGrade1">Grade</label>
              <div class="controls">
                <select name="inputGrade1">
                  <option>A+</option>
                  <option>A</option>
                  <option>A-</option>
                  <option>B+</option>
                  <option>B</option>
                  <option>B-</option>
                  <option>C+</option>
                  <option>C</option>
                </select>
              </div>
            </div>
          </div>
          <button class="btn" onclick="return false" id="add">Add Another Course</button>
          <button class="btn" onclick="return false" id="remove">Remove Last Course</button><br><br>
          <legend>Availability</legend>
          <div id="availabilityInputs">
            <div class="control-group">
              <input type="hidden" id="availabilityCount" value="1">
              <label class="control-label" for="availCourse1">Course</label>
              <div class="controls">
                <select name="course1">
                  <!-- USE ARRAY AT BEGINNING SO DON'T HAVE TO REPEAT, ALSO HOW TO SET GLOBAL YEAR SEMESTER? -->
                  <?php 
                    require_once('dbconnect.php');
                    $db = DbUtil::loginConnection();
                    $stmt = $db -> stmt_init();

                    if($stmt -> prepare("SELECT DISTINCT course FROM sections WHERE semester='Spring' and year_offered=2013") or die(mysqli_error($db))) {
                      $stmt -> execute();
                      $stmt -> bind_result($course);
                      while($stmt -> fetch()){
                        echo '<option>' . $course . '</option>';
                      }  
                    }
                   ?>
                </select>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-success">Submit</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
