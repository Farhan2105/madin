<?php

function id_session()
{
    $ci = &get_instance(); // pengganti this
    $id = $ci->session->userdata('id_pengguna');

    return $id;
}

function nama_session()
{
    $ci = &get_instance(); // pengganti this
    $nama = $ci->session->userdata('nama');

    return $nama;
}

function input_text($name)
{

    $inputan = '
            <div class="form-group <?= form_error("' . $name . '") ? "has-error" : null ?>
            <label class="control-label col-md-2 col-sm-2 col-xs-12">' . $name . '
            </label>
            <div class="col-md-7 col-sm-6 col-xs-12">
                <input type="text" class="form-control col-md-7 col-xs-12" name="' . $name . '" value="' .$name . '" >
                <?= form_error("' . $name . '"); ?>
            </div>
        </div>
    ';
    return $inputan;
}

// punya mas
function textInput($nama, $autocomplete,$col='12',$type="text", $class_input = "" )
{	
	$class_div = "controls";
	
	$label = ucfirst(str_replace("_", " ", $nama)) ;

	$inputan = '<div class="col-md-'.$col.'">
					<label for="'.$nama.'" class="control-label" >'.$label.' </label>
						<div class="'.$class_div.'">
							<input type="'.$type.'" class="'.$class_input.'" id="'.$nama.'" name="'.$nama.'" placeholder="Masukkan '.$label.'" autocomplete="'.$autocomplete.'" >
							<div class="vd_red error-string" id="error-'.$nama.'"></div>
						</div>
						
				</div>		';
	return $inputan;
}
