<?php
/*              BUDDYPRESS FUNCTIONS            */

//Function to change Member Directory Headline
function my_bp_groups_message (){
 echo '<h1>Player Profiles</h1>';
}
add_action('bp_before_directory_members_page', 'my_bp_groups_message');


// Function to remove clickable links in BP Profile fields
function remove_xprofile_links() {
    remove_filter( 'bp_get_the_profile_field_value',
                   'xprofile_filter_link_profile_data', 9, 2);
}
add_action('bp_init','remove_xprofile_links');


// Function to populate BP Profile Fields W/ S2member Fields
function s2_profile_field_update() {
    global $current_user;
    $xprofile_fields = array('Nationality',
                             'High School Graduation Date',
                             'School',
                             'Height',
                             'Weight',
                             'About me',
                             'Date of Birth',
                             'Position',
                             'Alternate Position',
                             'Preferred Foot',
                             'Current Club',
                             'Previous Club',
                            );
    $s2member_fields = array('nationality',
                             'hs_grad_date',
                             'school',
                             'height',
                             'weight',
                             'about_you',
                             'date_of_birth',
                             'position',
                             'alternate_position',
                             'preferred_foot',
                             'current_club',
                             'prev_club',
                            );
    get_currentuserinfo();
    if(current_user_is("s2member_level2")){
        if(get_user_field("s2member_login_counter") < 1000)
        {
            for($i = 0; $i < sizeof($xprofile_fields); $i++)
            {
                if(xprofile_get_field_data($xprofile_fields[$i], $current_user->id) == '' && get_user_field($s2member_fields[$i]) != '')
                {
                    xprofile_set_field_data($xprofile_fields[$i], $current_user->id, get_user_field($s2member_fields[$i]));
                }
            }
        }
    }
}
add_action('wp_head', 's2_profile_field_update',10,2);
                       
                             
?>
