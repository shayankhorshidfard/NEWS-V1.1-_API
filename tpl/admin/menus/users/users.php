<div class="wrap">
    <h1>
        کاربران ویژه
    </h1>
    <table class="widefat">
        <thead>
        <tr>
            <th>شناسه</th>
            <th>ایمیل</th>
            <th>نام کامل</th>
            <th>شماره همراه</th>
            <th>کیف پول</th>
            <th>عملیات</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($users as $user): ?>
        <?php
            $userwallet = get_user_meta($user->ID, 'wallet', true);
            $userwallet = empty($userwallet) ? 0 : $userwallet;
            ?>
            <tr>
                <td><?php echo $user->ID; ?></td>
                <td><?php echo $user->display_name; ?></td>
                <td><?php echo $user->user_email; ?></td>
                <td><?php echo get_user_meta($user->ID, 'mobile', true); ?></td>
                <td><?php echo number_format($userwallet) . 'تومان'; ?></td>
                <td><a href="<?php echo add_query_arg(['action' => 'edit', 'id' => $user->ID]); ?>">
                        <span class="dashicons dashicons-edit"></span>
                    </a>
                    <a title="حذف کردن شماره موبایل و کیف پول" href="<?php echo add_query_arg(['action' => 'removeMobileAndWallet', 'id' => $user->ID]); ?>">
                        <span class="dashicons dashicons-trash"></span>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>