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






