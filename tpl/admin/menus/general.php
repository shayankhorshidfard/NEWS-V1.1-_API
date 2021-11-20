<style>
    table {
        border: 2px solid #dddd !important;
        border-bottom: none !important;
        font-size: 15px !important;
        font-weight: bold !important;
        border-radius: 5px !important;
    }
</style>

<div class="scroll scrollbar" id="style-2" style="width: 97%"    ><div class="card"><div class="card-body" >
    <?php
    global $wpdb;
    $result = $wpdb->get_results ( "SELECT * FROM {$wpdb->prefix}posts" );
    foreach ( $result as $print ) {
        ?>
        <h3 class="card-title" style="color: #4579c3"><?php echo $print->post_title;?></h3>
        <p style="font-size: 15px;font-weight: bold" class="card-text"><?php echo $print->post_content;?></p>


        <?php
    }
    ?>
</div></div></div>

<style>
    .card {
        border: 1px solid #d0d0d;
        border-radius: 5px;
        max-width: 99%;
    }

    div.scroll {
        padding-right: 20px;
        height: 730px;
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



