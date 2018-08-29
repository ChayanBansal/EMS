<?php 

function clear_data()
{
	$_POST = array();
}
class header
{
	function display($logo_location, $portal_name)
	{ //pass values in the function 
		//html code for header
		//use variable names for respective values 
		//color and the formatting would be same
	}
}

class foot
{
	function display()
	{
		//code for footer
	}
}

class input_field
{
	function display($id, $class, $type/*password or text or email*/, $name, $placeholder, $required_flag/*0 or 1 */ )
	{
		if ($required_flag == 1) {
			echo "<input id='$id' class='$class' type='$type' name='$name' placeholder='$placeholder' required>";
		} else {
			echo "<input id='$id' class='$class' type='$type' name='$name' placeholder='$placeholder'>";
		}
	}
	function display_w_value($id, $class, $type/*password or text or email*/, $name, $placeholder, $value, $required_flag/*0 or 1 */ )
	{
		if ($required_flag == 1) {
			echo "<input id='$id' class='$class' type='$type' name='$name' placeholder='$placeholder' required value='$value'>";
		} else {
			echo "<input id='$id' class='$class' type='$type' name='$name' placeholder='$placeholder' value='$value'>";
		}
	}
	function display_w_js($id, $class, $type/*password or text or email*/, $name, $placeholder, $required_flag/*0 or 1 */, $funcin, $funcout)
	{
		if ($required_flag == 1) {
			echo "<input id='$id' class='$class' type='$type' name='$name' placeholder='$placeholder' required onfocus='$funcin' onfocusout='$funcout'>";
		} else {
			echo "<input id='$id' class='$class' type='$type' name='$name' placeholder='$placeholder' onfocus='$funcin' onfocusout='$funcout'>";
		}
	}
	function display_table($id, $class, $type/*password or text or email*/, $name, $placeholder, $required_flag/*0 or 1 */, $min, $max, $disabled_flag, $maximum_value)
	{
		if ($disabled_flag == 1) {
			if ($required_flag == 1) {
				echo "<input id='$id' class='$class' type='$type' name='$name' placeholder='$placeholder' min='$min' max='$max' onkeyup=validate(this,$maximum_value) onfocusout=validate_focus(this,$maximum_value) disabled required>";
			} else {
				echo "<input id='$id' class='$class' type='$type' name='$name' placeholder='$placeholder' min='$min' max='$max' onkeyup=validate(this,$maximum_value) onfocusout=validate_focus(this,$maximum_value) disabled>";
			}
		} else {
			if ($required_flag == 1) {
				echo "<input id='$id' class='$class' type='$type' name='$name' placeholder='$placeholder' min='$min' max='$max' onkeyup=validate(this,$maximum_value) onfocusout=validate_focus(this,$maximum_value) required>";
			} else {
				echo "<input id='$id' class='$class' type='$type' name='$name' placeholder='$placeholder' min='$min' max='$max' onkeyup=validate(this,$maximum_value) onfocusout=validate_focus(this,$maximum_value) >";
			}
		}
	}
	function display_w_value_table($id, $class, $type/*password or text or email*/, $name, $placeholder, $required_flag/*0 or 1 */, $min, $max, $disabled_flag, $maximum_value, $value)
	{
		if ($disabled_flag == 1) {
			if ($required_flag == 1) {
				echo "<input id='$id' class='$class' type='$type' name='$name' placeholder='$placeholder' min='$min' max='$max' onkeyup=validate(this,$maximum_value) onfocusout=validate_focus(this,$maximum_value) disabled required value='$value'>";
			} else {
				echo "<input id='$id' class='$class' type='$type' name='$name' placeholder='$placeholder' min='$min' max='$max' onkeyup=validate(this,$maximum_value) onfocusout=validate_focus(this,$maximum_value) disabled value='$value'>";
			}
		} else {
			if ($required_flag == 1) {
				echo "<input id='$id' class='$class' type='$type' name='$name' placeholder='$placeholder' min='$min' max='$max' onkeyup=validate(this,$maximum_value) onfocusout=validate_focus(this,$maximum_value) required value='$value'>";
			} else {
				echo "<input id='$id' class='$class' type='$type' name='$name' placeholder='$placeholder' min='$min' max='$max' onkeyup=validate(this,$maximum_value) onfocusout=validate_focus(this,$maximum_value) value='$value'>";
			}
		}
	}

	function display_table_readonly($id, $class, $type/*password or text or email*/, $name, $placeholder, $required_flag/*0 or 1 */, $min, $max, $readonly_flag, $maximum_value)
	{
		if ($readonly_flag == 1) {
			if ($required_flag == 1) {
				echo "<input id='$id' class='$class' type='$type' name='$name' placeholder='$placeholder' min='$min' max='$max' onkeyup=validate(this,$maximum_value) onfocusout=validate_focus(this,$maximum_value) readonly required>";
			} else {
				echo "<input id='$id' class='$class' type='$type' name='$name' placeholder='$placeholder' min='$min' max='$max' onkeyup=validate(this,$maximum_value) onfocusout=validate_focus(this,$maximum_value) readonly>";
			}
		} else {
			if ($required_flag == 1) {
				echo "<input id='$id' class='$class' type='$type' name='$name' placeholder='$placeholder' min='$min' max='$max' onkeyup=validate(this,$maximum_value) onfocusout=validate_focus(this,$maximum_value) required>";
			} else {
				echo "<input id='$id' class='$class' type='$type' name='$name' placeholder='$placeholder' min='$min' max='$max' onkeyup=validate(this,$maximum_value) onfocusout=validate_focus(this,$maximum_value) >";
			}
		}
	}
	function display_table_readonly_w_value($id, $class, $type/*password or text or email*/, $name, $placeholder, $required_flag/*0 or 1 */, $min, $max, $readonly_flag, $maximum_value, $value)
	{
		if ($readonly_flag == 1) {
			if ($required_flag == 1) {
				echo "<input id='$id' class='$class' type='$type' name='$name' placeholder='$placeholder' min='$min' max='$max' onkeyup=validate(this,$maximum_value) onfocusout=validate_focus(this,$maximum_value) readonly required value='$value'>";
			} else {
				echo "<input id='$id' class='$class' type='$type' name='$name' placeholder='$placeholder' min='$min' max='$max' onkeyup=validate(this,$maximum_value) onfocusout=validate_focus(this,$maximum_value) readonly value='$value'>";
			}
		} else {
			if ($required_flag == 1) {
				echo "<input id='$id' class='$class' type='$type' name='$name' placeholder='$placeholder' min='$min' max='$max' onkeyup=validate(this,$maximum_value) onfocusout=validate_focus(this,$maximum_value) required value='$value'>";
			} else {
				echo "<input id='$id' class='$class' type='$type' name='$name' placeholder='$placeholder' min='$min' max='$max' onkeyup=validate(this,$maximum_value) onfocusout=validate_focus(this,$maximum_value) value='$value'>";
			}
		}
	}
	function display_table_btn($id, $class, $type/*password or text or email*/, $name, $placeholder, $required_flag/*0 or 1 */, $min, $max, $disabled_flag, $maximum_value, $value, $actual_value)
	{
		if ($disabled_flag == 1) {
			if ($required_flag == 1) {
				echo "<button id='$id' class='$class' type='$type' name='$name' placeholder='$placeholder' min='$min' max='$max' onkeyup=validate(this,$maximum_value) onfocusout=validate_focus(this,$maximum_value) disabled required value='$value'> $actual_value </button>";
			} else {
				echo "<button id='$id' class='$class' type='$type' name='$name' placeholder='$placeholder' min='$min' max='$max' onkeyup=validate(this,$maximum_value) onfocusout=validate_focus(this,$maximum_value) disabled value='$value'> $actual_value </button>";
			}
		} else {
			if ($required_flag == 1) {
				echo "<button id='$id' class='$class' type='$type' name='$name' placeholder='$placeholder' min='$min' max='$max' onkeyup=validate(this,$maximum_value) onfocusout=validate_focus(this,$maximum_value) required value='$value'> $actual_value </button>";
			} else {
				echo "<button id='$id' class='$class' type='$type' name='$name' placeholder='$placeholder' min='$min' max='$max' onkeyup=validate(this,$maximum_value) onfocusout=validate_focus(this,$maximum_value) value='$value'> $actual_value </button>";
			}
		}
	}

	function display_textarea($id, $class/*password or text or email*/, $name, $placeholder, $rows, $cols, $required_flag/*0 or 1 */ )
	{
		if ($required_flag == 1) {
			echo "<textarea id='$id' class='$class' name='$name' placeholder='$placeholder' required rows='$rows' cols='$cols' style='resize:none'></textarea>";
		} else {
			echo "<textarea id='$id' class='$class' name='$name' placeholder='$placeholder' rows='$rows' cols='$cols' style='resize:none'>
			</textarea>";
		}
	}

}

class input_button
{
	function display($id, $class, $type, $name, $onclick, $value)
	{
		echo "<input id='$id' class='$class' type='$type' name='$name' onclick='$onclick' value='$value'>";
	}
	function display_btn($id, $class, $type, $name, $onclick, $value)
	{
		echo "<button id='$id' class='$class' type='$type' name='$name' onclick='$onclick'>$value</button>";
	}
}

class input_check
{
	private $value;
	public function input_safe($conn, $post_input)
	{
		$this->value = (mysqli_real_escape_string($conn, htmlentities(strip_tags($post_input))));

		return $this->value;
	}
}

class alert
{
	function exec($msg, $class)
	{
		echo (' <div class="alert alert-' . $class . ' fade in alert-styled" id="err" style="position:fixed; top:0;left:0;z-index:200; width:100%; text-align:center">' . $msg . '<span class="close-alert" data-dismiss="alert" style="font-size:2.6rem">&times</span></div>');
		$this->log_message($msg, $class);
	}
	function session_notification($sess_val, $succ_msg, $fail_msg)
	{
		if (isset($_SESSION[$sess_val])) {
			if ($_SESSION[$sess_val] == true) {
				$alert = new alert();
				$alert->exec($succ_msg, "success");

			} else {
				$alert = new alert();
				$alert->exec($fail_msg, "danger");

			}
			unset($_SESSION[$sess_val]);
		}
	}
	function log_message($msg, $type)
	{
		if ($type == "danger" or $type == "warning") {
			require('config.php');
			$insert_log = "INSERT INTO logs(message,type) VALUES('$msg','$type')";
			$insert_log_run = mysqli_query($conn, $insert_log);

		}
	}
}

class initial
{
	function initialise($conn)
	{
		
/*		if(isset($_SESSION['start_flag'])){
			//do nothing
		}
		else{
			$_SESSION['start_flag']=0;
		}*/ //to be deleted
		//echo($_SESSION['start_flag']);
		//if($_SESSION['start_flag']==0) //initialise this session variable at the time when the user clicks the register button!
		if (isset($_SESSION['pointer'])) {
			//do nothing
		} else {
			$semester = $_SESSION['selected_semester'];
			$first_row = "SELECT roll_id from roll_list where enrol_no IN(select enrol_no from students where course_id=" . $_SESSION['current_course_id'] . ") AND semester=" . $semester;
			$first_row_run = mysqli_query($conn, $first_row);
			$i = 1;
			while ($first_row_result = mysqli_fetch_assoc($first_row_run)) {
				$_SESSION['valid_roll'][$i] = $first_row_result['roll_id'];
				$i++;
			}
			$_SESSION['pointer'] = 1;
			$_SESSION['final_ptr'] = $i - 1;
			$data_table = new data_table();
			$data_table->get_subject_id($conn);
		}
	}
}
class click
{
	function next_prev_submit()
	{
		/*$check_uptime = new uptime;
		$check_uptime->execute($conn);*/ //To be replaced
		$temp_pointer = $_SESSION['pointer'];
		if (($temp_pointer == 1 and isset($_POST['prev'])) or ($temp_pointer == $_SESSION['final_ptr'] and isset($_POST['next']))) {
			$_POST = array();
		}
		if (isset($_POST['next'])) {
			$pointertemp = $_SESSION['pointer'];
		//	echo($pointertemp);
			$pointertemp++;
		//	echo($pointertemp);
			$_SESSION['pointer'] = $pointertemp;
		//	echo($_SESSION['pointer'])

		} else if (isset($_POST['prev'])) {
			$pointertemp = $_SESSION['pointer'];
			$pointertemp--;
			$_SESSION['pointer'] = $pointertemp;
		}
	}
}

class form_receive
{
	public function login()
	{

		$alert = new alert();
		if (isset($_POST['login'])) //check button click
		{
			if (!isset($_SESSION['remaining_attempts'])) {
				$_SESSION['remaining_attempts'] = 4;
			}
			require("config.php");
			$form_input_check = new input_check();
			$username = $form_input_check->input_safe($conn, $_POST['username']); //preventing SQL injection //name of the input field should be username
			$password = md5($form_input_check->input_safe($conn, $_POST['password']));//preventing SQL injection //name of the input field should be password
			$check_locked_qry = "SELECT locked from operators where operator_username='" . $username . "'";
			$check_locked_qry_run = mysqli_query($conn, $check_locked_qry);
			$locked = mysqli_fetch_assoc($check_locked_qry_run);
			$locked = $locked['locked'];
			if ($locked == 1) {
				$alert->exec("Your account is locked for security reasons! Please contact the superadmin to unlock your account!", "warning");
			} else {
				$login_query = "SELECT * FROM operators WHERE operator_username='$username' AND operator_password='$password'";
				$login_query_run = mysqli_query($conn, $login_query);

				if ($login_query_run) {
					if (mysqli_num_rows($login_query_run) == 1) {
						$operator_data = $login_query_run->fetch_assoc();
						 //creating session//values of id, name and username
						$_SESSION['operator_id'] = $operator_data['operator_id'];
						$_SESSION['operator_name'] = $operator_data['operator_name'];
						$_SESSION['operator_username'] = $username;
						$update_operator_active_qry = "UPDATE operators set operator_active=1 where operator_id=" . $_SESSION['operator_id'];
						$update_operator_active_qry_run = mysqli_query($conn, $update_operator_active_qry);
						$token = new csrf_token();
						$token->create_token();
						header('location: /ems/includes/home');
						unset($_SESSION['remaining_attempts']);
					} else {
						$_SESSION['remaining_attempts']--;
						if ($_SESSION['remaining_attempts'] == 0) {
							$update_locked_qry = "UPDATE operators set locked=1 where operator_username='" . $username . "'";
							$update_locked_qry_run = mysqli_query($conn, $update_locked_qry);
							if ($update_locked_qry_run && mysqli_affected_rows($conn) > 0) {
								$alert->exec("Your account is locked for security reasons! Please contact the superadmin to unlock your account!", "warning");
								session_destroy();
							} else {
								$alert->exec("You are not registered with the portal!", "info");
								session_destroy();
							}
						} else {
							$alert->exec("Please check your username or password! <b>" . $_SESSION['remaining_attempts'] . " attempts remaining!</b>", "danger");
						}

					}
				} else {
					$alert->exec("Unable to connect to the server!", "danger");
				}
			}

		}
	}
	function super_login()
	{

		$alert = new alert();
		if (isset($_POST['superlogin'])) //check button click
		{
			require("config.php");
			$form_input_check = new input_check();
			$username = md5($form_input_check->input_safe($conn, $_POST['username'])); //preventing SQL injection //name of the input field should be username
			$password = md5($form_input_check->input_safe($conn, $_POST['password']));//preventing SQL injection //name of the input field should be password
			$login_query = "SELECT * FROM super_admin WHERE super_admin_username='$username' AND super_admin_password='$password'";
			$login_query_run = mysqli_query($conn, $login_query);

			if ($login_query_run) {

				if (mysqli_num_rows($login_query_run) == 1) {
					$operator_data = $login_query_run->fetch_assoc();
					 //creating session//values of id, name and username
					$_SESSION['super_admin_id'] = $operator_data['super_admin_id'];
					$_SESSION['super_admin_name'] = $operator_data['super_admin_name'];
					$_SESSION['super_admin_username'] = $username;
					$update_active = "UPDATE super_admin SET active_flag=1 WHERE super_admin_id=" . $operator_data['super_admin_id'];
					$update_active = mysqli_query($conn, $update_active);
					$token = new csrf_token();
					$token->create_token();
					header('location: /ems/includes/super_home');
				} else {
					$alert->exec("Please check your username or password!", "danger");
				}
			} else {
				$alert->exec("Unable to connect to the server!", "danger");
			}
		}
	}
}
class course
{
	function randomize()
	{
		//$colors = ["blue", "red", "green", "yellow", "pink"];
		//$i = mt_rand(0, 4);
		//return $colors[$i];
		return "chayanraghav_class_blue";
	}



	function display($conn)
	{
		echo ('<div class="display_courses">
			<form action="select_course" method="post"> 
				<div class="tcaption"> 	COURSE SELECTION <br></div>');
				//UG list
		$ug_list_query = "SELECT * FROM courses where level_id=1";
		$ug_l_run = mysqli_query($conn, $ug_list_query);

		$pg_list_query = "SELECT * FROM courses where level_id=2";
		$pg_l_run = mysqli_query($conn, $pg_list_query);

		echo ('<div class="c_ug_pg col-sm-12 col-xs-12 col-lg-12">');
		echo ('<div class="course_list col-sm-6 col-xs-6 col-lg-6">
						<div class="level_head">Undergraduate</div>');
		while ($ug_course = mysqli_fetch_assoc($ug_l_run)) {
			$course_id = $ug_course['course_id'];
			$course_name = $ug_course['course_name'];
			$button = new input_button();
			$button->display("s_c", "course " . $this->randomize(), "submit", $course_id, "", $course_name);   //$id,$class,$type,$name,$onclick,$value
		}
		echo ('</div>');
					//UG list close
					//PG list

		echo ('<div class="course_list col-sm-6 col-xs-6 col-lg-6">
						<div class="level_head">Postgraduate</div>');
		while ($pg_course = mysqli_fetch_assoc($pg_l_run)) {
			$course_id = $pg_course['course_id'];
			$course_name = $pg_course['course_name'];
			$button = new input_button();
			$button->display("s_c", "course " . $this->randomize(), "submit", $course_id, "", $course_name);   //$id,$class,$type,$name,$onclick,$value
		}
		echo ('</div>');
		echo ('</div>');
				//UG list close
		echo ('</form>
		</div>
		<center><div class="main-container" style="width:40%; margin-bottom:100px;">
    <div class="sub-container">
		<button class="option dark_red" data-toggle="modal" data-target="#add_roll_list_modal"><i style="font-size:36px;"class="fa fa-vcard-o"></i>Student Registration Section</button>
		</div>
		</div></center>
		<!-- Add Roll List Modal Box Start -->


<!-- Modal -->
<div id="add_roll_list_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    <form action="add_roll_list" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Student Registration Section
			<p style="font-size:12px;">
				Academic Semester |
				Main Exam |
				Retotaling |
				Revaluation |
				ATKT
			</p>
		</h4>
		
      </div>
      <div class="modal-body">
			<div class="form-group">
				<label for="register_for_type">Type </label>
				<select id="register_for_type" name="register_for_type" class="form-control" required>
					<option value="" disabled selected>Select Type</option>
					<option value="1" >Academic Semester</option>
					<option value="2" >Main</option>
					<option value="3" >Retotaling</option>
					<option value="4" >Revaluation</option>
					<option value="5" >ATKT</option>

				</select>
			</div>
			
	  		<div class="form-group">
                <label for="roll_course">Course: </label>
                <select id="roll_course_list" name="roll_course" class="form-control" onChange="roll_get_batch(this.value)" required>
                    <option value="" disabled selected>Select Course</option>');
		$get_roll_course = "SELECT course_id, course_name FROM courses";
		$get_roll_course_run = mysqli_query($conn, $get_roll_course);
		if ($get_roll_course_run) {
			while ($roll_courses = mysqli_fetch_assoc($get_roll_course_run)) {
				echo ('<option value="' . $roll_courses['course_id'] . '">' . $roll_courses['course_name'] . '</option>');
			}
		}
		echo ('</select>
            </div>   
            <div class="form-group">
                <label for="roll_batch">Batch (From Year): </label>
                <select id="roll_batch_list" name="roll_batch" class="form-control" onChange="roll_get_semester(this.value)" required>
                    <option value="" disabled selected>Select batch</option>
                </select>
            </div>
            <div class="form-group">
                <label for="roll_semester">Semester: </label>
                <select id="roll_semester_list" name="roll_semester" class="form-control" required>
                    <option value="" disabled selected>Select Semester</option>
                </select>
            </div>
	  </div>
	  <div class="well" style="margin:10px; background-color:#F45D3D; color:white; font-size:20px;">Please make sure you do not register the same candidate more than once for the same Examination!!</div>
	  <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success" name="proceed_to_add_roll">Proceed</button>
      </div>
      </form>
    </div>

  </div>
</div>
<!-- Add Roll List Modal Box Close -->
		');
	}
}
class super_user_options
{
	function create_course($conn)
	{
		$input_chk = new input_check();
		$alert = new alert();
		if (isset($_POST['course_submit'])) {
			$post_lvl = $input_chk->input_safe($conn, $_POST['level']);
			if (empty($post_lvl)) {
				return;
			}
			$level = 0;
			switch ($post_lvl) {
				case 'ug':
					$level = 1;
					break;
				case 'pg':
					$level = 2;
					break;
			}
			$course_name = $input_chk->input_safe($conn, $_POST['cname']);
			$course_duration = $input_chk->input_safe($conn, $_POST['cduration']);
			$prog_name = $input_chk->input_safe($conn, $_POST['prog_name']);
			$branch_name = $input_chk->input_safe($conn, $_POST['branch_name']);
			$school_id = $input_chk->input_safe($conn, $_POST['cmb_schoolname']);
			if (empty($branch_name) or empty($prog_name) or empty($course_duration) or is_nan($course_duration)) {
				return;
			}
			$check_course_exists_qry = "SELECT count(*) from courses WHERE level_id=$level AND course_name='" . $course_name . "' AND duration=" . $course_duration;
			$check_course_exists_qry_run = mysqli_query($conn, $check_course_exists_qry);
			if ($check_course_exists_qry_run) {
				$num_rows = mysqli_fetch_assoc($check_course_exists_qry_run);
				if ($num_rows['count(*)'] > 0) {
					$alert->exec("Course already exists!", "warning");
					return;
				}
			}

			$create_course_qry = "INSERT into courses(school_id,level_id,course_name,duration) VALUES($school_id,$level,'" . $course_name . "'," . $course_duration . ")";
			$create_course_qry_run = mysqli_query($conn, $create_course_qry);
			if ($create_course_qry_run) {
				$course_id = mysqli_insert_id($conn);
				$create_branch_qry = "INSERT into branches VALUES($course_id,'" . $prog_name . "','" . $branch_name . "')";
				$create_branch_qry_run = mysqli_query($conn, $create_branch_qry);
				if ($create_branch_qry_run) {
					$_SESSION['course_inserted'] = $course_name;
					$_SESSION['semester'] = $course_duration * 2;
					$alert->exec('Course successfully added! <a data-toggle="modal" data-target="#addcourseModal">Add another course <i class="glyphicon glyphicon-circle-arrow-right"></i></a>', "success");
				} else {
					$alert->exec("Unable to process query! Please try again", "danger");
				}
			} else {
				$alert->exec("Unable to process query! Please try again", "danger");
			}
		}

	}
	function create_exam_month_year($conn)
	{
		if (isset($_POST['set_exam_month'])) {
			$input_chk = new input_check();
			$courses_selected = $_POST['cmb_course_month_year'];
			$month = $input_chk->input_safe($conn, $_POST['month']);
			$year = $input_chk->input_safe($conn, $_POST['year']);
			$get_sessions = "SELECT * FROM academic_sessions";
			$get_sessions_run = mysqli_query($conn, $get_sessions);
			$session_rows = mysqli_affected_rows($conn);
			$i = 1;
			$executed = true;
			$alert = new alert();
			foreach ($courses_selected as $session_id) {
				$check_exam_month_exists = "SELECT count(*) FROM exam_month_year WHERE session_id=$session_id AND type_flag=0";
				$check_exam_month_exists_run = mysqli_query($conn, $check_exam_month_exists);
				if (mysqli_fetch_assoc($check_exam_month_exists_run)['count(*)'] > 0) {
					$alert->exec("Exam slot already selected!", "warning");
					$executed = false;
				} else {
					$insert_exam_details = "INSERT INTO exam_month_year VALUES ($session_id,'" . $month . " " . $year . "',0)";
					$insert_exam_details_run = mysqli_query($conn, $insert_exam_details);
					if (!$insert_exam_details_run) {
						$executed = false;
					}
				}
			}
			if ($executed) {
				$alert->exec("New exam slots successfully created!", "success");
			} else {
				$alert->exec("Unable to allot exam slots!", "danger");
			}

		}
	}
	function add_subject($conn)
	{
		if (isset($_POST['add_sub_submit'])) {
			$input_chk = new input_check();
			$alert = new alert();
			$success = false;
			$no_of_sub = $input_chk->input_safe($conn, $_POST['number_subjects']);
			$course_id = $input_chk->input_safe($conn, $_POST['mcourse']);
			$semester = $input_chk->input_safe($conn, $_POST['msemester']);
			$ay = $input_chk->input_safe($conn, $_POST['myear']);
			if (empty($no_of_sub) or empty($course_id) or empty($semester) or is_nan($semester) or is_nan($no_of_sub)) {
				return;
			}
			mysqli_autocommit($conn, false);
			mysqli_begin_transaction($conn);
			$get_ac_session_qry = "SELECT ac_session_id FROM academic_sessions WHERE from_year=$ay AND course_id=$course_id AND current_semester=$semester";
			$get_ac_session_qry_run = mysqli_query($conn, $get_ac_session_qry);
			if (mysqli_num_rows($get_ac_session_qry_run) == 1) {
				$ac_session = mysqli_fetch_assoc($get_ac_session_qry_run)['ac_session_id'];
			} else {
				return;
			}
			for ($i = 1; $i <= $no_of_sub; $i++) {
				$subcode = $input_chk->input_safe($conn, $_POST['subcode' . $i]);
				$check_sub_exists_qry = "SELECT count(*) from subjects where sub_code='" . $subcode . "' AND ac_session_id=$ac_session";
				$check_sub_exists_qry_run = mysqli_query($conn, $check_sub_exists_qry);
				if ($check_sub_exists_qry_run) {
					$get_count = mysqli_fetch_assoc($check_sub_exists_qry_run);
					if ($get_count['count(*)'] > 0) {
						$alert->exec("Subject with subject code " . $subcode . " already exists!", "warning");
						continue;
					}
				}
				$subname = $input_chk->input_safe($conn, $_POST['subname' . $i]);
				$type = $_POST['type' . $i];
				if (isset($_POST['theory' . $i])) {
					$theory_cr = $_POST['theory' . $i];
					if ($theory_cr == 0) {
						$alert->exec("Theory credits cannot be 0!", "warning");
						return;
					}
				} else {
					$theory_cr = 0;
				}
				if (isset($_POST['practical' . $i])) {
					$practical_cr = $_POST['practical' . $i];
					if ($practical_cr == 0) {
						$alert->exec("Practical credits cannot be 0!", "warning");
						return;
					}
				} else {
					$practical_cr = 0;
				}
				$total_cr = $input_chk->input_safe($conn, $_POST['total' . $i]);
				$cat_pass = $input_chk->input_safe($conn, $_POST['pass1']);
				$cat_max = $input_chk->input_safe($conn, $_POST['max1']);
				$end_theory_pass = $input_chk->input_safe($conn, $_POST['pass2']);
				$end_theory_max = $input_chk->input_safe($conn, $_POST['max2']);
				$cap_pass = $input_chk->input_safe($conn, $_POST['pass3']);
				$cap_max = $input_chk->input_safe($conn, $_POST['max3']);
				$end_practical_pass = $input_chk->input_safe($conn, $_POST['pass4']);
				$end_practical_max = $input_chk->input_safe($conn, $_POST['max4']);
				$ia_pass = $input_chk->input_safe($conn, $_POST['pass5']);
				$ia_max = $input_chk->input_safe($conn, $_POST['max5']);
				$ie_pass = $input_chk->input_safe($conn, $_POST['pass6']);
				$ie_max = $input_chk->input_safe($conn, $_POST['max6']);
				if (isset($_POST['ie' . $i])) {
					if (empty($cat_pass) or empty($cat_max) or empty($end_theory_pass) or empty($end_theory_max) or empty($cap_pass) or empty($cap_max) or empty($end_practical_pass) or empty($end_practical_max) or empty($ia_pass) or empty($ia_max) or empty($ie_pass) or empty($ie_max)) {
						$alert->exec("Please verify all fields!", "danger");
						return;
					}
				} else if (empty($total_cr) or empty($cat_pass) or empty($cat_max) or empty($end_theory_pass) or empty($end_theory_max) or empty($cap_pass) or empty($cap_max) or empty($end_practical_pass) or empty($end_practical_max) or empty($ia_pass) or empty($ia_max) or empty($ie_pass) or empty($ie_max)) {
					$alert->exec("Please verify all fields!", "danger");
					return;
				}
				if (isset($_POST['elective' . $i])) {
					$elective = 1;
				} else {
					$elective = 0;
				}
				if (isset($_POST['ie' . $i])) {
					$ie = 1;
					$theory_cr = 0;
					$practical_cr = 0;
					$total_cr = 0;
					$add_subject_qry = "INSERT into subjects(sub_code,sub_name,total_credits,ie_flag,elective_flag,ac_session_id) values('" . $subcode . "','" . $subname . "'," . $total_cr . "," . $ie . "," . $elective . ",$ac_session)";
					$add_subject_qry_run = mysqli_query($conn, $add_subject_qry);
					if ($add_subject_qry_run) {
						$ac_sub_code = mysqli_insert_id($conn);
						$sub_distribution_qry = "INSERT into sub_distribution(practical_flag,credits_allotted,ac_sub_code) VALUES(2,0,$ac_sub_code)";
						$sub_distribution_qry_run = mysqli_query($conn, $sub_distribution_qry);
						if ($sub_distribution_qry_run) {
							$get_sub_id_qry = "SELECT * from sub_distribution where ac_sub_code=$ac_sub_code";
							$get_sub_id_qry_run = mysqli_query($conn, $get_sub_id_qry);
							if ($get_sub_id_qry_run) {
								$row = mysqli_fetch_assoc($get_sub_id_qry_run);
								$comp_distribution_qry = "INSERT into component_distribution VALUES(6," . $row['sub_id'] . "," . $ie_pass . "," . $ie_max . ")";
								$comp_distribution_qry_run = mysqli_query($conn, $comp_distribution_qry);
								if ($comp_distribution_qry_run) {
									$success = true;
								} else {
									$success = false;
								}
							}
						}
					}
				} else {
					$ie = 0;
					$add_subject_qry = "INSERT into subjects(sub_code,sub_name,total_credits,ie_flag,elective_flag,ac_session_id) values('" . $subcode . "','" . $subname . "'," . $total_cr . "," . $ie . "," . $elective . ",$ac_session)";
					$add_subject_qry_run = mysqli_query($conn, $add_subject_qry);
					$ac_sub_code = mysqli_insert_id($conn);
					if ($add_subject_qry_run) {

						switch ($type) {
							case 'theory':
								$sub_distribution_qry = "INSERT into sub_distribution(practical_flag,credits_allotted,ac_sub_code) VALUES(0," . $theory_cr . ",$ac_sub_code)";
								break;

							case 'practical':
								$sub_distribution_qry = "INSERT into sub_distribution(practical_flag,credits_allotted,ac_sub_code) VALUES(1," . $practical_cr . ",$ac_sub_code)";
								break;
							case 'both':
								$sub_distribution_qry = "INSERT into sub_distribution(practical_flag,credits_allotted,ac_sub_code) VALUES(0," . $theory_cr . ",$ac_sub_code),(1," . $practical_cr . ",$ac_sub_code)";
								break;
						}
						$sub_distribution_qry_run = mysqli_query($conn, $sub_distribution_qry);
						if ($sub_distribution_qry_run) {
							$get_sub_id_qry = "SELECT * from sub_distribution where ac_sub_code=$ac_sub_code";
							$get_sub_id_qry_run = mysqli_query($conn, $get_sub_id_qry);
							if ($get_sub_id_qry_run) {
								while ($row = mysqli_fetch_assoc($get_sub_id_qry_run)) {
									if ($row['practical_flag'] == 0) {
										$comp_distribution_qry = "INSERT into component_distribution VALUES(1," . $row['sub_id'] . "," . $cat_pass . "," . $cat_max . "),(2," . $row['sub_id'] . "," . $end_theory_pass . "," . $end_theory_max . ")";
									} else {
										$comp_distribution_qry = "INSERT into component_distribution VALUES(3," . $row['sub_id'] . "," . $cap_pass . "," . $cap_max . "),(4," . $row['sub_id'] . "," . $end_practical_pass . "," . $end_practical_max . "),(5," . $row['sub_id'] . "," . $ia_pass . "," . $ia_max . ")";
									}
									$comp_distribution_qry_run = mysqli_query($conn, $comp_distribution_qry);
								}
								if ($comp_distribution_qry_run) {
									$alert->exec("Records successfully inserted!", "success");
									$success = true;
								} else {
									$success = false;
									$alert->exec("Unable to distribute components", "danger");
								}

							} else {
								$success = false;
								$alert->exec("Unable to fetch subjects", "danger");
							}
						} else {
							$success = false;
							$alert->exec("Unable to distribute subjects", "danger");
						}
					} else {
						$success = false;
						$alert->exec("Unable to insert subjects! Please try again later...", "danger");
					}
				}

			}
			if ($success) {
				mysqli_commit($conn);
				mysqli_autocommit($conn, true);
				$alert->exec("Records successfully inserted!", "success");
			} else {
				mysqli_rollback($conn);
				mysqli_autocommit($conn, true);
				$alert->exec("Unable to insert subjects", "danger");
			}

		}
	}
	function update_subject($conn)
	{
		if (isset($_POST['update_sub_submit'])) {
			$input_chk = new input_check();
			$subname = $input_chk->input_safe($conn, $_POST['update_sub_name']);
			$subcode = $input_chk->input_safe($conn, $_POST['update_sub_code']);
			$update_sub = "UPDATE subjects set sub_name='$subname' WHERE sub_code='$subcode'";
			$update_sub_run = mysqli_query($conn, $update_sub);
			$alert = new alert();
			if ($update_sub_run and mysqli_affected_rows($conn) > 0) {
				$alert->exec("Subject details updated successfully!", "success");
			} else {
				$alert->exec("Unable to update subject!", "danger");

			}
		}
	}
	function create_operator($conn)
	{
		if (isset($_POST['create'])) {
			$operator_name = $_POST['operator_name'];
			$operator_email = $_POST['operator_email'];
			if ($operator_name == "") {
				$er = new alert();
				$er->exec("Please enter operator name!", "alert");
			} else if ($operator_email == "") {
				$er = new alert();
				$er->exec("Please enter operator email!", "alert");
			} else {

				$get_operator_list_query = "SELECT operator_email from operators";
				$get_op_list_query_run = mysqli_query($conn, $get_operator_list_query);
				$permit = 1;
				while ($row = mysqli_fetch_assoc($get_op_list_query_run)) {
					if ($row['operator_email'] == $operator_email) {
						$permit = 0;
					}
				}
				if ($permit == 1) {
					$i = 0;
					$j = 0;
					while ($i < strlen($operator_email)) {
						if (substr($operator_email, $i, 1) != "@") {
							$j++;
						} else {
							break;
						}
						$i++;
					}

					$operator_username = substr($operator_email, 0, $j);

					$temp_pass = substr($operator_email, 0, 2) . "" . mt_rand(1000, 9999);
					$operator_password = md5($temp_pass);
					mysqli_autocommit($conn, false);
					mysqli_begin_transaction($conn);
					$create_operator_query = "INSERT INTO operators(operator_name, operator_email, operator_username, operator_password) 
								VALUES('$operator_name', '$operator_email', '$operator_username', '$operator_password')";
					try {
						$create_query_run = mysqli_query($conn, $create_operator_query);
					} catch (Exception $e) {
						mysqli_rollback($conn);
						$er = new alert();
						$er->exec("Not able to connect to database!", "danger");
					}
					if ($create_query_run == true) {
						$er = new alert();
						$email = $operator_email;
						$username = $operator_username;
						$name = $operator_name;
						$send_pass = $temp_pass;
						require('phpmailer/sending_mail.php');
					} else {
						$er = new alert();
						$er->exec("Error while creating new operator!", "danger");
					}
				} else {
					$er = new alert();
					$er->exec("Operator already exists!", "danger");
				}
			}

		}
	}

	function lock_operator($conn)
	{
		if (isset($_POST['lock'])) {
			$alert = new alert();
			$username = $_POST['lock'];
			$update_locked_qry = "UPDATE operators set locked=1 where operator_username='" . $username . "'";
			$update_locked_qry_run = mysqli_query($conn, $update_locked_qry);
			if ($update_locked_qry_run && mysqli_affected_rows($conn) > 0) {
				$alert->exec("Operator account successfully locked!", "success");
			} else {
				$alert->exec("Unable to lock account!", "danger");
			}
		}
	}

	function unlock_operator($conn)
	{
		if (isset($_POST['unlock'])) {
			$alert = new alert();
			$username = $_POST['unlock'];
			$update_locked_qry = "UPDATE operators set locked=0 where operator_username='" . $username . "'";
			$update_locked_qry_run = mysqli_query($conn, $update_locked_qry);
			if ($update_locked_qry_run && mysqli_affected_rows($conn) > 0) {
				$alert->exec("Operator account successfully unlocked!", "success");
			} else {
				$alert->exec("Unable to unlock account!", "danger");
			}
		}
	}

	function add_session($conn)
	{
		require('config.php');
		if (isset($_POST['session_submit'])) {
			$alert = new alert();
			$type = $_POST['session_type'];
			$course_id = $_POST['session_course'];
			$from_year = $_POST['session_year'];
			$semester = $_POST['session_semester'];
			switch ($type) {
				case 'main':
					$check_session_qry = "SELECT count(*) from academic_sessions where from_year=$from_year AND course_id=$course_id AND current_semester=$semester";
					$check_session_qry_run = mysqli_query($conn, $check_session_qry);
					if ($check_session_qry_run) {
						$result_count = mysqli_fetch_assoc($check_session_qry_run);
						if ($result_count['count(*)'] == 0) {
							mysqli_autocommit($conn, false);
							$add_session_qry = "INSERT into academic_sessions(from_year,course_id,current_semester) VALUES($from_year,$course_id,$semester)";
						} else {
							mysqli_rollback($conn);
							mysqli_autocommit($conn, true);
							$alert->exec("Academic session already exists! Consider updating session..", "warning");
							return;
						}
					} else {
						return;
					}
					break;

				case 'retotal':
					$get_ac_session = "SELECT ac_session_id FROM academic_sessions WHERE from_year=$from_year AND course_id=$course_id AND current_semester=$semester";
					$get_ac_session_run = mysqli_query($conn, $get_ac_session);
					if (mysqli_num_rows($get_ac_session_run) == 0) {
						$alert->exec("Please open an academic session first!", "warning");
						return;
					} else {
						$ac_sess_id = mysqli_fetch_assoc($get_ac_session_run)['ac_session_id'];
					}
					$check_session_qry = "SELECT count(*) from $retotal.retotal_sessions where ac_session_id =$ac_sess_id";
					$check_session_qry_run = mysqli_query($conn, $check_session_qry);
					if ($check_session_qry_run) {
						$result_count = mysqli_fetch_assoc($check_session_qry_run);
						if ($result_count['count(*)'] == 0) {
							mysqli_autocommit($conn, false);
							$add_session_qry = "INSERT INTO $retotal.retotal_sessions(ac_session_id) VALUES($ac_sess_id)";
						} else {
							mysqli_rollback($conn);
							mysqli_autocommit($conn, true);
							$alert->exec("Retotalling session already exists!", "warning");
							return;
						}
					} else {
						return;
					}

					break;
				case 'reval':
					$get_ac_session = "SELECT ac_session_id FROM academic_sessions WHERE from_year=$from_year AND course_id=$course_id AND current_semester=$semester";
					$get_ac_session_run = mysqli_query($conn, $get_ac_session);
					if (mysqli_num_rows($get_ac_session_run) == 0) {
						$alert->exec("Please open an academic session first!", "warning");
						return;
					} else {
						$ac_sess_id = mysqli_fetch_assoc($get_ac_session_run)['ac_session_id'];
					}
					$check_session_qry = "SELECT count(*) from $reval.reval_sessions where ac_session_id =$ac_sess_id";
					$check_session_qry_run = mysqli_query($conn, $check_session_qry);
					if ($check_session_qry_run) {
						$result_count = mysqli_fetch_assoc($check_session_qry_run);
						if ($result_count['count(*)'] == 0) {
							mysqli_autocommit($conn, false);
							$add_session_qry = "INSERT INTO $reval.reval_sessions(ac_session_id) VALUES($ac_sess_id)";
						} else {
							mysqli_rollback($conn);
							mysqli_autocommit($conn, true);
							$alert->exec("Revaluation session already exists!", "warning");
							return;
						}
					} else {
						return;
					}
					break;
				case 'atkt':
					$get_ac_session = "SELECT ac_session_id FROM academic_sessions WHERE from_year=$from_year AND course_id=$course_id AND current_semester=$semester";
					$get_ac_session_run = mysqli_query($conn, $get_ac_session);
					if (mysqli_num_rows($get_ac_session_run) == 0) {
						$alert->exec("Please open an academic session first!", "warning");
						return;
					} else {
						$ac_sess_id = mysqli_fetch_assoc($get_ac_session_run)['ac_session_id'];
					}
					$check_session_qry = "SELECT count(*) from $atkt.atkt_sessions where ac_session_id =$ac_sess_id";
					$check_session_qry_run = mysqli_query($conn, $check_session_qry);
					if ($check_session_qry_run) {
						$result_count = mysqli_fetch_assoc($check_session_qry_run);
						if ($result_count['count(*)'] == 0) {
							mysqli_autocommit($conn, false);
							$add_session_qry = "INSERT INTO $atkt.atkt_sessions(ac_session_id) VALUES($ac_sess_id)";
							$alert->exec("ATKT session created!", "success");
						} else {
							mysqli_rollback($conn);
							mysqli_autocommit($conn, true);
							$alert->exec("ATKT session already exists!", "warning");
							return;
						}
					} else {
						return;
					}
					break;

				default:
					# code...
					break;
			}
			$add_session_qry_run = mysqli_query($conn, $add_session_qry);
			if ($add_session_qry_run) {
				mysqli_commit($conn);
				mysqli_autocommit($conn, true);
				$alert->exec("Session successfully created!", "success");
			} else {
				$alert->exec("Unable to create session!", "danger");
			}
		}
	}

	function update_session($conn)
	{
		if (isset($_POST['session_update_submit'])) {
			$alert = new alert();
			$input_chk = new input_check();
			$ay = $input_chk->input_safe($conn, $_POST['session_ay']);
			$course_id = $input_chk->input_safe($conn, $_POST['session_update_submit']);
			$semester = $input_chk->input_safe($conn, $_POST['session_semester']);
			mysqli_autocommit($conn, false);
			$update_session_qry = "UPDATE academic_sessions SET current_semester=$semester WHERE from_year=$ay AND course_id=$course_id";
			$update_session_qry_run = mysqli_query($conn, $update_session_qry);
			if ($update_session_qry_run) {
				$update_student_semester = "UPDATE students SET current_sem=$semester WHERE from_year=$ay AND course_id=$course_id";
				$update_student_semester_run = mysqli_query($conn, $update_student_semester);
				$alert->exec("Academic Session successfully updated!", "success");
			} else {
				mysqli_rollback($conn);
				mysqli_autocommit($conn, true);
				$alert->exec("Failed to update session!", "danger");
			}
		}
	}
	function approve_disapprove_edit_tr($conn)
	{
		if (isset($_POST['approve_edit_tr'])) {
			$update_edit_tr = "UPDATE edit_tr_request SET status=1 WHERE request_id=" . $_POST['approve_edit_tr'];
			$update_edit_tr_run = mysqli_query($conn, $update_edit_tr);
			if ($update_edit_tr_run == true) {
				$a = new alert();
				$a->exec("Request Approved", "success");
				unset($_POST['approve_edit_tr']);
			}
		} else if (isset($_POST['disapprove_edit_tr'])) {
			$update_edit_tr = "UPDATE edit_tr_request SET status=2 WHERE request_id=" . $_POST['disapprove_edit_tr'];
			$update_edit_tr_run = mysqli_query($conn, $update_edit_tr);
			if ($update_edit_tr_run == true) {
				$a = new alert();
				$a->exec("Request Disapproved", "danger");
				unset($_POST['disapprove_edit_tr']);
			}
		}
	}

	function message($conn)
	{
		if (isset($_POST['send_mail'])) {
			$input_chk = new input_check();
			$emails = array();
			$subject = $input_chk->input_safe($conn, $_POST['mail_sub']);
			$body = $input_chk->input_safe($conn, $_POST['mail_body']);
			$count = $_SESSION['no_operators'];
			for ($i = 0; $i < $count; $i++) {
				if (isset($_POST['op' . $i])) {
					$emails[] = $_POST['op' . $i];
				}
			}
			require('phpmailer/message_mail.php');
		}
	}

}
class GeneralOptions
{
	function start_transaction($con)
	{
		mysqli_autocommit($con, false);
		mysqli_begin_transaction($con);
	}
	function end_transaction($con)
	{
		mysqli_commit($con);
	}
	function rollback($con)
	{
		mysqli_rollback($con);
	}
}
class useroptions
{
	function display($conn)
	{
		$button1 = new input_button();
		$button2 = new input_button();
		$button3 = new input_button();
		echo ('
		<form action="" method="post">
		<div class="sem">
		<select name="semester" id="sem" class="form-control">
		');
		$option_qry = "SELECT DISTINCT(semester) as semester from roll_list r,students s where s.enrol_no=r.enrol_no AND s.course_id=" . $_SESSION['current_course_id'];
		$option_qry_run = mysqli_query($conn, $option_qry);
		if ($option_qry_run) {
			while ($opt = mysqli_fetch_assoc($option_qry_run)) {
				echo ('<option value=' . $opt['semester'] . '>Semester ' . $opt['semester'] . '</option>');
			}
		}

		echo ('
	  </select>
	  </div>
			  <div class="cr_container">
			  <div class="cr_restrict">
					 ');
				// $button1->display_btn("border-div","course","submit","generate","",'Generate Marksheet <i class="glyphicon glyphicon-copy" style="margin-left: 10px;"></i>');
		$button1->display_btn("border-div", "course", "submit", "feed", "", 'Feed Marks <i class="glyphicon glyphicon-download-alt" style="margin-left: 10px;"></i>');
		$button1->display_btn("border-div", "course", "submit", "view", "", 'View Marks <i class="glyphicon glyphicon-eye-open" style="margin-left: 10px;"></i>');
		echo ('</div>
			  </div>
			  </form>');
	}
	function check_opt()
	{
		if (isset($_POST['generate'])) {
			$_SESSION['selected_semester'] = $_POST['semester'];
			header('location: generate');
		} else if (isset($_POST['feed'])) {
			$_SESSION['selected_semester'] = $_POST['semester'];
			header('location: feed');
		} else if (isset($_POST['view'])) {
			$_SESSION['selected_semester'] = $_POST['semester'];
			header('location: view');
		}
	}
	function insert_main_marks($conn)
	{
		if (isset($_POST['feed_marks'])) {
			$alert = new alert();
			$operator_id = $_SESSION['operator_id'];
			$form_input_check = new input_check();
			$sqltransact = new GeneralOptions();
			$sqltransact->start_transaction($conn);
			$remark = $form_input_check->input_safe($conn, $_POST['remark']);
			if (empty($remark)) {
				$alert->exec("Please enter a remark!", "warning");
				$sqltransact->rollback($conn);
				return;
			}
			$transaction_qry = "INSERT into transactions(operator_id,remark) VALUES($operator_id,'$remark')";
			$transaction_qry_run = mysqli_query($conn, $transaction_qry);
			if ($transaction_qry_run) {
				$transaction_id = mysqli_insert_id($conn);
			} else {
				$sqltransact->rollback($conn);
				return;
			}
			$component_id = $_SESSION['sub_comp_id'];
			$sub_id = $_SESSION['sub_id'];

			$insert_score_qry = "INSERT INTO score VALUES ";
			for ($i = 1; $i <= $_SESSION['num_rows']; $i++) {
				$roll_id = $_SESSION['roll_id' . $i];
				$marks = $_POST['score' . $i];
				if (!isset($marks) OR is_nan($marks)) {
					$alert->exec("Please enter correct value(s) for marks!", "warning");
					$sqltransact->rollback($conn);
					return;
				}
				if ($i == $_SESSION['num_rows']) {
					$insert_score_qry .= "($roll_id,$component_id,$sub_id,$marks,$transaction_id,NULL)";
				} else {
					$insert_score_qry .= "($roll_id,$component_id,$sub_id,$marks,$transaction_id,NULL),";
				}
			}
			$insert_score_qry_run = mysqli_query($conn, $insert_score_qry);
			if ($insert_score_qry_run) {
				$audit_qry = "INSERT INTO auditing VALUES(" . $_SESSION['ac_sess_id'] . "," . $transaction_id . ",NULL,$component_id,0," . $_SESSION['ac_sub_code'] . ")";
				$audit_qry_run = mysqli_query($conn, $audit_qry);
				if ($audit_qry_run) {
					$_SESSION['score_entered_success'] = true;
					$sqltransact->end_transaction($conn);
					header('location: /ems/includes/useroptions');
				} else {
					$_SESSION['score_entered_success'] = false;
					$sqltransact->rollback($conn);
					header('location: /ems/includes/useroptions');
				}
			} else {
				$_SESSION['score_entered_success'] = false;
				$sqltransact->rollback($conn);
				header('location: /ems/includes/useroptions');
			}
		}

	}
	function insert_atkt_marks($conn)
	{
		if (isset($_POST['feed_atkt_marks'])) {
			$alert = new alert();
			$operator_id = $_SESSION['operator_id'];
			$form_input_check = new input_check();
			$sqltransact = new GeneralOptions();
			$sqltransact->start_transaction($conn);
			$remark = $form_input_check->input_safe($conn, $_POST['remark']);
			if (empty($remark)) {
				$alert->exec("Please enter a remark!", "warning");
				$sqltransact->rollback($conn);
				return;
			}
			$transaction_qry = "INSERT into transactions(operator_id,remark) VALUES($operator_id,'$remark')";
			$transaction_qry_run = mysqli_query($conn, $transaction_qry);
			if ($transaction_qry_run) {
				$transaction_id = mysqli_insert_id($conn);
			} else {
				$sqltransact->rollback($conn);
				return;
			}
			$component_id = $_SESSION['sub_comp_id'];
			$sub_id = $_SESSION['sub_id'];

			$get_atkt_roll_list = "SELECT atkt_roll_id FROM atkt_roll_list WHERE atkt_session_id=" . $_SESSION['atkt_session_id']." AND atkt_roll_id IN(SELECT atkt_roll_id FROM atkt_subjects WHERE sub_id=".$_SESSION['sub_id']." AND component_id=".$_SESSION['sub_comp_id'].")" ;
			$get_atkt_roll_list_run = mysqli_query($conn, $get_atkt_roll_list);
			$insert_score_qry = "INSERT INTO score_atkt VALUES ";
			$i = 1;
			while ($atkt_roll = mysqli_fetch_assoc($get_atkt_roll_list_run)) {
				$atkt_roll_id = $atkt_roll['atkt_roll_id'];
				$marks = $_POST['score' . $i];
				if (!isset($marks) OR is_nan($marks)) {
					$alert->exec("Please enter correct value(s) for marks!", "warning");
					$sqltransact->rollback($conn);
					return;
				}
				if ($i == $_SESSION['num_rows']) {
					$insert_score_qry .= "($atkt_roll_id,$component_id,$sub_id,$marks,$transaction_id,NULL)";
				} else {
					$insert_score_qry .= "($atkt_roll_id,$component_id,$sub_id,$marks,$transaction_id,NULL),";
				}
				$i++;
			}

			$insert_score_qry_run = mysqli_query($conn, $insert_score_qry);
			if ($insert_score_qry_run) {
				$audit_qry = "INSERT INTO auditing VALUES(" . $_SESSION['atkt_session_id'] . "," . $transaction_id . ",NULL,$component_id,3," . $_SESSION['ac_sub_code'] . ")";
				$audit_qry_run = mysqli_query($conn, $audit_qry);
				if ($audit_qry_run) {
					$_SESSION['score_entered_success'] = true;
					$sqltransact->end_transaction($conn);
					header('location: /ems/includes/useroptions');
				} else {
					$_SESSION['score_entered_success'] = false;
					$sqltransact->rollback($conn);
					header('location: /ems/includes/useroptions');
				}
			} else {
				$_SESSION['score_entered_success'] = false;
				$sqltransact->rollback($conn);
				header('location: /ems/includes/useroptions');
			}
		}

	}
	function insert_retotal_marks($conn)
	{
		if (isset($_POST['feed_retotal_marks'])) {
			$alert = new alert();
			$operator_id = $_SESSION['operator_id'];
			$form_input_check = new input_check();
			$sqltransact = new GeneralOptions();
			$sqltransact->start_transaction($conn);
			$remark = $form_input_check->input_safe($conn, $_POST['remark']);
			if (empty($remark)) {
				$alert->exec("Please enter a remark!", "warning");
				$sqltransact->rollback($conn);
				return;
			}
			$transaction_qry = "INSERT into transactions(operator_id,remark) VALUES($operator_id,'$remark')";
			$transaction_qry_run = mysqli_query($conn, $transaction_qry);
			if ($transaction_qry_run) {
				$transaction_id = mysqli_insert_id($conn);
			} else {
				$sqltransact->rollback($conn);
				return;
			}
			$component_id = $_SESSION['sub_comp_id'];
			$sub_id = $_SESSION['sub_id'];

			$get_retotal_roll_list = "SELECT retotal_roll_id,roll_id FROM retotal_roll_list WHERE retotal_session_id=" . $_SESSION['retotal_session_id']." AND retotal_roll_id IN(SELECT retotal_roll_id FROM retotal_subjects WHERE sub_id=".$_SESSION['sub_id'].")";
			$get_retotal_roll_list_run = mysqli_query($conn, $get_retotal_roll_list);
			$insert_score_qry = "INSERT INTO score_retotal VALUES ";
			$i = 1;
			while ($retotal_roll = mysqli_fetch_assoc($get_retotal_roll_list_run)) {
				$get_prev_marks = "SELECT marks FROM score WHERE roll_id=" . $retotal_roll['roll_id'] . " AND sub_id=$sub_id AND component_id=$component_id";
				$get_prev_marks_run = mysqli_query($conn, $get_prev_marks);
				$prev_marks = mysqli_fetch_assoc($get_prev_marks_run)['marks'];
				if (!isset($prev_marks) OR is_nan($prev_marks)) {
					$alert->exec("Please make sure the process of MAIN is complete before feeding retotalling marks!", "info");
					$sqltransact->rollback($conn);
					return;
				}

				$retotal_roll_id = $retotal_roll['retotal_roll_id'];
				$marks = $_POST['score' . $i];
				if (!isset($marks) or is_nan($marks)) {
					$alert->exec("Please enter correct value(s) for marks!", "warning");
					$sqltransact->rollback($conn);
					return;
				}
				$status_changed = 1; //1 for no change, 0 for decrease, 2 for increase
				if ($marks > $prev_marks) {
					$status_changed = 2;
				} else if ($marks == $prev_marks) {
					$status_changed = 1;
				} else {
					$status_changed = 0;
				}
				if ($i == $_SESSION['num_rows']) {
					$insert_score_qry .= "($retotal_roll_id,$component_id,$sub_id,$marks,$transaction_id,NULL,$status_changed)";
				} else {
					$insert_score_qry .= "($retotal_roll_id,$component_id,$sub_id,$marks,$transaction_id,NULL,$status_changed),";
				}
				$i++;
			}

			$insert_score_qry_run = mysqli_query($conn, $insert_score_qry);
			if ($insert_score_qry_run) {
				$audit_qry = "INSERT INTO auditing VALUES(" . $_SESSION['retotal_session_id'] . "," . $transaction_id . ",NULL,$component_id,1," . $_SESSION['ac_sub_code'] . ")";
				$audit_qry_run = mysqli_query($conn, $audit_qry);
				if ($audit_qry_run) {
					$_SESSION['score_entered_success'] = true;
					$sqltransact->end_transaction($conn);
					header('location: /ems/includes/useroptions');
				} else {
					$_SESSION['score_entered_success'] = false;
					$sqltransact->rollback($conn);
					header('location: /ems/includes/useroptions');
				}
			} else {
				$_SESSION['score_entered_success'] = false;
				$sqltransact->rollback($conn);
				header('location: /ems/includes/useroptions');
			}
		}

	}

	function request_tr_update($conn)
	{
		if (isset($_POST['update_tr_submit'])) {
			$alert = new alert();
			$input_chk = new input_check();
			$rollid = $input_chk->input_safe($conn, $_POST['tr_req_roll_id']);
			$requester = $_SESSION['operator_id'];
			$remark = $input_chk->input_safe($conn, $_POST['tr_req_remark']);
			$subcode = $input_chk->input_safe($conn, $_POST['tr_req_subject']);
			$ac_sess_id = $input_chk->input_safe($conn, $_POST['ac_sess_id']);
			if (empty($rollid) or empty($remark) or empty($subcode)) {
				$alert->exec("All fields are compulsary!", "warning");
				return;
			}
			if (is_nan($rollid)) {
				$alert->exec("Roll ID must be a number!", "info");
				return;
			}
			$get_ac_sub_code = "SELECT ac_sub_code FROM subjects WHERE ac_session_id=$ac_sess_id AND sub_code='$subcode'";
			$get_ac_sub_code_run = mysqli_query($conn, $get_ac_sub_code);
			$ac_sub_code = mysqli_fetch_assoc($get_ac_sub_code_run)['ac_sub_code'];
			$insert_request = "INSERT into edit_tr_request(requester,roll_id,ac_sub_code,cat_flag,end_theory_flag,cap_flag,end_practical_flag,ia_flag,ie_flag,remarks) VALUES($requester,$rollid,$ac_sub_code,";
			for ($comp = 1; $comp <= 6; $comp++) {
				if (isset($_POST['tr_update_check' . $comp])) {
					$insert_request .= "1,";
				} else {
					$insert_request .= "0,";
				}
			}
			$insert_request .= "'$remark')";
			$insert_request_run = mysqli_query($conn, $insert_request);
			$alert = new alert();

			if ($insert_request_run) {
				$alert->exec("Request for change of marks submitted successfully!", "success");
			} else {
				$alert->exec("Unable to proceed with request! Please try again....", "danger");
			}
		}
	}
	function update_tr_main($conn)
	{
		if (isset($_POST['tr_update_done'])) {
			$input_safe = new input_check();
			$request_id = $input_safe->input_safe($conn, $_POST['tr_update_done']);
			mysqli_autocommit($conn, false);
			mysqli_begin_transaction($conn);
			$get_request_details = "SELECT * FROM edit_tr_request WHERE request_id=" . $request_id;
			$get_request_details_run = mysqli_query($conn, $get_request_details);
			if ($get_request_details_run) {
				$req_details = mysqli_fetch_assoc($get_request_details_run);
				$subcode = $req_details['ac_sub_code'];
				$enroll = "SELECT enrol_no FROM roll_list WHERE roll_id=" . $req_details['roll_id'];
				$enroll = mysqli_query($conn, $enroll);
				$enroll = mysqli_fetch_assoc($enroll)['enrol_no'];
				$rollid = $req_details['roll_id'];
				$components = array();
				if ($req_details['cat_flag'] == 1) {
					$_SESSION['marks1'] = $_POST['cat_marks'];
					$components[] = 1;
				} else if ($req_details['end_theory_flag'] == 1) {
					$_SESSION['marks2'] = $_POST['end_th_marks'];
					$components[] = 2;
				} else if ($req_details['cap_flag'] == 1) {
					$_SESSION['marks3'] = $_POST['cap_marks'];
					$components[] = 3;
				} else if ($req_details['end_practical_flag'] == 1) {
					$_SESSION['marks4'] = $_POST['end_pr_marks'];
					$components[] = 4;
				} else if ($req_details['ia_flag'] == 1) {
					$_SESSION['marks5'] = $_POST['ia_marks'];
					$components[] = 5;
				} else if ($req_details['ie_flag'] == 1) {
					$_SESSION['marks6'] = $_POST['ie_marks'];
					$components[] = 6;
				}
				foreach ($components as $comp) {
					$get_sub_id = "SELECT sub_id FROM component_distribution WHERE component_id=$comp AND sub_id IN(SELECT sub_id from sub_distribution WHERE ac_sub_code=$subcode)";
					$get_sub_id = mysqli_query($conn, $get_sub_id);
					$subid = mysqli_fetch_assoc($get_sub_id)['sub_id'];
					//updating score
					$update_score = "UPDATE $main.score SET marks=" . $_SESSION['marks' . $comp] . " WHERE roll_id=$rollid AND sub_id=$subid AND component_id=$comp";
					$update_score_run = mysqli_query($conn, $update_score);
					if ($update_score_run) {
						//success	
					}
				}
				//updating tr
				$update_fail = false;
				foreach ($components as $comp) {
					$get_sub_id = "SELECT sub_id FROM component_distribution WHERE component_id=$comp AND sub_id IN(SELECT sub_id from sub_distribution WHERE sub_code=$subcode)";
					$get_sub_id = mysqli_query($conn, $get_sub_id);
					$subid = mysqli_fetch_assoc($get_sub_id)['sub_id'];
					$get_credits = "SELECT credits_allotted FROM sub_distribution WHERE sub_id=$subid";
					$sub_id = mysqli_fetch_assoc(mysqli_query($conn, $get_credits));

					$get_score = "SELECT marks FROM score WHERE roll_id=$rollid AND component_id=$comp AND sub_id=$subid";
					$score = mysqli_fetch_assoc(mysqli_query($conn, $get_score))['marks'];
					switch ($comp) {
						case 1:
							$score = "SELECT marks FROM score WHERE roll_id=$rollid AND component_id=1 AND sub_id=$subid";
							$cat_cap_ia = mysqli_fetch_assoc(mysqli_query($conn, $score))['marks'];
							$score = "SELECT marks FROM score WHERE roll_id=$rollid AND component_id=2 AND sub_id=$subid";
							$end_sem = mysqli_fetch_assoc(mysqli_query($conn, $score))['marks'];

							$get_passing_marks = "SELECT passing_marks FROM component_distribution WHERE sub_id=" . $subid . " AND component_id=" . $comp;
							$get_passing_marks_run = mysqli_query($conn, $get_passing_marks);
							$passing_marks = mysqli_fetch_assoc($get_passing_marks_run)['passing_marks']; //$passing_marks['passing_marks']
							$check_fail_exists = "SELECT * FROM failure_report WHERE roll_id=$rollid AND sub_id=$subid AND component_id=$comp";
							$check_fail_exists = mysqli_query($conn, $check_fail_exists);

							if ($cat_cap_ia < $passing_marks) {
								$update_roll_list = "UPDATE roll_list SET atkt_flag=1 WHERE roll_id=" . $rollid;//Updating atkt_flag
								$update_roll_list_run = mysqli_query($conn, $update_roll_list);

								if (mysqli_num_rows($check_fail_exists) == 0) {
									$insert_failure_report = "INSERT INTO failure_report(roll_id, sub_id, component_id) 
									VALUES($rollid,$subid,$comp)";
									$insert_failure_report = mysqli_query($conn, $insert_failure_report);

								}
							} else {
								if (mysqli_num_rows($check_fail_exists) > 0) {
									$del_failure = "DELETE FROM failure_report WHERE roll_id=$rollid AND sub_id=$subid AND component_id=$comp";
									$del_failure_run = mysqli_query($conn, $del_failure);
								}
							}
							$total = $cat_cap_ia + $end_sem;
							$percentage = (($total * 100) / 100);
							if ($percentage >= 91 and $percentage <= 100) {
								$grade = 'O';
								$gp = 10;
								$cr = $sub_id['credits_allotted'];
								$gpv = $gp * $cr;
							} else if ($percentage >= 81 and $percentage < 91) {
								$grade = 'A+';
								$gp = 9;
								$cr = $sub_id['credits_allotted'];
								$gpv = $gp * $cr;
							} else if ($percentage >= 71 and $percentage < 81) {
								$grade = 'A';
								$gp = 8;
								$cr = $sub_id['credits_allotted'];
								$gpv = $gp * $cr;
							} else if ($percentage >= 61 and $percentage < 71) {
								$grade = 'B+';
								$gp = 7;
								$cr = $sub_id['credits_allotted'];
								$gpv = $gp * $cr;
							} else if ($percentage >= 51 and $percentage < 61) {
								$grade = 'B';
								$gp = 6;
								$cr = $sub_id['credits_allotted'];
								$gpv = $gp * $cr;
							} else if ($percentage >= 41 and $percentage < 51) {
								$grade = 'C';
								$gp = 5;
								$cr = $sub_id['credits_allotted'];
								$gpv = $gp * $cr;
							} else if ($percentage == 40) {
								$grade = 'P';
								$gp = 4;
								$cr = $sub_id['credits_allotted'];
								$gpv = $gp * $cr;
							} else if ($percentage < 40) {
								$grade = 'F';
								$gp = 0;
								$cr = 0;
								$gpv = $gp * $cr;
							}
							$update_tr = "UPDATE tr SET cat_cap=$cat_cap_ia, ia=NULL, end_sem=$end_sem, total=$total, percent=$percentage, grade='$grade', gp=$gp, cr=$cr, gpv=$gpv WHERE roll_id=$rollid AND sub_id=$subid";
							$update_tr_run = mysqli_query($conn, $update_tr);
							if (!$update_tr_run) {
								$update_fail = true;
							}
							break;

						case 2:
							$score = "SELECT marks FROM score WHERE roll_id=$rollid AND component_id=1 AND sub_id=$subid";
							$cat_cap_ia = mysqli_fetch_assoc(mysqli_query($conn, $score))['marks'];
							$score = "SELECT marks FROM score WHERE roll_id=$rollid AND component_id=2 AND sub_id=$subid";
							$end_sem = mysqli_fetch_assoc(mysqli_query($conn, $score))['marks'];

							$get_passing_marks = "SELECT passing_marks FROM component_distribution WHERE sub_id=" . $subid . " AND component_id=" . $comp;
							$get_passing_marks_run = mysqli_query($conn, $get_passing_marks);
							$passing_marks = mysqli_fetch_assoc($get_passing_marks_run)['passing_marks']; //$passing_marks['passing_marks']
							$check_fail_exists = "SELECT * FROM failure_report WHERE roll_id=$rollid AND sub_id=$subid AND component_id=$comp";
							$check_fail_exists = mysqli_query($conn, $check_fail_exists);

							if ($end_sem < $passing_marks) {
								$update_roll_list = "UPDATE roll_list SET atkt_flag=1 WHERE roll_id=" . $rollid;//Updating atkt_flag
								$update_roll_list_run = mysqli_query($conn, $update_roll_list);

								if (mysqli_num_rows($check_fail_exists) == 0) {
									$insert_failure_report = "INSERT INTO failure_report(roll_id, sub_id, component_id) 
									VALUES($rollid,$subid,$comp)";
									$insert_failure_report = mysqli_query($conn, $insert_failure_report);

								}
							} else {
								if (mysqli_num_rows($check_fail_exists) > 0) {
									$del_failure = "DELETE FROM failure_report WHERE roll_id=$rollid AND sub_id=$subid AND component_id=$comp";
									$del_failure_run = mysqli_query($conn, $del_failure);
								}
							}
							$total = $cat_cap_ia + $end_sem;
							$percentage = (($total * 100) / 100);
							if ($percentage >= 91 and $percentage <= 100) {
								$grade = 'O';
								$gp = 10;
								$cr = $sub_id['credits_allotted'];
								$gpv = $gp * $cr;
							} else if ($percentage >= 81 and $percentage < 91) {
								$grade = 'A+';
								$gp = 9;
								$cr = $sub_id['credits_allotted'];
								$gpv = $gp * $cr;
							} else if ($percentage >= 71 and $percentage < 81) {
								$grade = 'A';
								$gp = 8;
								$cr = $sub_id['credits_allotted'];
								$gpv = $gp * $cr;
							} else if ($percentage >= 61 and $percentage < 71) {
								$grade = 'B+';
								$gp = 7;
								$cr = $sub_id['credits_allotted'];
								$gpv = $gp * $cr;
							} else if ($percentage >= 51 and $percentage < 61) {
								$grade = 'B';
								$gp = 6;
								$cr = $sub_id['credits_allotted'];
								$gpv = $gp * $cr;
							} else if ($percentage >= 41 and $percentage < 51) {
								$grade = 'C';
								$gp = 5;
								$cr = $sub_id['credits_allotted'];
								$gpv = $gp * $cr;
							} else if ($percentage == 40) {
								$grade = 'P';
								$gp = 4;
								$cr = $sub_id['credits_allotted'];
								$gpv = $gp * $cr;
							} else if ($percentage < 40) {
								$grade = 'F';
								$gp = 0;
								$cr = 0;
								$gpv = $gp * $cr;
							}
							$update_tr = "UPDATE tr SET cat_cap=$cat_cap_ia,ia=NULL, end_sem=$end_sem, total=$total, percent=$percentage, grade='$grade', gp=$gp, cr=$cr, gpv=$gpv WHERE roll_id=$rollid AND sub_id=$subid";
							$update_tr_run = mysqli_query($conn, $update_tr);
							if (!$update_tr_run) {
								$update_fail = true;
							}
							break;

						case 3:
							$score = "SELECT marks FROM score WHERE roll_id=$rollid AND component_id=3 AND sub_id=$subid";
							$cat_cap_ia = mysqli_fetch_assoc(mysqli_query($conn, $score))['marks'];
							$score = "SELECT marks FROM score WHERE roll_id=$rollid AND component_id=4 AND sub_id=$subid";
							$end_sem = mysqli_fetch_assoc(mysqli_query($conn, $score))['marks'];
							$score = "SELECT marks FROM score WHERE roll_id=$rollid AND component_id=5 AND sub_id=$subid";
							$cat_cap_ia += mysqli_fetch_assoc(mysqli_query($conn, $score))['marks'];
							$get_passing_marks = "SELECT passing_marks FROM component_distribution WHERE sub_id=" . $subid . " AND component_id=" . $comp;
							$get_passing_marks_run = mysqli_query($conn, $get_passing_marks);
							$passing_marks = mysqli_fetch_assoc($get_passing_marks_run)['passing_marks']; //$passing_marks['passing_marks']
							$check_fail_exists = "SELECT * FROM failure_report WHERE roll_id=$rollid AND sub_id=$subid AND component_id=$comp";
							$check_fail_exists = mysqli_query($conn, $check_fail_exists);

							if ($cat_cap_ia < $passing_marks) {
								$update_roll_list = "UPDATE roll_list SET atkt_flag=1 WHERE roll_id=" . $rollid;//Updating atkt_flag
								$update_roll_list_run = mysqli_query($conn, $update_roll_list);

								if (mysqli_num_rows($check_fail_exists) == 0) {
									$insert_failure_report = "INSERT INTO failure_report(roll_id, sub_id, component_id) 
									VALUES($rollid,$subid,$comp)";
									$insert_failure_report = mysqli_query($conn, $insert_failure_report);

								}
							} else {
								if (mysqli_num_rows($check_fail_exists) > 0) {
									$del_failure = "DELETE FROM failure_report WHERE roll_id=$rollid AND sub_id=$subid AND component_id=$comp";
									$del_failure_run = mysqli_query($conn, $del_failure);
								}
							}
							$total = $cat_cap_ia + $end_sem;
							$percentage = (($total * 100) / 100);
							if ($percentage >= 91 and $percentage <= 100) {
								$grade = 'O';
								$gp = 10;
								$cr = $sub_id['credits_allotted'];
								$gpv = $gp * $cr;
							} else if ($percentage >= 81 and $percentage < 91) {
								$grade = 'A+';
								$gp = 9;
								$cr = $sub_id['credits_allotted'];
								$gpv = $gp * $cr;
							} else if ($percentage >= 71 and $percentage < 81) {
								$grade = 'A';
								$gp = 8;
								$cr = $sub_id['credits_allotted'];
								$gpv = $gp * $cr;
							} else if ($percentage >= 61 and $percentage < 71) {
								$grade = 'B+';
								$gp = 7;
								$cr = $sub_id['credits_allotted'];
								$gpv = $gp * $cr;
							} else if ($percentage >= 51 and $percentage < 61) {
								$grade = 'B';
								$gp = 6;
								$cr = $sub_id['credits_allotted'];
								$gpv = $gp * $cr;
							} else if ($percentage >= 41 and $percentage < 51) {
								$grade = 'C';
								$gp = 5;
								$cr = $sub_id['credits_allotted'];
								$gpv = $gp * $cr;
							} else if ($percentage == 40) {
								$grade = 'P';
								$gp = 4;
								$cr = $sub_id['credits_allotted'];
								$gpv = $gp * $cr;
							} else if ($percentage < 40) {
								$grade = 'F';
								$gp = 0;
								$cr = 0;
								$gpv = $gp * $cr;
							}
							$update_tr = "UPDATE tr SET cat_cap=$cat_cap_ia,ia=NULL, end_sem=$end_sem, total=$total, percent=$percentage, grade='$grade', gp=$gp, cr=$cr, gpv=$gpv WHERE roll_id=$rollid AND sub_id=$subid";
							$update_tr_run = mysqli_query($conn, $update_tr);
							if (!$update_tr_run) {
								$update_fail = true;
							}
							break;

						case 4:
							$score = "SELECT marks FROM score WHERE roll_id=$rollid AND component_id=3 AND sub_id=$subid";
							$cat_cap_ia = mysqli_fetch_assoc(mysqli_query($conn, $score))['marks'];
							$score = "SELECT marks FROM score WHERE roll_id=$rollid AND component_id=4 AND sub_id=$subid";
							$end_sem = mysqli_fetch_assoc(mysqli_query($conn, $score))['marks'];
							$score = "SELECT marks FROM score WHERE roll_id=$rollid AND component_id=5 AND sub_id=$subid";
							$cat_cap_ia += mysqli_fetch_assoc(mysqli_query($conn, $score))['marks'];

							$get_passing_marks = "SELECT passing_marks FROM component_distribution WHERE sub_id=" . $subid . " AND component_id=" . $comp;
							$get_passing_marks_run = mysqli_query($conn, $get_passing_marks);
							$passing_marks = mysqli_fetch_assoc($get_passing_marks_run)['passing_marks']; //$passing_marks['passing_marks']
							$check_fail_exists = "SELECT * FROM failure_report WHERE roll_id=$rollid AND sub_id=$subid AND component_id=$comp";
							$check_fail_exists = mysqli_query($conn, $check_fail_exists);

							if ($end_sem < $passing_marks) {
								$update_roll_list = "UPDATE roll_list SET atkt_flag=1 WHERE roll_id=" . $rollid;//Updating atkt_flag
								$update_roll_list_run = mysqli_query($conn, $update_roll_list);

								if (mysqli_num_rows($check_fail_exists) == 0) {
									$insert_failure_report = "INSERT INTO failure_report(roll_id, sub_id, component_id) 
									VALUES($rollid,$subid,$comp)";
									$insert_failure_report = mysqli_query($conn, $insert_failure_report);

								}
							} else {
								if (mysqli_num_rows($check_fail_exists) > 0) {
									$del_failure = "DELETE FROM failure_report WHERE roll_id=$rollid AND sub_id=$subid AND component_id=$comp";
									$del_failure_run = mysqli_query($conn, $del_failure);
								}
							}
							$total = $cat_cap_ia + $end_sem;
							$percentage = (($total * 100) / 100);
							if ($percentage >= 91 and $percentage <= 100) {
								$grade = 'O';
								$gp = 10;
								$cr = $sub_id['credits_allotted'];
								$gpv = $gp * $cr;
							} else if ($percentage >= 81 and $percentage < 91) {
								$grade = 'A+';
								$gp = 9;
								$cr = $sub_id['credits_allotted'];
								$gpv = $gp * $cr;
							} else if ($percentage >= 71 and $percentage < 81) {
								$grade = 'A';
								$gp = 8;
								$cr = $sub_id['credits_allotted'];
								$gpv = $gp * $cr;
							} else if ($percentage >= 61 and $percentage < 71) {
								$grade = 'B+';
								$gp = 7;
								$cr = $sub_id['credits_allotted'];
								$gpv = $gp * $cr;
							} else if ($percentage >= 51 and $percentage < 61) {
								$grade = 'B';
								$gp = 6;
								$cr = $sub_id['credits_allotted'];
								$gpv = $gp * $cr;
							} else if ($percentage >= 41 and $percentage < 51) {
								$grade = 'C';
								$gp = 5;
								$cr = $sub_id['credits_allotted'];
								$gpv = $gp * $cr;
							} else if ($percentage == 40) {
								$grade = 'P';
								$gp = 4;
								$cr = $sub_id['credits_allotted'];
								$gpv = $gp * $cr;
							} else if ($percentage < 40) {
								$grade = 'F';
								$gp = 0;
								$cr = 0;
								$gpv = $gp * $cr;
							}
							$update_tr = "UPDATE tr SET cat_cap=$cat_cap_ia,ia=NULL, end_sem=$end_sem, total=$total, percent=$percentage, grade='$grade', gp=$gp, cr=$cr, gpv=$gpv WHERE roll_id=$rollid AND sub_id=$subid";
							$update_tr_run = mysqli_query($conn, $update_tr);
							if (!$update_tr_run) {
								$update_fail = true;
							}
							break;

						case 5:
							$score = "SELECT marks FROM score WHERE roll_id=$rollid AND component_id=3 AND sub_id=$subid";
							$cat_cap_ia = mysqli_fetch_assoc(mysqli_query($conn, $score))['marks'];
							$score = "SELECT marks FROM score WHERE roll_id=$rollid AND component_id=4 AND sub_id=$subid";
							$end_sem = mysqli_fetch_assoc(mysqli_query($conn, $score))['marks'];
							$score = "SELECT marks FROM score WHERE roll_id=$rollid AND component_id=5 AND sub_id=$subid";
							$ia = mysqli_fetch_assoc(mysqli_query($conn, $score))['marks'];

							$get_passing_marks = "SELECT passing_marks FROM component_distribution WHERE sub_id=" . $subid . " AND component_id=" . $comp;
							$get_passing_marks_run = mysqli_query($conn, $get_passing_marks);
							$passing_marks = mysqli_fetch_assoc($get_passing_marks_run)['passing_marks']; //$passing_marks['passing_marks']
							$check_fail_exists = "SELECT * FROM failure_report WHERE roll_id=$rollid AND sub_id=$subid AND component_id=$comp";
							$check_fail_exists = mysqli_query($conn, $check_fail_exists);
							if ($ia < $passing_marks) {

								$update_roll_list = "UPDATE roll_list SET atkt_flag=1 WHERE roll_id=" . $rollid;//Updating atkt_flag
								$update_roll_list_run = mysqli_query($conn, $update_roll_list);

								if (mysqli_num_rows($check_fail_exists) == 0) {
									$insert_failure_report = "INSERT INTO failure_report(roll_id, sub_id, component_id) 
									VALUES($rollid,$subid,$comp)";
									$insert_failure_report = mysqli_query($conn, $insert_failure_report);

								}
							} else {
								if (mysqli_num_rows($check_fail_exists) > 0) {
									$del_failure = "DELETE FROM failure_report WHERE roll_id=$rollid AND sub_id=$subid AND component_id=$comp";
									$del_failure_run = mysqli_query($conn, $del_failure);
								}
							}
							$total = $cat_cap_ia + $end_sem;
							$percentage = (($total * 100) / 100);
							if ($percentage >= 91 and $percentage <= 100) {
								$grade = 'O';
								$gp = 10;
								$cr = $sub_id['credits_allotted'];
								$gpv = $gp * $cr;
							} else if ($percentage >= 81 and $percentage < 91) {
								$grade = 'A+';
								$gp = 9;
								$cr = $sub_id['credits_allotted'];
								$gpv = $gp * $cr;
							} else if ($percentage >= 71 and $percentage < 81) {
								$grade = 'A';
								$gp = 8;
								$cr = $sub_id['credits_allotted'];
								$gpv = $gp * $cr;
							} else if ($percentage >= 61 and $percentage < 71) {
								$grade = 'B+';
								$gp = 7;
								$cr = $sub_id['credits_allotted'];
								$gpv = $gp * $cr;
							} else if ($percentage >= 51 and $percentage < 61) {
								$grade = 'B';
								$gp = 6;
								$cr = $sub_id['credits_allotted'];
								$gpv = $gp * $cr;
							} else if ($percentage >= 41 and $percentage < 51) {
								$grade = 'C';
								$gp = 5;
								$cr = $sub_id['credits_allotted'];
								$gpv = $gp * $cr;
							} else if ($percentage == 40) {
								$grade = 'P';
								$gp = 4;
								$cr = $sub_id['credits_allotted'];
								$gpv = $gp * $cr;
							} else if ($percentage < 40) {
								$grade = 'F';
								$gp = 0;
								$cr = 0;
								$gpv = $gp * $cr;
							}
							$update_tr = "UPDATE tr SET cat_cap=$cat_cap_ia, ia=NULL, end_sem=$end_sem, total=$total, percent=$percentage, grade='$grade', gp=$gp, cr=$cr, gpv=$gpv WHERE roll_id=$rollid AND sub_id=$subid";
							$update_tr_run = mysqli_query($conn, $update_tr);
							if (!$update_tr_run) {
								$update_fail = true;
							}
							break;

						case 6:
							$score = "SELECT marks FROM score WHERE roll_id=$rollid AND component_id=6 AND sub_id=$subid";
							$ie = mysqli_fetch_assoc(mysqli_query($conn, $score))['marks'];

							$get_passing_marks = "SELECT passing_marks FROM component_distribution WHERE sub_id=" . $subid . " AND component_id=" . $comp;
							$get_passing_marks_run = mysqli_query($conn, $get_passing_marks);
							$passing_marks = mysqli_fetch_assoc($get_passing_marks_run)['passing_marks']; //$passing_marks['passing_marks']
							$check_fail_exists = "SELECT * FROM failure_report WHERE roll_id=$rollid AND sub_id=$subid AND component_id=$comp";
							$check_fail_exists = mysqli_query($conn, $check_fail_exists);

							if ($ie < $passing_marks) {
								$update_roll_list = "UPDATE roll_list SET atkt_flag=1 WHERE roll_id=" . $rollid;//Updating atkt_flag
								$update_roll_list_run = mysqli_query($conn, $update_roll_list);

								if (mysqli_num_rows($check_fail_exists) == 0) {
									$insert_failure_report = "INSERT INTO failure_report(roll_id, sub_id, component_id) 
									VALUES($rollid,$subid,$comp)";
									$insert_failure_report = mysqli_query($conn, $insert_failure_report);

								}
							} else {
								if (mysqli_num_rows($check_fail_exists) > 0) {
									$del_failure = "DELETE FROM failure_report WHERE roll_id=$rollid AND sub_id=$subid AND component_id=$comp";
									$del_failure_run = mysqli_query($conn, $del_failure);
								}
							}
							$total = $ie;
							$percentage = (($total * 100) / 100);
							if ($percentage >= 91 and $percentage <= 100) {
								$grade = 'O';
								$gp = 10;
								$cr = $sub_id['credits_allotted'];
								$gpv = $gp * $cr;
							} else if ($percentage >= 81 and $percentage < 91) {
								$grade = 'A+';
								$gp = 9;
								$cr = $sub_id['credits_allotted'];
								$gpv = $gp * $cr;
							} else if ($percentage >= 71 and $percentage < 81) {
								$grade = 'A';
								$gp = 8;
								$cr = $sub_id['credits_allotted'];
								$gpv = $gp * $cr;
							} else if ($percentage >= 61 and $percentage < 71) {
								$grade = 'B+';
								$gp = 7;
								$cr = $sub_id['credits_allotted'];
								$gpv = $gp * $cr;
							} else if ($percentage >= 51 and $percentage < 61) {
								$grade = 'B';
								$gp = 6;
								$cr = $sub_id['credits_allotted'];
								$gpv = $gp * $cr;
							} else if ($percentage >= 41 and $percentage < 51) {
								$grade = 'C';
								$gp = 5;
								$cr = $sub_id['credits_allotted'];
								$gpv = $gp * $cr;
							} else if ($percentage == 40) {
								$grade = 'P';
								$gp = 4;
								$cr = $sub_id['credits_allotted'];
								$gpv = $gp * $cr;
							} else if ($percentage < 40) {
								$grade = 'F';
								$gp = 0;
								$cr = 0;
								$gpv = $gp * $cr;
							}
							$update_tr = "UPDATE tr SET ie=$ie, total=$total, percent=$percentage, grade='$grade', gp=$gp, cr=$cr, gpv=$gpv WHERE roll_id=$rollid AND sub_id=$subid";
							$update_tr_run = mysqli_query($conn, $update_tr);
							if (!$update_tr_run) {
								$update_fail = true;
							}
							break;
					}
					$total_earned_gpv = "SELECT gpv,cr FROM tr WHERE roll_id=$rollid";
					$total_earned_gpv = mysqli_query($conn, $total_earned_gpv);
					$total_cr_allot = 0;
					$total_earn_gpv = 0;
					$total_cr_earned = 0;
					while ($res = mysqli_fetch_assoc($total_earned_gpv)) {
						$total_cr_earned += $res['cr'];
						$total_earn_gpv += $res['gpv'];
					}
					$get_total_cr = "SELECT credits_allotted FROM sub_distribution WHERE sub_code IN
					(SELECT sub_code FROM subjects WHERE course_id IN 
					(SELECT course_id FROM students WHERE enrol_no IN
					(SELECT enrol_no FROM roll_list WHERE roll_id=$rollid)))";
					$get_total_cr_run = mysqli_query($conn, $get_total_cr);
					while ($cred = mysqli_fetch_assoc($get_total_cr_run)) {
						$total_cr_allot += $cred['credits_allotted'];
					}
					$sgpa = $total_earn_gpv / $total_cr_allot;
					$update_exam_summary = "UPDATE exam_summary SET total_credits_earned=$total_cr_earned,total_gpv_earned=$total_earn_gpv,sgpa=$sgpa WHERE roll_id=$rollid";
					$update_exam_summary_run = mysqli_query($conn, $update_exam_summary);
					if (!$update_exam_summary_run) {
						$update_fail = true;
					}
					$check_atkt_flag = "SELECT count(*) FROM failure_report WHERE roll_id=$rollid";
					$check_atkt_flag = mysqli_query($conn, $check_atkt_flag);
					if (mysqli_fetch_assoc($check_atkt_flag)['count(*)'] == 0) {
						$update_atkt = "UPDATE roll_list SET atkt_flag=0 WHERE roll_id=$rollid";
						$update_atkt = mysqli_query($conn, $update_atkt);
					}
					$alert = new alert();
					$_SESSION['enrollment'] = $enroll;
					if ($update_fail) {
						mysqli_rollback($conn);
						$_SESSION['tr_updated'] = false;
						header('location: useroptions');
					} else {
						$update_status = "UPDATE edit_tr_request SET status=3 WHERE request_id=$request_id";
						$update_status_run = mysqli_query($conn, $update_status);
						mysqli_commit($conn);
						mysqli_autocommit($conn, true);
						$_SESSION['tr_updated'] = true;
						header('location: useroptions');
					}

				}

			}
		}
	}
}
class dashboard
{
	function display($name, $options, $href, $last_option)
	{
		echo ('<div id="custom-bootstrap-menu" class="navbar navbar-default " role="navigation" style="z-index:200">
		<div class="container-fluid">
			<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>                        
		  	</button>
			<a class="navbar-brand" href="#">Welcome, <b>' . $name . '</b></a>	
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav">
			
			<li id="refresh" onclick="window.location.reload(false)"><a href="#">Refresh <i class="glyphicon glyphicon-refresh"></i></a></li>
			<li id="" ><a>');
		require("config.php");
		if (isset($_SESSION['current_course_id'])) {
			$get_course_name = "SELECT course_name FROM courses WHERE course_id=" . $_SESSION['current_course_id'];
			$get_course_name_run = mysqli_query($conn, $get_course_name);
			if ($get_course_name_run) {
				$course_name = mysqli_fetch_assoc($get_course_name_run);
				echo ($course_name['course_name']);
			}
		}
		mysqli_close($conn);
		echo ('</a></li>
		  </ul>
				<ul class="nav navbar-nav navbar-right">
				<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Options <span class="caret"></span></a>
				<ul class="dropdown-menu">
			
				');
		$i = 0;
		foreach ($options as $option) {
			echo ('<li><a href="' . $href[$i] . '">' . $option . '</a></li>
					');
			$i++;
		}
		echo ('	</ul>
			  </li>
			  <li><a href="mailto:coe@suas.ac.in"><i class="glyphicon glyphicon-envelope" style=""></i> ' . $last_option . '</a></li>
				</ul>
				</div>
		</div>
	</div>');
	}
	function display_super_dashboard($name, $options, $href, $last_option)
	{
		echo ('<div id="custom-bootstrap-menu" class="navbar navbar-default " role="navigation" style="z-index:200">
		<div class="container-fluid">
			<div class="navbar-header"><a class="navbar-brand">Welcome, <b>' . $name . '</b> </a>
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>                        
		  	</button>
			</div>

			<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav">
			
			<li id="refresh" onclick="window.location.reload(false)"><a href="#">Refresh <i class="glyphicon glyphicon-refresh"></i></a></li>
		  </ul>
				<ul class="nav navbar-nav navbar-right">

				<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"> <i class="glyphicon glyphicon-cog"></i> Settings <span class="caret"></span></a>
				<ul class="dropdown-menu">
				');
		$i = 0;
		foreach ($options as $option) {
			echo ('<li><a href="' . $href[$i] . '">' . $option . '</a></li>
					');
			$i++;
		}
		echo ('	
		</ul>
			  </li>
			  <li><a href="#" data-toggle="modal" data-target="#mailModal"><i class="glyphicon glyphicon-envelope" style=""></i> Contact Operators </a></li>
			  </ul>
			</div>
		</div>
	</div>');
	}

}
class conversion
{
	function numberToRomanRepresentation($number)
	{
		$map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
		$returnValue = '';
		while ($number > 0) {
			foreach ($map as $roman => $int) {
				if ($number >= $int) {
					$number -= $int;
					$returnValue .= $roman;
					break;
				}
			}
		}
		return $returnValue;
	}
}
class validate
{
	function conf_logged_in()
	{
		if (!isset($_SESSION['operator_id'])) {
			header('location: /ems/index');
		} else {
			//echo ('<script>startTimer();</script>');
		}
	}
	function conf_logged_in_super()
	{
		if (!isset($_SESSION['super_admin_id'])) {
			header('location: /ems/index');
		} else {
			//echo ('<script>startTimer();</script>');
		}
	}
}

class change_password
{
	public function execute($conn)
	{
		if (isset($_POST['change_password'])) {
			$pass_input_check = new input_check();
			$entered_cur_password = md5($pass_input_check->input_safe($conn, $_POST['cur_pass']));
			$new_password = md5($pass_input_check->input_safe($conn, $_POST['new_pass']));
			$confirm_new_password = md5($pass_input_check->input_safe($conn, $_POST['retype_pass']));
			$username = md5($pass_input_check->input_safe($conn, $_POST['username']));
			$super_user_id = $_SESSION['super_admin_id'];
			$get_pass = "SELECT * FROM super_admin"; //taking out current password from database
			$get_pass_run = mysqli_query($conn, $get_pass);
			$pass = $get_pass_run->fetch_assoc();
			$cur_password = $pass['super_admin_password'];
			$cur_username = $pass['super_admin_username'];
			$alert = new alert();
			if ($cur_password != $entered_cur_password or $username != $cur_username) {
				$alert->exec("Incorrect username or password!", "warning");
			} else if (empty($entered_cur_password)) {
				$alert->exec("Please enter you current password!", "info");
			} else if ($new_password != $confirm_new_password) {
				$alert->exec("Passwords do not match!", "info");
			} else if ($new_password == $entered_cur_password) {
				$alert->exec("Please select a different new password!", "warning");
			} else {
				$update_query = "UPDATE  super_admin SET super_admin_password='$new_password' WHERE super_admin_id=" . $super_user_id;
				$update_run = mysqli_query($conn, $update_query);
				if ($update_run) {
					session_destroy();
					echo "<script type='text/javascript'>document.location.href='/ems/index';</script>";
				} else {
					$alert->exec("Unable to change password! Please try again..", "danger");
				}
			}

		}
	}
}

class show_enroll
{
	function set_enrol_session($conn)
	{
		$semester = $_SESSION['selected_semester'];
		$current_course = $_SESSION['current_course_id'];
		$get_enrol_query = "SELECT r.enrol_no from roll_list r,students s where s.enrol_no=r.enrol_no AND semester=" . $semester . " AND course_id=" . $current_course;
		$get_enrol_run = mysqli_query($conn, $get_enrol_query);
		$i = 1;
		while ($get_enrol_result = mysqli_fetch_assoc($get_enrol_run)) {
			$_SESSION['enrol'][$i] = $get_enrol_result['enrol_no'];
			$i++;
		}

	}
	function display()
	{
		echo ('
        <form action="" method="post">
        <div class="search-bar">
                <div class="input-group input-group-lg">                
            <div class="input-group-addon">
                <select name="" id="erno" onclick="showres()">
                ');
		foreach ($_SESSION['enrol'] as $value) {
			echo ('<option value=' . $value . '>' . $value . '</option>');
		}
		echo ('</select>
            </div>
                <input type="text" name="txtsearch" id="enrol" class="form-control" style="text-align: center" placeholder="Search by Enrollment number">
                <div class="input-group-addon"><button type="submit" id="go" name="btnsearch">Search <i class="glyphicon glyphicon-chevron-right"></i></button></div>
            </div>
        </div>');

	}
}
class search
{
	function search_roll($conn)
	{
		if (isset($_POST['btnsearch'])) {
			$found = false;
			$search_qry = "SELECT roll_id from roll_list WHERE enrol_no='" . $_POST['txtsearch'] . "'";
			$search_qry_run = mysqli_query($conn, $search_qry);
			if ($search_qry_run) {
				$search_qry_result = mysqli_fetch_assoc($search_qry_run);
				$j = 1;
				foreach ($_SESSION['valid_roll'] as $roll) {
					if ($roll == $search_qry_result['roll_id']) {
						$_SESSION['pointer'] = $j;
						$found = true;
						break;
					}
					$j++;
				}
				if (!$found) {
					$alert = new alert();
					$alert->exec("Enrollment number does not match Roll List! Please check again.", "warning");
				}
			} else {
				$alert = new alert();
				$alert->exec("No result found! Please check enrollment number....", "danger");

			}
		}

	}
	function search_roll_2($conn)
	{
		if (isset($_SESSION['view_enroll'])) {
			if (isset($_SESSION['pointer'])) {
				unset($_SESSION['pointer']);
			}
			$initial = new initial();
			$initial->initialise($conn);

			$found = false;
			$search_qry = "SELECT roll_id from roll_list WHERE enrol_no='" . $_SESSION['view_enroll'] . "'";
			$search_qry_run = mysqli_query($conn, $search_qry);
			if ($search_qry_run) {
				$search_qry_result = mysqli_fetch_assoc($search_qry_run);
				$j = 1;
				foreach ($_SESSION['valid_roll'] as $roll) {
					if ($roll == $search_qry_result['roll_id']) {
						$_SESSION['pointer'] = $j;
						$found = true;
						break;
					}
					$j++;
				}
				if (!$found) {
					$alert = new alert();
					$alert->exec("Enrollment number does not match Roll List! Please check again.", "warning");
				}
			} else {
				$alert = new alert();
				$alert->exec("No result found! Please check enrollment number....", "danger");
			}
			unset($_SESSION['view_enroll']);
		}
	}

}
class students
{
	function display($conn)
	{
		if (isset($_POST['filter'])) {
			switch ($_POST['filter']) {
				case 'enroll':
					$_SESSION['order_field'] = "enrol_no";
					break;

				case 'name':
					$_SESSION['order_field'] = "name";
					break;

				case 'father':
					$_SESSION['order_field'] = "father_name";
					break;

				case 'year':
					$_SESSION['order_field'] = "from_year";
					break;

				default:
					$_SESSION['order_field'] = "enrol_no";
					break;
			}
		} else {
			$_SESSION['order_field'] = "enrol_no";
		}
		$current_course = $_SESSION['current_course_id'];
		$get_students = "SELECT s.*,rl.* FROM students s, roll_list rl WHERE s.enrol_no=rl.enrol_no and rl.semester=" . $_SESSION['selected_semester'] . " AND course_id=$current_course order by s." . $_SESSION['order_field'];
		$get_students_run = mysqli_query($conn, $get_students);
		echo ('
		<div class="cr_container style="font-family: "Helvetica Neue", Helvetica, Arial, serif;">
		<div class="filter">
		<div class="form-group">
			<label for="filter_box"><b>Filter By:</b></label>
			<form action="" method="post">
			<select name="filter" id="filter_box" class="form-control" type="submit" onchange="this.form.submit()">
			<option value="enroll">Enrollment Number</option>	
			<option value="name">Name</option>
				<option value="father">Semester</option>
				<option value="year">Year</option>
			</select>
			</form>
		</div>
	</div>
		<form action="generate" method="post">
		<div class="list" style="font-family: "Helvetica Neue", Helvetica, Arial, serif !important">
			<table class="table table-striped">
				<thead>
				<tr>
					<th>Enrollment Number</th>
					<th>Name</th>
					<th>Semester</th>
					<th>Enrolled Year</th>
					<th>Marks Entered</th>
					<th>View Marks</th>
				</tr>
				</thead>
				');

		while ($student = mysqli_fetch_assoc($get_students_run)) {
			echo ('<tr>
			<td>' . $student['enrol_no'] . '</td>
			<td>' . $student['first_name'] . " " . $student['middle_name'] . " " . $student['last_name'] . '</td>
			<td>' . $student['semester'] . '</td>
			<td>' . $student['from_year'] . '</td>
			<td>');
			if ($student['marks_entered_flag'] == 1) {
				echo ('<i class="glyphicon glyphicon-ok" style="color: green"></i>');
			} else {
				echo ('<i class="glyphicon glyphicon-remove" style="color: red"></i>');
			}
			echo ('
			</td>

			<td>');
			if ($student['marks_entered_flag'] == 1) {
				echo ('<button type="submit" class="noborder" name="generatetr" value="' . $student['roll_id'] . '"><i class="glyphicon glyphicon-new-window" style="color: navy"></i>
				</button>');
			} else {
		/*Ye dikkat dega isse roll id karna hai!*/ echo ('<button type="submit" class="noborder" name="feednow" value="' . $student['enrol_no'] . '">Feed Now <i class="glyphicon glyphicon-edit" style="color: navy"></i>
				</button>');
			}
			echo ('
			</form>
				
			 </td>		
		</tr>');
		}
		echo ('
		</table>
		</div>
		</form>
	</div>');
	}
	function gotofeed($conn)
	{
		if (isset($_POST['feednow'])) {
			$_SESSION['view_enroll'] = $_POST['feednow'];
			header('location: feed');
		}
	}
	function disp_tr($conn)
	{
		if (isset($_POST['generatetr'])) {
			$tr_data = "SELECT t.*,sn.* from tr t,subjects s, subject_name sn where t.sub_id=s.subject_id and s.sub_code=sn.sub_code and roll_id=" . $_POST['generatetr'];
			$tr_data_run = mysqli_query($conn, $tr_data);
			if ($tr_data_run) {
				echo ('<div class="trr">
			<table class="table table-striped">
				<tr>
					<th style="vertical-align:middle">Paper Code</th>
					<th style="vertical-align:middle">Paper Name</th>
					<th style="vertical-align:middle">Maximum Marks (Th;Pr)</th>
					<th style="vertical-align:middle">CAT;CAP;IA<br> 50;40;20</th>
					<th style="vertical-align:middle">Total <br> Th; Pr<br> 100;100</th>
					<th style="vertical-align:middle">Per (%)</th>
					<th style="vertical-align:middle">Grade</th>
					<th style="vertical-align:middle">GP.</th>
					<th style="vertical-align:middle">Cr.</th>
					<th style="vertical-align:middle">GPV.</th>
				</tr>');
				$i = 0;
				while ($row = mysqli_fetch_assoc($tr_data_run)) {
					echo ('<tr style="vertical-align:middle">
						<td>' . $row['sub_code'] . '</td>
						<td style="vertical-align:middle">' . $row['sub_name'] . '</td>
						<td style="vertical-align:middle">100</td>
						<td>' . $row['cat_cap_ia'] . '</td>
						<td>' . $row['total'] . '</td>
						<td>' . $row['percentage'] . '</td>
						<td>' . $row['grade'] . '</td>
						<td>' . $row['gp'] . '</td>
						<td>' . $row['cr'] . '</td>
						<td>' . $row['gpv'] . '</td>
					</tr>');
				}
				echo ('
			</table>
		</div>');
			} else {
				echo ("Unable to process query!");
			}
		}
	}

}
class data_table
{
	function get_subject_id($conn)
	{
		$current_course = $_SESSION['current_course_id'];
		$selected_sem = $_SESSION['selected_semester'];
		$get_subject_query = "SELECT s.*,sn.sub_name FROM subjects s,subject_name sn WHERE s.sub_code=sn.sub_code and course_id=$current_course AND semester=$selected_sem";
		$get_subject_run = mysqli_query($conn, $get_subject_query);
		$i = 0;
		while ($get_subject_result = mysqli_fetch_assoc($get_subject_run)) {
			$_SESSION['sub_code'][$i] = $get_subject_result['sub_code'];
			$_SESSION['subject_list'][$i] = $get_subject_result['sub_name'];
			$_SESSION['practical_flag'][$i] = $get_subject_result['practical_flag'];//chayan left it here
			$_SESSION['sub_id'][$i] = $get_subject_result['subject_id'];
			$_SESSION['credits_allotted'][$i] = $get_subject_result['credits_allotted'];
			$i++;
		}
	}
	function get_details($conn)
	{
		$temp_pointer = $_SESSION['valid_roll'][$_SESSION['pointer']];
		$get_query = "SELECT s.*,rl.* from students s,roll_list rl where s.enrol_no=rl.enrol_no and roll_id=$temp_pointer";
		$get_query_run = mysqli_query($conn, $get_query);
		if ($get_query_run) {
			$get_query_result = mysqli_fetch_assoc($get_query_run);
			$_SESSION['name'] = $get_query_result['first_name'] . " " . $get_query_result['middle_name'] . " " . $get_query_result['last_name'];
			$_SESSION['enroll'] = $get_query_result['enrol_no'];
			$_SESSION['marks_entered_flag'] = $get_query_result['marks_entered_flag'];
			$_SESSION['father_name'] = $get_query_result['father_name'];
			$_SESSION['current_semester'] = $get_query_result['semester'];
		} else {
			$alert = new alert();
			$alert->exec("Unable to process student detail query!", "danger");
		}

	}

	function print_table()
	{
		echo ('
		<div class="well well-lg" style="overflow:auto; margin-bottom:60px">
		<div class="details">
		<div class="stinfo">Enrollment Number: ');
		echo ($_SESSION['enroll']);
		echo ('</div>
        <div class="stinfo">Student Name: ' . $_SESSION['name'] . '</div>
        <div class="stinfo">Fathers Name:  ' . $_SESSION['father_name'] . '</div>
        </div>
				<div class="feed-container">');

		if ($_SESSION['marks_entered_flag'] == 1) {
			echo ('<div class="overlayfed">
					<div class="ok"><i class="glyphicon glyphicon-ok-circle"></i></div>
					<div class="okinfo">Student marks entered!<br>Please contact the super admin to make any changes...</div>
					</div>');
		}
		echo ('	<table class="record">
                        <tr>
                            <th>
                                <label>Subject Code</label>
                            </th>
                            <th>
                                <label>Subject Name</label>
                            </th>
                            <th>
                                <label>Theory/Practical</label>
                            </th>
                           
                            <th>
                                <label for="">CAT/CAP/IA</label>
                            </th>
                            <th>
                                <label for="">End Semester</label>
                            </th>
						</tr>
						');
		$i = 0;
		foreach ($_SESSION['sub_id'] as $subject) {
			echo ('<tr>
						<td>' . $_SESSION['sub_code'][$i] . '</td>
						<td>' . $_SESSION['subject_list'][$i] . '</td>
						<td>');
			if ($_SESSION['practical_flag'][$i] == 1) {
				echo ("Practical");
			} else {
				echo ("Theory");
			}
			echo ('</td>');
			$input = new input_field();

			if ($_SESSION['marks_entered_flag'] == 1) {
				if ($_SESSION['practical_flag'][$i] == 1) {
					echo ("<td>");
					$input->display_table("", "form-control", "number", $_SESSION['sub_id'][$i] . "cap_ia", "Enter CAP + IA", 0, 0, 60, 1, 60); //ASLIYAT PATA KARO KI MAXIMUM AUR MINIMUM VALUE KYA AAYEGI						
					echo ("</td>");
				} else {
					echo ("<td>");
					$input->display_table("", "form-control", "number", $_SESSION['sub_id'][$i] . "cat", "Enter CAT", 0, 0, 50, 1, 50); //ASLIYAT PATA KARO KI MAXIMUM AUR MINIMUM VALUE KYA AAYEGI						
					echo ("</td>");
				}

				if ($_SESSION['practical_flag'][$i] == 1) {
					echo ("<td>");
					$input->display_table("", "form-control", "number", $_SESSION['sub_id'][$i] . "endsempr", "End-Sem Practical Marks", 0, 0, 40, 1, 40);//ASLIYAT PATA KARO KI MAXIMUM AUR MINIMUM VALUE KYA AAYEGI						
					echo ("</td>");
				} else {

					echo ("<td>");
					$input->display_table("", "form-control", "number", $_SESSION['sub_id'][$i] . "endsemth", "End-Sem Theoretical Marks", 0, 0, 50, 1, 50);//ASLIYAT PATA KARO KI MAXIMUM AUR MINIMUM VALUE KYA AAYEGI						
					echo ("</td>");
				}
				echo ('</tr>');
				$i++;
			} else {
				if ($_SESSION['practical_flag'][$i] == 1) {
					echo ("<td>");
					$input->display_table("", "form-control", "number", $_SESSION['sub_id'][$i] . "cap_ia", "Enter CAP + IA", 0, 0, 60, 0, 60); //ASLIYAT PATA KARO KI MAXIMUM AUR MINIMUM VALUE KYA AAYEGI						
					echo ("</td>");
				} else {
					echo ("<td>");
					$input->display_table("", "form-control", "number", $_SESSION['sub_id'][$i] . "cat", "Enter CAT", 0, 0, 50, 0, 50); //ASLIYAT PATA KARO KI MAXIMUM AUR MINIMUM VALUE KYA AAYEGI						
					echo ("</td>");
				}

				if ($_SESSION['practical_flag'][$i] == 1) {
					echo ("<td>");
					$input->display_table("", "form-control", "number", $_SESSION['sub_id'][$i] . "endsempr", "End-Sem Practical Marks", 0, 0, 40, 0, 40);//ASLIYAT PATA KARO KI MAXIMUM AUR MINIMUM VALUE KYA AAYEGI						
					echo ("</td>");
				} else {

					echo ("<td>");
					$input->display_table("", "form-control", "number", $_SESSION['sub_id'][$i] . "endsemth", "End-Sem Theoretical Marks", 0, 0, 50, 0, 50);//ASLIYAT PATA KARO KI MAXIMUM AUR MINIMUM VALUE KYA AAYEGI						
					echo ("</td>");
				}
				echo ('</tr>');
				$i++;
			}
		}
		echo ('
						</table>
				');
		echo ('
				</div>
                <div class="footernav">');
		$button = new input_button();
		$input = new input_button();
		$button->display_btn("", "prev remove", "submit", "prev", "", '<i class="glyphicon glyphicon-arrow-left" id="left"></i> Previous');
		if ($_SESSION['marks_entered_flag'] == 1) {
			$button->display_btn("", "remove btn btn-success btn-lg disabled", "submit", "finish", "", 'Finish <i class="glyphicon glyphicon-saved"></i>');
		} else {
			$button->display_btn("", "remove btn btn-success btn-lg", "submit", "finish", "", 'Confirm and Submit <i class="glyphicon glyphicon-saved"></i>');
		}
		$button->display_btn("", "next remove", "submit", "next", "", 'Next <i class="glyphicon glyphicon-arrow-right" id="right"></i>');
		echo ('
		    	</div>
            </div>
    </form>');
	}
	function feed($conn)
	{
		if (isset($_POST['finish']) && $_SESSION['marks_entered_flag'] != 1) {
			$roll_id = $_SESSION['valid_roll'][$_SESSION['pointer']];
			$i = 0;
			//$valid=TRUE;
			$total_credits_earned = 0;
			$total_earned_gpv = 0;
			$cr = 0;
			foreach ($_SESSION['sub_id'] as $subjects) //HAR EK SUBJECT_ID KE LIYE MARKS FEED HO RAHE HAIN
			{
				if ($_SESSION['practical_flag'][$i] == 1) {
					if (!empty(($_POST[$subjects . "cap_ia"])) and !empty(($_POST[$subjects . "endsempr"]))) {
						$cat_cap_ia = $_POST[$subjects . "cap_ia"];
						$end_sem = $_POST[$subjects . "endsempr"];
					} else {
			//			$valid=FALSE;
						$alert = new alert();
						$alert->exec("Please validate all fields!", "danger");
					}
				} else {
					if (!empty($_POST[$subjects . "cat"]) and !empty($_POST[$subjects . "endsemth"])) {
						$cat_cap_ia = $_POST[$subjects . "cat"];
						$end_sem = $_POST[$subjects . "endsemth"];
					} else {
			//			$valid=FALSE;
						$alert = new alert();
						$alert->exec("Please validate all fields!", "danger");
					}
				}
				//if($valid){
				$total = $cat_cap_ia + $end_sem;
				$percentage = ($total / 100) * 100;

				if ($percentage >= 91 and $percentage <= 100) {
					$grade = 'O';
					$gp = 10;
					$cr = $_SESSION['credits_allotted'][$i];
					$gpv = $gp * $cr;
				} else if ($percentage >= 81 and $percentage < 91) {
					$grade = 'A+';
					$gp = 9;
					$cr = $_SESSION['credits_allotted'][$i];
					$gpv = $gp * $cr;
				} else if ($percentage >= 71 and $percentage < 81) {
					$grade = 'A';
					$gp = 8;
					$cr = $_SESSION['credits_allotted'][$i];
					$gpv = $gp * $cr;
				} else if ($percentage >= 61 and $percentage < 71) {
					$grade = 'B+';
					$gp = 7;
					$cr = $_SESSION['credits_allotted'][$i];
					$gpv = $gp * $cr;
				} else if ($percentage >= 51 and $percentage < 61) {
					$grade = 'B';
					$gp = 6;
					$cr = $_SESSION['credits_allotted'][$i];
					$gpv = $gp * $cr;
				} else if ($percentage >= 41 and $percentage < 51) {
					$grade = 'C';
					$gp = 5;
					$cr = $_SESSION['credits_allotted'][$i];
					$gpv = $gp * $cr;
				} else if ($percentage == 40) {
					$grade = 'P';
					$gp = 4;
					$cr = $_SESSION['credits_allotted'][$i];
					$gpv = $gp * $cr;
				} else if ($percentage < 40) {
					$grade = 'F';
					$gp = 0;
					$cr = 0;
					$gpv = $gp * $cr;
				}
				$insert_marks_query = "INSERT INTO tr(roll_id,sub_id,cat_cap_ia,end_sem,total,percentage,grade,gp,cr,gpv) 
											VALUES($roll_id,$subjects,$cat_cap_ia,$end_sem,$total,$percentage,'$grade',$gp,$cr,$gpv)";
				$insert_marks_run = mysqli_query($conn, $insert_marks_query);

				if ($insert_marks_run == true) {
					// DON'T DO ANYTHING
				} else {
					$alert = new alert();
					$alert->exec("Unable to insert record! Please try again or contact super admin!", "danger");
				}
				if ($percentage < 40)//FAIL CONDITION
				{
					$insert_fail_subject_query = "INSERT INTO failure_report(roll_id,subject_id) VALUES($roll_id,$subjects)";
					$insert_fail_subject_run = mysqli_query($conn, $insert_fail_subject_query);
					if ($insert_fail_subject_run) {
						//
					} else {
						//echo('Failure query nhi chali');
					}
				}
				$total_credits_earned = $total_credits_earned + $cr;
				$total_earned_gpv = $total_earned_gpv + $gpv;
				$i++;
			}
			$sgpa = $total_earned_gpv / $total_credits_earned;//ISKA BHI FORMULAE DEKHNA HAI
			if ($sgpa >= 4) {
				$result_pass_fail = 1;//1 = TRUE = PASS
			} else {
				$result_pass_fail = 0;//0 = FALSE = FAIL
			}
			$insert_exam_summary = "INSERT INTO exam_summary (roll_id,total_credits_earned,total_earned_gpv,sgpa,result_pass_fail) 
													VALUES($roll_id,$total_credits_earned,$total_earned_gpv,$sgpa,$result_pass_fail)";
			$insert_exam_summary_run = mysqli_query($conn, $insert_exam_summary);
			if ($insert_exam_summary_run) {
				//
			} else {
				//echo('exam_summary query nhi chali');
			}
			$get_sgpa = "SELECT sum(sgpa) as sgpa_sum FROM exam_summary WHERE roll_id=$roll_id GROUP BY roll_id"; //FOR CALULATING CGPA
			$get_sgpa_run = mysqli_query($conn, $get_sgpa);
			if ($get_sgpa_run) {
				$get_sgpa_result = mysqli_fetch_assoc($get_sgpa_run);
				$sgpa_sum = $get_sgpa_result['sgpa_sum'];
				$semester = $_SESSION['current_semester']; //SMESTER WISE MARKS ENTERY KARATE HAIN.....ACHHA RAHEGA....STARTING MEIN OPERATOR SE CHOOSE KARAO KI KONSE SEMESTER KE BACHHON KE MARKS FEED KARNE HAIN
				$cgpa = $sgpa / $semester;
				$enrol_no = $_SESSION['enroll'];
				$update_cgpa_summary = "UPDATE cgpa_summary SET cgpa=$cgpa, semester=$semester WHERE enrol_no='$enrol_no'"; //ACADEMIC YAER PE DISCUSSION KARNA HAI KI ISKI VALUE FROM-TO KE COMBINATION MEIN LENA HAI KYA
				$update_cgpa_run = mysqli_query($conn, $update_cgpa_summary);
				if ($update_cgpa_run) {
					$update_mks_e_flag = "UPDATE roll_list SET marks_entered_flag=1 WHERE roll_id=$roll_id";
					$update_mks_e_flag_run = mysqli_query($conn, $update_mks_e_flag);
					if ($update_mks_e_flag_run) {
						$alert = new alert();
						$alert->exec("Successful transaction! Marks entered", "success");
						$_SESSION['marks_entered_flag'] = 1;
						$_POST = array();
					} else {
						$alert = new alert();
						$alert->exec("Unsuccessful transaction: Marks entered flag cannot be changed to 1", "warning");
					}
				} else {
					
					//echo('cgpa_summary query nhi chali');
				}
			}
		}
	}
}


class csrf_token
{
	function hidden_input($token)
	{
		echo ('<input name="5d57af0a25794bf7516ef53d2de3a230" type="hidden" value="' . $token . '">');
	}
	function create_token()
	{
		$_SESSION['token'] = mt_rand(10000, 99999);
	}
}
?>