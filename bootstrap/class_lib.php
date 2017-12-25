<?php 


class header
{
	function display($logo_location, $portal_name){ //pass values in the function 
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
		if($required_flag==1)
		{
			echo "<input id='$id' class='$class' type='$type' name='$name' placeholder='$placeholder' required>";
		}
		else
		{
			echo "<input id='$id' class='$class' type='$type' name='$name' placeholder='$placeholder'>";
		}
	}
	function display_w_js($id, $class, $type/*password or text or email*/, $name, $placeholder, $required_flag/*0 or 1 */,$funcin,$funcout )
	{
		if($required_flag==1)
		{
			echo "<input id='$id' class='$class' type='$type' name='$name' placeholder='$placeholder' required onfocus='$funcin' onfocusout='$funcout'>";
		}
		else
		{
			echo "<input id='$id' class='$class' type='$type' name='$name' placeholder='$placeholder' onfocus='$funcin' onfocusout='$funcout'>";
		}
	}
}

class input_button
{
	function display($id,$class,$type,$name,$onclick,$value)
	{
		echo "<input id='$id' class='$class' type='$type' name='$name' onclick='$onclick' value='$value'>";
	}
}

class input_check
{
	private $value;
	public function input_safe($conn,$post_input)
	{
		$this->value = (mysqli_real_escape_string($conn,htmlspecialchars(strip_tags($post_input))));
		
		return $this->value;
	}
}



class form
{

	function display($form_id,$form_class,$id_1,$class_1,$id_2,$class_2,$button_id,$button_class)
	{
		$user_name = new input_field();
		$password = new input_field();
		$submit = new input_button();
		
		echo "<form action='' method='post'>";
		echo('<div class="form-container">
		<div class="main">
			 <div class="login">
				 <div class="titleform">');
					 if($_SESSION['superflag']==TRUE){
						 echo("Super-Admin");
					 }else{
						 echo("Sign In");
					 }
				 echo('</div>
				 <div class="field" id="f1"> <span class="glyphicon glyphicon-user"></span>');
				 $user_name->display_w_js("","","text","username","Username","1","change()","change2()");
				 echo('</div>
				 <div class="field" id="f2"><span class="glyphicon glyphicon-lock"></span>');
				 $password->display_w_js("","","password","password","Password","1","change3()","change4()");
				 echo('</div>
				 <div class="field">');
				 $submit->display("","","submit","login","openover()","Sign In");
				 echo('</div>
			 </div>
			 </div>
			 </div>');
			 
			 echo '</form>';
			
	}
	 
}
class form_receive
{
	 public function login()
	{
		
		if (isset($_POST['login'])) //check button click
		{
			$form_input_check = new input_check();
			require("./config.php");
			$username = md5($form_input_check->input_safe($conn,$_POST['username'])); //preventing SQL injection //name of the input field should be username
			$password = md5($form_input_check->input_safe($conn,$_POST['password']));//preventing SQL injection //name of the input field should be password
			$login_query="SELECT * FROM operators WHERE operator_username='$username' AND operator_password='$password'";
			$login_query_run=mysqli_query($conn,$login_query);
			if($login_query_run){
				if(mysqli_num_rows($login_query_run)==1)
				{
					$operator_data=$login_query_run->fetch_assoc();
					session_start(); //creating session//values of id, name and username
					$_SESSION['operator_id']=$operator_data['operator_id'];
					$_SESSION['operator_name']=$operator_data['operator_name'];
					$_SESSION['operator_username']=$user_name;
					header ('location: home.php');		
				}
				else 
				{	
					echo "<script> alert ('Invalid Credentials')</script>";
				}
			}
			else{
				echo("Falid!");
			}
		}
	}
}

class change_password
{
	public function execute()
	{
		if ($conn->connect_error)
		{
			echo "<script> alert('Database connection error.')</script>"; 
			die();
		}

		
	
		if (isset($_POST['change_password'])) 
		{
			$pass_input_check = new input_check();
			
			$entered_cur_password = md5($pass_input_check->input_safe($_POST['cur_password']));
			$new_password = md5($pass_input_check->input_safe($_POST['new_password']));
			$confirm_new_password = md5($pass_input_check->input_safe($_POST['confirm_new_password']));
			
			$operator_id=$_SESSION['operator_id'];
			$get_pass="SELECT password FROM operators WHERE operator_id=$operator_id"; //taking out current password from database
			$get_pass_run=$conn->query($get_pass);
			$pass=$get_pass_run->fetch_assoc();
			$cur_password=$pass['password'];
			
		
			if ( $cur_password!=$entered_cur_password )
			{
				echo "<script> alert('Please re-enter the current password')</script>"; 
				die();
			}
			if ( empty( $entered_cur_password ) )
			{
				echo "<script> alert('Please enter the current password')</script>"; 
				die();
			}

		
			if ( $new_password != $confirm_new_password)
			{
				echo "<script> alert('New passwords do not match')</script>"; 
				die();
			}
	
			$update_query = "UPDATE  operators SET password='$new_password' WHERE operator_id=$operator_id " ;
			$update= $conn->query($update_query);
	
			if ( $update == TRUE)
			{
				$_SESSION['pass_changed']=1;
				header ('location: home.php');
			}
			else
			{
				echo "<script> alert('Error! Not able to change password. Please try again.')</script>"; 
			}

	
		}	
	}
}

class course
{
	function display()
	{
		$course_query="SELECT * FROM branch";
		$c_q_run=$conn->query($course_query);
		while ($courses=$c_q_run->fetch_assoc());
		{
			echo('<div><button id="" class="" onclick="" type="" value="" name="">'.$courses["branch_name"].'</button><div>');
		}
	}
}