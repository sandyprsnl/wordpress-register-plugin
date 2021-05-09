<h1>WordPress Extra Post Info</h1>
<?php
$users = (array) get_users();

echo "<table class='wp-list-table widefat fixed striped table-view-list users'>
<thead>
  <tr>
    <th class='manage-column column-name'>username</th>
    <th  class='manage-column column-name'>email</th>
    <th  class='manage-column column-name'>status</th>
    <th  class='manage-column column-name'>DOB</th>
    <th  class='manage-column column-name'>Mobile</th>
    <th  class='manage-column column-name'>Profile pic</th>
    <th  class='manage-column column-name'>Activate User</th>
  </tr>
</thead>
<tbody> ";
foreach ($users as $user) {
    if ($user->data->user_status == 0) {
        $usermeta = get_user_meta($user->data->ID);
        if (!empty($usermeta['dob'][0])) {
            $dob = $usermeta['dob'][0];
        } else {
            $dob = '';
        }
        if (!empty($usermeta['mobile'][0])) {
            $mobile = $usermeta['mobile'][0];
        } else {
            $mobile = '';
        }
        if (!empty($usermeta['profile-img'][0])) {
            $profile_img = $usermeta['profile-img'][0];
        } else {
            $profile_img = PLUGINURL.'submenus/uperson.jpg';
        }
        echo "<tr>
    <td class='email column-email'>" . $user->data->user_login . "</td>
    <td class='email column-email'>" . $user->data->user_email . "</td>
    <td class='email column-email'>" . $user->data->user_status . "</td>
    <td class='email column-email'>" . $dob . "</td>
    <td class='email column-email'>" . $mobile . "</td>
    <td class='email column-email'> <img width='100px'height='100px' src='" . $profile_img . "'></td>
    <td class='email column-email'>  <button activate=".$user->data->ID."  class= 'activate-user button'>Activate User</button></td>
  </tr>";
    }
}
echo " </tbody>
</table> ";
