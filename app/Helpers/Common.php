<?php


function getUser($data)
{
 	return $data;
}

function getStudentStatus($status)
{
	$val = [
		'Pending' => config('examapp.student_status.pending'), 
		'Approved' => config('examapp.student_status.approved'), 
		'Rejected' => config('examapp.student_status.rejected'), 
	];

	foreach ($val as $key => $value) {
		if($status == $value){
			if($value == 2) {
				return '<span class="badge badge-light-danger">'.$key.'</span>';
			}
			return '<span class="badge badge-light-primary">'.$key.'</span>';
		}
	}
}

function getQuestionType($type)
{
	if($type == 1 ) {
		$val = 'Question Text Answer Text';
	}elseif($type == 2) {
		$val = 'Question Text Answer Image';
	}else {
		$val = 'Question Text & Image Answer Text';
	}		
	return $val;
}

function getExamStatus($status)
{
	if($status == 0) {
		$val = '<span class="badge badge-light-success">'.'Inctive'.'</span>';
	} else {
		$val = '<span class="badge badge-light-danger">'.'Active'.'</span>';
	}
	return $val;
}






