<html>
<body>
    <table width="500px"  cellspacing="5"style="border: 1px solid gray;" >
        <tr style="border: 1px solid gray;">
            <th colspan="2" style="background-color: #6a6a6a; padding: 12px 0 0; color: white;"><h3> <?php echo $subject; ?></h3></th>
        </tr>
        <tr style="border: 1px solid gray;">
            <th align="left" width="115">Full Name: </th>
            <td width="250"><?php echo $info['full_name']?></td>
        </tr>
        <tr>
            <th align="left">User Name : </th>
            <td><?php echo $info['username'];?></td>
        </tr>
        <?php if(isset($info['npassword'])){
            ?>
             <tr>
            <th align="left">Password : </th>
            <td><?php echo $info['npassword'];?></td>
        </tr>
       <?php } ?>
       
        
         <tr>
            <th align="left">Email: </th>
            <td><?php echo $info['email']?></td>
        </tr>
         <tr>
            <th align="left">Contact Number: </th>
            <td><?php echo $info['contact_no']?></td>
        </tr>
         <tr>
            <th align="left">Address: </th>
            <td><?php echo $info['address']?></td>
        </tr>
         <tr>
            <th align="left">User Type: </th>
            <td><?php echo $info['user_type']?></td>
        </tr>
          <tr>
            <th align="left">Remark: </th>
            <td><?php echo $info['remark']?></td>
        </tr>     
    </table>
</body>
</html>