<form action="" method="post"  enctype="multipart/form-data">
  <table>
    <tr><td>Users:</td><td><select name="user_id">
          <?php
          foreach ($users as $user) {
            echo "<option value=\"{$user->id}\">{$user->fname} {$user->lname}</option>";
          }
          ?>
        </select></td></tr>
    <tr><td>Subject:</td><td><input type="text" name="subject" value="" /></td></tr>
    <tr><td>Message:</td><td><textarea name="message" rows="10" cols="30"></textarea></td></tr>
    <tr><td>Attach File</td><td>
        <input type="file" name="file_upload" id="file" /> </td></tr>
    <tr><td></td><td><input type="submit" name="send" value="Send" /></td></tr>
</form>
</td></tr>
</table>
</form>
