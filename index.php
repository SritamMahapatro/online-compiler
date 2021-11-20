<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <meta name="description" content="Web site created using create-react-app" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
       <style>
           body
           {
               font-weight:bold;
           }
           #ayush{
            font-size: 20px;
            font-family: cursive;
            color: #fff;
            text-align: center;
             text-shadow: 0 0 5px #fff, 0 0 10px #fff, 0 0 15px #0073e6, 0 0 20px #0073e6, 0 0 25px #0073e6, 0 0 30px #0073e6, 0 0 35px #0073e6;
            }
           </style>
        <title>Online/Compiler</title>
</head>
<body>
<form method="post">
    <div style="font-family: cursive;">
        <nav class="navbar navbar-expand-lg navbar-light bg-light" >
            <div class="container-fluid" >
                <a id="ayush" class="navbar-brand" >Online/Compiler</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" >C-Compiler</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">About</a>
                            
                        </li>
                        <input class="btn btn-success" type="submit" name="runs" value="run"/>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div>
        <div class="mb-3">
            <div class="alert alert-info" role="alert" style="font-family: cursive;">
            Designed and developed © by TechnoXcratS
        </div>
            <div class="alert alert-warning" role="alert" style="font-family: cursive;">
                Write Your Code Here....!
            </div>
            <textarea  name="code" spellcheck="false" autocorrect="off" autocapitalize="none" class="form-control" id="exampleFormControlTextarea1" rows="20" style="display:flex;background: url(http://i.imgur.com/2cOaJ.png);background-attachment: local;background-repeat: no-repeat;padding-left: 35px;padding-top: 10px;background-color: black;color: #87CEEB;font-size: 11px;font-weight: bold;"><?php if(isset($_POST['code'])) { echo htmlentities ($_POST['code']); }?></textarea>
        </div>
        <input class="btn btn-success" type="submit" name="runs" value="run"/>
        <hr>
        </hr>
        <div class="mb-3">
            <div class="alert alert-info" role="alert" style="font-family: cursive;">
                Input....!
            </div>
            <textarea name="inputs" spellcheck="false" class="form-control" id="exampleFormControlTextarea123" rows="3" style="font-size:11px;font-family: cursive;"><?php if(isset($_POST['inputs'])) { echo htmlentities ($_POST['inputs']); }?></textarea>
        </div>
        <hr>
        </hr>
        <div class="mb-3">
            <div class="alert alert-success" role="alert" style="font-family: cursive;">
                Output....!
            </div>
            <textarea disabled name="message" class="form-control" id="exampleFormControlTextarea12" rows="7" style="background-color: black;color: red;font-family: cursive;"><?php
            if(isset($_POST['runs'])) {
            runcod();
            }
    function runcod() {
       $timestart = microtime(true); //time beginning of execution.
       $pass = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstvwxyz"), 0, 6);//this helps us to generate a word with 6 alphabet 
       $sup=$pass.".c";//adding .c to the end
       $temp=$pass; // storing it in a temp variable
       $suptxt=$pass."error.txt";  //adding file with error.txt which will save the error in code
       $input=$pass."input.txt";   //adding file with input.txt which will save the input if any
       $output=$pass."output.txt";  //adding file with error.txt which will save the output if the code is error free
       $error="";   
        $code= $_POST['code'];  //getting the code from the text area.
        $myfile = fopen($sup, "w") or die("Unable to open file!");//creating file with random name which we generated before.
        fwrite($myfile, $code);// putting it into a file.
        fclose($myfile);//closing the connection.
        $gc="gcc -o $pass $sup -lm 2> $suptxt";//shell command to run c code.
        shell_exec($gc);// executing shell command if the code is error free we will get output.txt
        if (filesize($suptxt) == 0 )//if the error file is emty the code is error free....
        {
            echo "no errors your output is here:-\n";
            $inpu= $_POST['inputs'];
            if($inpu=="")
            $inpu=" ";
            $myfile = fopen($input, "w") or die("Unable to open file!");//input file.
            fwrite($myfile, $inpu);
            fclose($myfile);
            $runcd="./$temp < $input > $output";//shell command to execute the executable with text inputfile.
            shell_exec($runcd);  //running shell command
            $myfile = fopen($output, "r") or die("Unable to open file!");
            $out=fread($myfile,filesize($output));    //reading the output
            echo $out;  //displaying the output
            fclose($myfile);
            unlink($sup);  //deleting the file after we have displayed the output.
            unlink($input); //deleting the file after we have displayed the output.
            unlink($output);//deleting the file after we have displayed the output.
            unlink($suptxt);//deleting the file after we have displayed the output.
        } 
        else//it contains error.
        {
             echo "its contains error\n";
             $myfile = fopen($suptxt, "r") or die("Unable to open file!");
             $error=fread($myfile,filesize($suptxt));
             echo $error; // displaying the errors.
             unlink($suptxt); //deleting the file after we have displayed the errors.
             fclose($myfile);//deleting the file after we have displayed the errors.
        }
       $timeend = microtime(true); //time end os execution.
       $executiontime = ($timeend - $timestart);//(final_time - initial_time= execution_time)   
       $timeme=round($executiontime, 3);//rounding of the time to three decimal places.
       $message="\nIt Took $timeme seconds";//displaying execution time.
       echo $message;//displaying execution time.
    }
     ?> 
            </textarea>
        </div>
    </div>
    <div>
        <figure class="text-end">
            <blockquote class="blockquote" style="font-family: cursive;">
                <p>Any fool can write code that a computer can understand. Good programmers write code that humans can
                    understand.</p>
            </blockquote>
            <figcaption style="font-family: cursive;" class="blockquote-footer">
                Martin Fowler
            </figcaption>
        </figure>
        <div class="alert alert-info" role="alert" style="font-family: cursive;">
            Designed and developed © by Team TechnoXcratS
        </div>
    </div>
    </form>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
    crossorigin="anonymous"></script>
</html>
