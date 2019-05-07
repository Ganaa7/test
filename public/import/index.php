<?php
$conn = mysqli_connect("localhost","root","","test");
require_once('vendor/php-excel-reader/excel_reader2.php');
require_once('vendor/SpreadsheetReader.php');

if (isset($_POST["import"]))
{


  $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
  
  if(in_array($_FILES["file"]["type"],$allowedFileType)){
 	
		//echo "TEST id is:".mysql_insert_id();
        $targetPath = 'uploads/'.$_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        $job_type_id = mysql_real_escape_string($_POST['jobtype']);
        $query = "insert into test(test,job_type_id,created_at) values('Ajil','".$job_type_id."',NOW())";
        if ($conn->query($query) === TRUE) {
            $last_test_id = $conn->insert_id;
            //echo $last_test_id;
        } 
        else 
        {
            echo "Error: " . $query . " -Test table-д өгөгдөл орсонгүй.<br>" . $conn->error;
        }
        $Reader = new SpreadsheetReader($targetPath);
        $sheetCount = count($Reader->sheets());

        for($i=0;$i<$sheetCount;$i++)
        {
            
            $Reader->ChangeSheet($i);
            
          foreach ($Reader as $Row)
            {
          
            
                $quiz = "";
                if(isset($Row[0])) {
                    $quiz = mysqli_real_escape_string($conn,$Row[0]);
                }
                if(isset($Row[6])) {
                    $diff = mysqli_real_escape_string($conn,$Row[6]);
                }
                $right_answer_num = "";
                if(isset($Row[5])) {
                    $right_answer_num = mysqli_real_escape_string($conn,$Row[5]);
                }

                $query = "insert into quiz(test_id,diff,quiz,right_answer_num) values('".$last_test_id."','".$diff."','".$quiz."','".$right_answer_num."')";
                if ($conn->query($query) === TRUE){
                $last_quiz_id = $conn->insert_id;
              //  echo $last_quiz_id;
                }

                for ($x = 1; $x <= 4; $x++) {
                    $a = "";
                    if(isset($Row[$x])) {
                    $a = mysqli_real_escape_string($conn,$Row[$x]);
                    $query = "insert into answer(quiz_id,answer_num,answer) values('".$last_quiz_id."','".$x."','".$a."')";
                    $result = mysqli_query($conn, $query);
                    } 
     			}
           
                if (! empty($result)) {
                    $type = "success";
                    $message = "Excel Data Imported into the Database";
                    } 
                else 
                    {
                    $type = "error";
                    $message = "Problem in Importing Excel Data";
                    }
                
             }
        }
         
  }
  else
  { 
        $type = "error";
        $message = "Invalid File Type. Upload Excel File.";
  }
}
?>

<!DOCTYPE html>
<html>    
<head>
<style>    
body {
	font-family: Arial;
	width: 550px;
}

.outer-container {
	background: #F0F0F0;
	bsord: #e0dfdf 1px solid;
	padding: 40px 20px;
	bsord-radius: 2px;
}

.btn-submit {
	background: #333;
	bsord: #1d1d1d 1px solid;
    bsord-radius: 2px;
	color: #f0f0f0;
	cursor: pointer;
    padding: 5px 20px;
    font-size:0.9em;
}

.tutorial-table {
    margin-top: 40px;
    font-size: 0.8em;
	bsord-collapse: collapse;
	width: 100%;
}

.tutorial-table th {
    background: #f0f0f0;
    bsord-bottom: 1px solid #dddddd;
	padding: 8px;
	text-align: left;
}

.tutorial-table td {
    background: #FFF;
	bsord-bottom: 1px solid #dddddd;
	padding: 8px;
	text-align: left;
}

#response {
    padding: 10px;
    margin-top: 10px;
    bsord-radius: 2px;
    display:none;
}

.success {
    background: #c7efd9;
    bsord: #bbe2cd 1px solid;
}

.error {
    background: #fbcfcf;
    bsord: #f3c6c7 1px solid;
}

div#response.display-block {
    display: block;
}
</style>
</head>

<body>
    <h2>Import Excel File into MySQL Database using PHP</h2>
     <div class="mb-3">
              
             
                  
                 


            </div>
    <div class="outer-container">
        <form action="" method="post"
            name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
            

            <div>
				 <label for="job">Ажилд орохыг хүсэж буй ажлын  байр</label>
             <select class="custom-select d-block w-100" id="jobtype" name="jobtype" required="">
                  <option value="">Сонгох...</option>
                  <option value="1">Програм хангамжийн инженер</option>
                  <option value="2">Холбооны инженер</option>
                  <option value="3">Навигацийн инженер</option>
                  <option value="4">Ажиглалтын инженер</option>
                  <option value="5">United States</option>
                </select>
                <label>Choose Excel
                    File</label> <input type="file" name="file"
                    id="file" accept=".xls,.xlsx">
                <button type="submit" id="submit" name="import"
                    class="btn-submit">Import</button>
        
            </div>
        
        </form>
        
    </div>
    <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?></div>
    
         
<?php
  /*  $sqlSelect = "SELECT * FROM quiz";
    $result = mysqli_query($conn, $sqlSelect);

if (mysqli_num_rows($result) > 0)
{
?>
        
    <table class='tutorial-table'>
        <thead>
            <tr>
                <th>Асуулт</th>
                <th>A</th>
				<th>B</th>
				<th>C</th>
				<th>D</th>
				<th>diff</th>
				<th>Answer</th>

            </tr>
        </thead>
<?php
    while ($row = mysqli_fetch_array($result)) {
?>                  
        <tbody>
        <tr>
            <td><?php  echo $row['quiz']; ?></td>
            <td><?php  echo $row['A']; ?></td>
			<td><?php  echo $row['B']; ?></td>
			<td><?php  echo $row['C']; ?></td>
			<td><?php  echo $row['D']; ?></td>
			<td><?php  echo $row['diff']; ?></td>
			<td><?php  echo $row['answer']; ?></td>
        </tr>
<?php
    }
?>
        </tbody>
    </table>
<?php 
} 
*/?>

</body>
</html>