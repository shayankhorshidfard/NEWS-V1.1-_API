<?php



$categories = get_categories();



?>



<div class="wrap">
    <h1>
        اضافه کردن api جدید
    </h1>
    <form method="post" action="">
        <table class="form-table" >
            <tr valign="top">
                <th scope="row">نام مرکز</th>

                <td>
                    <input type="text" name="name_office">
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">ادرس API</th>

                <td>
                    <input type="text" name="api_address">
                </td>
            </tr>

            <tr valign="top">
                <th scope="row"> دسته بندی</th>
                <td>
                    <select name="categories" id="">
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?php echo ($cat->term_id) ?>"><?php echo $cat->name ?></option>
                        <?php endforeach; ?>
                    </select>

                </td>
            </tr>


            <tr valign="top">
                <th scope="row"></th>

                <td>
                    <input type="submit" class="button" name="saveData" value="ذخیره سازی">
                </td>
            </tr>
        </table>
    </form>
</div>