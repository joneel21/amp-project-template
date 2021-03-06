<?php
 
 /*if( isset( $_GET[ 'tab' ] ) ) {
    $active_tab = $_GET[ 'tab' ];
 } */
 $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'general';
?>

<div class="tabwrapper">

    <div id="icon-themes" class="icon32"></div>
    <h1>AMP Extension</h1>
    <!--<?php settings_errors(); ?>-->  
    <h2 class="nav-tab-wrapper">
        <a href="?page=ext-amp-setting&tab=general" class="nav-tab <?php echo $active_tab == 'general' ? 'nav-tab-active' : '' ?>">General</a>
        <a href="?page=ext-amp-setting&tab=styling" class="nav-tab <?php echo $active_tab == 'styling' ? 'nav-tab-active' : '' ?>">Styling</a>
        <!--<a href="?page=ext-amp-setting&tab=analytics" class="nav-tab <?php echo $active_tab == 'analytics' ? 'nav-tab-active' : '' ?>">Analytics</a>-->
        <a href="?page=ext-amp-setting&tab=forms" class="nav-tab <?php echo $active_tab == 'forms' ? 'nav-tab-active' : '' ?>">Forms</a>
        <a href="?page=ext-amp-setting&tab=advanced" class="nav-tab <?php echo $active_tab == 'advanced' ? 'nav-tab-active' : '' ?>">Advanced</a>
    </h2>

    <form method="post" action="options.php">
    <?php
        // This prints out all hidden setting fields
            if($active_tab === 'general'){
                settings_fields( 'ext_amp_general_options' );                
                do_settings_sections( 'ext_amp_general_options' );
            }
            else if($active_tab === 'styling'){
                settings_fields( 'ext_amp_styling_options' );                
                do_settings_sections( 'ext_amp_styling_options' );
            }
            else if($active_tab === 'forms'){
                settings_fields( 'ext_amp_forms_options' );        
                do_settings_sections( 'ext_amp_forms_options' );
            }
            else if($active_tab === 'advanced'){
                echo '<h2>Coming soon!</h2>';
            }
        
        submit_button();
    ?>
    </form>
</div>
       