<?php
// Add Menu Page

add_action('admin_menu', 'menu_page');
function menu_page() {
    add_menu_page(
        'EasyPay BD',
        'EasyPay BD',
        'manage_options',
        'easypay_bd',
        'easypay_calback',
        'dashicons-money-alt',
        20
    );

    add_submenu_page(
        'easypay_bd',
        'Bkash',
        'Bkash',
        'manage_options',
        'easypay-bkash',
        'easypay_bkash_callback'
    );
    add_submenu_page(
        'easypay_bd',
        'Nagad',
        'Nagad',
        'manage_options',
        'easypay-nagad',
        'easypay_nagad_callback'
    );
    add_submenu_page(
        'easypay_bd',
        'Roket',
        'Roket',
        'manage_options',
        'easypay-roket',
        'easypay_roket_callback'
    );
    add_submenu_page(
        'easypay_bd',
        'Upay',
        'Upay',
        'manage_options',
        'easypay-upay',
        'easypay_upay_callback'
    );
    add_submenu_page(
        'easypay_bd',
        'All Transactions',
        'All Transactions',
        'manage_options',
        'easypay-transactions',
        'easypay_transactions_callback'
    );
}

// Remove Sub Menu 
add_action('admin_menu', function() {
    remove_submenu_page('easypay_bd', 'easypay_bd');
});


// Main Menu Page Callback
function easypay_calback() {
    ?>
    <div class="wrap">
        <h2>EasyPay Settings</h2>
        <form action="options.php" method="post">
            <?php 
            settings_fields('easypay_group');
            do_settings_sections('easypay_settings');
            submit_button('Save Change');

            ?>
        </form>
    </div>
    <?php 
}

// Bkash Sub Menu Page Callback
function easypay_bkash_callback() {
       ?>
    <div class="wrap">
        <h2>EasyPay - Bkash</h2>
        <form action="options.php" method="post">
            <?php 
            settings_fields('easypay_bkash_group');
            do_settings_sections('easypay_bkash_settings');
            submit_button('Save Change');

            ?>
        </form>
    </div>
    <?php 
}
// Nagad Sub Menu Page Callback
function easypay_nagad_callback() {
       ?>
    <div class="wrap">
        <h2>EasyPay - Nagad</h2>
        <form action="options.php" method="post">
            <?php 
            settings_fields('easypay_nagad_group');
            do_settings_sections('easypay_nagad_settings');
            submit_button('Save Change');

            ?>
        </form>
    </div>
    <?php 
}
// Roket Sub Menu Page Callback
function easypay_roket_callback() {
       ?>
    <div class="wrap">
        <h2>EasyPay - Roket</h2>
        <form action="options.php" method="post">
            <?php 
            settings_fields('easypay_roket_group');
            do_settings_sections('easypay_roket_settings');
            submit_button('Save Change');

            ?>
        </form>
    </div>
    <?php 
}
// Upay Sub Menu Page Callback
function easypay_upay_callback() {
       ?>
    <div class="wrap">
        <h2>EasyPay - Upay</h2>
        <form action="options.php" method="post">
            <?php 
            settings_fields('easypay_upay_group');
            do_settings_sections('easypay_upay_settings');
            submit_button('Save Change');

            ?>
        </form>
    </div>
    <?php 
}
// All Transation Sub Menu Page Callback
function easypay_transactions_callback() {
      global $wpdb;

        $table_name = $wpdb->prefix . 'easypay_transactions';
        $results = $wpdb->get_results("SELECT * FROM $table_name");

  ?>
  <div class="wrap"><h1>All Transactions</h1>
  <table class="widefate fixed striped">
    <thead>
        <tr>
            <th>No </th>
            <th>User ID </th>
            <th>Method </th>
            <th>Type </th>
            <th>Transaction ID </th>
            <th>Amount </th>
            <th>Status </th>
        </tr>
    </thead>
    <tbody>
  <?php

  if ($results) {
    $i = 1;
    foreach ($results as $row) {
        echo '<tr>
            <td>' . $i++ . '</td>
            <td>#' . esc_html($row->user_id) . '</td>
            <td>' . esc_html($row->method) . '</td>
            <td>' . esc_html($row->type) . '</td>
            <td>' . esc_html($row->transaction) . '</td>
            <td>' . esc_html($row->amount) . '</td>
            <td>' . esc_html($row->status) . '</td>
        </tr>';
    }
  } else {
    echo '<tr><td colspan="7">No transactions found.</td></tr>';
  }
    ?>
        </tbody>
    </table>
    </div>
    <?php
}


// Setting Register
add_action('admin_init', 'easypay_register_settings');
function easypay_register_settings() {
    // Bkash
    register_setting('easypay_bkash_group', 'easypay_button_option_bkash', array(
        'sanitize_callback' => 'easypay_sanitize_checkbox_bkash'
    ));
    register_setting('easypay_bkash_group', 'easypay_number_option_bkash', array(
        'sanitize_callback' => 'easypay_sanitize_number_bkash'
    ));
    register_setting('easypay_bkash_group', 'easypay_select_option_bkash', array(
        'sanitize_callback' => 'easypay_sanitize_select_bkash'
    ));
    register_setting('easypay_bkash_group', 'easypay_description_option_bkash', array(
        'sanitize_callback' => 'easypay_sanitize_description_bkash'
    ));

    // Nagad
    register_setting('easypay_nagad_group', 'easypay_button_option_nagad', array(
        'sanitize_callback' => 'easypay_sanitize_checkbox_nagad'
    ));
    register_setting('easypay_nagad_group', 'easypay_number_option_nagad', array(
        'sanitize_callback' => 'easypay_sanitize_number_nagad'
    ));
    register_setting('easypay_nagad_group', 'easypay_select_option_nagad', array(
        'sanitize_callback' => 'easypay_sanitize_select_nagad'
    ));
    register_setting('easypay_nagad_group', 'easypay_description_option_nagad', array(
        'sanitize_callback' => 'easypay_sanitize_description_nagad'
    ));

    // Roket
    register_setting('easypay_roket_group', 'easypay_button_option_roket', array(
        'sanitize_callback' => 'easypay_sanitize_checkbox_roket'
    ));
    register_setting('easypay_roket_group', 'easypay_number_option_roket', array(
        'sanitize_callback' => 'easypay_sanitize_number_roket'
    ));
    register_setting('easypay_roket_group', 'easypay_select_option_roket', array(
        'sanitize_callback' => 'easypay_sanitize_select_roket'
    ));
    register_setting('easypay_roket_group', 'easypay_description_option_roket', array(
        'sanitize_callback' => 'easypay_sanitize_description_roket'
    ));

    // Upay
    register_setting('easypay_upay_group', 'easypay_button_option_upay', array(
        'sanitize_callback' => 'easypay_sanitize_checkbox_upay'
    ));
    register_setting('easypay_upay_group', 'easypay_number_option_upay', array(
        'sanitize_callback' => 'easypay_sanitize_number_upay'
    ));
    register_setting('easypay_upay_group', 'easypay_select_option_upay', array(
        'sanitize_callback' => 'easypay_sanitize_select_upay'
    ));
    register_setting('easypay_upay_group', 'easypay_description_option_upay', array(
        'sanitize_callback' => 'easypay_sanitize_description_upay'
    ));


// Bkash
add_settings_section(
    'easypay_bkash_section', 
    'Bkash', 
     null , 
    'easypay_bkash_settings'
);

add_settings_field('easypay_button_option_bkash', 'Enable/Disable', function() {
    $checked = get_option('easypay_button_option_bkash');
    echo '<input type="checkbox" name="easypay_button_option_bkash" value="1"' . checked(1, $checked, false) . '> Enable/Disable';
}, 'easypay_bkash_settings', 'easypay_bkash_section');


add_settings_field(
    'easypay_number_option_bkash', 
    'Agent/Personal Number', 
    function() {
        $val = get_option('easypay_number_option_bkash', '');
        echo '<input type="number" class="regular-text" name="easypay_number_option_bkash" placeholder="Enter your number" value="' . esc_attr($val) .'">';
    },'easypay_bkash_settings', 'easypay_bkash_section');

add_settings_field(
    'easypay_select_option_bkash', 
    'Type', 
    function() {
        ?>
        <select name="easypay_select_option_bkash">
            <option value="Agent" <?php selected(get_option('easypay_select_option_bkash'), 'Agent') ?>>Agent</option>
            <option value="Personal" <?php selected(get_option('easypay_select_option_bkash'), 'Personal') ?>>Personal</option>
        </select>
        <?php
    },
    'easypay_bkash_settings',
    'easypay_bkash_section');

add_settings_field(
    'easypay_description_option_bkash',
    'Description',
    function() {
        $val = get_option('easypay_description_option_bkash', '');
        echo '<textarea class="regular-text" placeholder="Desceiption...." name="easypay_description_option_bkash">' . esc_textarea($val) . '</textarea>';
    },
    'easypay_bkash_settings',
    'easypay_bkash_section');







// Nagad
add_settings_section(
    'easypay_nagad_section', 
    'Nagad', 
     null , 
    'easypay_nagad_settings'
);

add_settings_field('easypay_button_option_nagad', 'Enable/Disable', function() {
    $checked = get_option('easypay_button_option_nagad');
    echo '<input type="checkbox" name="easypay_button_option_nagad" value="1"' . checked(1, $checked, false) . '> Enable/Disable';
}, 'easypay_nagad_settings', 'easypay_nagad_section');


add_settings_field(
    'easypay_number_option_nagad', 
    'Agent/Personal Number', 
    function() {
        $val = get_option('easypay_number_option_nagad', '');
        echo '<input type="number" class="regular-text" name="easypay_number_option_nagad" placeholder="Enter your number" value="' . esc_attr($val) .'">';
    },'easypay_nagad_settings', 'easypay_nagad_section');

add_settings_field(
    'easypay_select_option_nagad', 
    'Type', 
    function() {
        ?>
        <select name="easypay_select_option_nagad">
            <option value="Agent" <?php selected(get_option('easypay_select_option_nagad'), 'Agent') ?>>Agent</option>
            <option value="Personal" <?php selected(get_option('easypay_select_option_nagad'), 'Personal') ?>>Personal</option>
        </select>
        <?php
    },
    'easypay_nagad_settings',
    'easypay_nagad_section');

add_settings_field(
    'easypay_description_option_nagad',
    'Description',
    function() {
        $val = get_option('easypay_description_option_nagad', '');
        echo '<textarea class="regular-text" placeholder="Desceiption...." name="easypay_description_option_nagad">' . esc_textarea($val) . '</textarea>';
    },
    'easypay_nagad_settings',
    'easypay_nagad_section');




// Roket
add_settings_section(
    'easypay_roket_section', 
    'Roket', 
     null , 
    'easypay_roket_settings'
);

add_settings_field('easypay_button_option_roket', 'Enable/Disable', function() {
    $checked = get_option('easypay_button_option_roket');
    echo '<input type="checkbox" name="easypay_button_option_roket" value="1"' . checked(1, $checked, false) . '> Enable/Disable';
}, 'easypay_roket_settings', 'easypay_roket_section');


add_settings_field(
    'easypay_number_option_roket', 
    'Agent/Personal Number', 
    function() {
        $val = get_option('easypay_number_option_roket', '');
        echo '<input type="number" class="regular-text" name="easypay_number_option_roket" placeholder="Enter your number" value="' . esc_attr($val) .'">';
    },'easypay_roket_settings', 'easypay_roket_section');

add_settings_field(
    'easypay_select_option_roket', 
    'Type', 
    function() {
        ?>
        <select name="easypay_select_option_roket">
            <option value="Agent" <?php selected(get_option('easypay_select_option_roket'), 'Agent') ?>>Agent</option>
            <option value="Personal" <?php selected(get_option('easypay_select_option_roket'), 'Personal') ?>>Personal</option>
        </select>
        <?php
    },
    'easypay_roket_settings',
    'easypay_roket_section');

add_settings_field(
    'easypay_description_option_roket',
    'Description',
    function() {
        $val = get_option('easypay_description_option_roket', '');
        echo '<textarea class="regular-text" placeholder="Desceiption...." name="easypay_description_option_roket">' . esc_textarea($val) . '</textarea>';
    },
    'easypay_roket_settings',
    'easypay_roket_section');





// Upay
add_settings_section(
    'easypay_upay_section', 
    'Upay', 
     null , 
    'easypay_upay_settings'
);

add_settings_field('easypay_button_option_upay', 'Enable/Disable', function() {
    $checked = get_option('easypay_button_option_upay');
    echo '<input type="checkbox" name="easypay_button_option_upay" value="1"' . checked(1, $checked, false) . '> Enable/Disable';
}, 'easypay_upay_settings', 'easypay_upay_section');


add_settings_field(
    'easypay_number_option_upay', 
    'Agent/Personal Number', 
    function() {
        $val = get_option('easypay_number_option_upay', '');
        echo '<input type="number" class="regular-text" name="easypay_number_option_upay" placeholder="Enter your number" value="' . esc_attr($val) .'">';
    },'easypay_upay_settings', 'easypay_upay_section');

add_settings_field(
    'easypay_select_option_upay', 
    'Type', 
    function() {
        ?>
        <select name="easypay_select_option_upay">
            <option value="Agent" <?php selected(get_option('easypay_select_option_upay'), 'Agent') ?>>Agent</option>
            <option value="Personal" <?php selected(get_option('easypay_select_option_upay'), 'Personal') ?>>Personal</option>
        </select>
        <?php
    },
    'easypay_upay_settings',
    'easypay_upay_section');

add_settings_field(
    'easypay_description_option_upay',
    'Description',
    function() {
        $val = get_option('easypay_description_option_upay', '');
        echo '<textarea class="regular-text" placeholder="Desceiption...." name="easypay_description_option_upay">' . esc_textarea($val) . '</textarea>';
    },
    'easypay_upay_settings',
    'easypay_upay_section');

}






// Sanitization Callback
// Bkash
function easypay_sanitize_checkbox_bkash($input) {
    return ($input == '1') ? 1 : 0 ;
}

function easypay_sanitize_number_bkash($input) {
    return sanitize_text_field($input);
}

function easypay_sanitize_select_bkash($input) {
    $allowed = ['Agent', 'Personal'];
    return in_array($input, $allowed) ? $input : 'Personal';
}

function easypay_sanitize_description_bkash($input) {
    return sanitize_textarea_field($input);
}



// Nagad
function easypay_sanitize_checkbox_nagad($input) {
    return ($input == '1') ? 1 : 0 ;
}

function easypay_sanitize_number_nagad($input) {
    return sanitize_text_field($input);
}

function easypay_sanitize_select_nagad($input) {
    $allowed = ['Agent', 'Personal'];
    return in_array($input, $allowed) ? $input : 'Personal';
}

function easypay_sanitize_description_nagad($input) {
    return sanitize_textarea_field($input);
}


// Roket
function easypay_sanitize_checkbox_roket($input) {
    return ($input == '1') ? 1 : 0 ;
}

function easypay_sanitize_number_roket($input) {
    return sanitize_text_field($input);
}

function easypay_sanitize_select_roket($input) {
    $allowed = ['Agent', 'Personal'];
    return in_array($input, $allowed) ? $input : 'Personal';
}

function easypay_sanitize_description_roket($input) {
    return sanitize_textarea_field($input);
}


// Upay
function easypay_sanitize_checkbox_upay($input) {
    return ($input == '1') ? 1 : 0 ;
}

function easypay_sanitize_number_upay($input) {
    return sanitize_text_field($input);
}

function easypay_sanitize_select_upay($input) {
    $allowed = ['Agent', 'Personal'];
    return in_array($input, $allowed) ? $input : 'Personal';
}

function easypay_sanitize_description_upay($input) {
    return sanitize_textarea_field($input);
}










?>