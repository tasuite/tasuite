<!DOCTYPE html>
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
    $(function() {
      $( ".acc" ).accordion();
    });
  })

  $(document).ready(function(){
    $(function() {
      $( '#ldapqry' ).change(function(){
        $.ajax({
          type: 'POST',
          url: 'uvaldap.php',
          data: {param: $('#ldapqry').val()},
          success: function(data) {
            $( '#ldapresult' ).html(data);
          }
        })
      })
    })
  })

  $(document).ready(function(){
    $(function() {
      $('#explode').click(function(){
        var allLinks = document.getElementsByTagName('a');
        for (var i = 0; i < allLinks.length; i++) {
          allLinks[i].click();
        };
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
              <input type="text" id="inputFname">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputLname">Last Name</label>
            <div class="controls">
              <input type="text" id="inputLname">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputCompid">UVa Computing ID</label>
            <div class="controls">
              <input type="text" id="inputCompid">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputYear">Current Year</label>
            <div class="controls">
              <select id="inputYear">
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
              <select id="inputSchool">
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
              <textarea rows=5 placeholder="Just a few lines is fine.  If someone referred you, let us know!"></textarea>
            </div>
          </div>
          <legend>Grades</legend>
          <legend>Availability</legend>
          <button type="submit" class="btn btn-success">Submit</button>
          <!-- TO ADD:
                      Year
                      Personal Statement
                      Major
                      School
          -->
        </form>
      </div>
    </div>
  </div>
</body>
</html>
