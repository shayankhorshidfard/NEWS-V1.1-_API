<?php
define('DOING_AJAX', true);
?>
<style>
    table {
        border: 2px solid #dddd !important;
        border-bottom: none !important;
        font-size: 15px !important;
        font-weight: bold !important;
        border-radius: 5px !important;
    }
</style>

<div class="wrap">
    <h1>
        لیست اطلاعات
    </h1>
    <a class="button" href="<?php echo add_query_arg(['action' => 'add']) ?>" style="margin: 10px">
        ثبت داده جدید
    </a>


    <table class="widefat" dir="rtl">
        <thead>
        <tr>
            <th>id</th>
            <th>نام مرکز</th>
            <th>آدرس API</th>
            <th>قسمت</th>
            <th style="text-align: center">عملیات</th>

        </tr>
        </thead>
        <tbody>
        <?php foreach ($samples as $sample): ?>
            <tr>
                <td><?php echo $sample->id; ?></td>
                <td><?php echo $sample->name_office; ?></td>
                <td><?php echo $sample->api_address; ?></td>
                <td><?php echo $sample->categories; ?></td>
                <td style="text-align: center">
                    <a class="button" style="width: 120px;text-align: center;margin-bottom: 5px"
                       href="<?php echo add_query_arg(['action' => 'delete', 'item' => $sample->id]) ?>">حذف کردن</a>

                    <?php
                    the_content();
                    ?>
                    <form method="post">
                        <input type="hidden" value="<?php echo $sample->api_address; ?>" name="apiUrl">
                        <input type="hidden" value="<?php echo $sample->categories; ?>" name="cat">
                        <button class="button" type="submit" id="portpostbtn" name="getNews"
                                style="width: 120px;border: 2px solid green;color: green">
                            دریافت اطلاعات
                        </button>
                        <button <?php if (isset($enable)) {
                            echo 'disable';
                        } ?> class="button" type="submit" id="portpostbtn" name="savesetting"
                             style="width: 120px;border: 2px solid #4579c3;color: #4579c3">
                            ثبت اطلاعات
                        </button>
                    </form>
                </td>

            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <?php
    if (isset($_POST['savesetting'])) {

        $response = wp_remote_get($_POST['apiUrl']);
        $posts = json_decode(wp_remote_retrieve_body($response));

        echo '<div class="latest-posts">';
        if ($posts != null) {
            global $wpdb, $enable;
            $enable = 1;
            $succesmsg = '<span class="button message" dir="rtl" style="border:2px solid green !important;margin-top: 10px;color: green">  اطلاعات این api با موفقیت ثبت شد </span></div>';
            $errormsg = '<span class="button message-error" dir="rtl" style="border:2px solid #f5002f !important;margin-top: 10px"> اطلاعات این api قبلا ثبت شده است </span>';
            $apipost = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}postmeta");

            foreach ($posts as $post) {
                $title = $post->title->rendered;
                $content = $post->content->rendered;
                $id_metapost = $post->id;
                $guid = $post->guid->rendered;

                $apipost = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}postmeta where post_id=$id_metapost");


                if (count($apipost) == 0) {

                    $wpdb->insert($wpdb->prefix . 'posts', [
                        'post_title' => $post->title->rendered,
                        'post_content' => $post->content->rendered,

                    ]);
                    $wpdb->insert($wpdb->prefix . 'postmeta', [
                        'post_id' => $post->id,
                        'meta_key' => $post->guid->rendered,
                    ]);

                    $enable = 0;
                }


            }
            if (count($apipost) == 0) {
                echo $succesmsg;
            } else {
                echo $errormsg;
            }

            echo '</div>';
        }
    }
    if (isset($_POST['getNews'])) {

        $res = wp_remote_get($_POST['apiUrl']);
        $ps = json_decode(wp_remote_retrieve_body($res));
        echo '<div class="scroll scrollbar" id="style-2"  ><div class="card" style="width: 100%;"><div class="card-body">';
        if ($ps != null) {
            global $wpdb;
            foreach ($ps as $pst) {
                $title = $pst->title->rendered;
                $content = $pst->content->rendered;
                $apost = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}posts");
                echo '<h2>' . $pst->date . '</h2>';
                echo '<h3 class="card-title">' . $title . '</h3><p style="font-size: 15px;font-weight: bold" class="card-text">' . $content . '</p>';
            }


            echo ' </div></div></div>';
        }


    }
    ?>


</div>

<style>
    .card {
        border: 1px solid #d0d0d0;
        border-radius: 5px;
    }

    .message {
        width: auto;
        border: 2px solid green;
        color: green;
        margin-top: 10px;
        text-align: right;
    }

    .message-error {
        width: auto;
        border: 2px solid #802c41;
        color: #802c41;
        margin-top: 10px;
        text-align: right;
    }

    tr td {
        border-bottom: 1px solid #dddd;
    }

    div.scroll {
        padding-right: 20px;
        width: 550px;
        height: 450px;
        overflow-x: hidden;
        overflow-y: auto;
        text-align: justify;
        border-radius: 10px;
        margin-top: 20px;
    }

    div.scroll::-webkit-scrollbar {
        width: 10px;
        border-radius: 5px;

    }

    div.scroll::-webkit-scrollbar-thumb {
        background: rgba(0, 75, 113, 0.54);

        border-radius: 5px;
    }

    div.scroll::-webkit-scrollbar-track {
        background: white;
        border: 1px solid white;
        border-radius: 5px;
    }

</style>


