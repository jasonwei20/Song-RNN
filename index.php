<!doctype html>
<html>
  <head>
    <style>
    .container {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
.slidecontainer {
    width: 100%;
}

.slider {
    -webkit-appearance: none;
    width: 100%;
    height: 25px;
    background: #d3d3d3;
    outline: none;
    opacity: 0.7;
    -webkit-transition: .2s;
    transition: opacity .2s;
}

.slider:hover {
    opacity: 1;
}

.slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 25px;
    height: 25px;
    background: #426ef4;
    cursor: pointer;
}

.slider::-moz-range-thumb {
    width: 25px;
    height: 25px;
    background: #4CAF50;
    cursor: pointer;
}
/* Hide the browser's default checkbox */
.container input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

/* Create a custom checkbox */
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
    background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container input:checked ~ .checkmark {
    background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the checkmark when checked */
.container input:checked ~ .checkmark:after {
    display: block;
}

/* Style the checkmark/indicator */
.container .checkmark:after {
    left: 9px;
    top: 5px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}
.button {
    background-color: #C9C6FB;
    border: none;
    color: white;
    padding: 10px 22px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}
</style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <title>Modernist by Steve Smith</title>
    
    <link rel="stylesheet" href="stylesheets/styles.css">
    <link rel="stylesheet" href="stylesheets/pygment_trac.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="wrapper">
      <header>
        <h1>Song-RNN</h1>
        <p>By Jason Wei, June Kim, Tong Xu</p>
        <p class="view"><a href="http://github.com/orderedlist/modernist">View the Project on GitHub <small>orderedlist/modernist</small></a></p>
        <ul>
          <li><a href="https://github.com/orderedlist/modernist/zipballmus/master">Download <strong>ZIP File</strong></a></li>
          <li><a href="https://github.com/orderedlist/modernist/tarball/master">Download <strong>TAR Ball</strong></a></li>
          <li><a href="http://github.com/orderedlist/modernist">View On <strong>GitHub</strong></a></li>
        </ul>
      </header>
      <section>
        <h1>Generating Song Lyrics with Deep Learning</h1>
        <p> Generate original song lyrics with artificial intelligence. Song-RNN uses a recurrent neural network trained on a large corpus of country, pop, and hip-hop to generate original song lyrics, which can be used as inspiration for singers and songwriters. </p>


    <div class="slidecontainer">
      <form action="index.php" method="post">
        <input type="radio" name="genre" value="pop"/> Pop<br>
        <input type="radio" name="genre" value="country"/> Country<br>
        <input type="radio" name="genre" value="hip_hop"/> Hip-Hop<br>
        <br>

        Root word: <input type="text" name="root_word" value=""><br><br><br>
        <p style="text-align:left;">
        More Conservative
        <span style="float:right;">More Creative </span>
        </p>
        <input type="range" min="0" max="100" value=50 class="slider" id="myRange" name="temperature">
        <button class="button" onclick="" name="submit" >Compose Lyrics</button>
      </form>
    </div>

    <?php
      // only run all the code below if "compose lyrics" has been pressed
      chdir("/Library/WebServer/Documents");
      shell_exec("rm speech_to_text.wav");

      if (is_null($_POST["submit"]) == False) {

        //set user home directory and path to system python3, operate from home directory
        $user_dir = "/Users/junhwikim/";
        $python_path = "/Library/Frameworks/Python.framework/Versions/3.6/bin/python3";
        chdir($user_dir);

        //Which genre?
        $genre = $_POST["genre"];

        //Which root word?
        $root_word = $_POST["root_word"];

        //What temperature? Divide by 100 because don't know how to make slider from 0 to 1 with 0.01 step size
        $temperature = ($_POST["temperature"])/100;

        $wav_name = "speech_to_text.wav";

        //Execute get_lyrics.py
        $result = shell_exec($python_path." ".$user_dir."Documents/watson/get_lyrics.py ".$genre." ".$root_word." ".$temperature." ".$wav_name);

        // Parse result by ";", insert newline
        $parts = explode(';', $result);
        foreach ($parts as &$value) 
        {
          echo($value."<br>");
          echo(" ");
        }

        //shell_exec("open ".$user_dir."Documents/watson/CHKYYGJ.wav");
      }
    ?>
    <br>
    <br>

    <audio controls>
        <source src="speech_to_text.wav" type="audio/wav">
    </audio>

    <img style="width:100%;" id="image" src="songrnn1.jpeg">

    </div>
    <footer>
      <p>Project maintained by <a href="http://github.com/orderedlist">Jason Wei, June Kim, Tong Xu</a></p>
      <p>Hosted on GitHub Pages &mdash; Theme by <a href="https://github.com/orderedlist">orderedlist</a></p>
    </footer>
    <script src="javascripts/scale.fix.js"></script>
  </body>
</html>
