<?php

    include 'connect.php';

    $email;

    $myFile = fopen("../Resources/Text_Files/userPage.txt", "r") or 
    die("Unable to open file!");

    $email = fgets($myFile);
    fclose($myFile);

    $sql = "SELECT I.Book_Id, Title, Author, Publisher, B.Price, Issue_Date,
            I.Email
            FROM books AS B JOIN issued_books 
            AS I ON I.Book_Id = B.Book_Id
            WHERE I.Email = '$email'";
    $result = mysqli_query($db, $sql);
    
    $Total = "SELECT 
    SUM(B.Price)
    FROM
    books AS B JOIN issued_books 
            AS I ON I.Book_Id = B.Book_Id";
    
    $final = mysqli_query($db, $Total);
    $finaln = mysqli_fetch_assoc($final);
    $sum = $finaln['SUM(B.Price)'];
    

    $asql = "SELECT Name FROM user WHERE Email = '$email'";
    $result2 = mysqli_query($db, $asql);
    $cell = mysqli_fetch_assoc($result2);
    $name = $cell;

?>

<!DOCTYPE html>
<html>
    <title>Issued Books</title>
    <head>
        <link rel="stylesheet" type="text/css" href="../FrontEnd/CSS_Files/issued_books.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
        .thetable{
            border: 3px solid #4e49b8;
            background-color: #4e49af;
            height: 45vh;
            overflow-y: auto;
            overflow-x: hidden;
        }
        table{
            width: 60vw;
        }
        td{
            padding: 5px 10px;
            text-align: center;
            vertical-align: middle;
        }
        .button {
  background-color: #FFFFFF; /* Green */
  border: none;
  color: black;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}
.button {
  transition-duration: 0.4s;
}

.button:hover {
  background-color: #CC0066; /* Green */
  color: white;
}
    </style>
    </head>
    <body>

        <div class="header">
        <nav>
        
        <div class="nav-links">
            <ul>
                <li><a href="../FrontEnd/HTML_Files/UserPage.html"><u>Return to Dashboard</u></a></li>
                <li><a href="../FrontEnd/HTML_Files/ReturnBook.html"><u>Return a book</u></a></li>
                <li><a href="../FrontEnd/HTML_Files/LOGIN.html"><u>Logout</u></a></li>
            </ul>
        </div>
    </nav>

            <div class="left-sidebar"></div>

            <span>
                <a href="" class="logo">Check Cart</a>
            </span>

            <span class="left-col">
                <img src="../Resources/Images/logo.png">
            </span>

            <div id="book_history" class="center">
            <div style="position: relative; top: -10px">
                <h3>Cart:</h3> <br>
            </div>
            
            <div class="thetable">
                <table>
                    <tr>
                        <th>Book ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Publisher</th>
                        <th>Buying Date</th>
                        <th>Price</th>
                        
                    </tr>
                    <?php 
                        while($row = mysqli_fetch_assoc($result))
                        {
                            echo "<tr>";
                            echo "<td>" . $row['Book_Id'] ."</td>";
                            echo "<td>" . $row['Title'] ."</td>";
                            echo "<td>" . $row['Author'] ."</td>";
                            echo "<td>" . $row['Publisher'] ."</td>";
                            echo "<td>" . $row['Issue_Date'] ."</td>";
                            echo "<td>" . $row['Price'] ."</td>";
                            
                            echo "</tr>";
                           
                            

                            






                        }
                    ?>
                   
                </table>
            </div>
                    
            <?php 
            echo ("<h1> Total Amount: $sum </h1> ");
            ?>
            
            <form action="../FrontEnd/HTML_Files/Payment.html">
            <button type="submit" class = 'button' name="submit_BB">Buy</button>
            </form>
        </div>
        </div>
    </body>
</html>