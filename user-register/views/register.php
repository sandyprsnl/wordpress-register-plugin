
<h2>Register</h2>
<form id="UesrRegister" action="" method="post" enctype="multipart/form-data" >
   First Name :
    <input type="text" name="fname" required ><br><br><br>
    Last Name:
    <input type="text" name="lname" required><br><br><br>
    Username <strong>*</strong>
    <input type="text" name="username" required ><br><br><br>
    Password <strong>*</strong>
    <input type="password" name="password" required ><br><br><br>
    Email: <strong>*</strong>
    <input type="text" name="email" required ><br><br><br>
    DOB: <strong>*</strong>
    <input type="text" name="dob" pattern="[0-9]{10}" required ><br><br><br>
    Phone: <strong>*</strong>
    <input type="text" name="phone" pattern="[0-9]{10}" required title="phone no max 10 "><br><br><br>
    profile Image: <strong></strong>
    <input type="file" name="profile" accept="image/x-png,image/gif,image/jpeg"><br><br><br>
   <input type="submit" name="submit" value="Register"/>
    </form>
