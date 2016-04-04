 /*  
 **
 ** Shortcode and function declaration for mm_multipage_form 
 ** [mm_multipage_form]
 */
    add_shortcode('mm_multipage_form','mm_multipage_form_func');
    function mm_multipage_form_func(){
        global $wpdb;
        $this_page = $_SERVER['REQUEST_URI'];
        $page = $_POST['page'];
        $user_ID = get_current_user_id();
        $form_db_name = "form_contact_information";
        $user_has_submitted = FALSE;
        $user_data = NULL;
        
        // Make sure the user is registered
        if($user_ID == 0){
            echo '<h2> You cannot fill out this form because you are not registered </h2>';
            return;
        }
        
        //Check if the user has submitted data before
        $results = $wpdb->get_results("SELECT * FROM $form_db_name");
        foreach ($results as $res){
            if($res->user_ID == $user_ID ){
                $user_has_submitted = TRUE;
                $user_data = $res;
            }
        }
        
        // Tell user that they have or have not filled out the form before.
        if($user_has_submitted){
            echo '<h2>You have submitted data before</h2>';
        }
        else
            echo '<h2>You have never submitted this data before</h2>';
        
        if($page == NULL){
            echo '<h3>Contact Information</h3>';
            echo '<form method="post" action="'.$this_page.'">
                  <label for="first_name" id="first_name">First Name: </label>
                  <input type="text" name="first_name" id="first_name" value="'.$user_data->first_name.'" />
                  
                  <label for="last_name" id="last_name">Last Name: </label>
                  <input type="text" name="last_name" id="last_name" value="'.$user_data->last_name.'" />
                  
                  <label for="email" id="email">Email: </label>
                  <input type="email" name="email" id="email" value="'.$user_data->email.'" />
                  
                  <label for="phone" id="phone">Phone: </label>
                  <input type="tel" name="phone" id="phone" value="'.$user_data->phone.'" />
                  
                  <label for="address1" name="address1" id="address1">Address 1: </label>
                  <input type="text" name="address1" id="address1" value="'.$user_data->address1.'" />
                  
                  <label for="address2" name="address2" id="address2">Address 2: </label>
                  <input type="text" name="address2" id="address2" value="'.$user_data->address2.'" />
              
                  <label for="country" name="country" id="country">Country: </label>
                  <input type="text" name="country" id="country" value="'.$user_data->country.'" />
                  
                  <label for="state" name="state" id="state">State/Province: </label>
                  <input type="text" name="state" id="state" value="'.$user_data->state.'" />
                  
                  <label for="city" name="city" id="city">City: </label>
                  <input type="text" name="city" id="city" value="'.$user_data->city.'" />
                  
                  <label for="zip_code" name="zip_code" id="zip_code">Zip Code: </label>
                  <input type="text" name="zip_code" id="zip_code" value="'.$user_data->zip_code.'" />
                  
                  <input type="hidden" value="1" name="page" />
                  
                  <input type="submit" value="Next" />
                  
                  </form>';
        }  // End page 1 (Contact Info) of multipage_form
        
        elseif($page ==1 ){  
            // Grab POST data from page 1          
            // $first_name = $_POST['first_name'];
            // $last_name = $_POST['last_name'];
            // $email = $_POST['email'];
            // $phone = $_POST['phone'];
            // $address1 = $_POST['address1'];
            // $address2 = $_POST['address2'];
            // $country = $_POST['country'];
            // $state = $_POST['state'];
            // $city = $_POST['city'];
            // $zip = $_POST['zip_code'];
            
            // Assign table and inputs for INSERT function
            
            $page_one_table = 'form_contact_information';
            $page_one_inputs = array(
                'user_ID' => $user_ID,
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'address1' => $_POST['address1'],
                'address2' => $_POST['address2'],
                'country' => $_POST['country'],
                'state' => $_POST['state'],
                'city' => $_POST['city'],
                'zip_code' => $_POST['zip_code'],
                'page' => $page,
            );
            
            // Insert data into a new row
            if($user_has_submitted){
                $insert_page_one = $wpdb->update('form_contact_information',$page_one_inputs, array( 'ID' => $user_data->id ) );
                $form_id = $user_data->id;
            }
            else{
                $insert_page_one = $wpdb->insert($page_one_table,$page_one_inputs);
                $form_id = $wpdb->insert_id;
            }    
            
            // Start Page 2 Form Questions
            echo '<h3>Graduation & Enrollment Dates</h3>';
            echo '<form method="post" action="'.$this_page.'">
                  <label for="hs_grad_date" id="hs_grad_date">High School Graduation Date: </label>
                  <input type="month" id="hs_grad_date" />
                  
                  <label for="col_enroll_date" id="col_enroll_date">Enrollment date for college: </label>
                  <input type="month" id="col_enroll_date" />
                  
                  <label for="col_to_attend" id="col_to_attend">Where do you plan to go to college? (N/A if you are not sure) </label>
                  <input type="text" id="col_to_attend" />
                  
                  <input type="hidden" value="2" name="page" />
                  <input type="submit" value="Next" />
                  </form>';
            
            
            // Echo form 1 data for validation
            $page_one_inputs = $wpdb->get_results("SELECT * FROM $form_db_name WHERE user_ID=$user_ID");      
            $page_one_inputs = $page_one_inputs[0];
            echo '<p>Here are the form inputs: </p>
                  <p>User ID: '.$page_one_inputs->user_ID.'</p>
                  <p>First Name: '.$page_one_inputs->first_name.'</p>
                  <p>Last Name: '.$page_one_inputs->last_name.'</p>
                  <p>Email: '.$page_one_inputs->email.'</p>
                  <p>Phone: '.$page_one_inputs->phone.'</p>
                  <p>Address 1: '.$page_one_inputs->address1.'</p>
                  <p>Address 2: '.$page_one_inputs->address2.'</p>
                  <p>Country: '.$page_one_inputs->country.'</p>
                  <p>State: '.$page_one_inputs->state.'</p>
                  <p>City: '.$page_one_inputs->city.'</p>
                  <p>Zip Code: '.$page_one_inputs->zip_code.'</p>';
            echo '<h2>Form ID: '.$form_id.'</h2>';    
                  
        } // End Page 2 multipage_form
    };
