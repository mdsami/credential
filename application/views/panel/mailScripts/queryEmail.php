<html>
<body>
    <table width="350" style="border: 1px solid gray;">
        <tr style="border: 1px solid gray;">
            <th colspan="2" style="background-color: gray; padding: 12px 0 0; color: white;"><h3><u>Queary information:</u></h3></th>
        </tr>
        <tr style="border: 1px solid gray;">
            <th align="left" width="115">Name: </th>
            <td width="250"><?php echo $fname.' '.$lname;?></td>
        </tr>
        <tr>
            <th align="left">Company : </th>
            <td><?php echo $company;?></td>
        </tr>
        <tr>
            <th align="left">Email Address: </th>
            <td><?php echo $email;?></td>
        </tr>
        <tr>
            <th align="left">Phone Number: </th>
            <td><?php echo $phone;?></td>
        </tr>
        <tr>
            <th align="left">Message: </th>
            <td><?php echo $message;?></td>
        </tr>
    </table>
</body>
</html>