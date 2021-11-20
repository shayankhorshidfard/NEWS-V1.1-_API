<div class="wrap">
    <h1>ویرایش اطلاعات کاربر</h1>
    <form action="" method="POST">
        <table class="form-table">
            <tr valign="top">
                <th scope="row">شماره تلفن</th>
                <td><input type="text" name="mobile" value="<?php echo $mobile; ?>"></td>
            </tr>
            <tr valign="top">
                <th scope="row">کیف پول</th>
                <td><input type="text" name="wallet" value="<?php echo $wallet; ?>"></td>
            </tr>
            <tr valign="top">

                <td><input value="ذخیره" class="button" type="submit" name="saveUserInfo"></td>
            </tr>
        </table>
    </form>
</div>
