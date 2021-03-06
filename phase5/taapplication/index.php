<!DOCTYPE html>

<?php
  $coursesString = ''; 
  require_once('dbconnect.php');
  $db = DbUtil::loginConnection();
  $stmt = $db -> stmt_init();
  if($stmt -> prepare("SELECT DISTINCT course FROM sections WHERE semester='Spring' and year_offered=2013 ORDER BY course") or die(mysqli_error($db))) {
  $stmt -> execute();
  $stmt -> bind_result($course);
  while($stmt -> fetch()){
    $coursesString = $coursesString . '<option>' . $course . '</option>';
  }

  $userexists = false;

  if($stmt -> prepare("SELECT EXISTS (SELECT * FROM applicant WHERE comp_id = ?)") or die(mysqli_error($db))) {
    $stmt -> bind_param("s", $_SERVER['PHP_AUTH_USER']);
    $stmt -> execute();
    $stmt -> bind_result($exists);
    $stmt -> fetch();
    if($exists == '1') $userexists = true;
  }

  if ($userexists) {
    if($stmt -> prepare("SELECT fname, lname, school, year, personal_statement FROM applicant WHERE comp_id = ?") or die(mysqli_error($db))) {
      $stmt -> bind_param("s", $_SERVER['PHP_AUTH_USER']);
      $stmt -> execute();
      $stmt -> bind_result($exfname, $exlname, $exschool, $exyear, $exps);
      $stmt -> fetch();
    }
  }

  $stmt -> close();
  $db -> close();  
}
?>

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
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/ui-lightness/jquery-ui-1.8.24.custom.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap-toggle-buttons.css">
  <script type="text/javascript" src="js/jquery.toggle.buttons.js"></script>
  <style>
  body {
    padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
  }
  </style>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link href="css/bootstrap-responsive.css" rel="stylesheet">
  <script type="text/javascript">
    $(document).ready(function(){
      $('.tb').toggleButtons({
        label: {
          enabled: "Yes",
          disabled: "No"
        },
        style: {
          enabled: "success",
          disabled: "danger"
        }
      });
    })
  </script>
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
    $('#ac1').change(function(){
      $.ajax({
        type: "POST",
        url: 'getSections.php',
        data: {cname : $('#ac1').val()},
        success: function(data) {
          $('#sections1').html(data);
          $('#sections1 .tb').toggleButtons({
            label: {
              enabled: "Yes",
              disabled: "No"
            },
            style: {
              enabled: "success",
              disabled: "danger"
            }
          });
        }
      })
    })
    $('#addAvail').click(function(){
      var curnum = parseInt(document.getElementById('availabilityCount').value) + 1
      document.getElementById('availabilityCount').value = curnum + "";
      var newdiv = document.createElement('div');
      newdiv.setAttribute('class', 'control-group');
      newdiv.innerHTML = '<label class="control-label" for="availCourse' + curnum + '">Course</label>\
              <div class="controls">\
                <select name="availCourse' + curnum + '" id="ac' + curnum + '">\
                  <?php echo $coursesString; ?>\
                </select>\
              </div>\
              <label class="control-label" for="beforeCourse' + curnum + '">TA\'d before with</label>\
              <div class="controls">\
                <input type="text" name="beforeCourse' + curnum + '" placeholder="Instructor Name or N/A">\
              </div>\
              <div id="sections' + curnum + '">\
                <label class="control-label" for="section1">GRADER</label>\
                <div class="controls">\
                  <div id="toggle-button" class="tb"><input name="section1" type="checkbox" value="GRADER"></div>\
                </div>\
              </div>';
      $('#availabilityInputs div.availChildren' + (curnum-1)).collapse('hide');
      $('label[for=availCourse' + (curnum-1) + ']').text("Click here to show/hide");
      $('label[for=availCourse' + (curnum-1) + ']').click(function(){
        $($(this).parent().get(0).children[$($(this).parent().get(0)).children().size()-1]).collapse('toggle');
      });
      document.getElementById('availabilityInputs').appendChild(newdiv);
      $('#availabilityInputs div.control-group').last().hide().fadeIn(500);
      $('.inst').autocomplete({
        source: availableInstructors
      });
      $('#sections' + curnum + ' .tb').toggleButtons({
        label: {
          enabled: "Yes",
          disabled: "No"
        },
        style: {
          enabled: "success",
          disabled: "danger"
        }
      });
      $('#ac' + curnum + '').change(function(){
        $.ajax({
          type: "POST",
          url: 'getSections.php',
          data: {cname : $('#ac' + curnum + '').val()},
          success: function(data) {
            $('#sections' + curnum + '').html(data);
            $('#sections' + curnum + ' .tb').toggleButtons({
              label: {
                enabled: "Yes",
                disabled: "No"
              },
              style: {
                enabled: "success",
                disabled: "danger"
              }
            });
          }
        })
      })
    })
    $('#removeAvail').click(function(){
      document.getElementById('availabilityInputs').removeChild(document.getElementById('availabilityInputs').lastChild);
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
                <input type="text" class="cname" name="inputCourse' + curnum + '" placeholder="ex. CS 1110"> \
              </div> <div class="courseChildren' + curnum + '"> \
              <label class="control-label" for="inputInstructor' + curnum + '">Instructor</label> \
              <div class="controls"> \
                <input type="text" class="inst" name="inputInstructor' + curnum + '" placeholder="ex. Sherriff"> \
              </div>\
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
              </div></div>';
      $('#gradeInputs div.courseChildren' + (curnum-1)).collapse('hide');
      $('label[for=inputCourse' + (curnum-1) + ']').text("Click here to show/hide");
      $('label[for=inputCourse' + (curnum-1) + ']').click(function(){
        $($(this).parent().get(0).children[$($(this).parent().get(0)).children().size()-1]).collapse('toggle');
      })
      document.getElementById('gradeInputs').appendChild(newdiv);
      $('#gradeInputs div.control-group').last().hide().fadeIn(500);
      $('.cname').autocomplete({
        source: availableCourses
      })
      $('.inst').autocomplete({
        source: availableInstructors
      })
    })
  })
  </script>
  <?php if($userexists) {?>
  <script>
  $(document).ready(function(){
    for (var i = 1; i <= document.getElementById('gradeCount').value; i++) {
      $('#gradeInputs div.courseChildren' + i).collapse('hide');
      $('label[for=inputCourse' + i + ']').text("Click here to show/hide");
      $('label[for=inputCourse' + i + ']').click(function(){
        $($(this).parent().get(0).children[$($(this).parent().get(0)).children().size()-1]).collapse('toggle');
      });
    };
  })
  </script>
  <?php } ?>
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
            <?php if($userexists) {?><li><a href="deleteApplication.php">You are editing your existing application.  Click here to delete your application.</a></li><?php }?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row-fluid">
      <div class="span6">
        <form class="form-horizontal" method="post" action="submit.php">
          <legend>Personal Information</legend>
          <div class="control-group">
            <label class="control-label" for="inputFname">First Name</label>
            <div class="controls">
              <input type="text" name="inputFname" <?php if($userexists) echo 'value="'. $exfname . '"'; ?> >
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputLname">Last Name</label>
            <div class="controls">
              <input type="text" name="inputLname" <?php if($userexists) echo 'value="'. $exlname . '"'; ?> >
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
                <option <?php if($userexists && ($exyear == '1st Year')) echo 'selected'; ?>>1st Year</option>
                <option <?php if($userexists && ($exyear == '2nd Year')) echo 'selected'; ?>>2nd Year</option>
                <option <?php if($userexists && ($exyear == '3rd Year')) echo 'selected'; ?>>3rd Year</option>
                <option <?php if($userexists && ($exyear == '4th Year')) echo 'selected'; ?>>4th Year</option>
                <option <?php if($userexists && ($exyear == '5th Year')) echo 'selected'; ?>>5th Year</option>
              </select>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputSchool">School</label>
            <div class="controls">
              <select name="inputSchool">
                <option <?php if($userexists && ($exschool == 'College of Arts and Sciences')) echo 'selected'; ?>>College of Arts and Sciences</option>
                <option <?php if($userexists && ($exschool == 'School of Engineering and Applied Science')) echo 'selected'; ?>>School of Engineering and Applied Science</option>
                <option <?php if($userexists && ($exschool == 'School of Nursing')) echo 'selected'; ?>>School of Nursing</option>
                <option <?php if($userexists && ($exschool == 'School of Architecture')) echo 'selected'; ?>>School of Architecture</option>
                <option <?php if($userexists && ($exschool == 'School of Commerce')) echo 'selected'; ?>>School of Commerce</option>
              </select>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputStatement">Personal Statement</label>
            <div class="controls">
              <textarea name="inputStatement" rows=5 placeholder="Just a few lines is fine.  If someone referred you, let us know!"><?php if($userexists) echo $exps; ?></textarea>
            </div>
          </div>
          <legend>Grades</legend>
          <?php if($userexists) { ?>
          <div id="gradeInputs">
            <div class="control-group">
              <?php 
              $db = DbUtil::loginConnection();
              $stmt = $db -> stmt_init();

              if($stmt -> prepare("SELECT COUNT(*) FROM grades WHERE comp_id = ?") or die(mysqli_error($db))) {
                $stmt -> bind_param("s", $_SERVER['PHP_AUTH_USER']);
                $stmt -> execute();
                $stmt -> bind_result($numGrades);
                $stmt -> fetch();
              }

              $stmt -> close();
              echo '<input type="hidden" id="gradeCount" name="gradeCount" value="'.$numGrades.'">';
              $stmt = $db -> stmt_init();
              if($stmt -> prepare("SELECT course, grade, instructor, year_offered, semester FROM grades WHERE comp_id = ?") or die(mysqli_error($db))) {
                $stmt -> bind_param("s", $_SERVER['PHP_AUTH_USER']);
                $stmt -> execute();
                $stmt -> bind_result($excourse, $exgrade, $exinst, $exyear, $exsem);
                $i = 0;
                while ($stmt -> fetch()) {
                  $i++;
                  echo '<div id="gradeInputs">
                          <div class="control-group">
                            <input type="hidden" id="gradeCount" name="gradeCount" value="' . $i . '">
                            <label class="control-label" for="inputCourse' . $i . '">Course</label>
                            <div class="controls">
                              <input type="text" class="cname" name="inputCourse' . $i . '" placeholder="ex. CS 1110" value="' . $excourse . '">
                            </div>
                            <div class="courseChildren' . $i . '">
                              <label class="control-label" for="inputInstructor' . $i . '">Instructor</label>
                              <div class="controls">
                                <input type="text" class="inst" name="inputInstructor' . $i . '" placeholder="ex. Sherriff" value="' . $exinst . '">
                              </div>
                              <label class="control-label" for="inputYear' . $i . '">Year</label>
                              <div class="controls">
                                <select name="inputYear' . $i . '">
                                  <option ';
                                  if($exyear == '2009') echo 'selected';
                                  echo '>2009</option>
                                  <option ';
                                  if($exyear == '2010') echo 'selected';
                                  echo '>2010</option>
                                  <option ';
                                  if($exyear == '2011') echo 'selected';
                                  echo '>2011</option>
                                  <option ';
                                  if($exyear == '2012') echo 'selected';
                                  echo '>2012</option>
                                  <option ';
                                  if($exyear == '2013') echo 'selected';
                                  echo '>2013</option>
                                </select>
                              </div>
                              <label class="control-label" for="inputSemester' . $i . '">Semester</label>
                              <div class="controls">
                                <select name="inputSemester' . $i . '">
                                  <option ';
                                  if($exsem == 'Spring') echo 'selected';
                                  echo '>Spring</option>
                                  <option ';
                                  if($exsem == 'Fall') echo 'selected';
                                  echo '>Fall</option>
                                </select>
                              </div>
                              <label class="control-label" for="inputGrade' . $i . '">Grade</label>
                              <div class="controls">
                                <select name="inputGrade' . $i . '">
                                  <option ';
                                  if($exgrade == 'A+') echo 'selected';
                                  echo '>A+</option>
                                  <option ';
                                  if($exgrade == 'A') echo 'selected';
                                  echo '>A</option>
                                  <option ';
                                  if($exgrade == 'A-') echo 'selected';
                                  echo '>A-</option>
                                  <option ';
                                  if($exgrade == 'B+') echo 'selected';
                                  echo '>B+</option>
                                  <option ';
                                  if($exgrade == 'B') echo 'selected';
                                  echo '>B</option>
                                  <option ';
                                  if($exgrade == 'B-') echo 'selected';
                                  echo '>B-</option>
                                  <option ';
                                  if($exgrade == 'C+') echo 'selected';
                                  echo '>C+</option>
                                  <option ';
                                  if($exgrade == 'C') echo 'selected';
                                  echo '>C</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>';
                }
              }
               ?>
            </div>
          </div>
          <?php } else { ?>
          <div id="gradeInputs">
            <div class="control-group">
              <input type="hidden" id="gradeCount" name="gradeCount" value="1">
              <label class="control-label" for="inputCourse1">Course</label>
              <div class="controls">
                <input type="text" class="cname" name="inputCourse1" placeholder="ex. CS 1110">
              </div>
              <div class="courseChildren1">
                <label class="control-label" for="inputInstructor1">Instructor</label>
                <div class="controls">
                  <input type="text" class="inst" name="inputInstructor1" placeholder="ex. Sherriff">
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
          </div>
          <?php } ?>
          <button class="btn btn-small" onclick="return false" id="add">Add Another Course</button>
          <button class="btn btn-small" onclick="return false" id="remove">Remove Last Course</button><br><br>
          <legend>Availability</legend>
          <?php if($userexists) { ?>
          <div id="availabilityInputs">
            <div id="control-group">
              <?php 
              $db = DbUtil::loginConnection();
              $stmt = $db -> stmt_init();

              if($stmt -> prepare("SELECT COUNT(*) FROM availability WHERE compid = ?") or die(mysqli_error($db))) {
                $stmt -> bind_param("s", $_SERVER['PHP_AUTH_USER']);
                $stmt -> execute();
                $stmt -> bind_result($numAvail);
                $stmt -> fetch();
              }
              $stmt -> close();
               ?>
              <input type="hidden" id="availabilityCount" name="availCount" <?php echo 'value="' . $numAvail . '"'; ?>>
              <?php 
              $stmt = $db -> stmt_init(); 
              if ($stmt -> prepare("SELECT DISTINCT course FROM availability NATURAL JOIN sections WHERE compid = ? ORDER BY sis_section_number") or die(mysqli_error($db))) {
                $stmt -> bind_param("s", $_SERVER['PHP_AUTH_USER']);
                $stmt -> execute();
                $stmt -> bind_result($excourse);
                $i = 0;
                while ($stmt -> fetch()) {
                  $i++;
                  echo '<label class="control-label" for="availCourse' . $i . '">Course</label>
                        <div class="controls">
                          <select name="availCourse' . $i . '" id="ac' . $i . '">
                            <option ';
                                  if($excourse == 'CS 1010') echo 'selected';
                                  echo '>CS 1010</option>
                                  <option ';
                                  if($excourse == 'CS 1110') echo 'selected';
                                  echo '>CS 1110</option>
                          </select>
                        </div>
                        <div class="availChildren' . $i . '">
                          <label class="control-label" for="beforeCourse' . $i . '">TA\'d before with</label>
                          <div class="controls">
                            <input type="text" class="inst" name="beforeCourse' . $i . '" placeholder="Instructor Name or N/A">
                          </div>
                          <div id="sections' . $i . '">';
                            $db2 = DbUtil::loginConnection();
                            $stmt2 = $db2 -> stmt_init();
                            if($stmt2 -> prepare("SELECT id, section_day_time, sis_section_number FROM sections WHERE course = ?") or die(mysqli_error($db))) {
                              $stmt2 -> bind_param("s", $excourse);
                              $stmt2 -> execute();
                              $stmt2 -> bind_result($sisid, $secdaytime, $sissecno);
                              while($stmt2 -> fetch()) {
                                echo '<label class="control-label" for="section' . $sissecno . '">' . $secdaytime . '</label>
                                            <div class="controls">
                                              <div id="toggle-button" class="tb"><input name="section' . $sissecno . '" type="checkbox" value="' . $sisid .'"'; 
                                                $db3 = DbUtil::loginConnection();
                                                $stmt3 = $db3 -> stmt_init();
                                                if ($stmt3 -> prepare("SELECT id FROM availability WHERE compid = ?") or die (mysqli_error($db))) {
                                                  $stmt3 -> bind_param("s", $_SERVER['PHP_AUTH_USER']);
                                                  $stmt3 -> execute();
                                                  $stmt3 -> bind_result($checksisid);
                                                  while ($stmt3 -> fetch()) {
                                                    if ($checksisid == $sisid) {
                                                      echo ' checked';
                                                    }
                                                  }
                                                }
                                              echo '></div>
                                            </div>';
                              }
                            }
                          echo '</div></div>';
                }
              }
               ?>
            </div>
          </div>
          <?php } else { ?>
          <div id="availabilityInputs">
            <div class="control-group">
              <input type="hidden" id="availabilityCount" name="availCount" value="1">
              <label class="control-label" for="availCourse1">Course</label>
              <div class="controls">
                <select name="availCourse1" id="ac1">
                  <?php 
                    echo $coursesString;
                   ?>
                </select>
              </div>
              <div class="availChildren1">
                <label class="control-label" for="beforeCourse1">TA'd before with</label>
                <div class="controls">
                  <input type="text" class="inst" name="beforeCourse1" placeholder="Instructor Name or N/A">
                </div>
                <div id="sections1">
                  <label class="control-label" for="section1">GRADER</label>
                  <div class="controls">
                    <div id="toggle-button" class="tb"><input name="section1" type="checkbox" value="17436"></div>
                  </div>
                </div>
              </div>
            </div>
          </div> <?php } ?>
          <button class="btn btn-small" onclick="return false" width="40" id="addAvail">Add Another Course</button>
          <button class="btn btn-small" onclick="return false" width="40" id="removeAvail">Remove Last Course</button><br><br>
          <button type="submit" class="btn btn-success">Submit</button>
        </form>
      </div>
      <div class="span6">
        <img src="img/virginia-sabres-color.jpg" width="75%" height="75%" style="display: block; margin-left: auto; margin-right: auto">
        <img src="img/uva-computer-science.gif" style="display: block; margin-left: auto; margin-right: auto">
		
      </div>
    </div>
  </div>
</body>
</html>
